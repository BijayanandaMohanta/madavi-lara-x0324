<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineOrder;
use App\Models\Product;
use Illuminate\Http\Request;

class OnlineOrderController extends Controller
{
    public function index(Request $request){
        $orders = OnlineOrder::where('payment_status','!=','');
        if($request->product_name){
            $orders = $orders->where('product','like','%'.$request->product_name);
        }
        if($request->order_status){
            $orders = $orders->where('order_status',$request->order_status);
        }
        if($request->customer_search){
            $orders = $orders->where('mobile','like','%'.$request->customer_search);
        }
         if ($request->from_date != '' && $request->to_date == '') {
            return redirect()->back()->with('message', 'To date is required');
        }
        if ($request->from_date == '' && $request->to_date != '') {
            return redirect()->back()->with('message', 'From date is required');
        }

        if ($request->from_date != '' && $request->to_date != '') {
            $str_from = strtotime($request->from_date);
            $str_to = strtotime($request->to_date);
            $orders = $orders->whereBetween('str_date', [$str_from, $str_to]);
        }

        $orders = $orders->orderBy('id','desc')->paginate(10);

        $products = Product::all();
        return view('admin.online_orders.index',compact('orders','products'));
    }
}
