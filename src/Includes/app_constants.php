<?php
//nav bar show
$show_nav_bar = 1;
//system notification messages
$system_message = isset($_POST['message']) ? $_POST['message'] : "";
//navigation indicators
$home_in = "active";
if($pageID != "/dashboard"){
    $home_in = "";
}
if($pageID == "/"){
    $home_in = "active";
}
$manage_in = "";
$studio_in = "";
$vpy_in = "";
$ppy_in = "";
$fpy_in = "";
$movie_in = "";
$series_in = "";
$help_in = "";
$animation_in = "";
$wallet_in = "";
$terms_in = "";

