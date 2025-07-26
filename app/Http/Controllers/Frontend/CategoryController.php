<?php

namespace App\Http\Controllers\frontend;

use App\Brand;
use App\Cart;
use App\Category;
use App\CategoryAd;
use App\Ccategory;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\ProductReview;
use App\Scategory;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    private function bestsellerproducts()
    {
        // Best selling products as per cart
        $bestsellingproductsfromcart = Cart::select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->where('status', 'Completed')
            ->groupBy('product_id')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->with(['product' => function ($query) {
                $query->select('id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id')->where('status', 1);
            }])
            ->get()
            ->pluck('product');

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
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        // return $bestsellingproducts;

        // Merge both collections and filter out nulls
        $bestsellingproducts = $bestsellingproductsfromcart->merge($bestsellingproducts)
            ->unique('id')
            ->filter(function ($product) {
                return !is_null($product);
            });

        $bestsellingproducts->each(function ($product) {
            $product->totalReviews = $product->productReviews->count()?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
            if($product->stock < 0){
                $product->stock = 0;
            }
        });

        return $bestsellingproducts;
    }
    //
    public function index($slug, Request $request)
    {
        // Best selling products as per cart
        $bestsellingproducts = $this->bestsellerproducts();

        $category = Category::where('slug', $slug)->with(['products.productimages'])->first();
        if (!$category) {
            return redirect()->route('home');
        }
        // dd($request->brands);
        // DB::enableQueryLog();
        $products = $category->products()
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->orderBy('id', 'desc')->where('status', 1);

        if ($request->has('brands') && $request->brands != '') {
            $brandArray = explode(',', $request->brands);
            $products = $products->whereIn('brand', $brandArray);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }


        // Execute and dump the query results
        $products = $products->paginate(18);
        // $queries = DB::getQueryLog();

        // dd($queries);


        foreach ($products as $product) {
            $product->totalReviews = $product->productReviews->count()?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        }
        $categoryads = CategoryAd::where('category_id', $category->id)->get();

        return view("frontend.category-list", compact('bestsellingproducts', 'category', 'categoryads', 'products'));
    }
    public function childcategory($slug, Request $request)
    {
        $bestsellingproducts = $this->bestsellerproducts();

        $category = Ccategory::where('slug', $slug)->with(['products.productimages'])->first();
        if (!$category) {
            return redirect()->route('home');
        }
        $products = $category->products()
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->orderBy('id', 'desc')->where('status', 1);

        // dd($products);

        if ($request->has('brands') && $request->brands != '') {
            $brandArray = explode(',', $request->brands);
            $products = $products->whereIn('brand', $brandArray);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }


        // Execute and dump the query results
        $products = $products->paginate(18);
        foreach ($products as $product) {
            $product->totalReviews = $product->productReviews->count()?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        }

        return view("frontend.child-category-list", compact('bestsellingproducts', 'category', 'products'));
    }
    public function subcategorylist($slug, Request $request)
    {
        $bestsellingproducts = $this->bestsellerproducts();

        $category = Scategory::where('slug', $slug)->with(['products.productimages'])->first();
        if (!$category) {
            return redirect()->route('home');
        }
        $products = $category->products()
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->orderBy('id', 'desc')->where('status', 1);

        if ($request->has('brands') && $request->brands != '') {
            $brandArray = explode(',', $request->brands);
            $products = $products->whereIn('brand', $brandArray);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }


        // Execute and dump the query results
        $products = $products->paginate(18);
        foreach ($products as $product) {
            $product->totalReviews = $product->productReviews->count()?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        }

        return view("frontend.sub-category-list", compact('bestsellingproducts', 'category', 'products'));
    }
    public function category($slug)
    {
        $subcategory = Scategory::where('slug', $slug)->first();
        $category = Category::where('id', $subcategory->category_id)->first();
        if (!$category) {
            return redirect()->route('home');
        }
        $subcategories = Scategory::where('category_id', $category->id)->with('childcategories')->get();
        // dd($subcategories);
        return view('frontend.category', compact('subcategories', 'category'));
    }
    public function shopbybrand(Request $request)
    {
        if ($request->has('brands') && $request->brands != '') {
            $brandArray = explode(',', $request->brands);
            $brands = Brand::whereIn('brand', $brandArray)->orderByDesc('created_at')->get();
        } else {
            $brands = Brand::orderByDesc('created_at')->get();
        }

        return view("frontend.shop-by-brand", compact('brands'));
    }

    public function shopbybrandlist($slug, Request $request)
    {
        $bestsellingproducts = $this->bestsellerproducts();

        $brand = Brand::where('slug', $slug)->first();
        if (!$brand) {
            return redirect()->route('home');
        }
        $products = Product::where('brand', $brand->brand)
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)->with('productimages')->orderby('id', 'desc');

        if ($request->has('min_price') && $request->has('max_price')) {
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Execute and dump the query results
        $products = $products->paginate(18);
        // $products = Product::where('brand', $brand->brand)->with('productimages')->orderby('id', 'desc')->paginate(18);
        foreach ($products as $product) {
            $product_reviews = ProductReview::where('product_id', $product->id)->get();
            $product->totalReviews = $product_reviews->count();
        }
        return view("frontend.brand-list", compact('bestsellingproducts', 'brand', 'products'));
    }


    public function brandproductlistfilter(Request $request)
    {
        $brands = $request->input('brands');
        $brandArray = explode(',', $brands);

        $bestsellingproducts = $this->bestsellerproducts();

        $products = Product::select(['id', 'name', 'brand', 'price', 'mrp', 'gst', 'stock', 'slug', 'mop', 'status', 'out_of_stock', 'min_stock', 'category_id', 'sub_category_id', 'child_category_id'])->whereIn('brand', $brandArray)->get();

        $products->each(function ($product) {
            $product->totalReviews = $product->productReviews->count()?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        });

        //dd($bestsellingproducts);

        return view("frontend.brand-product-list-filter", compact('bestsellingproducts','products'));
    }
    public function offer(Request $request)
    {
        $offerproductsQuery = Product::whereRaw("FIND_IN_SET(5, tags)")
            ->where(function ($query) {
                $query->where('stock', '>', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', 0)
                            ->where('out_of_stock', 'Yes');
                    });
            })
            ->where('status', 1)
            ->orderBy('id', 'desc');

        if ($request->has('brands') && $request->brands != '') {
            $brandArray = explode(',', $request->brands);
            $offerproductsQuery = $offerproductsQuery->whereIn('brand', $brandArray);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $offerproductsQuery->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Apply pagination directly on the query builder
        $offerproducts = $offerproductsQuery->paginate(18);

        foreach ($offerproducts as $product) {
            $product->totalReviews = $product->productReviews->count()?? 0;
            $product->image = $product->productimages->first()->image ?? "no-image";
            $product->sumOfRatings = $product->productReviews->sum('rating');
        }

        return view("frontend.offer", compact('offerproducts'));
    }
    public function loadMoreCategories(Request $request)
        {
            $offset = $request->input('offset', 0);
            $limit = $request->input('limit', 1); // Load one category at a time

            $categories = Category::with('products')->skip($offset)->take($limit)->get();

            if ($categories->isEmpty()) {
                return response()->json(['html' => '', 'end' => true]);
            }

            $html = view('frontend.partials_category', compact('categories'))->render();

            return response()->json(['html' => $html, 'end' => false]);
        }
}
