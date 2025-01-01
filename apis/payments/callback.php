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
$status_value = 0;
// if status is success store record with success status and trans ref
if($status == "successful"){
    $status_value = 1;
    $user_notification = "Payment Successful";
    $color = "Green";
}
if($status == "cancelled"){
    $user_notification = "Payment Cancelled";
}
echo $txt_ref;
//put update query
if($status_value == 1){
//    $messageInsertSQL = ("UPDATE user Set avatar = '$ImageSignature', updated_at = now()  WHERE  user_code = '$account_user_cord' ");
//    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
}
?>
<style>
    .notification{
        position: fixed;
        top:50%;
        left: 25%;
        color: <?= $color ?>;
        font-weight: 700;
        font-size: 50px;
    }
</style>
<div class="notification"><?php echo "$user_notification"; ?></div>