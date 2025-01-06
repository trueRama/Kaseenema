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
                                            <select class="form-control js-example-basic-single w-100 select2-hidden-accessible" id="cat"
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
                        <!--           Movie Categories             -->
                        <div class="col-md-6">
                            <div>
                                <h4 class="card-title card-title-dash">Change Movie Access</h4>
                            </div>
                           <div class="row">
                               <div class="col-md-12">
                                   <form action="<?php echo $pageID; ?>?movie=<?php echo $move_code; ?>"
                                         method="post" enctype="multipart/form-data">
                                       <div class="form-group" data-select2-id="7">
                                           <label for="cat">Change Movie Access</label>
                                           <select class="form-control js-example-basic-single w-100 select2-hidden-accessible" id="cat"
                                                   name="movie_access" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                               <option value="<?php echo $selected_access_one_value; ?>">
                                                   Click Here to Change <?php echo $selected_access_one; ?>
                                               </option>
                                               <option value="<?php echo $selected_access_two_value; ?>">
                                                   <?php echo $selected_access_two; ?>
                                               </option>
                                           </select>
                                       </div>
                                       <button name="change_access" class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="submit">
                                           <i class="mdi mdi-book-arrow-down"></i> Save Settings
                                       </button>
                                   </form>
                               </div>
                               <div class="col-md-12" >
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
                        <!--    End of Movie Categories                    -->
                        <!--      Edit Movie Details                  -->
                        <div class="col-md-12">
                            <form action="<?php echo $pageID; ?>?movie=<?php echo $move_code; ?>"
                                  method="post" enctype="multipart/form-data" class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title card-title-dash">Edit Movie Details</h4>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="movie_name">Movie / Media Name</label>
                                                <input type="text" name="movie_name" id="movie_name" class="form-control" placeholder="<?php echo $movie_name; ?>">
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="cover_image">Movie / Media Cover</label>
                                                <input type="file" name="file" id="cover_image" class="form-control" accept="image/*">
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="poster">Movie / Media Poster</label>
                                                <input type="text" name="poster" id="poster" class="form-control" placeholder="<?php echo $poster; ?>">
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="movie_url">Movie / Media URL</label>
                                                <input type="text" name="movie_url" id="movie_url" class="form-control" placeholder="<?php echo $movie_url; ?>">
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="trailer_url">Movie / Media Trailer URL</label>
                                                <input type="text" name="trailer_url" id="trailer_url" class="form-control" placeholder="<?php echo $trailer_url; ?>">
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="voice">Movie / Media Voice Over</label>
                                                <input type="text" name="voice" id="voice" class="form-control" placeholder="<?php echo $voice; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group" data-select2-id="7">
                                                <label for="movie_type">Select Movie Type</label>
                                                <select class="js-example-basic-single w-100 select2-hidden-accessible" id="movie_type"
                                                        name="movie_type" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option value="movies">Movies</option>
                                                    <option value="series">Series</option>
                                                </select>
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="anime_status">Select Animation Status</label>
                                                <select class="js-example-basic-single w-100 select2-hidden-accessible" id="anime_status"
                                                        name="anime_status" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="form-group" data-select2-id="7">
                                                <label for="description">Movie Description</label>
                                                <textarea class="form-control" id="description" style="height: 9.75rem;"
                                                  rows="10" name="description" placeholder="<?php echo $description; ?>"></textarea>
                                            </div>
                                            <button name="edit" class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="submit">
                                                <i class="mdi mdi-book-arrow-down"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--    Movie Details                   -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<style>
    select.form-control, select.typeahead, select.tt-query, select.tt-hint, .select2-container--default .select2-selection--single select.select2-search__field, .select2-container--default select.select2-selection--single {
        color: #000;
    }
</style>
