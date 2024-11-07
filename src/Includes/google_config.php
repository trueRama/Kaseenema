<?php
include_once "connect.php";
// Google API configuration
$client_ID = "";
$client_secret = "";
$scope = "";
$sql_pgs_cat = "SELECT * FROM drive_setup";
$query_pgs_cat = mysqli_query($conn, $sql_pgs_cat);
$u_check_pgs_cat = mysqli_num_rows($query_pgs_cat);
if($u_check_pgs_cat > 0){
    while ($row = mysqli_fetch_array($query_pgs_cat, MYSQLI_ASSOC)) {
        $key_name = $row['key_name'];
        $key = $row['key_value'];
        if($key_name == "client_ID"){
            $client_ID = $key;
        }elseif ($key_name == "Client_secret") {
            $client_secret = $key;
        }elseif ($key_name == "scope"){
            $scope = $key;
        }
    }
}
define("GOOGLE_CLIENT_ID", $client_ID);
define("GOOGLE_CLIENT_SECRET", $client_secret);
define("GOOGLE_OAUTH_SCOPE", $scope);
//production
//const REDIRECT_URI = 'http://app.kaseenema.com/apis/google_config/google_drive_sync.php';
//test offline
const REDIRECT_URI = 'http://127.0.0.1:8002/apis/google_config/google_drive_sync.php';
// Start session
if(!session_id()) session_start();
// Google OAuth URL
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online';