<?php

namespace App\Http\Controllers\frontend;

use App\Models\AboutUs;
use App\Models\Ad;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\Category;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\Testimonial;
use App\Models\VideoReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(){
        $banners = Banner::all();
        $categories = Category::all();
        $about = AboutUs::find(1);
        $ads = Ad::where('status',1)->get();
        $testimonials = Testimonial::all();
        return view('frontend.index',compact('banners','categories','about','ads','testimonials'));
    }
    public function about(){
        $about = AboutUs::find(1);
        $testimonials = Testimonial::all();
        return view('frontend.about',compact('about','testimonials'));
    }
    public function products($slug = null){
        if($slug)
        {
            $category = Category::where('slug',$slug)->first();
            $products = $category->products()->get();
        }
        else{
            $products = Product::where('status',1)->get();
        }
        return view('frontend.products',compact('products'));
    }
    public function product($slug = null){
        return view('frontend.product-detail');
    }
    public function menu(){
        $menus = Menu::all();
        return view('frontend.menu',compact('menus'));
    }
    public function contact(){
        return view('frontend.contact');
    }
}
