<?php

namespace App\Http\Controllers\frontend;

use App\Ad;
use App\Banner;
use App\Cart;
use App\CartAddress;
use App\Category;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\ProductImage;
use App\ProductReview;
use App\Testimonial;
use App\VideoReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //
    public function index()
    {

        $banners = Banner::select('link', 'image')->orderBy('id','desc')->get();
        $testimonials = Testimonial::all();
        $ads = Ad::all();
        $videos = VideoReviews::all();
        $categories = Category::where('status', 1)->get();

        // New arrival products
        $newarrivalproducts = Product::select(['id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id'])
            ->whereRaw("FIND_IN_SET(1, tags)")
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)
            ->orderby('id', 'desc')->limit(10)->get();

        $newarrivalproducts->each(function ($product) {
            $product->totalReviews = $product->productReviews->count() ?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        });


        function fetchCompletedCarts($limit)
        {
            return Cart::where('status', 'Completed')
                ->orderBy('id', 'desc')
                ->limit($limit)
                ->with(['product' => function ($query) {
                    $query->select('id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id')
                        ->where('status', '1')
                        ->where(function ($query) {
                            $query->where('stock', '>', 0)
                                ->orWhere('out_of_stock', '=', 'Yes');
                        });
                }])
                ->get();
        }

        // Desired count of valid products
        $desiredCount = 10;
        $increment = 20; // Fetch more records initially
        $currentCount = 0;
        $finalResults = collect();

        while ($currentCount < $desiredCount) {
            $recentlysoldproductsfromcart = fetchCompletedCarts($increment)
                ->filter(function ($cart) {
                    return $cart->product !== null;
                });

            // Merge the valid cart products with the final results
            $finalResults = $finalResults->merge($recentlysoldproductsfromcart)->unique('product.id');
            $currentCount = $finalResults->count();
            $increment *= 2; // Increment the limit to fetch more records if needed
        }

        // Ensure we have only the desired count of valid cart products
        $recentlysoldproductsfromcart = $finalResults->take($desiredCount)->pluck('product');

        // Recently sold products as per tag
        $recentlysoldproducts = Product::select(['id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id'])
            ->whereRaw("FIND_IN_SET(2, tags)")
            ->where(function ($query) {
                $query->where('status', '1')
                    ->where(function ($query) {
                        $query->where('stock', '>', 0)
                            ->orWhere('out_of_stock', '=', 'Yes');
                    });
            })
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        // Merge both collections with cart products first
        $recentlysoldproducts = $recentlysoldproductsfromcart->merge($recentlysoldproducts)->unique('id');

        // Process each product
        $recentlysoldproducts->each(function ($product) {
            $product->totalReviews = $product->productReviews->count() ?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        });
        // dd($recentlysoldproducts);
        // Trending products
        $trendingproducts = Product::select(['id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id'])
            ->whereRaw("FIND_IN_SET(3, tags)")
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)
            ->orderby('id', 'desc')->limit(10)->get();
        // foreach ($trendingproducts as $products) {
        //     $product_image = ProductImage::where('product_id', $products->id)->orderBy('priority', 'asc')->first();
        //     $product_reviews = ProductReview::where('product_id', $products->id)->get();
        //     $products->totalReviews = $product_reviews->count();
        //     $products->image = $product_image->image ?? "no-image";
        // }
        $trendingproducts->each(function ($product) {
            $product->totalReviews = $product->productReviews->count() ?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        });

        // Best selling products as per cart
        $bestsellingproductsfromcart = Cart::select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->where('status', 'Completed')
            ->groupBy('product_id')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->with(['product' => function ($query) {
                $query->select('id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id');
            }])
            ->where('status', 1)
            ->get()
            ->pluck('product');
        //dd($bestsellingproductsfromcart);

        // Best selling products
        $bestsellingproducts = Product::select(['id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id'])
            ->whereRaw("FIND_IN_SET(4, tags)")
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)
            ->orderby('id', 'desc')->limit(10)->get()->except(['description', 'specification', 'warranty', 'highlights']);;

        // Merge both collections and filter out nulls
        $bestsellingproducts = $bestsellingproductsfromcart->merge($bestsellingproducts)->unique('id')->filter(function ($product) {
            return !is_null($product);
        });

        $bestsellingproducts->each(function ($product) {
            $product->totalReviews = $product->productReviews->count() ?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
            if($product->stock < 0){
                $product->stock = 0;
            }
        });

        // Categorywise products
        $categoriesofproducts = Category::where('display_home', 1)
            ->orderBy('priority', 'desc')
            ->with([
                'products' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('stock', '>', 0)
                            ->orWhere(function ($query) {
                                $query->where('stock', 0)
                                    ->where('out_of_stock', 'Yes');
                            });
                    });
                },
                'products.productimages' => function ($query) {
                    $query->orderBy('priority', 'asc');
                },
                'products.productReviews' // Eager load product reviews for rating calculations
            ])
            ->get()
            ->makeHidden(['description', 'specification', 'warranty', 'highlights']);

        // Pre-compute product images and calculated fields to avoid redundant calculations
        $categoriesofproducts->each(function ($category) {
            $category->products->each(function ($product) {
                // Compute fields once and store in the product object
                $product->image = $product->productimages->isNotEmpty()
                    ? $product->productimages->first()->image
                    : "no-image";

                $product->sumOfRatings = $product->productReviews->sum('rating');
                $product->totalReviews = $product->productReviews->count();
            });
        });


        // dd($categoriesofproducts->first()->products->first()->productimages->first()->image);
        // dd($categoriesofproducts);

        // Notify card in home
        $last_product_sold = Cart::where('status', 'Completed')
            ->whereHas('product', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('id', 'desc')->first();
       
        $last_product_order = Order::where('sid', ($last_product_sold->sid ?? null))->first();
        $last_product_user = Customer::where('id', ($last_product_order->customer_id ?? null))->first();

        // dd($last_product_sold->product_id);

        $last_sale_product_in_cart = Cart::where('status', 'Completed')->orderBy('id', 'desc')->first();
        $last_sale_product = Product::where('id', ($last_sale_product_in_cart->product_id ?? null))->first();
        $notify_product_image = ProductImage::where('product_id', ($last_sale_product->id ?? null))->first()->image;
        $last_product_order = Order::where('sid', ($last_sale_product_in_cart->sid ?? null))->first();
        $last_product_user = Customer::where('id', ($last_product_order->customer_id ?? null))->first();
        $last_product_address = CartAddress::where('sid', ($last_sale_product_in_cart->sid ?? null))->first();

        $date = $last_sale_product->updated_at ?? null;
        if ($date) {
            $formattedTime = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('h:i A');
            // Format the date separately
            $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('F d, Y');
        }


        $notify = new \stdClass;

        $notify->product_name = $last_sale_product->name ?? null;
        $notify->category = $last_sale_product->category->category ?? "";
        $notify->product_image = $notify_product_image ?? null;
        $notify->time_of_purchase = $formattedTime ?? '';
        $notify->date_of_purchase = $formattedDate ?? '';
        $notify->city = $last_product_address->city ?? null;
        $notify->customer_name = $last_product_address->first_name." ".$last_product_address->last_name ?? null;

        // dd($notify);

        // Total things
        $total_reviews = ProductReview::all(); // Fetch all reviews
        $total_reviews_count = $total_reviews->count(); // Count the total number of reviews
        $rating_sum = $total_reviews->sum('rating'); // Sum the ratings of all reviews

        // Calculate the average rating
        $rating_avg = $total_reviews_count > 0 ? number_format($rating_sum / $total_reviews_count, 2) : 0; // Format to 2 decimal places

        $total_product_sold = Cart::where('status', 'Completed')->sum("quantity"); // Sum the quantity of completed carts

        $summery = (object) [
            'total_reviews' => $total_reviews_count,
            'rating_avg' => $rating_avg,
            'total_product_sold' => $total_product_sold
        ];


        return view("frontend.index", compact('banners', 'testimonials', 'ads', 'videos', 'categories', 'newarrivalproducts', 'recentlysoldproducts', 'trendingproducts', 'categoriesofproducts', 'bestsellingproducts', 'notify', 'summery'));
    }
}
