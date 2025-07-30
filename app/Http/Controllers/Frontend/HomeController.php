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
use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\Pages;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\VideoReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        $about = AboutUs::find(1);
        $ads = Ad::where('status', 1)->get();
        $testimonials = Testimonial::all();
        return view('frontend.index', compact('banners', 'categories', 'about', 'ads', 'testimonials'));
    }
    public function about()
    {
        $about = AboutUs::find(1);
        $testimonials = Testimonial::all();
        return view('frontend.about', compact('about', 'testimonials'));
    }
    public function products($slug = null, Request $request)
    {
        // Get selected statuses from query param 'status' as comma-separated string, trim spaces
        $statusFilter = $request->query('status');
        $statuses = [];

        if ($statusFilter) {
            // Remove any leading spaces and split by comma, then trim each status
            $statuses = array_map('trim', explode(',', $statusFilter));
        }

        if ($slug) {
            $category = Category::where('slug', $slug)->firstOrFail();

            $productsQuery = $category->products();

            // If there are statuses to filter by, apply whereIn
            if (!empty($statuses)) {
                $productsQuery->whereIn('current_status', $statuses);
            }

            $products = $productsQuery->get();
        } else {
            $productsQuery = Product::where('status', 1);

            if (!empty($statuses)) {
                $productsQuery->whereIn('current_status', $statuses);
            }

            $products = $productsQuery->get();
            $category = null;
        }

        $categories = Category::all();
        $select_category = $category->id ?? null;

        return view('frontend.products', compact('products', 'categories', 'select_category'));
    }

    public function product($slug = null)
    {
        if (!$slug)
            return redirect()->back();
        $product = Product::where('slug', $slug)->first();
        if (!$product)
            return redirect()->back();
        $similarproducts = $product->category->products()->where('id', '!=', $product->id)->get();

        return view('frontend.product-detail', compact('product', 'similarproducts'));
    }
    public function menu()
    {
        $menus = Menu::all();
        return view('frontend.menu', compact('menus'));
    }
    public function contact()
    {
        $categories = Category::all();
        $setting = Setting::find(1);
        return view('frontend.contact', compact('categories', 'setting'));
    }
    public function contact_save(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->category = $request->category;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
    public function place_order(Request $request)
    {
        $data = $this->validate($request, [
            'category_id' => 'required',
            'product_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'category' => 'required',
            'product' => 'required',
            'price_id' => 'required',
            'mobile' => 'required',
            'message' => 'required',
        ]);
        $online_order = new OnlineOrder();
        $price = Price::find($request->price_id);
        $online_order->order_id = rand(1000000000, 9999999999);
        $online_order->category_id = $request->category_id;
        $online_order->product_id = $request->product_id;
        $online_order->name = $request->name;
        $online_order->email = $request->email;
        $online_order->category = $request->category;
        $online_order->product = $request->product;
        $online_order->price_id = $request->price_id;
        $online_order->quantity = $price->quantity;
        $online_order->amount = $price->amount;
        $online_order->mobile = $request->mobile;
        $online_order->message = $request->message;
        $online_order->order_status = "Placed";
        $online_order->payment_status = "Unpaid";
        $online_order->save();
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully.',
        ]);
    }
    public function online_orders_update_ajax(Request $request)
    {
        $status = $request->order_status;
        $id = $request->id;

        $online_order = OnlineOrder::find($id)->update([
            'order_status' => $status
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function online_payment_update_ajax(Request $request)
    {
        $status = $request->payment_status;
        $id = $request->id;

        $online_order = OnlineOrder::find($id)->update([
            'payment_status' => $status
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function terms_and_condition()
    {
        $data = Pages::find(2);
        return view('frontend.page', compact('data'));
    }
    public function privacy_policy()
    {
        $data = Pages::find(3);
        return view('frontend.page', compact('data'));
    }
    public function return_and_refund_policy()
    {
        $data = Pages::find(5);
        return view('frontend.page', compact('data'));
    }
    public function disclaimer()
    {
        $data = Pages::find(6);
        return view('frontend.page', compact('data'));
    }
    public function change_current_status_ajax(Request $request)
    {
        $status = $request->current_status;
        $id = $request->id;

        $upload = Product::find($id)->update([
            'current_status' => $status
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
