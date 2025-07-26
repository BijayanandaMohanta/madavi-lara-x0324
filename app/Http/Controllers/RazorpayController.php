<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartAddress;
use App\Order;
use App\OrderLog;
use App\Product;
use App\ProductImage;
use App\ProductStock;
use App\Setting;
use App\WpQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HelperController;
use Exception;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class RazorpayController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }

    public function initiatePayment(Request $request)
    {
        // $orderAmount = $request->amount; // Amount in INR
        $orderAmount = 1;
        $orderData = [
            'receipt'         => 'rcptid_' . time(),
            'amount'          => $orderAmount * 100, // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1, // Auto-capture
        ];

        $razorpayOrder = $this->api->order->create($orderData);

        return view('razorpay.payment', [
            'order_id'    => $razorpayOrder->id,
            'amount'      => $orderAmount,
            'key'         => env('RAZORPAY_KEY'),
            'callback_url' => route('razorpay.callback'),
        ]);
    }

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

    public function handleCallback(Request $request)
    {
        // print_r($request->razorpay_order_id);
        // die;

        // Check if the request has the necessary parameters, otherwise set default values
        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_payment_id = $request->razorpay_payment_id;
        $razorpay_signature = $request->razorpay_signature;
        $buy_now = $request->buy_now ?? null;


        try {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            $this->api->utility->verifyPaymentSignature($attributes);
        } catch (Exception $e) {
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => $error
            ]);
        }

        // dd('working');

        $order = Order::where('razorpay_order_id', $razorpay_order_id)->first();

        $sid = $order->sid;
        $order_sid = $order->sid;
        $order_id = $order->order_id;

        $order->update([
            'payment_status' => 'Paid',
            'txn_id' => $razorpay_payment_id,
            'order_status' => 'Placed'
        ]);

        $order_log = new OrderLog();
        $order_log->order_id = $order_id;
        $order_log->status = 'Placed';
        $order_log->save();

        // Initialize totals
        $totalQuantity = 0;
        $totalSubTotal = 0;
        $totalmop = 0;
        $totalprice = 0;
        $savings1 = 0;

        $ref_sid = Session::get('ref_sid') ?? null;
        
        $customer_id = Session::get('customer_id');
        $address_data = CartAddress::Where('customer_id', $customer_id)->Where('sid', $ref_sid ?? $sid)->first();
        // Wp queue for fallback in sending message
        $wp_queue = new WpQueue();
        $wp_queue->sid = $order_sid;
        $wp_queue->order_id = $order_id;
        $wp_queue->number = $address_data->phone;
        $wp_queue->status = 'Pending';
        $wp_queue->save();


        if ($buy_now == "buy_now") {

           
            $cart = Cart::where('ref_sid', $ref_sid)->first();

            $cart_arr = Cart::where('ref_sid', $ref_sid)->get();


            $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();

            $cart->image = $product_image->image ?? "no-image";
            $product_data = Product::where('id', $cart->product_id)->first();

            //update Stock
            $balance = $product_data->stock - $cart->quantity;
            $product_data->stock = $balance;
            $product_data->save();

            $remark = $cart->quantity . '' . " Debited For Order with Order id #$order->order_id";
            $stock = new ProductStock();
            $stock->type = 'Debit';
            $stock->remark = $remark;
            $stock->product_id = $cart->product_id;
            $stock->save();
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

            $cart = Cart::where('ref_sid', $ref_sid)->first();
            if ($cart) {
                $cart->update(['status' => 'Completed']);
            }

            
            $update1 = Order::where('razorpay_order_id', $razorpay_order_id)
            ->update(['sid' => $ref_sid]);

            $update2 = Cart::where('ref_sid', $ref_sid)->update(['sid' => $ref_sid]);
           
            

            foreach ($cart_arr as $cart2) {
                $product_image = ProductImage::where('product_id', $cart2->product_id)->orderBy('priority', 'asc')->first();
                $cart2->image = $product_image->image ?? "no-image";
                $product_data = Product::where('id', $cart2->product_id)->first();

                $cart2->slug = $product_data->slug;
                $totalQuantity += $cart2->quantity;
                $cart2->total_quantity = $totalQuantity;
                $totalSubTotal += $cart2->sub_total;
                $cart2->cart_total = $totalSubTotal;
                $totalmop += $cart2->mop;
                $cart2->total_mop = $totalmop;
                $totalprice += $cart2->price;
                $cart2->total_price = $totalprice;
                $savings1 += round(($cart->mop - $cart2->price) * $cart2->quantity);
                $cart2->saving = $savings1;
            }

            Session::put('carts', $cart_arr);

            $sid = Cookie::get('sid');
            $count_cart = Cart::where('sid', $sid)->count();
            $minutes = 43200;
            Cookie::queue('cart_count', $count_cart, $minutes);

            $customer_id = Session::get('customer_id');
            $date = date('d-m-Y');
            $str_date = strtotime($date);

            $address_data = CartAddress::Where('customer_id', $customer_id)->Where('sid', $ref_sid ?? $sid)->first();
            Session::put('sid', $ref_sid ?? $sid);
            Session::put('coupon', $coupon ?? 0);
            Session::put('order_id', $order->order_id);
            Session::put('date', $date);
            Session::put('address_data', $address_data);

            Session::forget('ref_sid');
            return response()->json([
                'status' => 'success',
                'message' => 'Payment successful',
                'order_id' => $order->order_id,
            ]);
        } else {
            $carts = Cart::where('sid', $sid)->get();
            //dd($carts);
            foreach ($carts as $cart) {
                $product_image = ProductImage::where('product_id', $cart->product_id)->orderBy('priority', 'asc')->first();
                $cart->image = $product_image->image ?? "no-image";
                $product_data = Product::where('id', $cart->product_id)->first();

                //update Stock
                $balance = $product_data->stock - $cart->quantity;
                $product_data->stock = $balance;
                $product_data->save();

                $remark = $cart->quantity . '' . " Debited For Order  with Order id #$order->order_id";
                $stock = new ProductStock();
                $stock->type = 'Debit';
                $stock->remark = $remark;
                $stock->product_id = $cart->product_id;
                $stock->save();
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

            
            Cookie::queue(Cookie::forget('sid'));
            Cookie::queue(Cookie::forget('cart_count'));
            Session::put('carts', $carts);
        }


        $customer_id = Session::get('customer_id');
        $date = date('d-m-Y');
        $str_date = strtotime($date);

        $address_data = CartAddress::Where('customer_id', $customer_id)->Where('sid', $ref_sid ?? $sid)->first();
        Session::put('sid', $ref_sid ?? $sid);
        Session::put('coupon', $coupon ?? 0);
        Session::put('order_id', $order_id);
        Session::put('date', $date);
        Session::put('address_data', $address_data);

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
        //(new HelperController)->sendZohoEmail($sub, $email_msg, $u, $address_data->email);
        
        
        $sub = "🤗 New Order: #{$order_id} Came ";
        // $email_msg = "Dear Openbox Admin, <br><br> 

        // You Got A New Order, please Check The details below and in Admin Portal and Proceed. <br> 

        // Here are your order details:  <br>
        
        // Customer Name: {$address_data->first_name} {$address_data->last_name}  <br>
        // Customer Mobile: {$address_data->phone} <br>
        // Customer Email: {$address_data->email}  <br>
        // Order ID: #{$order_id}  <br>
        // Order Date: {$order->date} <br>  
        // Order Total: {$order->grand_total} <br><br>
        // ";
        // $setting = Setting::first();
        $products = Cart::where('sid', $sid)->get();
        $amount_in_words = (new HelperController)->numberToWords($order->grand_total);
        $billing_address = CartAddress::where('sid', $sid)->orderBy('id', 'desc')->first();
        $sub = "🤗 New Order: #{$order_id} Came ";
        $msg = '<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        </head>
        
        <body style="margin:0px; padding:0px; font-family: Arial, Helvetica, sans-serif; color: #000;">
        <center>
          <div style="max-width:600px; margin:0px auto; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
              <div style="height:40px; background-color:#0AA8E3;"></div>
                <div style="margin:10px 0px; text-align: center;">
                  <img src="https://openboxwale.in/public/frontend/open-box-wale-white-bg.jpg" align="center" style="width:70%; max-width: 200px;">
                </div>
                <div style="padding:20px; background-color: #fff;">
                <p style="font-size:14px; line-height:22px; color:#000;"><span style="color:#0AA8E3;">Dear Admin,</span><br>
                    <strong style="color:#000;">You have received a new order.</strong><br>
                    Please check the details below and proceed accordingly.</p>
                    <p style="font-size:14px; line-height:22px; color:#000;">
                    <strong style="color:#0AA8E3;">Customer Details:</strong><br>
                    Name: '.$address_data->first_name.' '.$address_data->last_name.'<br>
                    Mobile: '.$address_data->phone.'<br>
                    Email: '.$address_data->email.'</p>
                    <table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size:14px; text-align:left; color:#000; border-collapse:collapse; margin-bottom:20px;">
                      <tr>
                          <td style="color:#0AA8E3;border-top:1px solid #ddd;"><strong>Order ID</strong></td>
                            <td style="border-top:1px solid #ddd;">'.$order_id.'</td>
                        </tr>
                        <tr>
                          <td style="color:#0AA8E3;border-top:1px solid #ddd;"><strong>Order Placed on</strong></td>
                            <td style="border-top:1px solid #ddd;">'.$order->date.'</td>
                        </tr>
                        <tr>
                            <td style="color:#0AA8E3;border-top:1px solid #ddd;"><strong>Payment Type</strong></td>
                            <td style="border-top:1px solid #ddd;">'.$order->payment_option.'</td>
                        </tr>
                    </table>
                     <table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:14px; text-align:left; color:#000; border-collapse:collapse; border: 1px solid #ddd;">
                      <tr bgcolor="#0AA8E3" style="color:#fff;">
                          <th>Sl. No</th>
                          <th>Description</th>
                          <th>Unit Price</th>
                          <th>CGST (9%)</th>
                          <th>'.($billing_address->state == 'Telangana' ? 'SGST (9%)' : 'IGST (9%)').'</th>
                          <th>Qty</th>
                          <th>Sub Total</th>
                          <th>Total Amount</th>
                      </tr>';
        
        // Loop through the $carts variable to add product details
        $total_order_quantity = count($carts);
        foreach ($carts as $index => $cart) {
            // Calculate individual discount
            $total_discount = $order->coupon;
            $individual_discount = $total_discount / $total_order_quantity;
        
            // Calculate discounted price
            $discounted_price = $cart->price - $individual_discount;
        
            // Calculate GST (assuming 18% total GST)
            $gst_rate = 18;
            $gstForPrice = ($discounted_price * $gst_rate) / 100;
            $cgst = $gstForPrice / 2;
            $sgst_igst = $gstForPrice / 2;
        
            // Calculate subtotal
            $subtotal = $cart->quantity * $discounted_price;
        
            // Add row to the table
            $msg .= '<tr>
                <td align="center">'.($index + 1).'</td>
                <td style="font-size: 11px;">'.$cart->product_name.'</td>
                <td align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($discounted_price, 2).'</td>
                <td align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($cgst, 2).'</td>
                <td align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($sgst_igst, 2).'</td>
                <td align="center">'.$cart->quantity.'</td>
                <td align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($subtotal, 2).'</td>
                <td align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($subtotal + $gstForPrice, 2).'</td>
            </tr>';
        }
        
        // Add totals section
        $msg .= '<tr>
            <td colspan="5" style="text-align: right; color: #0AA8E3;"><strong>Total Payable:</strong></td>
            <td colspan="3" align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($order->sub_total, 2).'</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right; color: #0AA8E3;"><strong>Discount:</strong></td>
            <td colspan="3" align="center"><span style="font-family: DejaVu Sans;">₹</span> '.number_format($order->coupon, 2).'</td>
        </tr>
        <tr>
            <td colspan="8" style="color: #0AA8E3;"><strong>Amount in Words:</strong> <strong style="text-transform: capitalize;">Rupee '.$amount_in_words.' only</strong></td>
        </tr>
        </table>
                </div>
            </div>
        </center>
        </body>
        </html>';
        
        $setting = Setting::first();
        //(new HelperController)->sendZohoEmail($sub, $msg, 'Admin', $setting->email);

        // $parameters = "$name,$order_id,https://openboxwale.in/dashboard-trackorder?order_id=$order_id";

        $attachment_link = $this->invoiceGenerate($ref_sid ?? $sid);
        $file_name = "inv_$order_id";
        
        (new HelperController)->sendWhatsappMessageWithPdf($address_data->phone, 'open_feedback',$file_name,$attachment_link,$order_id);

        // $parameters = "$name,$order_id";
        // (new HelperController)->sendWhatsappMessage($address_data->phone, 'open6',$parameters);

        // $sid = Session::get('sid');
        
        Session::forget('sid');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Payment successful',
            'order_id' => $order_id,
        ]);
    }

    // Cron for queue wp message sent of today
    public function wpQueueCron(){
        $wp_queue = WpQueue::where('status','Pending')
            ->whereRaw("DATE(created_at) = CURDATE()")
            ->get();
        foreach ($wp_queue as $key => $queue) {
            $order_id = $queue->order_id;
            $sid = $queue->sid;
            $number = $queue->number;
            $attachment_link = $this->invoiceGenerate($sid);
            $file_name = "inv_$order_id";
            (new HelperController)->sendWhatsappMessageWithPdf($number, 'open_feedback',$file_name,$attachment_link,$order_id);
        }
    }
}
