<?php

namespace App\Http\Controllers\frontend;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\HelperController;
use App\Setting;
use Illuminate\Support\Str;

class OtpController extends Controller
{
  //
  public function index($token, $action = null)
  {
    $customer = Customer::where('otp_token', $token)->first();
    if (!$customer) {
      abort(404, "Token Not found!");
    }
    if ($customer) {
      return view("frontend.otp", compact('token', 'customer', 'action'));
    } else {
      return redirect()->back()->with('failure', 'session no set');
    }
  }
  public function customer_otp_verify(Request $request)
  {
    $enteredOtp = $request->input('otp1') . $request->input('otp2') . $request->input('otp3') . $request->input('otp4') . $request->input('otp5') . $request->input('otp6');

    $customer = Customer::where('otp_token', $request->token)->first();
    if ($customer && $customer->otp == $enteredOtp) {

      // Check new user or existing user
      if ($customer->otp_status != 'Verified') {
        $u = "User";


        $name = Str::limit($customer->name, 30);
        $msg = "Dear {$name}, your account has been successfully created on OpenBoxWale! Start exploring great deals on open box products and start saving now. Buy at OpenBoxWale.in. Reach us at support@openboxwale.in for any help";

        $email_msg = "
        <html>
        <head>
            <title>Welcome to OpenBoxWale – Your Gateway to Amazing Deals! 🎉</title>
        </head>
        <body>
            <p>Dear {$customer->name},</p>
            <p>Congratulations! Your account has been successfully created on OpenBoxWale. 🛍️</p>
            <p>You’re now part of a community that loves quality and savings. Start exploring unbeatable deals on open box products today!</p>
            <p>What’s Next?</p>
            <p>
                ✅ Discover Amazing Deals – Browse through a wide range of open box products at incredible prices.<br>
                ✅ Save More – Enjoy significant savings on every purchase.<br>
                ✅ Shop with Confidence – All our products are carefully inspected to ensure quality.<br>
            </p>
            <p>Need Help?</p>
            <p>We’re here for you! For any assistance, feel free to reach out to us at <a href='mailto:support@openboxwale.in'>support@openboxwale.in</a>.</p>
            <p><a href='https://openboxwale.in'>🔗 Start Shopping Now: OpenBoxWale.in</a></p>
            <p>Thank you for choosing OpenBoxWale. Let’s start saving together!</p>
            <p>Happy Shopping!</p>
            <p>Team OpenBoxWale</p>
        </body>
        </html>
        ";

        (new HelperController)->sendSms($customer->mobile, $msg);
        (new HelperController)->sendZohoEmail("Welcome to OpenBoxWale – Your Gateway to Amazing Deals! 🎉", $email_msg, $u, $customer->email);
        
        $parameters = "$name";
        (new HelperController)->sendWhatsappMessage($customer->mobile, 'open7',$parameters);
      }

      // Update
      $customer->otp_status = 'Verified';
      $customer->save();

      $token = $request->token;

      if ($request->action != '') {
        $setting = Setting::first();
        return view('frontend.new-password', compact('customer', 'token', 'setting'));
      }

      Session::put('customer_id', $customer->id);

      $cart_count = Cookie::get('cart_count');

      if ($cart_count > 0) {
        return redirect()->route("cart")->with('success', 'Login successful');
      } else {
        $redirectUrl = Session::get('login_redirect_url', route('home'));
        Session::forget('login_redirect_url');

        return redirect($redirectUrl);
      }
    } else {
      return redirect()->back()->with('failure', 'Invalid OTP entered');
    }
  }
  public function resendOtp(Request $request)
  {
    $customer = Customer::where('otp_token', $request->token)->first();

    if (!$customer) {
      return back()->with('failure', 'Invalid OTP token.');
    }
    $newOtp = rand(100000, 999999); // Generate a 6-digit OTP
    $customer->otp = $newOtp;
    $customer->save();

    $name = Str::limit($customer->name, 30);
    $msg = "Dear {$name} , your OTP for Login/Sign Up on OpenBoxWale is {$newOtp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";

    (new HelperController)->sendSms($customer->mobile, $msg);
    $parameters = "$name,$newOtp,Openboxwale";
    (new HelperController)->sendWhatsappMessage($customer->mobile, '11_opens',$parameters);

    return back()->with('success', 'A new OTP has been sent to your registered mobile number.');
  }
}
