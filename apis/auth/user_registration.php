<?php
$curl = curl_init();
//create account
function registration($conn,$username,$phone,$email,$password)
{
    $user_type_name = "";
    $message = "";
    foreach($username as $index => $usernames)
    {
        $users_username = $usernames;
        $users_phone = $phone[$index];
        $users_email = $email[$index];
        $users_password = $password[$index];
        $user_code = "KASI0001";
        $hashed_password = password_hash($users_password, PASSWORD_DEFAULT);
        $user = mysqli_query($conn, "SELECT * FROM users order by id DESC LIMIT 1");
        if(mysqli_num_rows($user)>0){
            $row = mysqli_fetch_array($user);
            $ID = $row['id'];
            $user_code = "KASI".rand(100, 999);
            $user_code = $user_code."".$ID;
        }
        //check if username already exists
        $user_check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$users_username' ");
        if(mysqli_num_rows($user_check)>0) {
            $message = "Username already available: $users_username";
            $error = 1;
        }else{
            //check if phone number already exists
            $user_check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$users_email' ");
            if(mysqli_num_rows($user_check)>0) {
                $message = "Email already available: Contact $users_phone";
                $error = 1;
            }else{
                //create new account
                $new_user = mysqli_query($conn, "INSERT INTO users(user_code, username, email, mobile, password)
                VALUES ('$user_code', '$users_username', '$users_email', '$users_phone', '$hashed_password')") or die(mysqli_error($conn));
                $message = "Account(s) Created Successfully";
                //create one month free of subscription
                $date = new DateTime();
                $date->modify('+31 days');
                $end_date = $date->format('Y-m-d H:i:s');
//                $messageInsertSQL = ("INSERT INTO subscriptions(access_code, end_date, payment_reference, status)
//                VALUES ('$user_code', '$end_date', '$user_code', 1)");
//                mysqli_query($conn, $messageInsertSQL);
            }
        }
    }
    //single registration
    $checkAccount = mysqli_query($conn, ("select * from users WHERE username='$users_username' AND password ='$hashed_password'"));
    //login of account
    $checkExistance = mysqli_num_rows($checkAccount);
    if($checkExistance > 0){
        $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
        $username = $fetchDetails['username'];
        $_SESSION['username']= $username;
        $_SESSION['account_type']= $user_type_name;
        $_SESSION['user_code']= $fetchDetails['user_code'];
        $user_code = $fetchDetails['user_code'];
        //set account state online
        $messageInsertSQL = ("UPDATE users Set online_status = 1, updated_at = now() WHERE  user_code = '$user_code'");
        mysqli_query($conn, $messageInsertSQL);
        //update system logs
        mysqli_query($conn, "INSERT INTO system_logos(user_code, log_type) VALUES ('$user_code', 1)") or die(mysqli_error($conn));
    }
    //redirect to dashboard
    redirect($message, "/");
}
if(isset($_POST['signup'])) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $phone;
    //user registration form
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password != $cpassword){
        $message = "The passwords provided do not match, please make sure the passwords are the some.";
        redirect($message, "/signup");
    }else{
        registration($conn,$username, $phone,$email,$password);
    }
}