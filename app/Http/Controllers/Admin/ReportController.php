<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\CartAddress;
use App\Exports\BestSellingProductReport;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockReport;
use App\Exports\ContactExport;
use App\Exports\CartPendingExport;

class ReportController extends Controller
{
    public function orders_report(Request $request)
    {
        $orders = Order::where('order_status', '!=', 'Pending')->where('order_status', '!=', 'Cancelled');

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

        if ($request->order_status != '') {
            $order_status = $request->order_status;
            $orders = $orders->where('order_status', $order_status);
        }

        if ($request->order_from != '') {
            $order_from = $request->order_from == 'Online' ? NULL : $request->order_from;

            if ($request->order_from == 'Online') {
                // Online chosen, set offline counts and amounts to 0
                $total_online_order = (clone $orders)->where('order_from', NULL)->count();
                $total_online_order_amount = (clone $orders)->where('order_from', NULL)->sum('sub_total');

                $total_offline_order = 0;
                $total_offline_order_amount = 0;
            } else {
                // Offline chosen, set online counts and amounts to 0
                $total_online_order = 0;
                $total_online_order_amount = 0;

                $total_offline_order = (clone $orders)->where('order_from', 'Tele Order')->count();
                $total_offline_order_amount = (clone $orders)->where('order_from', 'Tele Order')->sum('grand_total');
            }

            // Apply the filter for order_from to the main query
            $orders = $orders->where('order_from', $order_from);
        } else {

            $total_online_order = (clone $orders)->where('order_from', NULL)->count();
            $total_online_order_amount = (clone $orders)->where('order_from', NULL)->sum('grand_total');

            $total_offline_order = (clone $orders)->where('order_from', 'Tele Order')->count();
            $total_offline_order_amount = (clone $orders)->where('order_from', 'Tele Order')->sum('grand_total');
        }

        if ($request->payment_option != '') {
            $orders = $orders->where('payment_option', $request->payment_option);
        }

        $totalEarningsDiscounts = (clone $orders)->sum('coupon');

        $report_orders = (clone $orders)->get();
        // Use the original query for further operations
        $orders = $orders->with(['customer:id,name,mobile'])->orderBy('id', 'desc')->paginate(10);


        return view('admin.reports.orders', compact('orders', 'total_online_order', 'total_online_order_amount', 'total_offline_order', 'total_offline_order_amount', 'report_orders','totalEarningsDiscounts'));
    }
    public function stocks_report(Request $request)
    {
        $products = Product::orderby('stock', 'desc');
        if ($request->filter == "Out Of Stock") {
            $products = $products->where("stock", "=", 0);
        }
        if ($request->filter == "Low Stock") {
            $products = $products->whereRaw('stock <= min_stock')->where('stock', ">", 0);
        }
        if ($request->filter == "In Stock") {
            $products = $products->where('stock', "!=", 0)->whereRaw('stock > min_stock');
        }
        if ($request->name != '') {
            $products = $products->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $products = $products->paginate(10);
        $out_of_stock = Product::where('stock', 0)->count();
        $low_stock = Product::whereRaw('stock <= min_stock')->where('stock', ">", 0)->count();
        $in_stock = Product::where('stock', "!=", 0)->whereRaw('stock > min_stock')->count();
        return view('admin.reports.stocks', compact('products', 'out_of_stock', 'low_stock', 'in_stock'))->with('filter', $request->filter);
    }
    public function best_selling_products_report()
    {
        $bestsellingproducts = Cart::where('status', 'Completed')
            ->groupBy('product_id')
            ->select('product_id', DB::raw('count(*) as count_per_product'))
            ->orderBy('count_per_product', 'desc')
            ->with('product')
            ->get();

        // dd($bestsellingproducts);
        return view('admin.reports.bestsellingproducts', compact('bestsellingproducts'));
        // return view('admin.reports.bestsellingproducts',compact('bestsellingproducts'));
    }
    public function statistics_report(Request $request)
    {
        // $ordersByMonth = Order::ordersByMonth()->get();
        //dd($request->payment_option);

        // Get the current date and the date 6 months ago
        $sixMonthsAgo = now()->subMonths(6);

        $orders = Order::where('order_status', '!=', 'Pending');

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

        if ($request->payment_option != '') {
            $payment_option = $request->payment_option;
            $orders = $orders->where('payment_option', $payment_option);
        }

        if ($request->order_from != '') {
            $order_from = $request->order_from == 'Online' ? NULL : $request->order_from;

            // Apply the filter for order_from to the main query
            $orders = $orders->where('order_from', $order_from);
        }
        

        // Query to get orders with status "Delivered" in the last 6 months
        $ordersDelivered = (clone $orders)->where('order_status', 'Delivered')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->orderBy('created_at', 'asc')
            ->count();

        // Query to get orders with status "Cancelled" in the last 6 months
        $ordersCancelled = (clone $orders)->where('order_status', 'Cancelled')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->orderBy('created_at', 'asc')
            ->count();

        // Bar with line chart data
        // Initialize an array to store order counts for each month
        $orderData = [];

        // Loop through the last 6 months
        for ($i = 0; $i < 6; $i++) {
            $month = now()->subMonths($i)->format('Y-m'); // Format as 'YYYY-MM'
            $monthName = now()->subMonths($i)->format('M-Y'); // Format as full month name (e.g., 'January')
            $orderData[$monthName] = [
                'delivered' => 0,
                'cancelled' => 0,
            ];
        }

        // Fetch delivered and cancelled orders for the last 6 months
        $allOrders = (clone $orders)->whereIn('order_status', ['Delivered', 'Cancelled'])
            ->where('created_at', '>=', $sixMonthsAgo)
            ->get();

        // Populate the order data
        foreach ($allOrders as $order) {
            $monthName = $order->created_at->format('M-Y'); // Format as full month name (e.g., 'January')
            if (array_key_exists($monthName, $orderData)) {
                if ($order->order_status === 'Delivered') {
                    $orderData[$monthName]['delivered']++;
                } elseif ($order->order_status === 'Cancelled') {
                    $orderData[$monthName]['cancelled']++;
                }
            }
        }

        // Prepare data for the chart
        $labels = array_keys($orderData);
        $deliveredData = array_column($orderData, 'delivered');
        $cancelledData = array_column($orderData, 'cancelled');

        // Bar chart for collection

        // Initialize an array to store order counts for each month
        $orderDataCollection = [];

        // Loop through the last 6 months
        for ($i = 0; $i < 6; $i++) {
            $month = now()->subMonths($i)->format('Y-m'); // Format as 'YYYY-MM'
            $monthLabelCollection = now()->subMonths($i)->format('M-Y'); // Format as 'YYYY-MMM' (e.g., '2025-Jan')
            $orderDataCollection[$monthLabelCollection] = [
                'offline' => 0, // Tele Order (Offline)
                'online' => 0,  // Online (empty order_from)
            ];
        }

        // Fetch orders for the last 6 months
        $allOrders = (clone $orders)->where('created_at', '>=', $sixMonthsAgo)->where('payment_status', 'Paid')
            ->get();

        // Populate the order data
        foreach ($allOrders as $order) {
            $monthLabelCollection = $order->created_at->format('M-Y'); // Format as 'YYYY-MMM' (e.g., '2025-Jan')
            if (array_key_exists($monthLabelCollection, $orderDataCollection)) {
                if ($order->order_from == 'Tele Order') {
                    $orderDataCollection[$monthLabelCollection]['offline']++; // Offline orders
                } else {
                    $orderDataCollection[$monthLabelCollection]['online']++; // Online orders
                }
            }
        }

        // Prepare data for the chart
        $labelsCollection = array_keys($orderDataCollection);
        $offlineData = array_column($orderDataCollection, 'offline');
        $onlineData = array_column($orderDataCollection, 'online');

        // Calculate total counts
        $totalOffline = array_sum($offlineData); // Total offline orders
        $totalOnline = array_sum($onlineData);   // Total online orders

        return view('admin.reports.statistics', compact('ordersDelivered', 'ordersCancelled', 'labels', 'deliveredData', 'cancelledData', 'labelsCollection', 'offlineData', 'onlineData','totalOffline','totalOnline'));
    }

    // Report excel export
    public function export_stock_report(Request $request)
    {
        return Excel::download(new StockReport, 'stock_report.xlsx');
    }
    public function export_best_selling_products_report(Request $request)
    {
        return Excel::download(new BestSellingProductReport, 'best_selling_products_report.xlsx');
    }
    public function export_contact_enquiry(Request $request)
    {
        return Excel::download(new ContactExport, 'contactrequests.xlsx');
    }
    public function exportOrders(Request $request)
    {
        $orders = json_decode($request->orders, true);
        $orders = collect($orders);
        $orders = $orders->toArray();
        foreach ($orders as &$order) { // Use & to pass by reference
            // Add Billing address & customer information
            $address = CartAddress::where('sid', $order['sid'])->first();
            if ($address) {
                $order['customer_name'] = $address->first_name . ' ' . $address->last_name;
                $order['customer_email'] = $address->email;
                $order['customer_phone'] = $address->phone;
                $order['billing_address'] = $address->address . " " . $address->apartment . " " . $address->city . " " . $address->state . " " . $address->pincode;
                $order['shipping_address'] = $address->address . " " . $address->apartment . " " . $address->city . " " . $address->state . " " . $address->pincode;
            } else {
                // Handle the case where the address is not found
                $order['customer_detail'] = 'N/A';
                $order['billing_address'] = 'N/A';
                $order['shipping_address'] = 'N/A';
            }

            // Total Product & total quantity 
            $total_product = Cart::where('sid', $order['sid'])->count('product_id');
            $total_quantity = Cart::where('sid', $order['sid'])->sum('quantity');

            $order['total_items'] = $total_product;
            $order['total_quantity'] = $total_quantity;

            // dd($order);
        }
        $orders = collect($orders);
        // dd($orders);

        return Excel::download(new OrderExport($orders), 'orders.xlsx');
    }
    public function download_all_invoice_report(){
        return view('admin.reports.downloadallinvoice');
    }
    public function export_all_pending_cart(){
        return Excel::download(new CartPendingExport, 'cart_pendings.xlsx');
    }
}
