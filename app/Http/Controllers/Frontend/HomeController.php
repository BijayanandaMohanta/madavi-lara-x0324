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
    public function index(){
        return view('frontend.index');
    }
    public function about(){
        return view('frontend.about');
    }
    public function products(){
        return view('frontend.products');
    }
    public function product(){
        return view('frontend.product-detail');
    }
    public function menu(){
        return view('frontend.menu');
    }
    public function contact(){
        return view('frontend.contact');
    }
}
