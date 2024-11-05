<?php
function loginUser($checkAccount, $password, $conn)
{
    $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
    $username = $fetchDetails['username'];
    $passwordHash = $fetchDetails['password'];
    $user_type_name = $fetchDetails['user_type'];
    $user_cord = $fetchDetails['user_code'];
    //check if password is correct
    if(password_verify($password, $passwordHash)) {
        //setUp User Session
        $_SESSION['username'] = $username;
        $_SESSION['account_type'] = $user_type_name;
        $_SESSION['user_code'] = $fetchDetails['user_code'];
        //set account state online
        $messageInsertSQL = ("UPDATE users Set online_status = 1, updated_at = now()  WHERE  user_code = '$user_cord'");
        mysqli_query($conn, $messageInsertSQL);
        //update system logs
        mysqli_query($conn, "INSERT INTO system_logos(user_code, log_type) VALUES ('$user_cord', 1)") or die(mysqli_error($conn));
        //redirect to dashboard
        echo("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Welcome {$username}')
            window.location.href='/'
        </SCRIPT>");
    }else {
        redirect("Check your Password to continue", "/login");
    }
}
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //check username
    $checkAccount = mysqli_query($conn, ("select * from users WHERE username='$username'"));
    //login of account
    $checkExistance = mysqli_num_rows($checkAccount);
    if ($checkExistance > 0) {
        loginUser($checkAccount,$password,$conn);
    } else {
        //check phonenumber
        $checkAccount = mysqli_query($conn, ("select * from users WHERE email='$username'"));
        //login of account
        $checkExistance = mysqli_num_rows($checkAccount);
        if ($checkExistance > 0) {
            loginUser($checkAccount,$password,$conn);
        } else {
            redirect("Check your Username or Email to continue", "/login");
        }
    }
}