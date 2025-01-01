<?php
use Ramsey\Uuid\Uuid;
// Define your Flutterwave credentials and endpoint
$secretKey = "FLWSECK-3c973ace13a5d81e7daeeb2e8e3951c3-193bb1d5b34vt-X"; // Replace with your secret key
$baseURL = "https://api.flutterwave.com/v3/payments";

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
        $new_wallet = mysqli_query($conn,"INSERT INTO user_wallet(use_code, wallet_code, wallet_standing)
        VALUES ('$user_cord', '$wallet_code','$current_balance')");
    }
    $end_date = $date->format('Y-m-d H:i:s');
    /** echo $username . "<br/>" . $phone . "<br/>"
     * . $wallet_code . "<br/>$payment_reference<br/>
    $amount<br/>$currency<br/> Order Detail
    $subscription_package Subscription<br/>" . $end_date; */
    /** create wallet payment record */
    mysqli_query($conn, "INSERT INTO wallet_payments(wallet_code,payment_reference,transaction_detail,transaction_number,amount)
    VALUES ('$wallet_code', '$payment_reference','$subscription_package Streaming Subscription','$phone', '$amount')")
    or die(mysqli_error($conn));

    /** create wallet subscription record */
    $messageInsertSQL = ("INSERT INTO subscriptions(access_code,end_date,payment_reference,status)
    VALUES ('$user_cord', '$end_date', '$payment_reference',0)");
    mysqli_query($conn, $messageInsertSQL);
    $message = "Payment Processing";
    redirect_payment("https://kaseenema.com/wolfarm", $secretKey, $baseURL, $phone, $email, $username, $payment_reference,
        $amount, $currency, $subscription_package, "https://app.kaseenema.com/callback");
}else{
    $message = "Invalid Payment Request";
    redirect($message, "/subscription");
}

function redirect_payment($url, $secretKey, $baseURL, $phone, $email, $username,
$payment_reference, $amount, $currency, $subscription_package, $callback): void
{
    echo "<form id='the-form' 
      method='post' 
      enctype='multipart/form-data' 
      action='$url'>\n";
    echo "<input type='hidden' name='secretKey' value='$secretKey'>\n";
    echo "<input type='hidden' name='baseURL' value='$baseURL'>\n";
    echo "<input type='hidden' name='phone' value='$phone'>\n";
    echo "<input type='hidden' name='email' value='$email'>\n";
    echo "<input type='hidden' name='username' value='$username'>\n";
    echo "<input type='hidden' name='payment_reference' value='$payment_reference'>\n";
    echo "<input type='hidden' name='amount' value='$amount'>\n";
    echo "<input type='hidden' name='currency' value='$currency'>\n";
    echo "<input type='hidden' name='subscription_package' value='$subscription_package'>\n";
    echo "<input type='hidden' name='callback' value='$callback'>\n";
    echo <<<ENDOFFORM
        <p id="the-button" style="display:none;">
        Click the button if page doesn't redirect within 3 seconds.
        <br>
        <input type="submit" value="Click this button">
        </p>
        </form>
        <script type="text/javascript">
        function DisplayButton()
        {
           document.getElementById("the-button").style.display="block";
        }
        setTimeout(DisplayButton,3000);
        document.getElementById("the-form").submit();
        </script>
ENDOFFORM;
}