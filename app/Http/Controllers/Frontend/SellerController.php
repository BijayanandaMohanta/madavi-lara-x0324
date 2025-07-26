<?php

namespace App\Http\Controllers\frontend;

use App\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\HelperController;
use App\Product;
use App\Setting;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    #generate random string
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
    public function index()
    {
        if (Session::has('seller_id')) {
            return redirect()->route('sellerprofile');
            // return redirect()->back();
        } else {
            $setting = Setting::first();
            Session::put('login_redirect_url', url()->previous());
            return view("frontend.sellerlogin", compact('setting'));
        }
    }
    public function sellerregister(Request $request)
    {
        // dd($request);
        $token = $this->generateRandomString(10);
        $seller = new Seller();

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'gst_number' => 'required|string|max:255',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        $seller_data = Seller::where('mobile', $request->mobile)
            ->orWhere('email', $request->email)
            ->first();

        if ($request->hasFile('proof_image')) {
            $proof_image = 'product_' . rand() . '.' . $request->file('proof_image')->extension();
            $data['proof_image'] = $proof_image;
            $request->file('proof_image')->move(public_path('uploads/sellers/'), $proof_image);
        }
        if ($seller_data != '') {
            if ($seller_data->otp_status != 'Verified') {
                $seller_data->delete();
                $token = rand();
                $pass = md5($request->password);
                $seller = new Seller();
                $seller->mobile = $request->mobile;
                $seller->otp = $otp;
                $seller->otp_status = 'Pending';
                $seller->otp_token = $token;
                $seller->name = $request->name;
                $seller->gst_number = $request->gst_number;
                $seller->proof_image = $proof_image;
                $seller->email = $request->email;
                $seller->promotional_whatsapp_message = $request->promotional_whatsapp_message;
                $seller->promotional_email = $request->promotional_email;
                $seller->password = $pass;
                $seller->save();
                // sms send code here
                //Session::put('seller_id', $seller->id);
                $u = "Seller";
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


                (new HelperController)->sendZohoEmail($sub, $e_msg, $u, $seller->email);

                $parameters = "$name,$otp,Openboxwale";
                (new HelperController)->sendWhatsappMessage($seller->mobile, '11_opens', $parameters);

                if ($request->promotional_whatsapp_message) {
                    $parameters = "";
                    (new HelperController)->sendWhatsappMessage($seller->mobile, 'openboxwale_test', $parameters);
                }

                return redirect()->route('sellerotp', ['token' => $token])->with('success', 'OTP Sent Successfully');
                // $responseData = array('status' => 'valid', 'message' => 'OTP Sent Successfully', 'token' => $token);
            } else {
                return redirect()->back()->with('failure', 'You Have Already Registered With Us');
            }
        } else {
            $token = rand();
            $pass = md5($request->password);
            $seller = new Seller();
            $seller->mobile = $request->mobile;
            $seller->otp = $otp;
            $seller->otp_status = 'Pending';
            $seller->otp_token = $token;
            $seller->name = $request->name;
            $seller->email = $request->email;
            $seller->password = $pass;
            $seller->promotional_whatsapp_message = $request->promotional_whatsapp_message;
            $seller->promotional_email = $request->promotional_email;
            $seller->save();
            // sms send code here
            // Session::put('seller_id', $seller->id);
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
            (new HelperController)->sendZohoEmail($sub, $e_msg, $u, $seller->email);
            return redirect()->route('sellerotp', ['token' => $token])->with('success', 'OTP Sent Successfully');
        }
    }

    public function sellerchecklog(Request $request)
    {
        if ($request->phone) {
            $this->validate($request, [
                'phone' => 'required',
            ]);

            // Handle phone login
            $token = $this->generateRandomString(10);
            $otp = rand(100000, 999999);
            // $otp = '123456';
            $seller = Seller::where('mobile', $request->phone)->first();

            if (!$seller) {
                return redirect()->route('sellerlogin')->with(['error' => 'Given mobile number is not registered with us.. Please register first!']);
            }

            $seller->otp = $otp;
            $seller->otp_token = $token;
            $seller->save();

            $u = "Seller";
            $name = Str::limit($seller->name, 30);
            $msg = "Dear {$name} , your OTP for Login/Sign Up on OpenBoxWale is {$otp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";
            (new HelperController)->sendSms($seller->mobile, $msg);


            $sub = "Your OTP for OpenBoxWale Login/Sign-Up";
            $e_msg = "Dear {$seller->name},<br><br>
            Your One-Time Password (OTP) for logging in or signing up on OpenBoxWale is:<br><br>

            {$otp}<br>

            This OTP is valid for the next 10 minutes. For your security, please do not share this code with anyone.<br>

            Get ready to start saving big with OpenBoxWale! Visit us at openboxwale.in.<br><br>

            Happy Shopping,<br>
            The OpenBoxWale Team<br>";


            (new HelperController)->sendZohoEmail($sub, $e_msg, $u, $seller->email);

            $parameters = "$name,$otp,Openboxwale";
            (new HelperController)->sendWhatsappMessage($seller->mobile, '11_opens', $parameters);


            return redirect()->route('sellerotp', ['token' => $token])->with('success', 'OTP Sent Successfully');
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
            $seller = Seller::where('email', $data['email'])->first();


            if ($seller) {
                if ($seller->password == $password) {
                    Session::put('seller_id', $seller->id);
                    $cus_id =  Session::get('seller_id');
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
                    return redirect()->route('sellerlogin')->withErrors(['password' => 'Invalid password']);
                }
            } else {
                return redirect()->route('sellerlogin')->withErrors(['email' => 'Not a registered email']);
            }
        }
    }
    //otp
    public function sellerotp($token, $action = null)
    {
        $seller = Seller::where('otp_token', $token)->where('status',1)->first();
        if (!$seller) {
            abort(404, "Token Not found!");
        }
        if ($seller) {
            return view("frontend.sellerotp", compact('token', 'seller', 'action'));
        } else {
            return redirect()->back()->with('failure', 'session no set');
        }
    }
    public function sellerotpverify(Request $request)
    {
        $enteredOtp = $request->input('otp1') . $request->input('otp2') . $request->input('otp3') . $request->input('otp4') . $request->input('otp5') . $request->input('otp6');

        $seller = Seller::where('otp_token', $request->token)->first();
        if ($seller && $seller->otp == $enteredOtp) {

            // Check new user or existing user
            if ($seller->otp_status != 'Verified') {
                $u = "User";


                $name = Str::limit($seller->name, 30);
                $msg = "Dear {$name}, your account has been successfully created on OpenBoxWale! Start exploring great deals on open box products and start saving now. Buy at OpenBoxWale.in. Reach us at support@openboxwale.in for any help";

                $email_msg = "
        <html>
        <head>
            <title>Welcome to OpenBoxWale – Your Gateway to Amazing Deals! 🎉</title>
        </head>
        <body>
            <p>Dear {$seller->name},</p>
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

                (new HelperController)->sendSms($seller->mobile, $msg);
                (new HelperController)->sendZohoEmail("Welcome to OpenBoxWale – Your Gateway to Amazing Deals! 🎉", $email_msg, $u, $seller->email);

                $parameters = "$name";
                (new HelperController)->sendWhatsappMessage($seller->mobile, 'open7', $parameters);
            }

            // Update
            $seller->otp_status = 'Verified';
            $seller->save();

            $token = $request->token;

            if ($request->action != '') {
                $setting = Setting::first();
                return view('frontend.new-password', compact('seller', 'token', 'setting'));
            }

            Session::put('seller_id', $seller->id);

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
    public function sellerresendotp(Request $request)
    {
        $seller = Seller::where('otp_token', $request->token)->first();

        if (!$seller) {
            return back()->with('failure', 'Invalid OTP token.');
        }
        $newOtp = rand(100000, 999999); // Generate a 6-digit OTP
        $seller->otp = $newOtp;
        $seller->save();

        $name = Str::limit($seller->name, 30);
        $msg = "Dear {$name} , your OTP for Login/Sign Up on OpenBoxWale is {$newOtp}. This OTP is valid for 10 minutes. Please do not share it with anyone. Start saving with openboxwale.in";

        (new HelperController)->sendSms($seller->mobile, $msg);
        $parameters = "$name,$newOtp,Openboxwale";
        (new HelperController)->sendWhatsappMessage($seller->mobile, '11_opens', $parameters);

        return back()->with('success', 'A new OTP has been sent to your registered mobile number.');
    }

    public function sellerprofile()
    {
        $seller = Seller::find(Session::get('seller_id'));
        if(!$seller){
            return redirect()->route('sellerlogin');
        }
         $units = Product::where('stock', '>', 0)
            ->where('status', 1)
            ->get();
            $units->each(function ($product) {
            $product->image = $product->productimages->first()->image ?? "no-image";
            });
        return view("frontend.dashboard-sellerprofile", compact('seller','units'));
    }
    public function sellerlogout(){
        // Session::forget('customer_id');
        Session::flush();
        return redirect()->route('sellerlogin')->with('primary', 'Logout out');
    }
}
