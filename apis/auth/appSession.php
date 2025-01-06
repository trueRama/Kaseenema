<?php
$account_username = "";
$account_name = "";
$account_phone_number = "";
$account_email = "";
$account_avatar = "assets/icons/app_icon.png";
$account_user_cord = '0000';
$account_user_id = "";
$account_user_type = "ordinary";
$user_access_key = "";
//setup session handler
//Handling the Login Credentials
if(isset($_SESSION['username'])){
    //get user details
    $account_username = $_SESSION['username'];
    $checkAccount = mysqli_query($conn, ("select * from users WHERE username='$account_username'"));
    //Account Details
    $checkExistance = mysqli_num_rows($checkAccount);
    if ($checkExistance > 0) {
        $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
        $account_name = $fetchDetails['fullname'];
        $account_phone_number = $fetchDetails['mobile'];
        $account_email = $fetchDetails['email'];
//        $account_ava = $fetchDetails['avatar'];
//        if($account_ava != null){
//            $account_avatar = "uploads_images/".$fetchDetails['avatar'];
//        }
        $account_user_cord = $fetchDetails['user_code'];
        $account_user_id = $fetchDetails['id'];
        $account_user_type = $fetchDetails['user_type'];
        $user_access_key = $fetchDetails['access_code'];
    }else{
        redirect("Your are required to login to access this content", "/logout");
    }
}