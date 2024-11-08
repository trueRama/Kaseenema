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