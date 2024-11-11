<?php
$movie_type = "movies";
$active_home = "active";
$active_s = "";
$active_a = "";
$active_as = "";
$anime = "";
if(isset($_GET["type"])){
    $movie_type = $_GET["type"];
    if($movie_type == "series"){
        $active_home = "";
        $active_s = "active";
    }
    if($movie_type == "animation_movies"){
        $movie_type = "movies";
        $anime = "AND animetion_status = 1";
        $active_home = "";
        $active_a = "active";
    }
    if($movie_type == "animation_series"){
        $movie_type = "series";
        $anime = "AND animetion_status = 1";
        $active_home = "";
        $active_as = "active";
    }
}
//check if pgs registered
$sql_pgs = "SELECT * FROM movies WHERE movie_type = '$movie_type' $anime order by name ASC LIMIT 100";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_pgs = "SELECT * FROM movies WHERE  name LIKE '%$search%' order by name ASC";
}
$query_pgs = mysqli_query($conn, $sql_pgs);
$u_check_pgs = mysqli_num_rows($query_pgs);
$number_of_pages = ceil($u_check_pgs/$results_per_page);
$sql_pgs = "SELECT * FROM movies WHERE movie_type = '$movie_type' $anime order by name 
ASC LIMIT $this_page_first_result, $results_per_page";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql_pgs = "SELECT * FROM movies WHERE  name LIKE '%$search%' order by name ASC 
    LIMIT $this_page_first_result , $results_per_page";
}
?>
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">App Movies</h4>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="button"
                                onclick="view_cat_open()">
                            <i class="mdi mdi-book-account"></i>View Categories</button>
                        <button class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="button"
                                  onclick="add_cat_open()">
                            <i class="mdi mdi-book-arrow-down"></i> Add Categories</button>
                        <button class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="button"
                                onclick="add_trader_open()">
                            <i class="mdi mdi-account-plus"></i> Upload New Movie</button>
                    </div>
                </div>
                <h6>
                    <p class="text-danger"><?php echo $system_message; ?></p>
                </h6>
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link ps-0 <?php echo $active_home; ?>" href="?type=movies">Movies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $active_s; ?>" href="?type=series">Series</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $active_a; ?>" href="?type=animation_movies">Animation Movies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border-0 <?php echo $active_as; ?>" href="?type=animation_series">Animation Series</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content tab-content-basic">
                    <div class="table-responsive  mt-1">
                        <table class="table select-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th><?php echo $movie_type; ?></th>
                                <th><tg class="show_desktop">Actions</tg></th>
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
                                    $movie = $row['name'];
                                    $cover = $row['cover_image'];
                                    $image = "assets/images/favicon.png";
                                    $code = $row['movie_code'];
                                    if($cover != NULL && $cover != ""  && $cover != "url"){
                                        $image = $cover;
                                    }
                                    $description = $row['description'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <img src="<?php echo $image; ?>" alt="">
                                                <div>
                                                    <h6><?php echo $movie; ?></h6>
                                                    <p><?php echo $description; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm badge-opacity-success show_desktop" href="/detail?movie=<?php echo $code; ?>" type="submit">
                                                Full Details
                                            </a>
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
</div>
<?php
    include ("src/views/admin/studio/upload_movie.php");
    include ("src/views/admin/studio/view_cat.php");
    include ("src/views/admin/studio/add_cat.php");
?>
