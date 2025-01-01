<?php
//app page navigation rout url setup
$pageID = $_SERVER['REQUEST_URI'];
if (stripos($pageID, '?') !== false) {
    $pageID = substr($pageID, 0, strpos($pageID, "?"));
}
/**  Server setting */
function getBaseUrl(): string
{
    $protocol = (!empty($_SERVER['HTTPS'])
        && $_SERVER['HTTPS'] !== 'off'
        || $_SERVER['SERVER_PORT'] == 443)
        ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return $protocol . $domainName;
}
/**  login  check */
function loginCheck()
{
    if(isset($_SESSION['username'])){
        $message = "Your are already logged in";
        redirect($message, "/dashboard");
    }
}
/**  logged out check */
function loggedOutCheck(): void
{
    if(!isset($_SESSION['username'])){
        $message = "Your are Required to Login to Access Most Service";
        redirect($message, "/login");
    }
}
/** subscription check */
function subscriptionCheck($conn): void
{
    if(isset($_SESSION['user_code'])){
        $sub_access = $_SESSION['user_code'];
        $current_date = date("Y-m-d H:i:s");
        $sql_sub = "SELECT * FROM subscriptions WHERE access_code = '$sub_access'";
        $query_sub = mysqli_query($conn, $sql_sub);
        $u_check_sub = mysqli_num_rows($query_sub);
        if($u_check_sub > 0){
            $row_sub = mysqli_fetch_array($query_sub, MYSQLI_ASSOC);
            $active_subscription = $row_sub['status'];
            $sub_end_date = $row_sub['end_date'];
            if($sub_end_date < $current_date){
                $active_subscription = 0;
                $sql_sub = "UPDATE subscriptions SET status = '$active_subscription' WHERE access_code = '$sub_access'";
                mysqli_query($conn, $sql_sub);
                $message = "Your Subscription is Expired";
                redirect($message, "/subscription");
            }
            if($active_subscription == 1){
                $_SESSION['subscription'] = $active_subscription;
            }else{
                $message = "Your are Required to Subscribe to Access Most Service";
                redirect($message, "/subscription");
            }
        }else{
            $message = "Your are Required to Subscribe to Access Most Service";
            redirect($message, "/subscription");
        }
    }
    if(!isset($_SESSION['subscription'])){
        $message = "Your are Required to Subscribe to Access Most Service";
        redirect($message, "/subscription");
    }
}
