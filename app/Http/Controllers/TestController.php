<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class TestController extends Controller {

    protected $serviceAccountFilePath;

    public function __construct() {
        $this->serviceAccountFilePath = url('/') . '/public/uploads/firebase.json';
    }

    // Function to generate a JWT token
    public function generateJWT() {
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
    public function getAccessToken($jwt) {
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
    public function sendFCMNotification($accessToken, $data, $deviceToken, $firebase_key) {
        $fcmUrl = 'https://fcm.googleapis.com/v1/projects/riders-76f0b/messages:send';

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
    public function sendUserFCMNotification($accessToken, $data, $deviceToken, $firebase_key) {
        $fcmUrl = 'https://fcm.googleapis.com/v1/projects/riders-76f0b/messages:send';

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
}
?>
