<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\CartAddress;
use App\Http\Controllers\HelperController;
use App\Models\OrderLog;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\WpQueue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class OrdersController extends Controller
{

    public function invoiceGenerate($sid)
    {
        // dd($sid);
        try {
            // Fetch required data
            $billing_address = CartAddress::where('sid', $sid)->orderBy('id', 'desc')->first();
            $order = Order::where('sid', $sid)->first();
            $products = Cart::where('sid', $sid)->get();
            $setting = Setting::first();

            $amount_in_words = (new HelperController)->numberToWords($order->sub_total);
            // dd($amount_in_words);

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

            $pdf = Pdf::loadView('frontend.generate-invoice', compact('billing_address', 'order', 'products', 'setting', 'amount_in_words','invoice_no'))
                ->setPaper('A4', 'portrait')
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isRemoteEnabled', true);

            if (!$pdf) {
                throw new \Exception("PDF generation failed.");
            }

            // Define file name & directory
            $fileName = "inv_$order->order_id.pdf";
            $directory = public_path('uploads/invoices/');

            $filePath = $directory . $fileName;

            // Save the PDF to the specified path
            if (file_put_contents($filePath, $pdf->output()) === false) {
                throw new \Exception("Failed to write PDF file: " . $filePath);
            }

            // Generate a downloadable response
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'application/pdf',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function invoiceGenerateDownload($sid)
    {
        try {
            // Fetch required data
            $billing_address = CartAddress::where('sid', $sid)->orderBy('id', 'desc')->first();
            $order = Order::where('sid', $sid)->first();
            $products = Cart::where('sid', $sid)->get();
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

            $pdf = Pdf::loadView('frontend.generate-invoice', compact('billing_address', 'order', 'products', 'setting', 'amount_in_words','invoice_no'))
                ->setPaper('A4', 'portrait')
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isRemoteEnabled', true);

            // Define file name & directory
            $fileName = "inv_$order->order_id.pdf";
            $directory = public_path('uploads/invoices/');
            $filePath = $directory . $fileName;

            // Save the PDF to the specified path
            if (file_put_contents($filePath, $pdf->output()) === false) {
                throw new \Exception("Failed to write PDF file: " . $filePath);
            }
            $newfilePath = "https://openboxwale.in/public/uploads/invoices/".$fileName;
            // dd($newfilePath);
            // Return the file path for further processing in a loop
            return $filePath;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function place_orders(){
        $orders = Order::where('txn_id', '!=', '')->where('ship_shipment_id', NULL)->whereNotIn('order_status',['Cancelled','Delivered','Store Pickuped'])->orderBy('id','desc')->paginate(10);
        foreach($orders as $order){
            $order->customer_name = 'N/A';
            $order->customer_phone = 'N/A';
            $customer_detail = CartAddress::select(['first_name','last_name','phone'])->where('sid', $order->sid)->first();
            $order->customer_name = $customer_detail->first_name.' '.$customer_detail->last_name;
            $order->customer_phone = $customer_detail->phone;
            
            // Check customer get wp message or not
            $wp_queue = WPQueue::where('order_id', $order->order_id)->first();
            if(!$wp_queue){
                $new_wp_queue = new WPQueue();
                $new_wp_queue->sid = $order->sid;
                $new_wp_queue->order_id = $order->order_id;
                $new_wp_queue->number = $order->customer_phone;
                $new_wp_queue->status = 'Pending';
                $new_wp_queue->save();
            }
        }
        return view('admin.orders.placeorder', [
            'orders' => $orders
        ]);
    }

    public function index(Request $request)
    {
        $orders = Order::where('order_status', '!=', 'Pending')
        ->where('payment_status','Paid')
        ->where(function ($query) {
            $query->where('payment_option', '=', 'Pay Online')
                  ->where('txn_id', '!=', '')
                  ->orWhere('payment_option', '!=', 'Pay Online');
        });

        if ($request->customer_search) {
            $found_orders_sid = CartAddress::where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->customer_search . '%')
                      ->orWhere('last_name', 'like', '%' . $request->customer_search . '%')
                      ->orWhere('phone', 'like', '%' . $request->customer_search . '%')
                      ->orWhere('email', 'like', '%' . $request->customer_search . '%');
            })->pluck('sid');
            $orders = $orders->whereIn('sid', $found_orders_sid);
        }
        if($request->product_name){
            $found_orders_sid_collection = Cart::where('product_name', 'like', '%' . $request->product_name . '%')->where('status','Completed')->pluck('sid');
            $found_orders_sid_string = $found_orders_sid_collection->implode(',');
            $orders = $orders->whereIn('sid', $found_orders_sid_collection);
        }

        if($request->order_id){
           $orders = $orders->where('order_id', $request->order_id);
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

        if ($request->order_status != '') {
            $order_status = $request->order_status;
            $orders = $orders->where('order_status', $order_status);
        }

        if ($request->order_from != '') {
            $order_from = $request->order_from == 'Online' ? NULL : $request->order_from;
            $orders = $orders->where('order_from', $order_from);
        }

        if ($request->payment_option != '') {
            $orders = $orders->where('payment_option', $request->payment_option);
        }

        $orders = $orders->orderBy('id','desc')->paginate(10);

        foreach($orders as $order){
            $order->customer_name = 'N/A';
            $order->customer_phone = 'N/A';
            $customer_detail = CartAddress::select(['first_name','last_name','phone'])->where('sid', $order->sid)->first();
            $order->customer_name = $customer_detail->first_name.' '.$customer_detail->last_name;
            $order->customer_phone = $customer_detail->phone;
        }

        $products = Product::select('name')->get();
       
        return view('admin.orders.index', compact('orders','products'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function edit($id)
    {

        $carts = DB::connection('read')->table('carts')->where('sid', $id)->get();
        $order = Order::where('sid', $id)->first();
        $address_data = CartAddress::Where('sid', $id)->first();

        $totalQuantity = 0; // To store sum of quantities
        $totalSubTotal = 0; // To store sum of sub totals
        $totalmop = 0; // To store sum of sub totals
        $totalprice = 0; // To store sum of sub totals
        $savings1 = 0;

        foreach ($carts as $cart) {
            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();
            $cart->slug = $product_data->slug ?? '';
            // $cart->sl_no = $product_data->sl_no ?? '';
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

        $order_log = OrderLog::where('order_id', $order->order_id)->orderBy('id', 'desc')->first();
        if (!$order_log) {
            $order_log = new OrderLog();
            $order_log->order_id = $order->order_id;
            $order_log->status = "Tele Order";
        }
        return view('admin.orders.edit', compact('carts', 'order', 'address_data', 'order_log'));
    }
    public function update(Request $request, $sid)
    {
        $order1 = Order::where("sid", $sid)->first();
        $cart_address = CartAddress::where("sid", $order1->sid)->first();
        // dd($sid);
        if ($order1) {
            $order_log = new OrderLog();
            $order_log->order_id = $order1->order_id;
            $order_log->status = $request->order_status;
            if ($request->order_status == "Cancelled" || $request->order_status == "Undelivered" || $request->order_status == "Return And Refund") {
                $carts = Cart::where('sid', $sid)->get();
                // Revert the stock
                foreach ($carts as $cart) {
                    $product_data = Product::where('id', $cart->product_id)->first();

                    //update Stock
                    if (!$product_data) {
                        continue;
                    }
                    $balance = $product_data->stock + $cart->quantity;
                    $product_data->stock = $balance;
                    $product_data->save();

                    $remark = $cart->quantity . '' . " Credited For Order $request->order_status with  $order1->order_id";
                    $stock = new ProductStock();
                    $stock->type = 'Credit';
                    $stock->remark = $remark;
                    $stock->product_id = $cart->product_id;
                    $stock->save();
                }
            }
            $order_log->save();

            $order1->order_status = $request->order_status;
            $order1->save();
            // Assuming you have a date string in this format: '2025-01-02 08:05:04'
            $originalDate = $order1->updated_at;

            // Convert and format to 'dd-mm-yy'
            $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $originalDate)->format('d-m-Y');

            $subject = "Your Order #{$order1->order_id} Has Been {$order1->order_status}!";

            $msg = "Dear {$cart_address->first_name} {$cart_address->last_name}
                Your order #{$order1->order_id}, status changed to {$order1->order_status}.<br><br>

                Here are your order details:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We’re excited to serve you, and we hope you love your purchase.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team <br>";

            if ($request->order_status == 'Shipped') {
                $subject = "🚚 Your Order {$order1->order_id} Has Been Shipped!";

                $link = 'https://www.shiprocket.in/';
                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name}
                Great news! Your order #{$order1->ship_shipment_id} has been successfully shipped and is on its way to you. 🎉<br><br>

                You can track the status of your shipment here:<br>
                👉 Track My Order ( Link to Tracking page or order view page)<br>

                Here are your order details:<br><br>

                Order ID: #{$order1->ship_shipment_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We’re excited to serve you, and we hope you love your purchase.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team <br>";

                // $sms = "Dear {User}, your order {$order1->order_id} has been shipped and is on its way! Expected delivery: {#var#}. Track here: {#var#}.  Buy at openboxwale.in";

                // (new HelperController)->sendSms($cart_address->phone, $sms);
                $parameters = "$cart_address->first_name $cart_address->last_name,$order1->order_id,$order1->date,https://openboxwale.in/dashboard-trackorder?order_id=$order1->order_id";

                (new HelperController)->sendWhatsappMessage($cart_address->phone, 'order_shipment', $parameters);
            }
            if ($request->order_status == 'Delivered') {
                $subject = "🎉 Your Order #{$order1->order_id} Has Been Successfully Delivered!";

                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name},<br>

                We’re delighted to let you know that your order #{$order1->order_id} has been successfully delivered! 🎁<br><br>

                Here are your order details for reference:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Delivered On: {$formattedDate}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We hope you enjoy your purchase. If you have any feedback or need assistance, feel free to reach out to us.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team<br>";

                $name = Str::limit($cart_address->first_name, 30);

                $sms = "Dear {$name}, your order {$order1->order_id} has been delivered. We hope you enjoy your purchase! For any support, contact: support@OpenBoxWale.in.";

                (new HelperController)->sendSms($cart_address->phone, $sms);

                $parameters = "$cart_address->first_name $cart_address->last_name,$order1->order_id";

                (new HelperController)->sendWhatsappMessage($cart_address->phone, 'open4', $parameters);
            }
            if ($request->order_status == 'Accepted') {
                $subject = "🎉 Your Order #{$order1->order_id} Has Been Accepted!";

                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name},<br>
                We’re thrilled to inform you that your order #{$order1->order_id} has been successfully accepted! 🎉<br>

                Here are the details of your order:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                You’ll receive another update as soon as your order is shipped.<br>

                Thank you for choosing OpenBoxWale! We’re excited to serve you.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team";
            }

            if ($request->order_status == 'Cancelled') {

                $subject = "😢 Your Order #{$order1->order_id} Has Been Cancelled!";

                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name},<br>
                We’re soory to inform you that your order #{$order1->order_id} has been cancelled.<br>

                Here are the details of your order:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We’re feel sorry for your cancellation.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team";

                $name = Str::limit($cart_address->first_name, 30);
                $sms = "Dear {$name}, your order {$order1->order_id} has been cancelled as per your request. Refunds (if applicable) will be processed within 7 days. For details, reach out to support@openboxwale.in";

                (new HelperController)->sendSms($cart_address->phone, $sms);
            }

            if ($cart_address->email ?? null && $request->order_status != 'Blocked') {
                (new HelperController)->sendZohoEmail($subject, $msg, $cart_address->first_name ?? 'User', $cart_address->email);
            }
            return redirect()->back()->with('success', 'Order updated successfully');
        } else {
            return redirect()->back()->with('danger', 'Order not found');
        }
    }
    public function update_order_sl_no(Request $request)
    {
        $slno = $request->input('slno');
        $cart_id = $request->input('cart_id');
        // $product_id = $request->input('product_id');
        $cart = Cart::findOrfail($cart_id);
        // $product = Product::findOrfail($product_id);
        $cart->update(['sl_no' => $slno]);
        // $product->update(['sl_no' => $slno]);
        return response()->json(['status' => 'success']);
    }
    public function download_all_invoice(Request $request){

        $orders = Order::select('sid')->whereNotIn('order_status', ['Pending', 'Cancelled', 'Return And Refund']);

        if ($request->from_date == '' && $request->to_date == '') {
            return redirect()->back()->with('message', 'From date and To date is required');
        }

        if ($request->from_date != '' && $request->to_date == '') {
            return redirect()->back()->with('message', 'To date is required');
        }
        if ($request->from_date == '' && $request->to_date != '') {
            return redirect()->back()->with('message', 'From date is required');
        }

        if ($request->from_date != '' && $request->to_date != '') {
            $orders = $orders->whereBetween('created_at', [Carbon::parse($request->from_date), Carbon::parse($request->to_date)]);
        }

        if (is_array($request->payment_option) && count($request->payment_option) > 0) {
            $orders = $orders->whereIn('payment_option', $request->payment_option);
        }

        // Use the original query for further operations
        $orders = $orders->orderBy('id', 'desc')->get();

        // Log the SQL query
        // Log::info($orders->toSql(), $orders->getBindings());
        // dd($orders);

        // Get all pdf file locations
        if ($orders->isEmpty()) {
            return redirect()->back()->with('message', 'No orders found');
        }

        $filePaths = [];
        foreach ($orders as $order) {
            $filePaths[] = $this->invoiceGenerateDownload($order->sid);
        }

        // Download pdf invoices in loop
       $zipFilePath = $this->downloadFiles($filePaths);
        return response()->download($zipFilePath);

    }
    public function downloadFiles($filePaths)
    {
        // Validate input
        if (empty($filePaths)) {
            return response()->json(['error' => 'No files to download'], 400);
        }

        // Define the path for the zip file inside the public directory
        $zipFileName = 'files.zip';
        $zipFilePath = public_path($zipFileName);

        // Delete the existing file if exists
        if (file_exists($zipFilePath)) {
            unlink($zipFilePath);
        }

        // Check if the public directory is writable
        if (!is_writable(dirname($zipFilePath))) {
            return response()->json(['error' => 'Public directory is not writable'], 500);
        }

        // Initialize the ZipArchive
        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
            return response()->json(['error' => 'Failed to create zip file'], 500);
        }

        // print_r($zip);die;
        // Add files to the zip archive
        $filesAdded = false;

        foreach ($filePaths as $filePath) {
            if (file_exists($filePath)) {
                $zip->addFile($filePath, basename($filePath));
                $filesAdded = true;
            } else {
                return response()->json(['error' => "File not found: {$filePath}"], 404);
            }
        }

        // print_r($filesAdded);die;

        $zip->close();

        // Verify that the zip file was created
        if (!$filesAdded || !file_exists($zipFilePath)) {
            return response()->json(['error' => 'Zip file was not created'], 500);
        }

        // Return the zip file for download
        // print_r($zipFilePath);
        // $zipFilePath = str_replace('/var/www/openboxwale__usr/data/www/openboxwale.in/public/', '', $zipFilePath);
        return $zipFilePath;
    }

    public function orders_update_ajax(Request $request)
    {
        // return $request->sid;
        $order1 = Order::where("sid", $request->sid)->first();
        $cart_address = CartAddress::where("sid", $order1->sid)->first();
        if ($order1) {
            $order_log = new OrderLog();
            $order_log->order_id = $order1->order_id;
            $order_log->status = $request->order_status;
            if ($request->order_status == "Cancelled" || $request->order_status == "Undelivered" || $request->order_status == "Return And Refund") {
                $carts = Cart::where('sid', $request->sid)->get();
                // Revert the stock
                foreach ($carts as $cart) {
                    $product_data = Product::where('id', $cart->product_id)->first();

                    //update Stock
                    if (!$product_data) {
                        continue;
                    }
                    $balance = $product_data->stock + $cart->quantity;
                    $product_data->stock = $balance;
                    $product_data->save();

                    $remark = $cart->quantity . '' . " Credited For Order $request->order_status with  $order1->order_id";
                    $stock = new ProductStock();
                    $stock->type = 'Credit';
                    $stock->remark = $remark;
                    $stock->product_id = $cart->product_id;
                    $stock->save();
                }
            }
            $order_log->save();

            $order1->order_status = $request->order_status;
            $order1->save();
            // Assuming you have a date string in this format: '2025-01-02 08:05:04'
            $originalDate = $order1->updated_at;

            // Convert and format to 'dd-mm-yy'
            $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $originalDate)->format('d-m-Y');

            $subject = "Your Order #{$order1->order_id} Has Been {$order1->order_status}!";

            $msg = "Dear {$cart_address->first_name} {$cart_address->last_name}
                Your order #{$order1->order_id}, status changed to {$order1->order_status}.<br><br>

                Here are your order details:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We’re excited to serve you, and we hope you love your purchase.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team <br>";

            if ($request->order_status == 'Shipped') {
                $subject = "🚚 Your Order {$order1->order_id} Has Been Shipped!";

                $link = 'https://www.shiprocket.in/';
                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name}
                Great news! Your order #{$order1->ship_shipment_id} has been successfully shipped and is on its way to you. 🎉<br><br>

                You can track the status of your shipment here:<br>
                👉 Track My Order ( Link to Tracking page or order view page)<br>

                Here are your order details:<br><br>

                Order ID: #{$order1->ship_shipment_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We’re excited to serve you, and we hope you love your purchase.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team <br>";

                // $sms = "Dear {User}, your order {$order1->order_id} has been shipped and is on its way! Expected delivery: {#var#}. Track here: {#var#}.  Buy at openboxwale.in";

                // (new HelperController)->sendSms($cart_address->phone, $sms);
                $parameters = "$cart_address->first_name $cart_address->last_name,$order1->order_id,$order1->date,https://openboxwale.in/dashboard-trackorder?order_id=$order1->order_id";

                (new HelperController)->sendWhatsappMessage($cart_address->phone, 'order_shipment', $parameters);
            }
            if ($request->order_status == 'Delivered') {
                $subject = "🎉 Your Order #{$order1->order_id} Has Been Successfully Delivered!";

                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name},<br>

                We’re delighted to let you know that your order #{$order1->order_id} has been successfully delivered! 🎁<br><br>

                Here are your order details for reference:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Delivered On: {$formattedDate}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We hope you enjoy your purchase. If you have any feedback or need assistance, feel free to reach out to us.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team<br>";

                $name = Str::limit($cart_address->first_name, 30);

                $sms = "Dear {$name}, your order {$order1->order_id} has been delivered. We hope you enjoy your purchase! For any support, contact: support@OpenBoxWale.in.";

                (new HelperController)->sendSms($cart_address->phone, $sms);

                $parameters = "$cart_address->first_name $cart_address->last_name,$order1->order_id";

                (new HelperController)->sendWhatsappMessage($cart_address->phone, 'open4', $parameters);
            }
            if ($request->order_status == 'Accepted') {
                $subject = "🎉 Your Order #{$order1->order_id} Has Been Accepted!";

                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name},<br>
                We’re thrilled to inform you that your order #{$order1->order_id} has been successfully accepted! 🎉<br>

                Here are the details of your order:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                You’ll receive another update as soon as your order is shipped.<br>

                Thank you for choosing OpenBoxWale! We’re excited to serve you.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team";
            }

            if ($request->order_status == 'Cancelled') {

                $subject = "😢 Your Order #{$order1->order_id} Has Been Cancelled!";

                $msg = "Dear {$cart_address->first_name} {$cart_address->last_name},<br>
                We’re soory to inform you that your order #{$order1->order_id} has been cancelled.<br>

                Here are the details of your order:<br><br>

                Order ID: #{$order1->order_id}<br>
                Order Date: {$order1->date}<br>
                Order Total: ₹{$order1->grand_total}<br><br>

                Thank you for choosing OpenBoxWale! We’re feel sorry for your cancellation.<br><br>

                Happy shopping,<br>
                The OpenBoxWale Team";

                $name = Str::limit($cart_address->first_name, 30);
                $sms = "Dear {$name}, your order {$order1->order_id} has been cancelled as per your request. Refunds (if applicable) will be processed within 7 days. For details, reach out to support@openboxwale.in";

                (new HelperController)->sendSms($cart_address->phone, $sms);
            }

            if ($cart_address->email ?? null && $request->order_status != 'Blocked') {
                (new HelperController)->sendZohoEmail($subject, $msg, $cart_address->first_name ?? 'User', $cart_address->email);
            }
            return response()->json(['status' => 'success', 'message' => 'Order updated successfully']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Order updated unsuccessfully']);
        }
    }

}
