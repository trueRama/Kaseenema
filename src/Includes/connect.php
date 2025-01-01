<?php
/** Online Data Base */
const DB_SERVER = "localhost";
const DB_USER = "kaseenema_movie";
const DB_PASS = "(Movie202424)";
const DB_NAME = "kaseenema_movie";
/** Offline Database */
//const DB_SERVER = "127.0.0.1";
//const DB_USER = "root";
//const DB_PASS = "";
//const DB_NAME = "kaseenema";
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}
clearstatcache();
//mysqli_close($conn);
//constants
/** pagination page number */
$results_per_page = 100;
/** determine which page number visitor is currently on */
$pageNumber = 1;
if (isset($_POST['pageNumber'])) {
    $pageNumber = $_POST['pageNumber'];
}
/** determine the sql LIMIT starting number for the results on the displaying page */
$this_page_first_result = ($pageNumber-1)*$results_per_page;
/** @var  $number_of_pages */
$number_of_pages = 1;