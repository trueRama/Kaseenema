<?php
use Ramsey\Uuid\Uuid;
// Define your Flutterwave credentials and endpoint
$secretKey = "FLWSECK-3c973ace13a5d81e7daeeb2e8e3951c3-193bb1d5b34vt-X"; // Replace with your secret key
$baseURL = "https://api.flutterwave.com/v3/payments";
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['phone_number'])){
    $phone = $_POST['phone_number'];
    $phone = substr($phone, 1);
    $email = $_POST['email'];
    $subscription_package = $_POST['subscription_package'];
    $date = new DateTime();
    $user_cord = $_SESSION['user_code'];
    $username = $_SESSION['username'];
    $uuid = Uuid::uuid4();
    $payment_reference = "KAS-".$uuid->toString();;
    $amount = 0;
    $currency = "UGX";
    //check package an assign the right details
    if($subscription_package == "Annual"){
        $date->modify('+366 days');
        $amount = 220000;
    }elseif ($subscription_package == "six_months"){
        $date->modify('+183 days');
        $amount = 110000;
    }elseif ($subscription_package == "monthly"){
        $date->modify('+31 days');
        $amount = 25000;
    }else{
        $message = "Invalid Payment Request";
        redirect($message, "/subscription");
    }
    //check if user has wallet
    //create new wallet
    $wallet_code = "KAW".rand(100, 999);
    $current_balance = 0;
    $my_wallets = mysqli_query($conn, "SELECT * FROM user_wallet WHERE use_code = '$user_cord'");
    if(mysqli_num_rows($my_wallets)>0){
        $row = mysqli_fetch_array($my_wallets);
        $wallet_code = $row['wallet_code'];
        $current_balance = $row['wallet_standing'];
    }else{
        $wallets = mysqli_query($conn, "SELECT * FROM user_wallet ORDER BY id DESC LIMIT 1");
        if(mysqli_num_rows($wallets)>0) {
            $row = mysqli_fetch_array($wallets);
            $ID = $row['id'];
            $wallet_code = $wallet_code."".$ID;
        }
        //create new wallet for user
        $new_wallet = mysqli_query($conn,"INSERT INTO user_wallet(use_code, wallet_code, wallet_standing)VALUES ('$user_cord', '$wallet_code','$current_balance')");
    }
    $end_date = $date->format('Y-m-d H:i:s');
    echo $username . "<br/>" . $phone . "<br/>" . $wallet_code . "<br/>$payment_reference<br/>$amount<br/>$currency<br/> Order Detail $subscription_package Subscription<br/>" . $end_date;
    /** create wallet payment record */
    mysqli_query($conn, "INSERT INTO wallet_payments(wallet_code,payment_reference,transaction_detail,transaction_number,amount)
    VALUES ('$wallet_code', '$payment_reference','$subscription_package Streaming Subscription','$phone', '$amount')")or die(mysqli_error($conn));

    /** create wallet subscription record */
    $messageInsertSQL = ("INSERT INTO subscriptions(access_code,end_date,payment_reference,status)
    VALUES ('$user_cord', '$end_date', '$payment_reference',0)");
    mysqli_query($conn, $messageInsertSQL);

    redirect($message, "https://kaseenema.com/wolfarm/");
//    /**  Data for the API request */
//    $postData = [
//        "tx_ref" => $payment_reference, // Unique transaction reference/ order id
//        "amount" => $amount,        // Payment amount
//        "currency" => "UGX",       // Currency code
//        "redirect_url" => "http://127.0.0.1:8000/callback", // URL to redirect after payment
//        "payment_options" => "card,ussd,mobilemoney", // Payment methods
//        "customer" => [
//            "email" => $email, // Customer's email
//            "phonenumber" => "779397727",    // Customer's phone number
//            "name" => $username              // Customer's name
//        ],
//        "customizations" => [
//            "title" => "KaSEENEMA Entertainments",
//            "description" => "$subscription_package Streaming Subscription",
//            "logo" => "https://kaseenema.com/wp-content/uploads/2024/10/cropped-Screenshot-2024-10-26-114334-1.png" // Logo URL
//        ]
//    ];
//    /** process payment */
//    // Initialize cURL session
//    $ch = curl_init();
//    // Set cURL options
//    curl_setopt($ch, CURLOPT_URL, $baseURL);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
//    curl_setopt($ch, CURLOPT_HTTPHEADER, [
//        "Authorization: Bearer $secretKey", // Authentication header
//        "Content-Type: application/json"   // Set content type to JSON
//    ]);
//    echo $baseURL;
//    // Execute cURL request and capture the response
//    $response = curl_exec($ch);
//    print_r($response);
//    // Check for cURL errors
//    if (curl_errno($ch)) {
//        echo 'Error: ' . curl_error($ch);
//    } else {
//        // Decode and handle the response
//        $responseDecoded = json_decode($response, true);
//        if ($responseDecoded['status'] === 'success' && isset($responseDecoded['data']['link'])) {
//            // Get the payment link
//            $paymentLink = $responseDecoded['data']['link'];
//            // Redirect the user to the payment link
//            header("Location: $paymentLink");
//            exit();
//        } else {
//            // Handle API response error
//            echo "Error: ".$responseDecoded['message'];
//        }
//    }
////     Close cURL session
//    curl_close($ch);
}else{
    $message = "Invalid Payment Request";
    redirect($message, "/subscription");
}