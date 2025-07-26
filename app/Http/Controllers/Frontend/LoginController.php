<?php

namespace App\Http\Controllers\frontend;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\HelperController;
use App\Setting;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    private function generateRandomString($length = 8)
    {
        // Define the characters you want to use
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Generate a random string
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $charactersLength - 1);
            $randomString .= $characters[$randomIndex];
        }

        return $randomString;
    }
    //
    public function index()
    {
        if (Session::has('customer_id')) {
            // return redirect()->route('home');
            return redirect()->back();
        } else {
            $setting = Setting::first();
            Session::put('login_redirect_url', url()->previous());
            return view("frontend.login", compact('setting'));
        }
    }
    public function userregister(Request $request)
    {
        // dd($request);
        $token = $this->generateRandomString(10);
        $customer = new Customer();

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'promotional_email' => 'nullable',
            'promotional_whatsapp_message' => 'nullable',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('failure', 'Fill the form for registration');
        }

        $otp = rand(100000, 999999);
        // $otp = '123456';

        $customer_data = Customer::where('mobile', $request->mobile)
            ->orWhere('email', $request->email)
            ->first();
        if ($customer_data != '') {
            if ($customer_data->otp_status != 'Verified') {
                $customer_data->delete();
                $token = rand();
                $pass = md5($request->password);
                $customer = new Customer();
                $customer->mobile = $request->mobile;
                $customer->otp = $otp;
                $customer->otp_status = 'Pending';
                $customer->otp_token = $token;
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->promotional_whatsapp_message = $request->promotional_whatsapp_message;
                $customer->promotional_email = $request->promotional_email;
                $customer->password = $pass;
                $customer->save();
                // sms send code here
                //Session::put('customer_id', $customer->id);
                $u = "User";
                $name = Str::limit($request->name, 30);
                $msg = "Dear {$name} , your OTP for Login/Sign Up on OpenBoxWale is {$otp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";

                (new HelperController)->sendSms($request->mobile, $msg);

                $sub = "Your OTP for OpenBoxWale Login/Sign-Up";
                $e_msg = "Dear {$request->name},<br><br>
                Your One-Time Password (OTP) for logging in or signing up on OpenBoxWale is:<br>

                {$otp}<br>

                This OTP is valid for the next 10 minutes. For your security, please do not share this code with anyone.<br>

                Get ready to start saving big with OpenBoxWale! Visit us at openboxwale.in.<br><br>

                Happy Shopping,<br>
                The OpenBoxWale Team<br>";


                (new HelperController)->sendZohoEmail($sub, $e_msg, $u, $customer->email);

                $parameters = "$name,$otp,Openboxwale";
                (new HelperController)->sendWhatsappMessage($customer->mobile, '11_opens',$parameters);

                if($request->promotional_whatsapp_message)
                {
                    $parameters = "";
                    (new HelperController)->sendWhatsappMessage($customer->mobile, 'openboxwale_test',$parameters);
                }

                return redirect()->route('otp', ['token' => $token])->with('success', 'OTP Sent Successfully');
                // $responseData = array('status' => 'valid', 'message' => 'OTP Sent Successfully', 'token' => $token);
            } else {
                return redirect()->back()->with('failure', 'You Have Already Registered With Us');
            }
        } else {
            $token = rand();
            $pass = md5($request->password);
            $customer = new Customer();
            $customer->mobile = $request->mobile;
            $customer->otp = $otp;
            $customer->otp_status = 'Pending';
            $customer->otp_token = $token;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = $pass;
            $customer->promotional_whatsapp_message = $request->promotional_whatsapp_message;
            $customer->promotional_email = $request->promotional_email;
            $customer->save();
            // sms send code here
            // Session::put('customer_id', $customer->id);
            $u = "User";
            $name = Str::limit($request->name, 30);
            $msg = "Dear {$name} , your OTP for Login/Sign Up on OpenBoxWale is {$otp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";

            (new HelperController)->sendSms($request->mobile, $msg);
            $sub = "Your OTP for OpenBoxWale Login/Sign-Up";
            $e_msg = "Dear {$request->name},<br><br>
Your One-Time Password (OTP) for logging in or signing up on OpenBoxWale is:<br><br>

{$otp}<br>

This OTP is valid for the next 10 minutes. For your security, please do not share this code with anyone.<br>

Get ready to start saving big with OpenBoxWale! Visit us at openboxwale.in.<br><br>

Happy Shopping,<br>
The OpenBoxWale Team<br>";


            (new HelperController)->sendZohoEmail($sub, $e_msg, $u, $customer->email);
            return redirect()->route('otp', ['token' => $token])->with('success', 'OTP Sent Successfully');
        }
    }
    public function checklog(Request $request)
    {
        if ($request->phone) {
            $this->validate($request, [
                'phone' => 'required',
            ]);

            // Handle phone login
            $token = $this->generateRandomString(10);
            $otp = rand(100000, 999999);
            // $otp = '123456';
            $customer = Customer::where('mobile', $request->phone)->first();

            if (!$customer) {
                return redirect()->route('userlogin')->with(['error' => 'Given mobile number is not registered with us.. Please register first!']);
            }

            $customer->otp = $otp;
            $customer->otp_token = $token;
            $customer->save();

            $u = "User";
            $name = Str::limit($customer->name, 30);
            $msg = "Dear {$name} , your OTP for Login/Sign Up on OpenBoxWale is {$otp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";
            (new HelperController)->sendSms($customer->mobile, $msg);

            
            $sub = "Your OTP for OpenBoxWale Login/Sign-Up";
            $e_msg = "Dear {$customer->name},<br><br>
            Your One-Time Password (OTP) for logging in or signing up on OpenBoxWale is:<br><br>

            {$otp}<br>

            This OTP is valid for the next 10 minutes. For your security, please do not share this code with anyone.<br>

            Get ready to start saving big with OpenBoxWale! Visit us at openboxwale.in.<br><br>

            Happy Shopping,<br>
            The OpenBoxWale Team<br>";


            (new HelperController)->sendZohoEmail($sub, $e_msg, $u, $customer->email);
            
            $parameters = "$name,$otp,Openboxwale";
            (new HelperController)->sendWhatsappMessage($customer->mobile, '11_opens',$parameters);


            return redirect()->route('otp', ['token' => $token])->with('success', 'OTP Sent Successfully');
        } else {
            $data = $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            // Handle phone login
            $token = $this->generateRandomString(10);
            $otp = rand(100000, 999999);
            // $otp = '123456';

            $password = md5($data['password']);
            $customer = Customer::where('email', $data['email'])->first();


            if ($customer) {
                if ($customer->password == $password) {
                    Session::put('customer_id', $customer->id);
                    $cus_id =  Session::get('customer_id');
                    $cart_count = Cookie::get('cart_count');

                    if ($cart_count > 0) {
                        return redirect()->route("cart")->with('success', 'Login successful');
                    } else {
                        // return redirect()->route("home")->with('success', 'Login successful');
                        $redirectUrl = Session::get('login_redirect_url', route('home'));
                        Session::forget('login_redirect_url');
                        
                        return redirect($redirectUrl);
                    }
                } else {
                    return redirect()->route('userlogin')->withErrors(['password' => 'Invalid password']);
                }
            } else {
                return redirect()->route('userlogin')->withErrors(['email' => 'Not a registered email']);
            }
        }
    }

    public function forgetpassword()
    {
        $setting = Setting::first();
        return view("frontend.forgot-password", compact('setting'));
    }
    public function forgotpasswordotpsent(Request $request)
    {
        $token = $this->generateRandomString(10);

        $otp = rand(100000, 999999);
        // $otp = '123456';
        $customer = Customer::where('mobile', $request->phone)->first();
        // dd($customer);
        if (!$customer) {
            return redirect()->route('userlogin')->with(['error' => 'Given mobile number is not registered with us.. Please register first!']);
        }

        $customer->otp = $otp;
        $customer->otp_token = $token;
        $customer->save();

        $u = "User";
        // $msg ="Dear {$u} , your OTP for Login/Sign Up on OpenBoxWale is {$otp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";
        $name = Str::limit($customer->name, 30);
        $msg = "Dear {$name}, we have received a request to reset your password. Use the following OTP {$otp} to reset it, This OTP is valid for 10 minutes. Buy at openboxwale.in";
        (new HelperController)->sendSms($customer->mobile, $msg);
        (new HelperController)->sendZohoEmail("Openboxwale Forgot Password OTP", $msg, $u, $customer->email);

        $parameters = "$name,OTP,$otp,OTP";
        (new HelperController)->sendWhatsappMessage($customer->mobile, 'open2',$parameters);

        return redirect()->route('otp', [
            'token' => $token,
            'action' => 'forgetpassword'
        ])->with('success', 'OTP Sent Successfully');
    }
    public function new_password_change(Request $request)
    {
        $mobile = $request->mobile;
        $token = $request->token;

        $data = $this->validate($request, [
            'new_password' => 'required|min:8',
            'password' => 'required|min:8',
        ]);

        $customer = Customer::where('mobile', $mobile)->where('otp_token', $token)->first();
        if (!$customer) {
            return redirect()->route('userlogin')->with(['error' => 'Invalid OTP or Token']);
        }
        $pass = md5($request->password);
        // update new password
        $customer->password = $pass;
        $customer->save();

        $email_msg = " <div class='content'>
            <p>Dear {$customer->name},</p>
            <p>We wanted to let you know that your password has been successfully updated.</p>
            <p>If you didn’t make this change, please contact our support team immediately to secure your account.</p>
            <p>You can now log in to your account with your new password. Visit us at 
                <a href='https://openboxwale.in' target='_blank'>OpenBoxWale</a>.
            </p>
            <p>Thank you for shopping with us!</p>
            <p>Best Regards,</p>
            <p><strong>The OpenBoxWale Team</strong></p>
        </div>
        <div class='footer'>
            If you have any questions, feel free to contact us at 
            <a href='mailto:support@openboxwale.in'>support@openboxwale.in</a>.
        </div>";


        $u = "User";
        $name = Str::limit($customer->name, 30);
        $msg = "Dear {$name}, your password has been successfully reset for your account. If this wasn’t you, please contact support@openboxwale.in immediately.";
        (new HelperController)->sendSms($customer->mobile, $msg);

        (new HelperController)->sendZohoEmail("🥳 OpenBoxWale - Password Changed successfully", $email_msg, $customer->name, $customer->email);
        return redirect()->route('userlogin')->with(['success' => 'Password Changed Successfully']);
    }
}
