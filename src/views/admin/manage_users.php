<?php
//check if pgs registered
$sql_pgs = "SELECT * FROM users order  by id DESC LIMIT 100";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_pgs = "SELECT * FROM users WHERE  username LIKE '%$search%' order  by id DESC";
}
$query_pgs = mysqli_query($conn, $sql_pgs);
$u_check_pgs = mysqli_num_rows($query_pgs);
$number_of_pages = ceil($u_check_pgs/$results_per_page);
$sql_pgs = "SELECT * FROM users order  by id DESC LIMIT $this_page_first_result, $results_per_page";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_pgs = "SELECT * FROM users WHERE  username LIKE '%$search%' order  by id DESC LIMIT $this_page_first_result , $results_per_page";
}
?>
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">App Users</h4>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-sm text-white mb-0 me-0" type="button" onclick="add_trader_open()">
                        <i class="mdi mdi-account-plus"></i> Add new User</button>
                    </div>
                </div>
                <div class="table-responsive  mt-1">
                    <h6>
                        <p class="text-danger"><?php echo $system_message; ?></p>
                    </h6>
                    <table class="table select-table">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
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
                                $username = $row['username'];
                                $email = $row['email'];
                                $mobile = $row['mobile'];
                                $status = $row['online_status'];
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
                                            <p><?php echo $mobile; ?></p>
                                            <div class="show_mobile">
                                                <div class=""><?php echo $email; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if($status != 1){ ?>
                                    <button class="btn btn-sm badge-opacity-danger show_desktop" name="val" type="submit">
                                        Offline
                                    </button>
                                    <?php }else{ ?>
                                    <button class="btn btn-sm badge-opacity-success show_desktop" name="val" type="submit">
                                        Online
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
<div class="modal p-5" id="add_traders">
    <div class="modal-body">
        <div class="modal-content">
            <div class="card card-rounded">
                <div class="card-header">
                    <button class="btn btn-dark btn-rounded btn-fw" onclick="add_trader_close()">x close window</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form class="forms-sample row" method="post" action="#">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Username</label>
                                            <input type="text" class="form-control" id="exampleInputUsername1"
                                                   name="name" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                   name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mobile</label>
                                            <input type="hidden" name="user_type" value="normal" required>
                                            <input type="tel" class="form-control" id="exampleInputEmail1"
                                                   name="mobile" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                   name="passw" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                            <input type="password" class="form-control" id="exampleInputConfirmPassword1"
                                                   name="cpassw" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2" name="adduser">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    try{
        let add_trader = document.getElementById("add_traders");
        //open add trader
        function add_trader_open(){
            add_trader.style.display = "block";
        }
        //close add trader
        function add_trader_close(){
            add_trader.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target === add_trader) {
                add_trader.style.display = "none";
            }
        }
    }catch (e) {

    }
</script>
