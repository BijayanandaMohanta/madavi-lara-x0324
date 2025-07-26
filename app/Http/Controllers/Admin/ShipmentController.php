<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\CartAddress;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\TrackingToken;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use App\Models\OrderLog;
use App\Models\ShipmentCookie;
use Illuminate\Support\Str;

class ShipmentController extends Controller
{
    public function shipment_in(Request $request, $sid)
    {
        // dd($sid);
        $newtoken = (new HelperController)->get_token();
        $date = date("d-m-Y");

        $token = new TrackingToken;
        $token->token = $newtoken;
        $token->date = $date;
        $token->save();


        $address = (new HelperController)->pickup_address($newtoken);
        $address_list = $address['data']['shipping_address'];
        // dd($sid);

        // Shipment Cookie Retrive
        $order = Order::where('sid', $sid)->first();
        $count_products = $order->orderCarts->count();
        if ($count_products == 1) {
            $product_id = $order->orderCarts->first()->product_id;
            $shipment_cookie = ShipmentCookie::where('product_id', $product_id)->first();
            if (!$shipment_cookie) {
                $shipment_cookie = (object) [
                    'pickup_location' => '',
                    'length' => '',
                    'breadth' => '',
                    'width' => '',
                    'height' => '',
                ];
            }
        } else {
            $shipment_cookie = (object) [
                'pickup_location' => '',
                'length' => '',
                'breadth' => '',
                'width' => '',
                'height' => '',
            ];
        }

        // dd($shipment_cookie);

        return view('admin.orders.shipment', compact('address_list', 'sid', 'shipment_cookie'));
    }
    public function shipment_generate(Request $request)
    {
        try {


            // dd($request->all());
            $date = date("d-m-Y");
            $checkToken = TrackingToken::where('date', $date)->first();

            if ($checkToken) {
                $token = $checkToken->token;
            } else {
                $token = (new HelperController)->get_token();
                $trackingToken = new TrackingToken();
                $trackingToken->date = $date;
                $trackingToken->token = $token;
                $trackingToken->save();
            }

            // dd($token);

            // dd($request->sid);
            $order = Order::where("sid", $request->sid)->first();
            // $sid = $order->sid;

            $order_date = date('Y-m-d', strtotime($order->created_at));

            // dd($order_date);

            $billing_country = "India";
            //$payment_method = $order->payment_option == 'Pay on Delivery' ? 'COD' : 'Prepaid';

            if( $order->payment_option == 'Pay Online'){
                $payment_method = 'Prepaid';
                $subb = $order->sub_total;
            }else{
                $payment_method = 'COD';
                $subb = $order->need_to_pay;
            }            


            // Fetch address details
            $address = CartAddress::where('sid', $order->sid)->orderBy('id', 'desc')->first();

            // Fetch order items
            $order_items = [];
            $items = Cart::where('sid', $order->sid)->get();
            foreach ($items as $item) {
                $product = Product::where('id', $item->product_id)->first();
                $order_items[] = [
                    'name' => substr($product->name, 0, 200),
                    'sku' => $product->id ?? 'default-sku',
                    'units' => $item->quantity,
                    'selling_price' => $item->price,
                    'discount' => "",
                    'tax' => "",
                    'hsn' => ""
                ];
            }

            // Prepare data for Shiprocket API
            $data = [
                'order_id' => $order->order_id,
                'order_date' => $order_date,
                'pickup_location' => $request->pickup_location,
                'billing_customer_name' => $address->first_name,
                'billing_last_name' => $address->last_name,
                'billing_address' => Str::limit($address->address . ',' . ($address->apartment ?? '') . ',' . ($address->landmark ?? ''), 190, ''),
                'billing_address_2' => Str::limit($address->landmark, 190, ''),
                'billing_city' => $address->city,
                'billing_pincode' => $address->pincode,
                'billing_state' => 'Andhraprasesh',
                'billing_country' => $billing_country,
                'billing_email' => $address->email,
                'billing_phone' => $address->phone,
                'shipping_is_billing' => true,
                'shipping_customer_name' => "",
                'shipping_last_name' => "",
                'shipping_address' => "",
                'shipping_address_2' => "",
                'shipping_city' => "",
                'shipping_pincode' => "",
                'shipping_country' => "",
                'shipping_state' => "",
                'shipping_email' => "",
                'shipping_phone' => "",
                'order_items' => $order_items,
                'payment_method' => $payment_method,
                'shipping_charges' => $order->delivery_charges,
                'giftwrap_charges' => 0,
                'transaction_charges' => 0,
                'total_discount' => $order->coupon_amount,
                'sub_total' => $subb,
                'length' => $request->length,
                'breadth' => $request->breadth,
                'height' => $request->height,
                'weight' => $request->weight
            ];

            // Call Shiprocket API to place order
            $place_order = (new HelperController)->place_order($token, $data);
//print_r($place_order);die();
            if(!$place_order){
                return redirect()->back()->with('error', 'Shiprocket place order failed');
            }
             //dd($place_order);

            // Process response from Shiprocket API
            $ship_status = $place_order->status;
            $ship_order_id = $place_order->order_id;
            $ship_shipment_id = $place_order->shipment_id;

            if ($ship_status == 'NEW') {
                // Update order status in the database
                $order->update([
                    'order_status' => 'Processing',
                    'length' => $request->length,
                    'breadth' => $request->breadth,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'pickup_location' => $request->pickup_location,
                    'ship_status' => $ship_status,
                    'shiprocket_order_id' => $ship_order_id,
                    'ship_shipment_id' => $ship_shipment_id
                ]);

                $order_log = new OrderLog();
                $order_log->order_id = $order->order_id;
                $order_log->status = 'Processing';
                $order_log->save();

                // Shipment Cookie Set
                $order = Order::where('sid', $request->sid)->first();
                $count_products = $order->orderCarts->count();

                if ($count_products == 1) {
                    $product_id = $order->orderCarts->first()->product_id;
                    $shipment_cookie_available = ShipmentCookie::where('product_id', $product_id)->count();
                    if ($shipment_cookie_available == 0) {
                        $shipment_cookie = new ShipmentCookie();
                        $shipment_cookie->product_id = $product_id;
                        $shipment_cookie->pickup_location = $request->pickup_location;
                        $shipment_cookie->length = $request->length;
                        $shipment_cookie->breadth = $request->breadth;
                        $shipment_cookie->height = $request->height;
                        $shipment_cookie->weight = $request->weight;
                        $shipment_cookie->save();
                    }
                }

                return redirect()->route('orders.edit', [$request->sid])->with('success', 'Order processing successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to place order');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to place order' . $e);
        }
        // dd($data);
    }
}
