<?php
//store logout time and session
$new_user = mysqli_query($conn, "INSERT INTO system_logos(user_code, log_type) 
            VALUES ('$account_user_cord', 0)")
            or die(mysqli_error($conn));
//set account offline
$messageInsertSQL = ("UPDATE users Set online_status = 0, updated_at = now()  
             WHERE  user_code = '$account_user_cord'");
$messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
//kill session
session_destroy();
//redirect to login page
echo header("location: /login");