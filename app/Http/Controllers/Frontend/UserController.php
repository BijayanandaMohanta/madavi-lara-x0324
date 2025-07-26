<?php

namespace App\Http\Controllers\frontend;

use App\Customer;
use App\Address;
use App\Order;
use App\Cart;
use App\CartAddress;
use App\Product;
use App\ProductImage;
use App\RewardCoupon;

use App\Http\Controllers\Controller;
use App\OrderLog;
use App\ProductReview;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\TrackingToken;
use App\Http\Controllers\HelperController;

class UserController extends Controller
{
    //
    public function userprofile()
    {
        $customer = Customer::find(Session::get('customer_id'));
        if(!$customer){
            return redirect()->route('userlogin');
        }
        return view("frontend.dashboard-myprofile", compact('customer'));
    }

    public function updateprofile(Request $request)
    {

        $data = $this->validate($request, [
            'name' => 'required',
            'mobile' => 'numeric|digits:10|unique:customer,mobile',
            'password' => 'nullable|min:8',
        ]);        

        $customer = Customer::find(Session::get('customer_id'));
        $customer->name = $request->name;
        // $request->email == '' ? '' : $customer->email = $request->email;
        $customer->password = $request->password != '' ? md5($request->password) : $customer->password;
        $customer->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function userorders(Request $request)
    {
        $customer_id = Session::get('customer_id');

        if($request->status){
            $orders = Order::where('customer_id', $customer_id)
            ->orderBy('id', 'desc')
            ->where('order_status', $request->status)
            ->where('txn_id','!=', '')
            ->get();
        }
        else{
            $orders = Order::where('customer_id', $customer_id)
            ->orderBy('id', 'desc')
            ->where('txn_id','!=', '')
            ->get();
        }

            

        foreach ($orders as $order) {
            $sid = $order->sid;
            $count_cart = Cart::where('sid', $sid)->sum('quantity');
            $order->total_items = $count_cart;
            $order = Order::where('id', $order->id)->first();
            $order_log = OrderLog::where('order_id', $order->order_id)->orderBy('id', 'desc')->first();
            // over write the order status
            $order->date = $order_log->created_at ?? $order->created_at;
        }

        return view("frontend.dashboard-myorders", compact('orders'));
    }
    public function view_order(Request $request)
    {
        $sid = $request->sid;
        $customer_id = Session::get('customer_id');

        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;

        $carts = Cart::where('sid', $sid)->get();
        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug ?? null;
            $totalQuantity += $cart->quantity;
            $cart->total_quantity = $totalQuantity;
            $totalSubTotal += $cart->sub_total;
            $cart->cart_total = $totalSubTotal;
            $totalmop += $cart->mop;
            $cart->total_mop = $totalmop;
            $totalprice += $cart->price;
            $cart->total_price = $totalprice;
            $savings1 += round(($cart->mop - $cart->price) * $cart->quantity);
            $cart->saving = $savings1;
        }
        $address_data = CartAddress::Where('customer_id', $customer_id)->Where('sid', $sid)->first();
        $order_data = Order::Where('sid', $sid)->first();
        $order_log = OrderLog::where('order_id', $order_data->order_id)->orderBy('id', 'desc')->first();
        // over write the order status
        $order_status = $order_log->status ?? $order_data->order_status;
        $order_date = $order_log->created_at ?? $order_data->created_at;

        return view('frontend.dashboard-myorder-view', compact('carts', 'address_data', 'order_data', 'order_status', 'order_date'));
    }
    public function dashboardtrackorder(Request $request)
    {
        // if(Session::has('customer_id') == false){
        //     return redirect()->route('userlogin');
        // }
        if(!$request->order_id || $request->order_id == ''){
            return view("frontend.dashboard-track-order");
        }

        $order_id = $request->order_id;
        $order = Order::where('order_id', $order_id)->first();
        if(!$order){
            return redirect()->back()->with('error', 'Order not found!');
        }
        $current_status = $order->order_status;
        $date = date("d-m-Y");

        $check_token = TrackingToken::where('date', $date)->orderBy('id','DESC')->first();
        if ($check_token) {
            $newtoken = $check_token->token;
        } else {
            $newtoken = (new HelperController)->get_token();
            $token = $newtoken;
            $token = new TrackingToken;
            $token->token = $newtoken;
            $token->date = $date;
            $token->save();
        }
        return view("frontend.dashboard-track-order",compact('order','newtoken','current_status'));
    }
    public function userwishlist()
    {
        $customer_id = Session::get('customer_id');
        $wishlistProducts = Wishlist::where('customer_id', $customer_id)
            ->join('products', 'wishlist.product_id', '=', 'products.id')
            ->where('products.status', 1)
            ->orderBy('products.created_at', 'DESC')
            ->get(['wishlist.*', 'products.*']);
        foreach ($wishlistProducts as $products) {
            $product_image = ProductImage::where('product_id', $products->id)->orderBy('priority', 'asc')->first();
            $products->image = $product_image->image ?? "no-image";
        }
        // dd($wishlistProducts);
        return view("frontend.dashboard-wishlist", compact('wishlistProducts'));
    }
    public function addtowishlist(Request $request)
    {

        $wishlist = Wishlist::where('product_id', $request->product_id)->where('customer_id', $request->customer_id)->first();
        if ($wishlist) {
            $wishlist->delete();
            $responseData = [
                'status' => 'valid',
                'message' => 'Removed from wishlist',
            ];
            return response()->json($responseData);
        } else {
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->customer_id = $request->customer_id;
            $wishlist->save();
            $responseData = [
                'status' => 'valid',
                'message' => 'Added to wishlist',
            ];
            return response()->json($responseData);
        }
    }
    public function useraddress()
    {

        $customer_id = Session::get('customer_id');
        $address_lists = Address::WHERE('customer_id', $customer_id)->get();

        return view("frontend.dashboard-address", compact('address_lists'));
    }
    public function usereditaddress($id)
    {

        $customer_id = Session::get('customer_id');
        $address = Address::WHERE('id', $id)->first();

        return view("frontend.dashboard-edit-address", compact('address'));
    }
    public function deleteaddress($id)
    {
        // $customer_id = Session::get('customer_id');
        $address = Address::WHERE('id', $id)->delete();

        return redirect()->route('useraddress')->with('success', 'Address Deleted Successfully');
    }
    public function userupdateaddress(Request $request)
    {

        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'address' => 'required',
            'apartment' => 'required',
            'landmark' => 'required',
            'type' => 'required',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required',
        ]);


        $customer_id = Session::get('customer_id');
        $address = Address::findOrFail($request->id);
        $address->phone = $request->phone;
        $address->customer_id = $customer_id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->apartment = $request->apartment;
         $address->landmark = $request->landmark;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->type = $request->type;

        $address->save();

        return redirect()->route('useraddress')->with('success', 'Address Updated Successfully');
    }
    public function add_address()
    {
        return view("frontend.dashboard-newaddress");
    }
    public function address_submit(Request $request)
    {
        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'address' => 'required',
            'apartment' => 'required',
            'landmark' => 'required',
            'type' => 'required',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|numeric|digits:6',
        ]);

        $customer_id = Session::get('customer_id');
        $address = new Address();
        $address->phone = $request->phone;
        $address->customer_id = $customer_id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->landmark = $request->landmark;
        $address->apartment = $request->apartment;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->type = $request->type;

        $address->save();

        return redirect()->route('useraddress')->with('success', 'Address Added Successfully');

        // return view("frontend.dashboard-newaddress");
    }
    public function userreviews()
    {
        $customer_id = Session::get('customer_id');
        $reviews = ProductReview::where('customer_id', $customer_id)->get();
        return view("frontend.dashboard-reviews", compact('reviews'));
    }
    public function userrewards()
    {
        $reward_coupons = RewardCoupon::where('status','1')->get();

        // Check if user is logged in or not then find the sum of total orders and total savings
        $customer_id = Session::get('customer_id');
        $orderSums = Order::where('customer_id', $customer_id)
            ->selectRaw('SUM(sub_total) as total_orders_amount, SUM(coupon) as total_savings')
            ->first();
        
        $total_orders_amount = $orderSums->total_orders_amount;
        $total_savings = $orderSums->total_savings;

        // reward coupons amount check with the total orders amount and show the neartest up reward coupon
        $reward_coupon = $reward_coupons->sortBy(function($coupon) use ($total_orders_amount
        ) {
            return abs($coupon->min_amount - $total_orders_amount);
        })->first();

        // nearest coupon applied or not
        $coupon_applied = false;
        if($reward_coupon){
            $coupon_applied = Order::where('customer_id', $customer_id)->where('coupon_code', $reward_coupon->coupon_code)->first();
        }

        // Get all reward coupon codes
        $rewardCouponCodes = RewardCoupon::pluck('coupon_code')->toArray();
        
        // Total redeem reward coupon amount
        $total_redeem_amount = Order::where('customer_id', $customer_id)
            ->whereIn('coupon_code', $rewardCouponCodes)
            ->sum('coupon');

        return view("frontend.dashboard-rewards", compact('reward_coupons','total_orders_amount','reward_coupon','coupon_applied','total_savings','total_redeem_amount'));
    }
    public function userlogout()
    {
        // Session::forget('customer_id');
        Session::flush();
        return redirect()->route('userlogin')->with('primary', 'Logout out');
    }
}
