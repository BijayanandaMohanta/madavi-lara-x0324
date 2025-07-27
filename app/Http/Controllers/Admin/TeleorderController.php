<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\CartAddress;
use App\Models\OrderLog;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Unit;
use App\Models\WpQueue;
use Carbon\Carbon;
use App\Models\TestGroup;
use App\Models\TestSubGroup;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Barryvdh\DomPDF\Facade\Pdf;

class TeleorderController extends Controller
{
  public function invoiceGenerate($sid)
  {
    try {
      // Fetch required data
      $billing_address = CartAddress::where('sid', $sid)->orderBy('id', 'desc')->first();
      $order = Order::where('sid', $sid)->first();
      $products = Cart::where('sid', $sid)->get();
      $setting = Setting::first();
      $path = asset("site_settings/$setting->logo");
      $amount_in_words = (new HelperController)->numberToWords($order->grand_total);
      // Generate PDF
      // $pdf = Pdf::loadView('frontend.generate-invoice', compact('billing_address', 'order', 'products', 'base64Svg', 'setting'));
      $pdf = Pdf::loadView('frontend.generate-invoice', compact('billing_address', 'order', 'products', 'setting','amount_in_words'));

      if (!$pdf) {
          throw new \Exception("PDF generation failed.");
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
          throw new \Exception("Directory is not writable: " . $directory);
      }

      $filePath = $directory . $fileName;

      // Save the PDF to the specified path
      if (file_put_contents($filePath, $pdf->output()) === false) {
          throw new \Exception("Failed to write PDF file: " . $filePath);
      }

      $filePath = "./public/uploads/invoices/".$fileName;
      return $filePath;

      //return response()->file(public_path("uploads/invoices/$fileName"));
  } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
  }
  }

  public function index()
  {
    $units = Product::where('status', 1)
      ->get();
    $units->each(function ($product) {
      $product->image = $product->productimages->first()->image ?? "no-image";
    });
    return view('admin.tele_orders.create', compact('units'));
  }
  //
  public function create()
  {
    $units = Product::all();
    return view('admin.tele_orders.create', compact('units'));
  }

  public function update(Request $request) {}

  public function edit($id) {}

  public function store(Request $request)
  {


    $data = $this->validate($request, [
      'name' => 'required',
      'email' => 'nullable',
      'payment_option' => 'required',
      'mobile' => 'required|numeric|digits:10',
      'state' => 'required',
      'address' => 'nullable',
      'product_id' => 'nullable|array',
      'price' => 'nullable|array',
      'quantity' => [
        'nullable',
        'array',
        function ($attribute, $value, $fail) {
          foreach ($value as $index => $quantity) {
            if ($quantity == 0) {
              $fail("The $attribute at index $index must not be zero.");
            }
          }
        },
      ],
    ]);


    $sid = rand();
    $customer_data = Customer::where('mobile', $data['mobile'])
      ->orWhere('email', $data['email'])
      ->first();
    if ($customer_data) {
      $customer_id = $customer_data->id;
    } else {
      $token = rand();
      $customer = new Customer();
      $customer->mobile = $data['mobile'];
      $customer->otp = '123456';
      $customer->otp_status = 'Verified';
      $customer->otp_token = $token;
      $customer->name = $data['name'];
      $customer->email = $data['email'] ?? null;
      $customer->save();

      $customer_data = Customer::where('mobile', $data['mobile'])
        ->orWhere('email', $request->email ?? null)
        ->first();
      $customer_id = $customer_data->id;
    }
    // Initialize variable custom discount
    $custom_discount = 0;
    if ($data['product_id'][0] != '') {
      foreach ($data['product_id'] as $index => $name) {
        $status = 'Completed';
        $qty = $data['quantity'][$index] ?? 1;
        $product_price = $data['price'][$index] ?? 1;
        $product_id = $name;
        $product_data = Product::where('id', $product_id)->first();

        // Discount Calculation For Custom price given
        if ($product_data->price > $product_price) {
          $custom_discount += $product_data->price - $product_price;
        } else {
          $custom_discount += 0;
        }
        $custom_discount = $custom_discount * $qty;

        $add_result = new Cart();
        $add_result->product_id = $product_id;
        $add_result->product_name = $product_data->name;
        $add_result->category_id = $product_data->category_id;
        $add_result->sub_category_id = $product_data->sub_category_id ?? null;
        $add_result->child_category_id = $product_data->child_category_id ?? null;
        $add_result->brand = $product_data->brand ?? 'N/A';
        $add_result->sid = $sid;
        $add_result->mrp = $product_data->mrp ?? 0;
        $add_result->price = $product_price;
        $add_result->mop = $product_data->mop ?? 0;
        $add_result->status = $status;
        $add_result->quantity = $qty;
        $currentDateTime = date('Y-m-d H:i:s'); // Get current date and time
        $add_result->added_date_time = $currentDateTime;
        $timestamp = strtotime($currentDateTime);
        $add_result->str_added_date = $timestamp;
        $add_result->sub_total = $qty * $product_price;
        $add_result->save();
      }
    }
    $cart_address = new CartAddress();

    $cart_address->sid = $sid;
    $cart_address->phone = $data['mobile'];
    $cart_address->customer_id = $customer_id;
    $cart_address->first_name = $data['name'];

    $cart_address->email = $data['email'] ?? null;
    $cart_address->address = $data['address'];
    $cart_address->state = $data['state'];
    $cart_address->save();


    $grand_total = Cart::where('sid', $sid)->sum('sub_total');

    // dicount applied on grand total
    $discount =  $grand_total * ($request->discount ?? 0) / 100;
    $grand_total1 = $grand_total - $discount - $custom_discount;

    $order_id = rand();
    $date = date('d-m-Y');
    $str_date = strtotime($date);
    $order = new Order();
    $order->customer_id = $customer_id;
    $order->sid = $sid;
    $order->order_id = $order_id;
    $order->grand_total = $grand_total;
    $order->sub_total = $grand_total1;
    $order->order_status = 'Delivered';
    $order->payment_status = 'Paid';
    $order->partial_amount = '0';
    $order->need_to_pay = '0';
    $order->payment_option = $data['payment_option'];
    $order->date = $date;
    $order->str_date = $str_date;
    $order->order_from = 'Tele Order';
    $order->coupon_code = $used_coupon->coupon_code ?? null;
    $order->coupon = ($discount + $custom_discount) ?? null;
    $order->save();


    $carts = Cart::where('sid', $sid)->get();

    if ($data['email']) {
      $cart_address = CartAddress::where("sid", $sid)->first();
      $ord = Order::where("sid", $sid)->first();

      $originalDate = $ord->created_at;

      // Convert and format to 'dd-mm-yy'
      $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $originalDate)->format('d-m-Y h:i A');
      $subject = "🛍️ Your Purchase at OpenBoxWale Store - Order {#$order_id}";

      $msg = "Dear {$cart_address->first_name},<br><br>

      Thank you for shopping with us at OpenBoxWale Store! Your purchase has been successfully processed. Below are the details of your transaction:<br><br>

      Order ID: #{$order_id}<br>
      Payment Type: {$ord->payment_option}<br>
      Purchase Date & Time: {$formattedDate}<br>
      Grand Total: ₹{$ord->grand_total}<br>
      Coupon Discount: ₹{$ord->coupon}<br>
      Amount Paid: ₹{$ord->sub_total}<br>
      <br>

      We truly appreciate your support and look forward to serving you again, whether online or in-store. If you have any questions about your purchase, please feel free to contact us.<br><br>

      Thank you for choosing OpenBoxWale!<br>

      Best regards,<br>
      The OpenBoxWale Team<br>";
      //(new HelperController)->sendZohoEmail($subject, $msg, $cart_address->first_name ?? 'User', $cart_address->email);

      // Wp queue for fallback in sending message
      $wp_queue = new WpQueue();
      $wp_queue->sid = $sid;
      $wp_queue->order_id = $order_id;
      $wp_queue->number = $data['mobile'];
      $wp_queue->status = 'Pending';
      $wp_queue->save();

      // $attachment_link = $this->invoiceGenerate($sid);

      // dd($attachment_link);

      // $file_name = "inv_$order_id";

      // (new HelperController)->sendWhatsappMessageWithPdf($data['mobile'], 'open_feedback', $file_name, $attachment_link, $order_id);
    }

    return redirect()->route('orders.index')->with('primary', 'Order Updated Successfully');
  }
  function destroy($id) {}

  public function getProductPrice(Request $request)
  {
    $product = Product::find($request->productid); // Replace with your model and logic
    if ($product) {
      return response()->json(['success' => true, 'price' => $product->price]);
    } else {
      return response()->json(['success' => false, 'message' => 'Product not found']);
    }
  }
}
