<?php
//database connection
include_once('Includes/connect.php');
//application serve settings
include_once('Includes/app_config.php');
//application constant variables
include_once('Includes/app_constants.php');
//application session manager
include('apis/auth/appSession.php');
//application UI theme and Layout
include_once ('Includes/header.php'); //Header and Css calls //nav bar navigation
if($account_user_cord != "0000"){
    include_once ('Includes/navbar.php');
    echo '<div class="container-fluid page-body-wrapper">';
    include_once('Includes/drawer.php');
    echo '<div class="main-panel">';
    echo '<div class="content-wrapper">';
}
include_once ('Includes/routs.php');  //Body, Routs and Content Calls
if($account_user_cord != "0000"){
    echo '</div></div></div>';
}
include_once('Includes/footer.php');  //footer and Javascript calls



