<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WpQueue;
use Exception;

class HelperController extends Controller
{

    protected $serviceAccountFilePath;

    public function __construct()
    {
        $this->serviceAccountFilePath = url('/') . '/public/uploads/firebase.json';
    }

    // Function to generate a JWT token
    public function generateJWT()
    {
        $jsonKey = json_decode(file_get_contents($this->serviceAccountFilePath), true);

        $clientEmail = $jsonKey['client_email'];
        $privateKey = $jsonKey['private_key'];
        $tokenUri = 'https://oauth2.googleapis.com/token';

        $now = time();
        $expiration = $now + 3600; // 1 hour expiration

        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT'
        ];

        $payload = [
            'iss' => $clientEmail,
            'sub' => $clientEmail,
            'aud' => $tokenUri,
            'iat' => $now,
            'exp' => $expiration,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging'
        ];

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($header)));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

        $signature = '';
        openssl_sign($base64UrlHeader . '.' . $base64UrlPayload, $signature, $privateKey, 'sha256');
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        return $jwt;
    }

    // Function to get access token from Google OAuth 2.0 server
    public function getAccessToken($jwt)
    {
        $tokenUri = 'https://oauth2.googleapis.com/token';

        $postData = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenUri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['access_token'])) {
            return $responseData['access_token'];
        } else {
            throw new Exception('Error fetching access token: ' . $response);
        }
    }

    // Function to send push notification via FCM
    public function sendFCMNotification($accessToken, $data, $deviceToken, $firebase_key)
    {
        $fcmUrl = 'https://fcm.googleapis.com/v1/projects/speed-diagno-app/messages:send';

        $notification = [
            'message' => [
                'token' => $deviceToken,

                'data' => [
                    'title' => $data['title'],
                    'body' => $data['body'],
                    'order_id' => $data['order_id'],
                    'address' => $data['address'],
                    'amount' => $data['amount'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'android_channel_id' => $data['android_channel_id'],
                ]
            ]
        ];



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));

        $response = curl_exec($ch);

        //print_r($response);die();
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        return json_decode($response, true);
    }
    public function sendUserFCMNotification($accessToken, $data, $deviceToken, $firebase_key)
    {
        // $fcmUrl = 'https://fcm.googleapis.com/v1/projects/speed-diagno-app/messages:send';
        $fcmUrl = '';

        $notification = [
            'message' => [
                'token' => $deviceToken,

                'data' => [
                    'title' => $data['title'],
                    'body' => $data['body'],
                    'android_channel_id' => $data['android_channel_id'],
                ]
            ]
        ];



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));

        $response = curl_exec($ch);

        //print_r($response);die();
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        return json_decode($response, true);
    }
    public function sendSms($num, $msg)
    {
        $mobilenumbers = $num; //enter Mobile numbers comma seperated
        $message = $msg; //enter Your Message

        $url = "http://ec2-13-234-142-114.ap-south-1.compute.amazonaws.com/API/sms.php";
        $message = urlencode($message);
        $ch = curl_init();
        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }
        $ret = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "username=&password=&from=OPBORE&to=$mobilenumbers&msg=$message&type=1&dnd_check=0"
        );

        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
        // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
        $curlresponse = curl_exec($ch); // execute
        if (curl_errno($ch))
            echo 'curl error : ' . curl_error($ch);
    }
    public function balance()
    {
        $url = "http://login.smsmoon.com/API/get_balance.php";
        $ch = curl_init();
        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=&password=");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $curlresponse = curl_exec($ch); // Execute the request

        if (curl_errno($ch)) {
            $error = 'curl error: ' . curl_error($ch);
            curl_close($ch);
            return $error;
        }

        curl_close($ch);

        return $curlresponse; // Return the response
    }


    // Get token
    public function get_token()
    {
        $postData = [
            'email' => '',
            'password' => ''
        ];

        $ch = curl_init('https://apiv2.shiprocket.in/v1/external/auth/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        $json = json_decode($response, true);
        return $json['token'];
    }

    // Check availability
    public function availability($token, $pincode)
    {
        if (isset($token)) {
            $auth = $token;
            //$pincode = $pincode;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability?pickup_postcode=500084&delivery_postcode=$pincode&weight=1&cod=0&token=$auth",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic " . $auth
                ),
            ));

            $response = curl_exec($curl);
            // print_r($response);
            // die();
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
                $json = "";
            } else {
                //echo $response;
                $json = json_decode($response, true);
                // echo "<pre>";
                // print_r($json);
                // echo "</pre>";
            }
            return $json;
        }
    }

    // Pickup address
    public function pickup_address($auth)
    {
        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/settings/company/pickup",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $auth"
            ),
        ));

        // Execute cURL request and capture response
        $SR_login_Response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'cURL error: ' . curl_error($curl);
            curl_close($curl);
            return false; // Return false on error
        }

        // Close cURL session
        curl_close($curl);

        // Decode JSON response
        $json = json_decode($SR_login_Response, true);

        // Check for JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON decode error: ' . json_last_error_msg();
            return false; // Return false on error
        }
        //print_r($json);die();
        // Return decoded JSON data
        return $json;
    }

    // Place order
    public function place_order($auth, $data)
    {

        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $auth"
            ),
        ));
        $SR_login_Response = curl_exec($curl);
         
        curl_close($curl);
        
         //echo '</pre>';
        $json = json_decode($SR_login_Response);
       
        return $json;
    }

    function trackByShipment($auth, $shipment_id)
    {
        // Step 1: Fetch shipment tracking details
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$shipment_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $auth"
            ),
        ));

        $shipment_response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }

        
        $shipment_data = json_decode($shipment_response, true);
        $data = json_decode($shipment_response, true);
        return $data['tracking_data']['shipment_track'][0] ?? '';

        // Step 2: Extract order_id from the response
        // if (!isset($shipment_data['tracking_data']['shipment_track'][0]['order_id'])) {
        //     return "Order ID not found in shipment track response.";
        // }

        //$order_id = $shipment_data['tracking_data']['shipment_track'][0]['order_id'];
        //return $order_id;
        // Step 3: Fetch order tracking details using extracted order_id
        // return track($auth, $order_id);
    }


    // Track order
    function trackOrder($auth, $shipment_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$shipment_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $auth"
            ),
        ));

        $shipment_response = curl_exec($curl);
        // print_r("https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$shipment_id");
        // die();
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }

        
        $shipment_data = json_decode($shipment_response, true);
        // $data = json_decode($shipment_response, true);
        // dd($shipment_data);
        // $order_id = $shipment_data['tracking_data']['shipment_track'][0]['order_id'] ?? '';
        return $shipment_data;
    }
    // Track order
    function track($auth, $order_id)
    {
        // print_r($auth);
        // die();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track?order_id=$order_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $auth"
            ),

        ));

        $response = curl_exec($curl);
        // print_r($response);
        // die();
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);
        }
        return $json;
    }

    // Send mail from the website to client side via zoho mail # in laravel via helper function
    public function sendZohoEmail($subject = "", $message = "", $toName = "", $toEmail = "")
    {
        $curl = curl_init();

        // Prepare the payload using double quotes to allow variable interpolation
        $payload = json_encode([
            "from" => ["address" => ""],
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
                "authorization: ", // Replace with your actual token
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        // print_r($response);die;

        curl_close($curl);

        if ($err) {
            //  echo "cURL Error #:" . $err;
        } else {
            // echo $response;
        }
    }

    public function sendWhatsappMessage($phoneNumber, $template_name, $parameters)
    {
        return;

        $url = "http://wp.smsmoon.com/api/sendmsg.php";

        $postData = http_build_query([
            'user' => '',
            'pass' => '',
            'sender' => '',
            'phone' => $phoneNumber,
            'text' => $template_name,
            'priority' => 'wa',
            'stype' => 'normal',
            'Params' => $parameters
        ]);

        $ch = curl_init();

        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }

        curl_setopt($ch, CURLOPT_URL, $url . '?' . $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);

        // dd($response);

        if (curl_errno($ch)) {
            echo 'curl error: ' . curl_error($ch);
        } else {
            //echo $response;
        }

        curl_close($ch);
    }
    public function sendWhatsappMessageWithPdf($phoneNumber, $template_name, $file_name, $attachment_link,$order_id = '')
    {
        // $url = "http://wp.smsmoon.com/api/sendmsg.php";
        $url = "http://144.76.182.197/api/sendmsg.php";

        $queryParams = http_build_query([
            'user' => '',
            'pass' => '',
            'sender' => '',
            'phone' => $phoneNumber,
            'text' => $template_name,
            'priority' => 'wa',
            'stype' => 'normal',
            'htype' => 'document',
            'fname' => $file_name,
            'url' => $attachment_link
        ]);

        $fullUrl = $url . '?' . $queryParams;

        $ch = curl_init();

        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }

        curl_setopt_array($ch, array(
            CURLOPT_URL => $fullUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_VERBOSE => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'curl error: ' . curl_error($ch);
        } else {
            //echo $response;
        }
        // Update queue status
        $wp_queue = WpQueue::where('order_id', $order_id)->first();
        $wp_queue->status = "Sent";
        $wp_queue->save();
        curl_close($ch);
    }

    public function numberToWords($number)
    {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'forty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            100000              => 'lakh',
            10000000            => 'crore',
            1000000000          => 'billion',
            1000000000000       => 'trillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'numberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->numberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int)($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->numberToWords($remainder);
                }
                break;
            case $number < 100000:
                $thousands = ((int)($number / 1000));
                $remainder = $number % 1000;
                $string = $this->numberToWords($thousands) . ' ' . $dictionary[1000];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->numberToWords($remainder);
                }
                break;
            case $number < 10000000:
                $lakhs  = ((int)($number / 100000));
                $remainder = $number % 100000;
                $string = $this->numberToWords($lakhs) . ' ' . $dictionary[100000];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->numberToWords($remainder);
                }
                break;
            case $number < 1000000000:
                $crores = ((int)($number / 10000000));
                $remainder = $number % 10000000;
                $string = $this->numberToWords($crores) . ' ' . $dictionary[10000000];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->numberToWords($remainder);
                }
                break;
            default:
                $billions = ((int)($number / 1000000000));
                $remainder = $number % 1000000000;
                $string = $this->numberToWords($billions) . ' ' . $dictionary[1000000000];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->numberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}
