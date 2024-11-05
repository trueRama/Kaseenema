<!-- Admin Settings Area Section -->
<?php if($account_user_type == "admin") { ?>
    <div class="row flex-grow player_container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div>
                        <h4 class="card-title card-title-dash">Select Movie Category</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6" data-select2-id="10">
                            <div class="card" data-select2-id="9">
                                <div class="card-body" data-select2-id="8">
                                    <form action="<?php echo $pageID; ?>?movie=<?php echo $move_code; ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group" data-select2-id="7">
                                            <label for="cat">Select Category to Add to this Movie</label>
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" id="cat"
                                                    name="cat" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <?php
                                                $sql_pgs_cat = "SELECT * FROM categories order by category ASC";
                                                $query_pgs_cat = mysqli_query($conn, $sql_pgs_cat);
                                                $u_check_pgs_cat = mysqli_num_rows($query_pgs_cat);
                                                if($u_check_pgs_cat > 0){
                                                    while ($row = mysqli_fetch_array($query_pgs_cat, MYSQLI_ASSOC)){
                                                        $id = $row['id'];
                                                        $category = $row['category'];
                                                        ?>
                                                        <option value="<?php echo $id; ?>"><?php echo $category; ?></option>
                                                    <?php } } ?>
                                            </select>
                                        </div>
                                        <button name="add_cat" class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="submit">
                                            <i class="mdi mdi-book-arrow-down"></i> Add Categories
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title card-title-dash">This Movie Categories</h4>
                                    <div class="mt-3 w-100">
                                        <?php
                                        $sql_pgs_movie = "SELECT * FROM movie_categories WHERE movie_code = '$move_code' order by id ASC";
                                        $query_pgs_movie = mysqli_query($conn, $sql_pgs_movie);
                                        $u_check_pgs_movie = mysqli_num_rows($query_pgs_movie);
                                        if($u_check_pgs_movie > 0){
                                            while ($row_movie = mysqli_fetch_array($query_pgs_movie, MYSQLI_ASSOC)){
                                                $id = $row_movie['category_id'];
                                                $sql_pgs_cat = "SELECT * FROM categories WHERE id = '$id'";
                                                $query_pgs_cat = mysqli_query($conn, $sql_pgs_cat);
                                                $row = mysqli_fetch_array($query_pgs_cat, MYSQLI_ASSOC);
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
    </div>
<?php } ?>