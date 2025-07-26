<?php

namespace App\Http\Controllers\Cron;

use App\Cart;
use App\CartAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Str;
use App\Order;
use App\OrderLog;
use App\Product;
use App\ProductImage;
use App\ProductStock;
use App\Setting;
use App\Test;
use App\TrackingToken;
use Razorpay\Api\Api;

class UpdateOrderStatusController extends Controller
{
    public function invoiceGenerate($sid)
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
            // Generate PDF
            // $pdf = Pdf::loadView('frontend.generate-invoice', compact('billing_address', 'order', 'products', 'base64Svg', 'setting'));
            $pdf = Pdf::loadView('frontend.generate-invoice', compact('billing_address', 'order', 'products', 'setting','amount_in_words','invoice_no'));

            if (!$pdf) {
                throw new Exception("PDF generation failed.");
            }

            // Define file name & directory
            $fileName = "inv_$order->order_id.pdf";
            $directory = public_path('uploads/invoices/');

            // Ensure the directory exists
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Ensure the directory is writable
            if (!is_writable($directory)) {
                throw new Exception("Directory is not writable: " . $directory);
            }

            $filePath = $directory . $fileName;

            // Save the PDF to the specified path
            if (file_put_contents($filePath, $pdf->output()) === false) {
                throw new Exception("Failed to write PDF file: " . $filePath);
            }

            $filePath = "https://openboxwale.in/public/uploads/invoices/".$fileName;
            return $filePath;

            //return response()->file(public_path("uploads/invoices/$fileName"));
        } catch (Exception $e) {
            return "no-file";
        }
    }
    public function update_order_status()
    {
        return "Cron is not ready yet!";
        $currentTime = Carbon::now()->format('Y-m-d H:i:s');
        $name = "Update Order Status";
        // $test = new Test;
        // $test->name = $name;
        // $test->datetime = $currentTime;
        // $test->save();
        // dd("Cron is not ready yet!");
        $date = Carbon::now()->format('d-m-Y');
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

        $orders = Order::where('shiprocket_order_id', '!=', '')
            ->where('date', $date)
            ->whereNotIn('order_status', ['Delivered', 'Cancelled'])
            ->get();

        foreach ($orders as $order) {
            $response = (new HelperController)->trackByShipment($token,$order->ship_shipment_id);
            $currentStatus = $response['current_status'] ?? '';
            
            if ($currentStatus && $currentStatus != $order->order_status) {
                Order::where('id', $order->id)->update([
                    'order_status' => $currentStatus,
                ]);

                $date = Carbon::now()->format('d-m-Y');

                $orderLog = new OrderLog();
                $orderLog->order_id = $order->order_id;
                $orderLog->status = $currentStatus;
                $orderLog->save();

                $msg = "Dear User, your order #$order->order_id status has been updated to $currentStatus. Track your order status here: https://www.shiprocket.in/. Thank you!";

                $cart_address = CartAddress::where('sid', $order->sid)->orderBy('id', 'desc')->first();

                // Use HelperController to send SMS
                (new HelperController)->sendSms($cart_address->mobile, $msg);
            }
        }
    }
    public function check_pending_payments()
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $date = now()->format('d-m-Y');

        $currentTime = Carbon::now()->format('Y-m-d H:i:s');
        $name = "Check pending payment";
        // $test = new Test;
        // $test->name = $name;
        // $test->datetime = $currentTime;
        // $test->save();
        // dd("Cron is not ready yet!");

        // Initialize totals
        $totalQuantity = 0;
        $totalSubTotal = 0;
        $totalmop = 0;
        $totalprice = 0;
        $savings1 = 0;
        // $date = '28-02-2025';

        $pendingOrders = Order::where('date', $date)
            ->where('order_status', 'Pending')
            ->where('payment_status', 'Pending')
            ->whereNotNull('razorpay_order_id')
            ->get();

        // Print the raw SQL query
        //dd($pendingOrders->toSql(), $pendingOrders->getBindings());


        // $pendingOrders = Order::where('sid', '619950637750')->get();

        // dd($pendingOrders);
        // $apiRes = $api->order->fetch("order_PzDompMT1r8tnq")->payments();
        //dd($apiRes);

        foreach ($pendingOrders as $order) {
            $sid = $order->sid;
            $apiRes = $api->order->fetch($order->razorpay_order_id)->payments();
            // dd($apiRes);
            $latestStatus = '';
            $latestPayment = null;

            if ($apiRes->count > 0) {
                foreach ($apiRes->items as $payment) {
                    if ($latestPayment === null || $payment['created_at'] > $latestPayment['created_at']) {
                        $latestPayment = $payment;
                        $latestStatus = $payment['status'];
                    }
                }
            }
            // print_r($latestStatus);die();
            //print_r($latestPayment['id']);die();
            if ($latestStatus === 'captured') {
                $txnId = $latestPayment['id'];


                try {

                    $order->update([
                        'order_status' => 'Placed',
                        'payment_status' => 'Paid',
                        'txn_id' => $txnId,
                    ]);

                    $order_id = $order->order_id;

                    // Precheck that the reference sid if there found with order sid then just update those carts with reference sid to sid
                    $precheck_carts = Cart::where('ref_sid', $order->sid)->get();
                    if($precheck_carts->count() > 0){
                        Cart::where('ref_sid', $order->sid)->update([
                            'sid' => $order->sid
                        ]);
                    }
                    // End precheck
                    $carts = Cart::where('sid', $order->sid)->get();

                    foreach ($carts as $cart) {
                        $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
                        $cart->image = $product_image->image ?? "no-image";
                        $product_data = Product::where('id', $cart->product_id)->first();

                        //update Stock
                        $balance = $product_data->stock - $cart->quantity;
                        $product_data->stock = $balance;
                        $product_data->save();

                        // $remark = $cart->quantity . '' . "Debited For Order  with Order id #$order->order_id";
                        // $stock = new ProductStock();
                        // $stock->type = 'Debit';
                        // $stock->remark = $remark;
                        // $stock->product_id = $cart->product_id;
                        // $stock->save();
                        //end update stock

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
                        Cart::where('sid', $sid)->update(['status' => 'Completed']);
                    }

                    // Update the cart status as well
                    // $cart = Cart::where('sid', $order->sid)->first();
                    // if ($cart->ref_sid != '') {
                    //     Cart::where('sid', $cart->ref_sid)->update([
                    //         'sid' => $cart->ref_sid,
                    //         'status' => "Completed"
                    //     ]);
                    // }
                    // else{
                    //     Cart::where('sid', $cart->sid)->update([
                    //         'status' => "Completed"
                    //     ]);
                    // }

                    // Insert order log and notifications
                    DB::table('order_log')->insert([
                        'order_id' => $order->order_id,
                        'status' => 'Placed'
                    ]);

                    $customer_id = $order->customer_id;
                    $date = date('d-m-Y');
                    $str_date = strtotime($date);

                    $address_data = CartAddress::Where('customer_id', $customer_id)->Where('sid', $ref_sid ?? $sid)->first();

                    $link = 'https://www.shiprocket.in/';
                    $u = "User";
                    $name = Str::limit($address_data->first_name, 30);
                    $msg = "Dear {$name}, your order {$order_id} has been successfully placed with OpenBoxWale. Track your order status here: {$link}. Thank you for choosing OBW!";
                    $sub = "🤗 Order Confirmation: Your Order #{$order_id} with OpenBoxWale ";
                    $email_msg = "Dear {$address_data->first_name} {$address_data->last_name}, <br><br> 

                    Thank you for shopping with OpenBoxWale! Weâ€™re excited to let you know that your order has been successfully placed. <br> 

                    Here are your order details:  <br>

                    Order ID: #{$order_id}  <br>
                    Order Date: {$order->date} <br>  
                    Order Total: {$order->grand_total} <br><br>

                    Youâ€™ll receive another email once your order is accepted and shipped.  <br>

                    We truly appreciate your trust in OpenBoxWale. If you have any questions, feel free to reach out to us anytime.<br><br>  

                    Happy shopping!  <br>
                    The OpenBoxWale Team";

                    // Update if buy now concept applied

                    (new HelperController)->sendSms($address_data->phone, $msg);
                    (new HelperController)->sendZohoEmail($sub, $email_msg, $u, $address_data->email);


                    $sub = "🤗 New Order: #{$order_id} Came ";
                    $email_msg = "Dear Openbox Admin, <br><br> 

                    You Got A New Order, please Check The details below and in Admin Portal and Proceed. <br> 

                    Here are your order details:  <br>
                    
                    Customer Name: {$address_data->first_name} {$address_data->last_name}  <br>
                    Customer Mobile: {$address_data->phone} <br>
                    Customer Email: {$address_data->email}  <br>
                    Order ID: #{$order_id}  <br>
                    Order Date: {$order->date} <br>  
                    Order Total: {$order->grand_total} <br><br>
                    ";
                    $setting = Setting::first();

                    (new HelperController)->sendZohoEmail($sub, $email_msg, 'Admin', $setting->email);

                    $attachment_link = $this->invoiceGenerate($ref_sid ?? $sid);
                    $file_name = "inv_$order_id";

                    (new HelperController)->sendWhatsappMessageWithPdf($address_data->phone, 'open_feedback', $file_name, $attachment_link);

                    // Commit all database changes

                } catch (\Exception $e) {

                    // Log or handle the exception as needed
                }
            }
        }

        // return response()->json(['message' => 'Payment statuses checked and updated successfully']);
    }
}
