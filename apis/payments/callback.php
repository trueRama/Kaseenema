<?php
//status types
//-cancelled
//-successful
$user_notification = "Processing Payment";
$status = $_GET['status'];
$txt_ref = $_GET['tx_ref'];
$transaction_id = "";
$color = "red";
if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];
}
// if status is success store record with success status and trans ref
if($status == "successful"){
    $user_notification = "Payment Successful Subscription Activated";
    $color = "Green";
    //Update wallet payment status
    mysqli_query($conn,"UPDATE wallet_payments SET payment_status = 1 WHERE payment_reference = '$txt_ref'");
    mysqli_query($conn,"UPDATE subscriptions SET status = 1 WHERE payment_reference = '$txt_ref'");
}else{
    $user_notification = "Payment Cancelled Subscription Not Activated";
    mysqli_query($conn,"DELETE FROM subscriptions WHERE payment_reference = '$txt_ref'");
}
echo "Transaction Reference: ".$txt_ref;
?>
<style>
    .notification{
        /*position: fixed;*/
        /*top:50%;*/
        /*left: 25%;*/
        color: <?= $color ?>;
        font-weight: 700;
        font-size: 50px;
    }
</style>
<div class="notification"><?php echo "$user_notification"; ?></div>