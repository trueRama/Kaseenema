<div class="modal p-5 w-50" id="view_cat">
    <div class="modal-body">
        <div class="modal-content">
            <div class="card card-rounded">
                <div class="card-header">
                    <button class="btn btn-dark btn-rounded btn-fw" onclick="view_cat_close()">x close window</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="mt-3 w-100">
                                <?php
                                $sql_pgs_cat = "SELECT * FROM categories order by category ASC";
                                $c = 0;
                                $query_pgs_cat = mysqli_query($conn, $sql_pgs_cat);
                                $u_check_pgs_cat = mysqli_num_rows($query_pgs_cat);
                                if($u_check_pgs_cat > 0){
                                while ($row = mysqli_fetch_array($query_pgs_cat, MYSQLI_ASSOC)){
                                $c++;
                                $id = $row['id'];
                                $category = $row['category'];
                                $category_pic = $row['category_pic'];
                                $image_cat = "assets/images/favicon.png";
                                if($category_pic != NULL && $category_pic != ""  && $category_pic != "url"){
                                    $image_cat = $category_pic;
                                }
                                ?>
                                <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                    <div class="d-flex">
                                        <img class="img-sm rounded-10" src="<?php echo $image_cat; ?>" alt="profile">
                                        <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold"><?php echo $category; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } }else{ echo "No Categories Added Yet"; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    try{
        let view_cat = document.getElementById("view_cat");
        //open add trader
        function view_cat_open(){
            view_cat.style.display = "block";
        }
        //close add trader
        function view_cat_close(){
            view_cat.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target === view_cat) {
                view_cat.style.display = "none";
            }
        }
    }catch (e) {

    }
</script>