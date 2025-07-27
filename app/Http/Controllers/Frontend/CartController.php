<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\RewardCoupon;
use App\Models\ProductImage;
use App\Models\ProductStock;
use App\Models\Address;
use App\Models\CartAddress;
use App\Models\Setting;
use App\Models\Order;
use App\Models\DeleteOrder;
use App\Models\DeleteCart;
use App\Models\Coupon;
use App\Models\OrderLog;
use App\Models\UseCoupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\HelperController;
use Razorpay\Api\Api;
use App\Models\TrackingToken;
use Illuminate\Support\Str;


class CartController extends Controller
{
    /**
     * Check if all products in the cart have sufficient stock.
     */
    private function checkCartStock($carts): bool
    {
        if (empty($carts)) {
            return true;
        }

        foreach ($carts as $cart) {
            if ($cart->product->stock == 0) {
                return true;
            }
        }

        return false;
    }
    private function checkProductActive($carts): bool
{
    if (empty($carts)) {
        return true;
    }

    foreach ($carts as $cart) {
        // Assuming the product ID is stored in the cart and is linked to the 'products' table
        $productStatus = DB::table('products')
            ->where('id', $cart->product_id) // Replace 'product_id' with the actual column name from your cart table
            ->value('status'); // Fetch the status directly from the database

        if ($productStatus == 0) {
            return true; // Product is inactive
        }
    }

    return false; // All products are active
}


    // check address availability of a customer

    private function checkAddressAvailability($customer_id) : bool
    {
        $check = Address::where('customer_id', $customer_id)->count();
        if($check > 0){
            return true;
        }
        else{
            return false;
        }
    }

    // bestseller products
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

    public function cart()
    {
        $customer_id = Session::get('customer_id');
        
        $bestsellingproducts = $this->bestsellerproducts();

        $totalQuantity = 0;
        $totalSubTotal = 0;
        $totalmop = 0;
        $totalprice = 0;
        $savings1 = 0;
        $sid = Cookie::get('sid');
        // dd($sid);
        $carts = Cart::where('sid', $sid)->get();
        if ($carts->isEmpty()) {
            return redirect()->route('home');
        }
        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug ?? '';
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
        $address_count = Address::Where('customer_id', $customer_id)->count();

        $check_product_stock = $this->checkCartStock($carts);

        if($totalSubTotal <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;

        return view("frontend.cart", compact('bestsellingproducts', 'carts', 'address_count', 'check_product_stock','shipping_charges'));
        // Session::regenerate();
        //return view("frontend.cart-page");
    }
    public function cart_address_submit(Request $request)
    {

        // Define validation rules
        $data = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'address' => 'required',
            'apartment' => 'required',
            'type' => 'required',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|numeric|digits:6',
        ]);
        // Validate the request
        // $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        // if ($validator->fails()) {
        //     return redirect()->back()->with('failure', 'Fill the form for Add Address');
        // }
        $customer_id = Session::get('customer_id');
        $address = new Address();
        $address->phone = $request->phone;
        $address->customer_id = $customer_id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->apartment = $request->apartment;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->pincode = $request->pincode;
        $address->type = $request->type;
        $address->order_note = $request->order_note;
        $address->save();

        $sid = Cookie::get('sid');
        $address_data = Address::Where('customer_id', $customer_id)->first();
        $cart_address = new CartAddress();
        $cart_address->address_id = $address_data->id;
        $cart_address->sid = $ref_sid ?? $sid;
        $cart_address->phone = $address_data->phone;
        $cart_address->customer_id = $customer_id;
        $cart_address->first_name = $address_data->first_name;
        $cart_address->last_name = $address_data->last_name;
        $cart_address->email = $address_data->email;
        $cart_address->address = $address_data->address;
        $cart_address->apartment = $address_data->apartment;
        $cart_address->state = $address_data->state;
        $cart_address->city = $address_data->city;
        $cart_address->pincode = $address_data->pincode;
        $cart_address->type = $address_data->type;
        $cart_address->order_note = $address_data->order_note;
        $cart_address->save();

        if ($request->buy_now == 'buy_now') {

            return redirect()->route('buy-now-make-payment')->with('success', 'Address Added Successfully');
        } else {

            return redirect()->route('make-payment')->with('success', 'Address Added Successfully');
        }


        // return view("frontend.dashboard-newaddress");
    }

    public function checkout()
    {
        $bestsellingproducts = $this->bestsellerproducts();

        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;
        $sid = Cookie::get('sid');
        $carts1 = Cart::where('sid', $sid)->get();
        foreach ($carts1 as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug;
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
        $carts = (object)[
            'total_quantity' => $totalQuantity,
            'cart_total' => $totalSubTotal,
            'total_mop' => $totalmop,
            'total_price' => $totalprice,
            'saving' => $savings1,
        ];
        if ($carts1->isEmpty()) {
            return redirect()->route('home');
        }
        return view("frontend.checkout", compact('bestsellingproducts', 'carts'));
    }
    public function buy_now_checkout()
    {
        $bestsellingproducts = $this->bestsellerproducts();
        
        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;
        $sid = Cookie::get('sid');
        $ref_sid = Session::get('ref_sid');

        $carts1 = Cart::where('ref_sid', $ref_sid)->get();
        foreach ($carts1 as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug;
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
        $carts = (object)[
            'total_quantity' => $totalQuantity,
            'cart_total' => $totalSubTotal,
            'total_mop' => $totalmop,
            'total_price' => $totalprice,
            'saving' => $savings1,
        ];
        if ($carts1->isEmpty()) {
            return redirect()->route('home');
        }
        return view("frontend.buy-now-checkout", compact('bestsellingproducts', 'carts'));
    }
    public function make_payment()
    {
        $customer_id = Session::get('customer_id');

        $customer_address_check = $this->checkAddressAvailability($customer_id);
        if (!$customer_address_check) {
            return redirect()->route('cart');
        }

        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;
        $sid = Cookie::get('sid');
        $carts = Cart::where('sid', $sid)->get();
        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug;
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
        $address = Address::Where('customer_id', $customer_id)->first();
        $cart_address = new CartAddress();
        $cart_address->address_id = $address->id;
        $cart_address->sid = $sid;
        $cart_address->phone = $address->phone;
        $cart_address->customer_id = $customer_id;
        $cart_address->first_name = $address->first_name;
        $cart_address->last_name = $address->last_name;
        $cart_address->email = $address->email;
        $cart_address->address = $address->address;
        $cart_address->apartment = $address->apartment;
        $cart_address->state = $address->state;
        $cart_address->city = $address->city;
        $cart_address->pincode = $address->pincode;
        $cart_address->type = $address->type;
        $cart_address->order_note = $address->order_note;
        $cart_address->save();

        $address_data = CartAddress::Where('customer_id', $customer_id)->orderBy('id', 'desc')->Where('sid', $sid)->first();

        $check_address = Address::Where('customer_id', $customer_id)->count();
        if ($check_address > 0) {
            $addresses = Address::Where('customer_id', $customer_id)->get();
        } else {
            $addresses = '';
        }

        $coupons = Coupon::where('status', 1)->get();

        $used_coupon = UseCoupon::where('sid', $sid)->first();
        if ($carts->isEmpty()) {
            return redirect()->route('home');
        }
        $check_product_stock = $this->checkCartStock($carts);
        if ($check_product_stock) {
            return redirect()->route('cart');
        }

        if($totalSubTotal <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;

        
        return view("frontend.make-payment", compact('carts', 'address_data', 'addresses', 'coupons', 'used_coupon','shipping_charges'));
    }
    public function buy_now_make_payment()
    {
        $customer_id = Session::get('customer_id');

        $customer_address_check = $this->checkAddressAvailability($customer_id);
        if (!$customer_address_check) {
            return redirect()->route('buy_now_checkout');
        }

        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;
        $sid = Cookie::get('sid');
        $ref_sid = Session::get('ref_sid');

        if ($ref_sid == '') {
            return redirect()->route('home');
        }

        try {
            // Fetch cart data by ref_sid
            $cart = Cart::where('sid', $sid)->where('ref_sid', $ref_sid)->first();
            if (!$cart) {
                throw new \Exception("Cart not found for the provided ref_sid.");
            }

            // Fetch product image and assign default if not found
            $product_image = ProductImage::where('product_id', $cart->product_id)
                ->orderBy('priority', 'asc')
                ->first();
            $cart->image = $product_image->image ?? "no-image";

            // Fetch product data
            $product_data = Product::where('id', $cart->product_id)->first();
            if ($product_data) {
                $cart->slug = $product_data->slug;
            }

            $totalSubTotal = $cart->sub_total;
            // Assign cart calculations
            $cart->total_quantity = $cart->quantity;
            $cart->cart_total = $cart->sub_total;
            $cart->total_mop = $cart->mop;
            $cart->total_price = $cart->price;
            $cart->saving = round(($cart->mop - $cart->price) * $cart->quantity);

            // Fetch address for the customer
            $address = Address::where('customer_id', $customer_id)->first();
            if (!$address) {
                throw new \Exception("Address not found for the customer.");
            }

            // Save the cart address
            $cart_address = new CartAddress();
            $cart_address->address_id = $address->id;
            $cart_address->sid = $ref_sid ?? $sid;
            $cart_address->phone = $address->phone;
            $cart_address->customer_id = $customer_id;
            $cart_address->first_name = $address->first_name;
            $cart_address->last_name = $address->last_name;
            $cart_address->email = $address->email;
            $cart_address->address = $address->address;
            $cart_address->apartment = $address->apartment;
            $cart_address->state = $address->state;
            $cart_address->city = $address->city;
            $cart_address->pincode = $address->pincode;
            $cart_address->type = $address->type;
            $cart_address->order_note = $address->order_note;
            $cart_address->save();

            // Fetch saved cart address for confirmation
            $address_data = CartAddress::where('customer_id', $customer_id)
                ->where('sid', $ref_sid)
                ->orderBy('id', 'desc')
                ->first();

            if (!$address_data) {
                throw new \Exception("Failed to save cart address.");
            }
        } catch (\Exception $exception) {
            // Dump and die with exception message for development/debugging
            // dd($exception->getMessage());
            return redirect()->route('home');
        }

        $check_address = Address::Where('customer_id', $customer_id)->count();
        if ($check_address > 0) {
            $addresses = Address::Where('customer_id', $customer_id)->get();
        } else {
            $addresses = '';
        }

        $coupons = Coupon::where('status', 1)->get();
        $used_coupon = UseCoupon::where('sid', $ref_sid ?? $sid)->first();


        // dd($used_coupon);


        if (Session::get('partial_cod_flag') == 'Partial COD') {
            $partial_cod_flag = 'Partial COD';
        } else {
            $partial_cod_flag = '';
        }

        if($totalSubTotal <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;


        return view("frontend.buy-now-make-payment", compact('cart', 'address_data', 'addresses', 'coupons', 'used_coupon', 'partial_cod_flag', 'shipping_charges'));
    }

    public function use_coupon(Request $request)
    {
        // Validate required inputs
        $sid = $request->input('sid');
        $couponCode = $request->input('coupon_code');
        $userId = $request->input('user_id');

        if (!$sid || !$couponCode || !$userId) {
            return response()->json(['status' => 'Invalid', 'message' => 'Coupon code is required to apply']);
        }

        $ref_id = $request->ref_sid ?? null;

        // Fetch cart total
        $cart = DB::table('carts')
            ->where($ref_id ? 'ref_sid' : 'sid', $ref_id ?? $sid)
            ->sum('sub_total');

        // Fetch coupon details
        $coupon = DB::table('coupons')
            ->where('code', $couponCode)
            ->where('status', 1)
            ->first();

        // Check if the coupon exists
        if (!$coupon) {
            // Check for reward coupons if regular coupon is not found
            $orderSums = Order::where('customer_id', $userId)
                ->selectRaw('SUM(sub_total) as total_orders_amount, SUM(coupon) as total_savings')
                ->first();
            $total_orders_amount = $orderSums->total_orders_amount ?? 0;

            $reward_coupon = RewardCoupon::where('status', '1')
                ->where('coupon_code', $couponCode)
                ->first();

            if (!$reward_coupon) {
                return response()->json(['status' => 'Invalid', 'message' => 'Invalid Coupon Code']);
            }

            // Check if the customer has already used this reward coupon
            $coupon_applied = Order::where('customer_id', $userId)
                ->where('coupon_code', $reward_coupon->coupon_code)
                ->exists();

            if ($coupon_applied) {
                return response()->json(['status' => 'Invalid', 'message' => 'You have already used this coupon']);
            }

            // Check eligibility for the reward coupon
            if ($total_orders_amount >= $reward_coupon->min_amount) {
                // Calculate discount
                $discountPercentage = str_replace('%', '', $reward_coupon->discount_percentage);
                $offer = ceil(($cart * $discountPercentage) / 100);

                // Delete previous coupon usage
                UseCoupon::where($ref_id ? 'ref_sid' : 'sid', $ref_id ?? $sid)
                    ->where('customer_id', $userId)
                    ->delete();

                // Save new coupon usage
                UseCoupon::create([
                    'sid' => $ref_id ?? $sid,
                    'coupon_code' => $reward_coupon->coupon_code,
                    'coupon_amount' => $offer,
                    'customer_id' => $userId,
                ]);

                return response()->json(['status' => 'valid', 'message' => 'Coupon Applied Successfully']);
            } else {
                return response()->json(['status' => 'Invalid', 'message' => 'You are not eligible for this coupon']);
            }
        }

        // Check if the user has exceeded the coupon usage limit
        $userUses = DB::table('orders')
            ->where('customer_id', $userId)
            ->where('coupon', $couponCode)
            ->count();

        if ($userUses >= $coupon->uses_limit) {
            return response()->json(['status' => 'Invalid', 'message' => 'Sorry, You have already used this coupon the maximum number of times']);
        }

        // dd($coupon->min_amount);

        // Check if the cart meets the minimum order amount for the coupon
        if ($cart < $coupon->min_amount) {
            return response()->json(['status' => 'Invalid', 'message' => "Minimum order amount should be {$coupon->min_amount} to use this coupon"]);
        }

        // dd("No");

        // Check if the cart items meet the coupon conditions (brand, category, product)
        $cartItemsQuery = Cart::where($ref_id ? 'ref_sid' : 'sid', $ref_id ?? $sid);

        if ($coupon->categories) {
            $cartItemsQuery->whereIn('category_id', explode(',', $coupon->categories));
        }
        if ($coupon->products) {
            $cartItemsQuery->whereIn('product_id', explode(',', $coupon->products));
        }
        if ($coupon->brands) {
            $cartItemsQuery->whereIn('brand', explode(',', $coupon->brands));
        }

        $cartItems = $cartItemsQuery->sum('sub_total');

        if ($cartItems <= 0) {
            return response()->json(['status' => 'Invalid', 'message' => 'Coupon Not Applicable For These Items']);
        }

        // Calculate discount
        $offer = 0;
        if ($coupon->discount_type == 'Percentage') {
            $offer = ceil(($cartItems * $coupon->offer_amount) / 100);
        } else {
            $offer = $coupon->offer_amount;
        }

        // Apply maximum discount limit
        if ($offer > $coupon->max_discount) {
            $offer = $coupon->max_discount;
        }

        // Ensure the discount does not exceed the cart total
        if ($offer > $cartItems) {
            $offer = $cartItems;
        }

        // Delete previous coupon usage
        UseCoupon::where($ref_id ? 'ref_sid' : 'sid', $ref_id ?? $sid)
            ->where('customer_id', $userId)
            ->delete();

        // Save new coupon usage
        UseCoupon::create([
            'sid' => $ref_id ?? $sid,
            'coupon_code' => $couponCode,
            'coupon_id' => $coupon->id,
            'coupon_amount' => $offer,
            'customer_id' => $userId,
        ]);

        return response()->json(['status' => 'valid', 'message' => 'Coupon Applied Successfully']);
    }
    public function change_address(Request $request)
    {

        // Define validation rules
        $rules = [
            'choosen_address' => 'required'

        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('failure', 'Fill the form for Add Address');
        }

        $customer_id = Session::get('customer_id');

        $sid = Cookie::get('sid');
        CartAddress::where('sid', $sid)->delete();
        $address_data = Address::Where('id', $request->choosen_address)->first();
        $cart_address = new CartAddress();
        $cart_address->address_id = $address_data->id;
        $cart_address->sid = $sid;
        $cart_address->phone = $address_data->phone;
        $cart_address->customer_id = $customer_id;
        $cart_address->first_name = $address_data->first_name;
        $cart_address->last_name = $address_data->last_name;
        $cart_address->email = $address_data->email;
        $cart_address->address = $address_data->address;
        $cart_address->apartment = $address_data->apartment;
        $cart_address->state = $address_data->state;
        $cart_address->city = $address_data->city;
        $cart_address->pincode = $address_data->pincode;
        $cart_address->type = $address_data->type;
        $cart_address->order_note = $address_data->order_note;
        $cart_address->save();



        return redirect()->route('make-payment')->with('success', 'Address Added Successfully');

        // return view("frontend.dashboard-newaddress");
    }
    public function change_address_payment(Request $request)
    {

        // Define validation rules
        $rules = [
            'choosen_address' => 'required'

        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('failure', 'Fill the form for Add Address');
        }

        $customer_id = Session::get('customer_id');

        $sid = Cookie::get('sid');
        CartAddress::where('sid', $sid)->delete();
        $address_data = Address::Where('id', $request->choosen_address)->first();
        $cart_address = new CartAddress();
        $cart_address->address_id = $address_data->id;
        $cart_address->sid = $sid;
        $cart_address->phone = $address_data->phone;
        $cart_address->customer_id = $customer_id;
        $cart_address->first_name = $address_data->first_name;
        $cart_address->last_name = $address_data->last_name;
        $cart_address->email = $address_data->email;
        $cart_address->address = $address_data->address;
        $cart_address->apartment = $address_data->apartment;
        $cart_address->state = $address_data->state;
        $cart_address->city = $address_data->city;
        $cart_address->pincode = $address_data->pincode;
        $cart_address->type = $address_data->type;
        $cart_address->order_note = $address_data->order_note;
        $cart_address->save();



        return redirect()->route('payment')->with('success', 'Address Added Successfully');

        // return view("frontend.dashboard-newaddress");
    }

    public function payment()
    {
        $customer_id = Session::get('customer_id');
        
        $customer_address_check = $this->checkAddressAvailability($customer_id);
        if (!$customer_address_check) {
            return redirect()->route('cart');
        }
        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;
        $sid = Cookie::get('sid');
        $carts = Cart::where('sid', $sid)->get();

        // $check = Order::where("sid", $sid)->first();
        // if ($check) {
        //     $check->delete();
        // }

        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug;
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

        $check_address = Address::Where('customer_id', $customer_id)->count();
        if ($check_address > 0) {
            $addresses = Address::Where('customer_id', $customer_id)->get();
        } else {
            $addresses = '';
        }
        $used_coupon = UseCoupon::where('sid', $sid)->first();
        if ($carts->isEmpty()) {
            return redirect()->route('home');
        }

        $check_product_stock = $this->checkCartStock($carts);
        if ($check_product_stock) {
            return redirect()->route('cart');
        }

        if($totalSubTotal <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;


        return view("frontend.payment", compact('carts', 'address_data', 'addresses', 'used_coupon','shipping_charges'));
    }

    public function initiatepayment(Request $request)
    {
        // Check for product stock
        $sid = Cookie::get('sid');

        // Calculate all total amounts
        
        $cart_subtotal_sum = Cart::where('sid', $sid)->sum('sub_total');
        $total_quantity_sum = Cart::where('sid', $sid)->sum('quantity');
        $total_price_sum = Cart::where('sid', $sid)->sum('price');
        $total_mop_sum = Cart::where('sid', $sid)->sum('mop');
        $used_coupon = UseCoupon::where('sid', $sid)->first();
        $coupon_amount = $used_coupon->coupon_amount ?? 0;
        $cart_saving = round($total_mop_sum - $total_price_sum * $total_quantity_sum);
        

        if($cart_subtotal_sum <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;

        // Grand total calculation
        $grand_total = ($cart_subtotal_sum ?? 0) - ($coupon_amount ?? 0) + ($shipping_charges ?? 0);

        // Partial amount calculation
        if (($grand_total >= 200) & ($grand_total <= 2000)) {
            $partial = 200;
        } else {
            $partial = round($grand_total * 0.1);
        }
        $need_to_pay = round($grand_total - $partial);

        if($request->type == "Buy Now"){
            $ref_sid = Session::get('ref_sid');
            $carts = Cart::where('ref_sid', $ref_sid)->get();
        }
        else{
            $carts = Cart::where('sid', $sid)->get();
        }

        if($request->payment_option == 'Pay Online'){
            $actual_pay_amount = $grand_total ?? 0;
        }
        elseif($request->payment_option == 'Pay Partial COD'){
            $actual_pay_amount = $partial ?? 0;
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Payment option is important!']);
        }
        
        $check_product_stock = $this->checkCartStock($carts);
        $check_product_status = $this->checkProductActive($carts);
        $cart_real = $carts->count();
        
        if($request->secret_count != $cart_real){
             return response()->json([
            'status' => 'error',
            'message' => 'One of the products in your cart is either out of stock or inactive. Please refresh the page and try again to complete your payment.',
        ]);
        }
     
        if ($check_product_stock) {
            return response()->json([
            'status' => 'error',
            'message' => 'One of the products in your cart is either out of stock or inactive. Please refresh the page and try again to complete your payment.',
        ]);
        }
        
        if ($check_product_status) {
            return response()->json([
            'status' => 'error',
            'message' => 'One of the products in your cart is either out of stock or inactive. Please refresh the page and try again to complete your payment.',
        ]);
        }
       

        // Rozer pay things
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $orderAmount =  $actual_pay_amount; // initial amount
        $orderData = [
            'receipt'         => 'rcptid_' . time(),
            'amount'          => $orderAmount * 100, // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1, // Auto-capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        $razorpay_order_id    = $razorpayOrder->id;
        $amount      = $orderAmount;
        $key         = env('RAZORPAY_KEY');
        $callback_url = route('razorpay.callback');

        return response()->json([
            'key' => $key,
            'amount' => $amount,
            'razorpay_order_id' => $razorpay_order_id,
            'callback_url' => $callback_url,
        ]);
       
    }

    public function addToCart(Request $request)
    {
        // Check if the sid cookie exists
        if (Cookie::has('sid')) {
            // Use the existing token
            $sid = Cookie::get('sid');
        } else {
            // Generate a new token and set it in the cookie
            $sid = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            $minutes = 4320000; // Cookie expires in 1 month (minutes)

            // Queue the cookie immediately
            Cookie::queue('sid', $sid, $minutes);
            Session::put('sid', $sid);
        }
        // dd($request->qty);
        if ($request->qty == 0) {
            $responseData = [
                'status' => 'invalid',
                'message' => 'Zero is not allowed'
            ];
            return response()->json($responseData);
        }
        // Check quantity available in stock
        $cart_quantity = Cart::where('product_id', $request->id)->where('sid', $sid)->first();
        if ($cart_quantity) {
            $product_id = $request->id;
            $cart_product_quantity = $cart_quantity->quantity;
            $product_data = Product::where('id', $product_id)->first();
            $stock = $product_data->stock;

            if ($stock < $cart_product_quantity + $request->qty) {
                $responseData = [
                    'status' => 'invalid',
                    'message' => 'Stock Not Avaliable For This Quantity'
                ];
                return response()->json($responseData);
            }
        }
        // print_r($sid);die();
        $status = 'Pending';
        $qty = $request->qty;
        $test_id = $request->id;
        $responseData = [];
        $product_id = $request->id;
        $product_data = Product::where('id', $product_id)->first();
        if ($product_data->stock >= $qty) {
            // Check if the test is already in the cart
            $check_exist_cart = Cart::where('sid', $sid)
                ->where('product_id', $product_id)
                ->first(); // Use first() to get the existing cart item if present

            if (is_null($check_exist_cart)) {
                // Create a new cart entry
                $add_result = new Cart();
                $add_result->product_id = $product_id;
                $add_result->product_name = $product_data->name;
                $add_result->category_id = $product_data->category_id;
                $add_result->sub_category_id = $product_data->sub_category_id;
                $add_result->child_category_id = $product_data->child_category_id;
                $add_result->brand = $product_data->brand;
                $add_result->sid = $sid;
                $add_result->mrp = $product_data->mrp;
                $add_result->price = $product_data->price;
                $add_result->mop = $product_data->mop;
                $add_result->status = $status;
                $add_result->quantity = $qty;
                $currentDateTime = date('Y-m-d H:i:s'); // Get current date and time
                $add_result->added_date_time = $currentDateTime;
                $timestamp = strtotime($currentDateTime);
                $add_result->str_added_date = $timestamp;
                $add_result->sub_total = $qty * $product_data->price;
                $add_result->save();
            } else {

                $check_exist_cart->quantity = $check_exist_cart->quantity + $qty;
                $check_exist_cart->sub_total = $check_exist_cart->quantity * $product_data->price;
                $check_exist_cart->save();
            }

            $count_cart = Cart::where('sid', $sid)->sum('quantity');
            $delete_coupon = UseCoupon::where('sid', $sid)->delete();

            //Session::put('cart_count', $count_cart);
            $minutes = 43200;
            Cookie::queue('cart_count', $count_cart, $minutes);
            $updated_cart_html = view('frontend.layouts.shopping-cart')->render();



            $responseData = [
                'status' => 'valid',
                'message' => 'Added to cart successfully',
                'cart_count' => $count_cart,
                'html' => $updated_cart_html
            ];
        } else {
            $responseData = [
                'status' => 'invalid',
                'message' => 'Stock Not Avaliable For This Quantity'

            ];
        }

        return response()->json($responseData);
    }


    public function update_cart(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $sid = Cookie::get('sid');
        $qty = $request->qty;
        $cart_id = $request->id;

        // Check quantity available in stock
        $cart_quantity = Cart::where('id', $cart_id)->first();
        $product_id = $cart_quantity->product_id;
        $cart_product_quantity = $cart_quantity->quantity;
        $product_data = Product::where('id', $product_id)->first();
        $stock = $product_data->stock;

        if ($stock < $cart_product_quantity + 1 && $qty >  $cart_product_quantity) {
            $responseData = [
                'status' => 'invalid',
                'message' => 'Stock Not Avaliable For This Quantity'
            ];
            return response()->json($responseData);
        }

        $check_exist_cart = Cart::where('id', $cart_id)
            ->first();
        $check_exist_cart->quantity = $qty;
        $check_exist_cart->sub_total = $check_exist_cart->quantity * $check_exist_cart->price;
        $check_exist_cart->save();
        $count_cart = Cart::where('sid', $sid)->sum('quantity');

        //Session::put('cart_count', $count_cart);
        $minutes = 43200;
        Cookie::queue('cart_count', $count_cart, $minutes);
        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;
        $sid = Cookie::get('sid');
        $carts = Cart::where('sid', $sid)->get();
        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug;
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
        if($totalSubTotal <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;

        $address_count = Address::Where('customer_id', $customer_id)->count();
        $delete_coupon = UseCoupon::where('sid', $sid)->delete();

        $count_cart = Cart::where('sid', $sid)->sum('quantity');
        //Session::put('cart_count', $count_cart);
        $minutes = 43200;
        Cookie::queue('cart_count', $count_cart, $minutes);
        $updated_cart_html1 = view('frontend.layouts.shopping-cart')->render();

        $updated_cart_html = view('frontend.cart_summary', [
            'carts' => $carts,
            'address_count' => $address_count,
            'shipping_charges' => $shipping_charges
        ])->render();
        $responseData = [
            'status' => 'success',
            'message' => 'Cart updated successfully',
            'cart_count' => $count_cart,
            'updated_cart_html1' => $updated_cart_html1,
            'updated_cart_html' => $updated_cart_html // Include the generated HTML
        ];

        return response()->json($responseData);
    }

    public function update_cart_data(Request $request)
    {
        $sid = Cookie::get('sid');
        $qty = $request->qty;
        $cart_id = $request->id;

        // Check quantity available in stock
        $cart_quantity = Cart::where('id', $cart_id)->first();
        $product_id = $cart_quantity->product_id;
        $cart_product_quantity = $cart_quantity->quantity;
        $product_data = Product::where('id', $product_id)->first();
        $stock = $product_data->stock;
        if ($stock < $cart_product_quantity + 1 && $qty >  $cart_product_quantity) {
            $responseData = [
                'status' => 'invalid',
                'message' => 'Stock Not Avaliable For This Quantity'
            ];
            return response()->json($responseData);
        }

        $check_exist_cart = Cart::where('id', $cart_id)->first();
        $check_exist_cart->quantity = $qty;
        $check_exist_cart->sub_total = $check_exist_cart->quantity * $check_exist_cart->price;
        $check_exist_cart->save();

        $count_cart = Cart::where('sid', $sid)->sum('quantity');
        $minutes = 43200;
        Cookie::queue('cart_count', $count_cart, $minutes);

        // Initialize totals
        $totalQuantity = 0;
        $totalSubTotal = 0;
        $totalmop = 0;
        $totalprice = 0;
        $savings1 = 0;

        // Retrieve all cart items for the given session ID
        $carts = Cart::where('sid', $sid)->get();

        // Calculate totals and additional attributes
        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";

            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug;

            // Calculate totals
            $totalQuantity += $cart->quantity;
            $totalSubTotal += $cart->sub_total;
            $totalmop += $cart->mop;
            $totalprice += $cart->price;
            $savings1 += round(($cart->mop - $cart->price) * $cart->quantity);
        }

        if($totalSubTotal <= env('MIN_ORDER_AMOUNT'))
        $shipping_charges = env('SHIPPING_CHARGES');
        else
        $shipping_charges = 0;


        // Create a cart summary object
        $cartSummary = (object)[
            'total_quantity' => $totalQuantity,
            'cart_total' => $totalSubTotal,
            'total_mop' => $totalmop,
            'total_price' => $totalprice,
            'saving' => $savings1,
            'shipping_charges' => $shipping_charges,
        ];

        $ref_sid = Session::get('ref_sid');

        $delete_coupon = UseCoupon::where('sid', $ref_sid ?? $sid)->delete();
        // Render updated HTML views
        $updated_cart_html = view('frontend.cart_summary_data', ['carts' => $carts])->render();
        $updated_cart_html1 = view('frontend.cart_summary_table', ['cart' => $cartSummary])->render();
        $updated_cart_html3 = view('frontend.cart_summary_table_payment_page', ['cart' => $cartSummary])->render();
        //Session::put('cart_count', $count_cart);
        $minutes = 43200;
        Cookie::queue('cart_count', $count_cart, $minutes);
        $updated_cart_html2 = view('frontend.layouts.shopping-cart')->render();

        $responseData = [
            'status' => 'success',
            'message' => 'Cart updated successfully',
            'cart_count' => $count_cart,
            'updated_cart_html' => $updated_cart_html,
            'updated_cart_html1' => $updated_cart_html1,
            'updated_cart_html2' => $updated_cart_html2,
            'updated_cart_html3' => $updated_cart_html3,
        ];

        return response()->json($responseData);
    }
    public function place_order(Request $request)
    {
        $rules = [
            'payment_option' => 'required'
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('failure', 'Choose The Payment Option');
        }
        $customer_id = Session::get('customer_id');
        $sid = Cookie::get('sid');
        if ($sid == '') {
            return redirect()->route('cart');
        }

        // $check = Order::where("sid", $sid)->first();
        // if ($check) {
        //     $check->delete();
        // }

        $check = Order::where("sid", $sid)->first();
        if ($check) {
            $deletedOrder = new DeleteOrder();
            $deletedOrder->fill($check->toArray());
            $deletedOrder->save();
            $check->delete();
        }

        $grand_total = Cart::where('sid', $sid)->sum('sub_total');

        $used_coupon = UseCoupon::where('sid', $sid)->first();

        $coupon = $used_coupon->coupon_amount ?? 0;

        $order_id = rand();

        if($grand_total <= env('MIN_ORDER_AMOUNT'))
        {
            $shipping_charges = env('SHIPPING_CHARGES');
        }
        elseif($request->payment_option != 'Pay Online' && $grand_total <= 999)
        {
            $shipping_charges = 99;
        }
        else{
            $shipping_charges = 0;
        }

        $grand_total = $grand_total + $shipping_charges - $coupon ;

        if ($request->payment_option == 'Pay Online') {
            $payment_status = 'Pending';
            $partial = 0;
            $need_to_pay = 0;
        } else {
            $payment_status = 'Pending';
            if (($grand_total >= 200) & ($grand_total <= 2000)) {
                $partial = 200;
            } else {
                $partial = round($grand_total * 0.1);
            }
            $need_to_pay = $grand_total - $partial ;
        }
        $date = date('d-m-Y');
        $str_date = strtotime($date);

        $order = new Order();
        $order->customer_id = $customer_id;
        $order->sid = $sid;
        $order->order_id = $order_id;
        $order->grand_total = $grand_total ;
        $order->sub_total = $grand_total - $coupon;
        $order->coupon = $coupon;
        $order->order_status = 'Pending';
        $order->payment_status = $payment_status;
        $order->partial_amount = $partial;
        $order->need_to_pay = $need_to_pay;
        $order->payment_option = $request->payment_option;
        $order->date = $date;
        $order->str_date = $str_date;
        $order->coupon_code = $used_coupon->coupon_code ?? null;
        $order->razorpay_order_id = $request->razorpay_order_id ?? null;
        $order->shipping_charges = $shipping_charges ?? 0;
        $order->save();


        // route::('invoice-generate',$sid);


        return response()->json(["status" => "success", "razorpay_order_id" => $request->razorpay_order_id, "message" => 'Order Placed Successfully']);
    }
    public function buy_now_place_order(Request $request)
    {
        $rules = [
            'payment_option' => 'required'
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('failure', 'Choose The Payment Option');
        }
        $customer_id = Session::get('customer_id');

        $ref_sid = Session::get('ref_sid');
        if ($ref_sid == '') {
            return redirect()->route('cart');
        }

        $check = Order::where("sid", $ref_sid)->first();
        if ($check) {
            $deletedOrder = new DeleteOrder();
            $deletedOrder->fill($check->toArray());
            $deletedOrder->save();
            $check->delete();
        }

        $grand_total = Cart::where('ref_sid', $ref_sid)->sum('sub_total');

        $used_coupon = UseCoupon::where('sid', $ref_sid)->first();

        $coupon = $used_coupon->coupon_amount ?? 0;

        $order_id = rand();
        if($grand_total <= env('MIN_ORDER_AMOUNT'))
            $shipping_charges = env('SHIPPING_CHARGES');
        else
            $shipping_charges = 0;

        $grand_total = $grand_total + $shipping_charges - $coupon ;

        if ($request->payment_option == 'Pay Online') {
            $payment_status = 'Pending';
            $partial = 0;
            $need_to_pay = 0;
        } else {
            $payment_status = 'Pending';
            if (($grand_total >= 200) & ($grand_total <= 2000)) {
                $partial = 200;
            } else {
                $partial = round($grand_total * 0.1);
            }
            $need_to_pay = $grand_total - $partial;
        }
        $date = date('d-m-Y');
        $str_date = strtotime($date);

       

        $order = new Order();
        $order->customer_id = $customer_id;
        $order->sid = $ref_sid;
        $order->order_id = $order_id;
        $order->grand_total = $grand_total;
        $order->sub_total = $grand_total - $coupon ;
        $order->coupon = $coupon;
        $order->order_status = 'Pending';
        $order->payment_status = $payment_status;
        $order->partial_amount = $partial;
        $order->need_to_pay = $need_to_pay;
        $order->payment_option = $request->payment_option;
        $order->date = $date;
        $order->str_date = $str_date;
        $order->coupon_code = $used_coupon->coupon_code ?? null;
        $order->razorpay_order_id = $request->razorpay_order_id ?? null;
        $order->shipping_charges = $shipping_charges ?? 0;
        $order->save();


        return response()->json(["status" => "success", "razorpay_order_id" => $request->razorpay_order_id, "message" => 'Order Placed Successfully']);
    }
    public function order_success()
    {

        $customer_id = Session::get('customer_id');
        $order_id = Session::get('order_id');

        $order = Order::where('order_id', $order_id)->first();
        // dd($order_id);
        $coupon = Order::where('order_id', $order_id)->get()->pluck('coupon');
        // dd($coupon);
        $coupon = $coupon[0];
        $sid = Session::get('sid');
        $address_data = Session::get('address_data');
        $carts = Session::get('carts');
        $date = Session::get('date');

        // cart address data
        $cart_address = CartAddress::where('sid', $order->sid)->orderBy('id', 'desc')->first();


        $pickupPincode = '500084'; // Replace with your actual pickup pincode
        $deliveryPincode = $cart_address->pincode;
        $weight = 1;
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
        } else {
            $newEtdFormatted = 'No ETD available';
        }


        return view("frontend.order-success", compact('order_id', 'date', 'address_data', 'carts', 'coupon', 'newEtdFormatted'));
    }
    public function buy_now(Request $request)
    {

        $customer_id = Session::get('customer_id');

        if (is_null($customer_id) || $customer_id <= 0) {
            return response()->json(["status" => "failed", "message" => 'Need To Login First']);
            // return response()->redirect()->route('userlogin');
        }

        if (Cookie::has('sid')) {
            $sid = Cookie::get('sid');
        } else {
            $sid = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
            $minutes = 43200; // Cookie expires in 1 month (minutes)
            Cookie::queue('sid', $sid, $minutes);
            Session::put('sid', $sid);
        }

        // reference sid

        $ref_sid = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        Session::put('ref_sid', $ref_sid);

        // Partial COD indecation
        Session::put('partial_cod_flag', $request->type);

        $qty = $request->qty;
        $product_id = $request->id;
        $product_data = Product::where('id', $product_id)->first();

        $check_exist_cart = Cart::where('sid', $sid)->where('product_id', $product_id)->first();

        if (is_null($check_exist_cart)) {
            $add_result = new Cart();
            $add_result->product_id = $product_id;
            $add_result->product_name = $product_data->name;
            $add_result->category_id = $product_data->category_id;
            $add_result->sub_category_id = $product_data->sub_category_id;
            $add_result->child_category_id = $product_data->child_category_id;
            $add_result->brand = $product_data->brand;
            $add_result->sid = $sid;
            $add_result->mrp = $product_data->mrp;
            $add_result->price = $product_data->price;
            $add_result->mop = $product_data->mop;
            $add_result->status = 'Pending';
            $add_result->quantity = $qty;
            $add_result->added_date_time = date('Y-m-d H:i:s');
            $add_result->str_added_date = strtotime($add_result->added_date_time);
            $add_result->sub_total = $qty * $product_data->price;
            $add_result->ref_sid = $ref_sid;
            $add_result->save();
        } else {
            $deletedCart = new DeleteCart();
            $deletedCart->fill($check_exist_cart->toArray());
            $deletedCart->save();
            $check_exist_cart->delete();
            $add_result = new Cart();
            $add_result->product_id = $product_id;
            $add_result->product_name = $product_data->name;
            $add_result->category_id = $product_data->category_id;
            $add_result->sub_category_id = $product_data->sub_category_id;
            $add_result->child_category_id = $product_data->child_category_id;
            $add_result->brand = $product_data->brand;
            $add_result->sid = $sid;
            $add_result->mrp = $product_data->mrp;
            $add_result->price = $product_data->price;
            $add_result->mop = $product_data->mop;
            $add_result->status = 'Pending';
            $add_result->quantity = $qty;
            $add_result->added_date_time = date('Y-m-d H:i:s');
            $add_result->str_added_date = strtotime($add_result->added_date_time);
            $add_result->sub_total = $qty * $product_data->price;
            $add_result->ref_sid = $ref_sid;
            $add_result->save();
        }

        $count_cart = Cart::where('sid', $sid)->sum('quantity');
        Cookie::queue('cart_count', $count_cart, 43200);

        $check_address = Address::where('customer_id', $customer_id)->count();
        $redirectUrl = $check_address > 0 ? route('buy-now-make-payment') : route('bow-now-checkout');
        $delete_coupon = UseCoupon::where('sid', $sid)->delete();

        // Return a JSON response with the redirect URL
        return response()->json(['status' => 'valid', 'redirect_url' => $redirectUrl]);
    }

    public function removeFromCart(Request $request)
    {
        $cart_id = $request->id;
        $cart = Cart::find($cart_id);
        $sid = Cookie::get('sid');
        $delete_coupon = UseCoupon::where('sid', $sid)->delete();
        if ($cart) {
            // $deletedCart = new DeleteCart();
            // $deletedCart->fill($cart->toArray());
            // $deletedCart->save();
            $cart->delete();
            $sid = Cookie::get('sid');
            $count_cart = Cart::where('sid', $sid)->sum('quantity');
            Cookie::queue('cart_count', $count_cart, 43200);
            $responseData = ['status' => 'valid', 'message' => 'Removed from cart successfully'];
        } else {
            $responseData = ['status' => 'invalid', 'message' => 'Cart not found'];
        }
        return response()->json($responseData);
    }

    public function invoice($sid)
    {
        $billing_address = CartAddress::where('sid', $sid)->orderBy('id', 'desc')->first();
        $order = Order::where('sid', $sid)->first();
        $products = Cart::where('sid', $sid)->get();
        $total_order_quantity = Cart::where('sid', $sid)->count();
        $setting = Setting::first();
        $amount_in_words = (new HelperController)->numberToWords($order->sub_total);
        if($order->order_from == 'Tele Order')
        {
            $tele_order_count = Order::where('order_from', 'Tele Order')->where('id','<',$order->id)->count();
            $date = \Carbon\Carbon::parse($order->date);
            $invoice_no = "INV-ST-".str_pad($tele_order_count + 1, 4, '0', STR_PAD_LEFT)."-".$date->format('M')."-".$date->format('Y');
            $invoice_no = strtoupper($invoice_no);
        }
        else{
            $tele_order_count = Order::where('order_from', NULL)->where('id','<',$order->id)->count();
            $date = \Carbon\Carbon::parse($order->date);
            $invoice_no = "INV-ON-".str_pad($tele_order_count + 1, 4, '0', STR_PAD_LEFT)."-".$date->format('M')."-".$date->format('Y');
            $invoice_no = strtoupper($invoice_no);
        }
        return view('frontend.invoice', compact('billing_address', 'order', 'products','setting','amount_in_words','total_order_quantity','invoice_no'));
    }
}
