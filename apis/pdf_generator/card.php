<?php
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Spipu\Html2Pdf\Html2Pdf;
$pgs_id = "";
$pgs_name = "";
$pgs_location = "";
$pgs_code = "";
$dob  = "";
$gender = "";
$pgs_username = "";
$email= "";
$user_code = "";
$village = "";
$pgs_role = "Ordinary Member";
$role_id = 0;
$alternate_person = "";
$alternate_contact = "";
$alternate_email = "";
//generate qr code
$options = new QROptions(
    [
        'eccLevel' => QRCode::ECC_L,
        'outputType' => QRCode::OUTPUT_IMAGE_JPG,
        'version' => 5,
    ]
);
$member_code = $_GET["member"]??"";
//check if pgs member is registered
$sql_pgs = "SELECT * FROM system_pgs_members WHERE user_code = '$member_code' order  by id DESC";
$query_pgs = mysqli_query($conn, $sql_pgs);
$u_check_pgs = mysqli_num_rows($query_pgs);
//get details
if($u_check_pgs > 0) {
    while ($row = mysqli_fetch_array($query_pgs, MYSQLI_ASSOC)) {
        //pgs member details
        $id = $row['id'];
        $user_code = $row['user_code'];
        $role_id = $row['role_id'];
        $added_by = $row['added_by'];
        $created_at = $row['added_at'];
        $signature = $row['upload_signature'];
        $village = $row['village'];
        $status = $row['status'];
        $pgs_id = $row['pgs_id'];
        //if is executive
        $exec_id = $role_id;
        $sql_exec_id = "SELECT * FROM pgs_executives WHERE  user_code = '$user_code' AND status = 0 order  by id DESC";
        $query_exec_id = mysqli_query($conn, $sql_exec_id);
        $u_check_exec_id = mysqli_num_rows($query_exec_id);
        if ($u_check_exec_id > 0) {
            $row_exec = mysqli_fetch_array($query_exec_id, MYSQLI_ASSOC);
            $exec_id = $row_exec['role_id'];
        }
        //PGS ROLE
        $sql_role = "SELECT * FROM pgs_roles WHERE  id = '$exec_id' ";
        $query_role = mysqli_query($conn, $sql_role);
        if (mysqli_num_rows($query_role) > 0) {
            $row_role = mysqli_fetch_array($query_role, MYSQLI_ASSOC);
            $pgs_role = $row_role['role'];
        }
        //user location
        $sql_location = "SELECT * FROM user_location WHERE  user_code = '$user_code' ";
        $query_location = mysqli_query($conn, $sql_location);
        if (mysqli_num_rows($query_location) > 0) {
            $row_location = mysqli_fetch_array($query_location, MYSQLI_ASSOC);
            $village = $row_location['village'];
        }
        //User Details
        $sql_alternate = "SELECT * FROM user WHERE user_code = '$user_code'";
        $query_alternate = mysqli_query($conn, $sql_alternate);
        $u_check_alternate = mysqli_num_rows($query_alternate);
        if ($u_check_alternate > 0) {
            $row_alternate = mysqli_fetch_array($query_alternate, MYSQLI_ASSOC);
            $alternate_person = $row_alternate['first_name'] . " " . $row_alternate['last_name'];
            $alternate_contact = $row_alternate['phonenumber'];
            $alternate_email = $row_alternate['email'];
            $gender = $row_alternate['gender'];
            $dob = $row_alternate['dob'];
        }
        //if is executive products
        $sql_farm = "SELECT * FROM system_pgs WHERE id = '$pgs_id'";
        $query_farm = mysqli_query($conn, $sql_farm);
        $u_check_farm = mysqli_num_rows($query_farm);
        if ($u_check_farm > 0) {
            $row_farm = mysqli_fetch_array($query_farm, MYSQLI_ASSOC);
            $pgs_name = $row_farm['pgs_name'];
            $pgs_location = $row_farm['location_name'];
            $pgs_code = $row_farm['pgs_code'];
        }
    }
}
$link = getBaseUrl()."member_studio?code=$member_code";
$qrcode = (new QRCode($options))->render((string)$link);
$data_selas = '
<table style="border: 2px solid green; border-radius: 10px; width: auto; padding-right: 25px;
 background-image: url(assets/icons/cards.png);">
    <tr>
        <td colspan="3">
            <h4 style="color: green; text-align: center">'.$pgs_name.' Membership Card</h4>
        </td>
    </tr>
    <tr>
        <td>
            <img src="'.$qrcode.'" style="width: 100%; height: 200px; object-fit: contain;">
        </td>
        <td style="padding-right: 25px">
            <h6 align="left" style="font-size: 12px; font-weight: bold;">Member: '.$alternate_person.'</h6>
            <h6 align="left" style="font-size: 12px; font-weight: bold;">Village: '.$village.'</h6>
            <h6 align="left" style="font-size: 12px; font-weight: bold;">Gender: '.$gender.'</h6>
            <h6 align="left" style="font-size: 12px; font-weight: bold;">Date of Birth: '.$dob. '</h6>
        </td>
        <td style="padding-right: 25px">
            <h6 align="left" style="color: #640303; font-size: 12px; font-weight: bold;">Card No.: '.$member_code.'</h6> 
            <h6 align="left" style="color: #640303; font-size: 12px; font-weight: bold;">PGS: ' .$pgs_name.'</h6>   
            <h6 align="left" style="color: #640303; font-size: 12px; font-weight: bold;">PGS ROLE: '.$pgs_role.'</h6>   
            <h6 align="left" style="color: #640303; font-size: 12px; font-weight: bold;">PGS CODE: '.$pgs_code.'</h6>        
            <h6 align="left" style="color: #640303; font-size: 12px; font-weight: bold;">PGS Location: '.$pgs_location.'</h6>
        </td>
    </tr>
</table>
    ';
echo $data_selas;
$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($data_selas);
ob_end_clean();
clearstatcache();
$html2pdf->output($member_code.'.pdf');