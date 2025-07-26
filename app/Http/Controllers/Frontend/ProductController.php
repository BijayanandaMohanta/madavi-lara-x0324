<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\Scategory;
use App\Category;
use App\ProductReview;
use App\Customer;
use App\Newsletter;
use App\Notify;
use App\Wishlist;
use App\TrackingToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\HelperController;

class ProductController extends Controller
{
    //
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->with('productimages')->first();

        if($product->status == 0){
            return redirect()->back();
        }

        if (!$product) {
            abort(404, "Product Not found!");
        }

        $wished = Session::has('customer_id') ? Wishlist::where('customer_id', Session::get('customer_id'))->where('product_id', $product->id)->count() : '';

        // dd($wished);

        $pid = $product->id;
        $relatedproducts = Product::select(['id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Exclude the current product
            ->where('status', 1)
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)
            ->orderby('id', 'desc')
            ->limit(15)
            ->with('productimages')
            ->get();

        $mostRelatedProducts = Product::select(['id', 'name','price', 'slug'])
        ->where('brand', $product->brand)
            ->where('sub_category_id', $product->sub_category_id)
            ->where('id', '!=', $product->id) // exclude the current product
            ->where('status', 1)
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)
            ->get();
        $relatedproducts->each(function ($product) {
            $product->totalReviews = $product->productReviews->count();
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        });

        // Fetch product reviews
        //print_r($product->id);die();
        $product_reviews = ProductReview::where('product_id', $product->id)->where('status', '1')->get();
        $totalReviews = $product_reviews->count();
        $sumOfRatings = $product_reviews->sum('rating'); // Sum of all ratings

        // Calculate rating percentages
        $ratingPercentages = [
            '5_star' => 0,
            '4_star' => 0,
            '3_star' => 0,
            '2_star' => 0,
            '1_star' => 0
        ];

        if ($totalReviews > 0) {
            $ratingPercentages['5_star'] = ($product_reviews->where('rating', 5)->count() / $totalReviews) * 100;
            $ratingPercentages['4_star'] = ($product_reviews->where('rating', 4)->count() / $totalReviews) * 100;
            $ratingPercentages['3_star'] = ($product_reviews->where('rating', 3)->count() / $totalReviews) * 100;
            $ratingPercentages['2_star'] = ($product_reviews->where('rating', 2)->count() / $totalReviews) * 100;
            $ratingPercentages['1_star'] = ($product_reviews->where('rating', 1)->count() / $totalReviews) * 100;
        }

       


        return view("frontend.product-view", compact(
            'product',
            'relatedproducts',
            'mostRelatedProducts',
            'totalReviews',
            'sumOfRatings',
            'ratingPercentages',
            'product_reviews',
            'pid',
            'wished'
        ));
    }

    // Real time search result

    public function realtime_search_result(Request $request)
    {
        $search = $request->input('search');
        $search = str_replace(' ', '%', $search);

        $results = Product::select(['id', 'name','price','slug', 'mop', 'status'])
        ->where(function ($query) {
            $query->where('stock', '>', 0);
        })
        ->where('name', 'like', "%{$search}%")->where('status', 1)->orderby('id', 'desc')->limit(15)->with('productimages')->get();

        $results->each(function ($product) {
            $product->image = $product->productimages->first()->image ?? "no-image";
        });
        // Return the results as HTML
        $html = view('frontend.layouts.search-result', compact('results'))->render();

        return response()->json(['html' => $html]);
    }



    public function search_result(Request $request)
    {
        // Retrieve the category based on the slug from the request
        $category = Category::where('slug', $request->slug)->first();

        $search = $request->keyword;
        $search = str_replace(' ', '%', $search);

        $products_data = Product::query()
            ->when($category, function ($query) use ($category) {
                // Add category filter if provided
                return $query->where('category_id', $category->id)
                    ->where('status', 1);
            })
            ->when($search, function ($query) use ($search) {
                // Add keyword filter if provided
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status',1)
            ->orderBy('id', 'desc');


        if ($request->has('brands') && $request->brands != '') {
            $brandArray = explode(',', $request->brands);
            $products_data = $products_data->whereIn('brand', $brandArray);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $products_data = $products_data->whereBetween('mop', [$request->min_price, $request->max_price]);
        }
        $products_data = $products_data->get();

        if (empty($request->slug) && empty($request->keyword)) {
            $products_data = array();
        } else if ($products_data->count() == 0) {
            $products_data = array();
        }

        // Load product images for each product
        foreach ($products_data as $product) {
            $product_image = ProductImage::where('product_id', $product->id)->orderBy('priority', 'asc')->first();
            $product->image = $product_image->image ?? "no-image";
        }
        // dd($products_data);
        return view("frontend.search-result", compact('products_data', 'category'));
    }

    public function rating_submit(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'review' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customer_id = Session::get('customer_id');
        $customer_data = Customer::Where('id', $customer_id)->first();
        // Create a new product review
        $productReview = new ProductReview();
        $productReview->product_id = $request->input('product_id');
        $productReview->rating = $request->input('rating');
        $productReview->review = $request->input('review');
        $productReview->customer_id = $customer_id;
        $productReview->name = $customer_data->name;
        $productReview->save();

        // Return a success response
        return response()->json(['success' => 'Review submitted successfully!']);
    }
    public function rating_update(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $review = ProductReview::where('customer_id', $customer_id)->where('product_id', $request->product_id)->first();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();
        return response()->json(['success' => 'Review updated successfully!']);
    }
    public function notify(Request $request)
    {
        if (Session::has('customer_id')) {
            $customer_id = Session::get('customer_id');
            $product_id = $request->product_id;
            $check = Notify::where('product_id', $product_id)->where('customer_id', $customer_id)->first();
            if (!$check) {
                $notify = new Notify();
                $notify->product_id = $product_id;
                $notify->customer_id = $customer_id;
                $notify->save();
                return response()->json(['status' => 'success', 'message' => 'Soon you will get notification on available stock']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'You have already requested for notification']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Please login first']);
        }
    }
    public function newsletter(Request $request)
    {
        $check = Newsletter::where('email', $request->email)->first();
        if (!$check) {
            $newsletter = new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->save();
            return response()->json(['status' => 'success', 'message' => 'You have successfully subscribed to our newsletter']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'You have already subscribed to our newsletter']);
        }
    }
    public function filterReviews(Request $request)
    {
        $rating = $request->rating; // Get the rating filter
        $productId = $request->product_id;
        $productReviews = ProductReview::where('product_id', $productId)
            ->where('rating', $rating)
            ->get();

        return response()->json($productReviews);
    }
    public function checkDelivery(Request $request)
    {
        $request->validate([
            'pincode' => 'required|digits:6', // Validate the pincode
        ]);

        $pickupPincode = '500084'; // Replace with your actual pickup pincode
        $deliveryPincode = $request->pincode;
        $weight = 1; // Weight in kilograms (customize as needed)
        $newtoken = (new HelperController)->get_token();
        $date = date("d-m-Y");

        // Save the token in the database
        $token = new TrackingToken;
        $token->token = $newtoken;
        $token->date = $date;
        $token->save();

        // Call the availability function
        $responseData = (new HelperController)->availability($newtoken, $deliveryPincode);

        

        // Check if data exists and extract the latest ETD
        $latestEtd = null;
        if (isset($responseData['data']['available_courier_companies'])) {
            foreach ($responseData['data']['available_courier_companies'] as $courier) {
                if (!empty($courier['etd'])) {
                    $etdDate = strtotime($courier['etd']);
                    if ($latestEtd === null || $etdDate > $latestEtd) {
                        $latestEtd = $etdDate;
                    }
                }
            }
        }

        if ($latestEtd) {
            $latestEtdFormatted = date("d-m-Y", $latestEtd);

            // Calculate the date two days after the latest ETD
            $newEtdDate = strtotime('+2 days', $latestEtd);
            $newEtdFormatted = date("d-m-Y", $newEtdDate);

            return response()->json([
                'success' => true,
                'latest_etd' => "Estimated Delivery Date between $latestEtdFormatted and $newEtdFormatted",
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Estimated Delivery Date Found.',
            ]);
        }
    }
}
