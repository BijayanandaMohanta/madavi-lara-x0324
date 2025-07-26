<?php

namespace App\Http\Controllers\frontend;

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
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Exception;
use Razorpay\Api\Api;

class TestingController extends Controller
{
    // Send mail from the website to client side via zoho mail # in laravel via helper function
    private function sendZohoEmail($subject = "", $message = "", $toName = "", $toEmail = "")
    {
        $curl = curl_init();

        // Prepare the payload using double quotes to allow variable interpolation
        $payload = json_encode([
            "from" => ["address" => "sales@openboxwale.in"],
            "to" => [["email_address" => ["address" => $toEmail, "name" => $toName]]],
            "subject" => $subject,
            "htmlbody" => $message,
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload, // Use the prepared payload
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey PHtE6r1eS7/r2WIr80MJ4fS4Qs6gZIIp9OhnLQRE5tlDCPYDF01R+NovwGLjqhsjVqJAFqGcnos6uOyauujTLWrsMWlMDmqyqK3sx/VYSPOZsbq6x00fsFkSf0DUUYDqdNVj0SXVs92X", // Replace with your actual token
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        // print_r($response);die;

        // curl_close($curl);

        if ($err) {
            //  echo "cURL Error #:" . $err;
        } else {
            //dd($response);
        }
    }
    public function update_order_status()
    {
        $currentTime = Carbon::now()->format('Y-m-d H:i:s');
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
        // return $token;
        // Example order id : 344222928

        $orders = Order::where('shiprocket_order_id', '!=', '')
            ->whereNotIn('order_status', ['Delivered', 'Cancelled'])
            ->where('order_id','767206824')
            ->get();
        
        // return $orders;
        // order_id = 778593847 but tracking is possible with 767206824 why

        foreach ($orders as $order) {
            $response = (new HelperController)->trackByShipment($token,$order->ship_shipment_id);
            // return $order_id;
            // $response = (new HelperController)->track($token,$order_id);
            $currentStatus = $response['current_status'] ?? '';
            // return $currentStatus;
            
            // $json = $response;
            // $currentStatus = $json[0]['tracking_data']['shipment_track'][0]['current_status'] ?? '';

            if ($currentStatus && $currentStatus != $order->order_status) {
                Order::where('id', $order->id)->update([
                    'order_status' => $currentStatus,
                ]);

                $date = Carbon::now()->format('d-m-Y');

                $orderLog = new OrderLog();
                $orderLog->order_id = $order->order_id;
                $orderLog->status = $currentStatus;
                $orderLog->save();

                $cart_address = CartAddress::where('sid', $order->sid)->orderBy('id', 'desc')->first();
            }
        }
        return "success";
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

        $pendingOrders = Order::where('order_id', '334292703')
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
            return $apiRes;
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
            print_r($latestStatus);die();
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

                    // Insert order log and notifications
                    DB::table('order_log')->insert([
                        'order_id' => $order->order_id,
                        'status' => 'Placed'
                    ]);
                    // Commit all database changes

                } catch (\Exception $e) {
                    // Log or handle the exception as needed
                }
            }
        }

        // return response()->json(['message' => 'Payment statuses checked and updated successfully']);
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
    function index()
    {
        $data = null;
        $sub = "Testing";
        $msg = "Working mail";

        $sid = "627323637050";
        $attachment_link = $this->invoiceGenerate($sid);
        $file_name = "inv_".time().".pdf";
        
        // (new HelperController)->sendWhatsappMessageWithPdf("7606938822", 'open_feedback',$file_name,$attachment_link);

        // $data = $this->check_pending_payments();
        // $data = $this->update_order_status();
        // $this->sendZohoEmail($sub, $msg, 'Bijayananda Mohanta', "bijay.to.access@gmail.com");
        $data = Order::where('sid','627323637050')->first();
        $data = $data->orderCarts->first()->product_id;
        return view('testing',[
            'data' => $data ?? '',
        ]);
    }
}


/*
Dump code

$last_sale_product_in_cart = Cart::where('status', 'Completed')->orderBy('id', 'desc')->first();
$last_sale_product = Product::where('id', ($last_sale_product_in_cart->product_id ?? null))->first();
$notify_product_image = ProductImage::where('product_id', ($last_sale_product->id ?? null))->first()->image;
$last_product_order = Order::where('sid', ($last_sale_product_in_cart->sid ?? null))->first();
$last_product_user = Customer::where('id', ($last_product_order->customer_id ?? null))->first();
$last_product_address = CartAddress::where('sid', ($last_sale_product_in_cart->sid ?? null))->first();

$date = $last_sale_product->updated_at ?? null;
if ($date) {
    $formattedTime = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('h:i A');
    // Format the date separately
    $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('F d, Y');
}


$notify = new \stdClass;

$notify->product_name = $last_sale_product->name ?? null;
$notify->category = $last_sale_product->category->category ?? "";
$notify->product_image = $notify_product_image ?? null;
$notify->time_of_purchase = $formattedTime ?? '';
$notify->date_of_purchase = $formattedDate ?? '';
$notify->city = $last_product_address->city ?? null;
$notify->customer_name = $last_product_address->first_name." ".$last_product_address->last_name ?? null;