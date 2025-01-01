<?php
$uri = $_SERVER['REQUEST_URI'];
$query = "";
/**  Test Mode setting */
//offline Debug
//if(isset($_SERVER['QUERY_STRING'])){
//    $query = $_SERVER['QUERY_STRING'];
//}
/**  production setting */
//production
if(isset($_SERVER['REDIRECT_QUERY_STRING'])){
    $query = $_SERVER['REDIRECT_QUERY_STRING'];
}
$character = "&";
// Find the position of the character
$position = strpos($query, $character);
// Extract the part of the string after the character
$query = substr($query, $position + 1);
switch ($uri) {
    /** Application View routs and calls
     *
     *===================================================================================
     */
    case '/':
        loggedOutCheck();
        if(isset($_SESSION['username'])) {
            header("location: /dashboard");
        }
        break;
    case '/dashboard':
    case "/dashboard?{$query}":
    case '/movies':
    case "/movies?{$query}":
    case '/series':
    case "/series?{$query}":
    case '/animations':
    case "/animations?{$query}":
        $account_type = $_SESSION['account_type'];
        if($account_type != "admin"){
            subscriptionCheck($conn);
        }
        loggedOutCheck();
        include_once ('src/views/dashboard.php');
        break;
    /** Application Auth Screen Routs
     *
     *===================================================================================
     */
    case "/signup?{$query}":
    case "/signup":
        loginCheck();
        include_once ('src/views/auth/signup.php');
        break;
    case "/login?$query":
    case "/login":
        loginCheck();
        include_once ('src/views/auth/login.php');
        break;
    /** Application subscribe User
     *
     *===================================================================================
     */
    case "/subscription?$query":
    case "/subscription":
        include_once ('src/views/user/subscription/subscription.php');
        break;
    case "/payment?$query":
    case "/payment":
        include_once ('apis/payments/gateway.php');
        break;
    case "/callback?$query":
    case "/callback":
        echo "<h1>Subscription Status</h1><p>Your subscription status is available here!</p>";
        include_once ('apis/payments/callback.php');
        break;
    case "/payments_approved?$query":
    case "/payments_approved":
        echo "<h1>Payments Records</h1><p>Your payment records are available here!</p>";
        include_once ('src/views/payments/payment.php');
        break;
    case "/payments_field?$query":
    case "/payments_field":
        echo "<h1>Payments Records</h1><p>Your payment records are available here!</p>";
        include_once ('src/views/payments/payment_failed.php');
        break;
    /** Application logout User
     *
     *===================================================================================
     */
    case "/logout":
        include_once ('src/views/auth/logout.php');
        break;
    /** Application Admin Screen Routs
     *
     *===================================================================================
     */
    //manage app users
    case "/app_users?{$query}":
    case "/app_users":
        loggedOutCheck();
        include_once ('src/views/admin/manage_users.php');
        break;
    //manage app users
    case "/studio?{$query}":
    case "/studio":
        loggedOutCheck();
        include_once ('src/views/admin/studio.php');
        break;

    /** Application User Screen Routs
     *
     *===================================================================================
     */
    //manage app users
    case "/detail?{$query}":
    case "/detail":
        loggedOutCheck();
        include_once ('src/views/user/movie_details.php');
        break;
    /** Application API routs and calls
     *
     *===================================================================================
     */
   //application api routs
    //login user api call
   case "/userLogin?{$query}":
   case "/userLogin":
        include_once ('apis/auth/loginUser.php');
        break;
   //signup user api call user registration api
   case "/user_registration?{$query}":
   case "/user_registration":
        include_once('apis/auth/user_registration.php');
        break;
   //Upload movie api
   case "/upload_movies?{$query}":
   case "/upload_movies":
        include_once('apis/create/upload_movies.php');
        break;
    //Upload episodes api
   case "/upload_episodes?{$query}":
   case "/upload_episodes":
        include_once('apis/create/upload_episodes.php');
        break;
    //Upload Categories api
   case "/upload_categories?{$query}":
   case "/upload_categories":
        include_once('apis/create/upload_cat.php');
        break;
    /** Resource Not found Calls
     *
     *===================================================================================
     */
   default:
        echo "<h1>Error 404</h1><p>Error 404 implies that the resource you requested for is not available!</p>";
        echo $query;
        break;
}