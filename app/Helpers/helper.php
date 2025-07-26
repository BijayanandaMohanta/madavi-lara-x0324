<?php
function send_push_notification($data, $token, $firebase_key)
{
    $data = array(
        "registration_ids" => $token,
        "priority" => 'high',
        "notification" => array(
            "title" => $data['title'],
            "description" => $data['body'],
            "image" => $data['image'],
            "address" => $data['address'],
            "order_id" => $data['order_id'],
        ),
        "data" => $data
    );
    $data_string = json_encode($data);

    $headers = array(
        'Authorization: key=' . $firebase_key,
        'Content-Type: application/json'
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    $result = curl_exec($ch);
    // print_r($result);
    // die();
    curl_close($ch);
    json_encode($result);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Get token
function get_token()
{
    $postData = [
        'email' => 'subhendu.dev@colourmoon.com',
        'password' => 'Subhendu@123.'
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
function availability($token)
{
    if (isset($token)) {
        $auth = $token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability?pickup_postcode=500072&delivery_postcode=534342&weight=1&cod=0&token=$auth",
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
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            $json = "";
        } else {
            //echo $response;
            $json = json_decode($response, true);
            echo "<pre>";
            print_r($json);
            echo "</pre>";
        }
        return $json;
    }
}

// Pickup address
function pickup_address($auth)
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
function place_order($auth, $data)
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
    //echo '<pre>';
    //print_r($SR_login_Response);
    //echo '</pre>';
    $json = json_decode($SR_login_Response);
    //print_r($json);
    return $json;
}

// Track order
function track($auth, $awb_no)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/awb/$awb_no?token=$auth",
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
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
        $json = "";
    } else {
        //echo $response;
        $json = json_decode($response, true);
        /*echo "<pre>";
    print_r($json);
    echo "</pre>";*/
    }
    return $json;
}

// embed youtube shorts
