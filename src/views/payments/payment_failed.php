<?php
$payment_type = "failed";
$status = 0;
$wallet_code = 0;
$username = "";
$email = "";
$mobile = "";
//check if pgs registered
$sql_pgs = "SELECT * FROM wallet_payments WHERE  payment_status = '$status' order  by id DESC LIMIT 100";
if($_SESSION['account_type'] != "admin"){
    $user_code = $_SESSION['user_code'];
    $sql_pgs = "SELECT * FROM user_wallet WHERE  use_code = '$user_code'";
    $query_pgs = mysqli_query($conn, $sql_pgs);
    $u_check_pgs = mysqli_num_rows($query_pgs);
    if($u_check_pgs > 0){
        $row = mysqli_fetch_array($query_pgs, MYSQLI_ASSOC);
        $wallet_code = $row['wallet_code'];
    }
    $sql_pgs = "SELECT * FROM wallet_payments WHERE  wallet_code = '$wallet_code' AND payment_status = '$status' order  by id DESC LIMIT 100";
}
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_pgs = "SELECT * FROM wallet_payments WHERE  payment_reference = '$search' order  by id DESC";
    if($_SESSION['account_type'] != "admin") {
        $sql_pgs = "SELECT * FROM wallet_payments WHERE  wallet_code = '$wallet_code' AND payment_reference = '$search'  order  by id DESC";
    }
}
$query_pgs = mysqli_query($conn, $sql_pgs);
$u_check_pgs = mysqli_num_rows($query_pgs);
$number_of_pages = ceil($u_check_pgs/$results_per_page);
$sql_pgs = "SELECT * FROM wallet_payments WHERE  payment_status = '$status' order  by id DESC LIMIT $this_page_first_result, $results_per_page";
if($_SESSION['account_type'] != "admin"){
    $sql_pgs = "SELECT * FROM wallet_payments WHERE  wallet_code = '$wallet_code' AND payment_status = '$status' order  by id DESC LIMIT $this_page_first_result, $results_per_page";
}
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_pgs = "SELECT * FROM wallet_payments WHERE  payment_reference = '$search' order  by id DESC";
    if($_SESSION['user_type'] != "admin") {
        $sql_pgs = "SELECT * FROM wallet_payments WHERE  wallet_code = '$wallet_code' AND payment_reference = '$search'  order  by id DESC";
    }
}
?>
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">App Payments</h4>
                    </div>
                </div>
                <div class="table-responsive  mt-1">
                    <table class="table select-table">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Payment Details</th>
                            <th><tg class="show_desktop">Status</tg></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $query_pgs = mysqli_query($conn, $sql_pgs);
                        if($u_check_pgs > 0){
                            while ($row = mysqli_fetch_array($query_pgs, MYSQLI_ASSOC)){
                                $i++;
                                $id = $row['id'];
                                $payment_wallet_code = $row['wallet_code'];
                                $status = $row['payment_status'];
                                $mobile = $row['transaction_number'];
                                $transaction_detail = $row['transaction_detail'];
                                $ref = $row['payment_reference'];
                                $amount = $row['amount'];
                                $sql_pgs_w = "SELECT * FROM user_wallet WHERE  wallet_code = '$payment_wallet_code'";
                                $query_pgs_w = mysqli_query($conn, $sql_pgs_w);
                                $u_check_pgs_w = mysqli_num_rows($query_pgs_w);
                                if($u_check_pgs_w > 0){
                                    $row_w = mysqli_fetch_array($query_pgs_w, MYSQLI_ASSOC);
                                    $payer_code = $row_w['use_code'];
                                    $sql_pgs_d = "SELECT * FROM users WHERE user_code = '$payer_code'";
                                    $query_pgs_d = mysqli_query($conn, $sql_pgs_d);
                                    $row_d = mysqli_fetch_array($query_pgs_d, MYSQLI_ASSOC);
                                    $username = $row_d['username'];
                                    $email = $row_d['email'];
                                }
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex ">
                                            <img src="assets/images/favicon.png" alt="">
                                            <div>
                                                <h6><?php echo $username; ?></h6>
                                                <p><?php echo "Ref: ".$ref; ?></p>
                                                <p><?php echo "Amount".$amount; ?></p>
                                                <p><?php echo $transaction_detail; ?></p>
                                                <p><?php echo $mobile; ?></p>
                                                <div class="show_mobile">
                                                    <div class=""><?php echo $email; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($status != 0){ ?>
                                            <button class="btn btn-sm badge-opacity-success  show_desktop" name="val" type="submit">
                                                Completed Payment
                                            </button>
                                        <?php }else{ ?>
                                            <button class="btn btn-sm badge-opacity-danger show_desktop" name="val" type="submit">
                                                Failed Payment
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                    <?php
                    include ("src/Includes/pagination.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
