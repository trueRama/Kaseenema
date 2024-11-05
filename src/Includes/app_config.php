<?php
//app page navigation rout url setup
$pageID = $_SERVER['REQUEST_URI'];
if (stripos($pageID, '?') !== false) {
    $pageID = substr($pageID, 0, strpos($pageID, "?"));
}
$uri = $_SERVER['REQUEST_URI'];
$query = "";
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
/**  login  check */
function loginCheck()
{
    if(isset($_SESSION['username'])){
        $message = "Your are already logged in";
        redirect($message, "/dashboard");
    }
}
/**  logged out check */
function loggedOutCheck()
{
    if(!isset($_SESSION['username'])){
        $message = "Your are Required to Login to Access Most Service";
        redirect($message, "/login");
    }
}