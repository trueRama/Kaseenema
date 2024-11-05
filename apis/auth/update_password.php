<?php
if (isset($_POST['update_password'])){
    $old_email =  $_POST['email'];
    $old_password =  $_POST['oPassword'];
    $new_password =  $_POST['password'];
    $confirm_password =  $_POST['cPassword'];
    $massage = "Password Update failed, Make Sure that confirm Password matches";
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    //check password strength
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $lowercase = preg_match('@[a-z]@', $new_password);
    $number    = preg_match('@[0-9]@', $new_password);
    $specialChars = preg_match('@[^\w]@', $new_password);
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8) {
        $massage = 'Password should be at least 8 characters in length and should include at least one upper case letter, 
        one number, and one special character.';
    }else{
        if($new_password == $confirm_password){
            //update wp_Password
            $massage = "Password updated successfully";
            // die(json_encode($data));
            $messageInsertSQL = ("UPDATE users Set password = '$hashed_password', updated_at = now()  WHERE  user_code = '$account_user_cord'");
            $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
        }
    }
    redirect($massage, "/profile");
}
