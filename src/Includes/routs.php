<?php
$uri = $_SERVER['REQUEST_URI'];
$query = "";
/**  Test Mode setting */
//offline Debug
if(isset($_SERVER['QUERY_STRING'])){
    $query = $_SERVER['QUERY_STRING'];
}
/**  production setting */
//production
//if(isset($_SERVER['REDIRECT_QUERY_STRING'])){
//    $query = $_SERVER['REDIRECT_QUERY_STRING'];
//}

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
    case "/login?{$query}":
    case "/login":
        loginCheck();
        include_once ('src/views/auth/login.php');
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