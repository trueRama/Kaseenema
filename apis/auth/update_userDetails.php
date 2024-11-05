<?php
if(isset($_POST['fname'])) {
    $account_user_cord_updater = $_POST['user_code'];
    $edit_type = $_POST['edit_type'];
    //update wp_email
    $massage = "Profile Update Failed";
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $oldEmail = $_POST['oldEmail'];
    if($email == $oldEmail){
        $messageInsertSQL = ("UPDATE users Set fullname = '$fname', mobile = '$contact', updated_at = now()  
             WHERE  user_code = '$account_user_cord_updater'");
    }else{
        $messageInsertSQL = ("UPDATE users Set fullname = '$fname', mobile = '$contact', email = '$email', updated_at = now()  WHERE  user_code = '$account_user_cord_updater' ");
    }
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
    if($messageInsertQuery){
        $massage = "User Profile Updated Successfully";
    }
    redirect($massage, "/profile");
}