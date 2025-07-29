<?php

namespace App\Http\Controllers\frontend;

use App\Models\AboutUs;
use App\Models\Ad;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\Category;
use App\Models\Contact;
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
        if(!$slug) return redirect()->back();
        $product = Product::where('slug',$slug)->first();
        if(!$product) return redirect()->back();
        $similarproducts = $product->category->products()->where('id','!=',$product->id)->get();
        
        return view('frontend.product-detail',compact('product','similarproducts'));
    }
    public function menu(){
        $menus = Menu::all();
        return view('frontend.menu',compact('menus'));
    }
    public function contact(){
        $categories = Category::all();
        return view('frontend.contact',compact('categories'));
    }
    public function contact_save(Request $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->category = $request->category;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('success','Your message has been sent successfully.');
    }
}
