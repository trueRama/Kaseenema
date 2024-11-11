<?php
$movie_type = "movies";
$active_home = "active";
$active_s = "";
$active_a = "";
$active_as = "";
$anime = "";
$cover_image = "assets/images/icons/movies.png";
$sql_get_movie = "SELECT * FROM movies WHERE cover_image != '' order by RAND() LIMIT 1";
$query_get_movie = mysqli_query($conn, $sql_get_movie);
$u_check_get_movie = mysqli_num_rows($query_get_movie);
if($u_check_get_movie > 0) {
    $move_row = mysqli_fetch_assoc($query_get_movie);
    $movie_name = $move_row['name'];
    if ($move_row['cover_image'] != NULL && $move_row['cover_image'] != "" && $move_row['cover_image'] != "url") {
        $cover_image = $move_row['cover_image'];
    }
}
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
<style>
    .content-wrapper {
        background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(203, 173, 13, 0.4), rgba(19, 13, 1, 0.5)),
        url("<?php echo $cover_image; ?>") no-repeat center;
        background-size: cover;
    }
    .content-wrapper {
        padding: 1.5rem 1rem 1.5rem .5rem;
    }
    .card.card-rounded {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background: transparent;
    }
    .show_movie{
        width: 100%;
        height: 200px;
        object-fit: cover;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 10px;
        background: rgba(0, 0, 0, 0.8);
    }
    .show_movies{
        /*margin: 5px;*/
    }
    .account{
        margin-top: 5px;
    }
    .text-white{
        font-weight: 700;
        font-size: 1.5rem;
    }
    .film-detail-fix {
        position: relative;
        bottom: auto;
        left: auto;
        right: auto;
        text-align: center;
        background: rgba(15, 12, 12, 0.8);
        padding: 15px 10px 10px;
        height: 50px;
        border-radius: 15px;
        margin-top: -45px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, .05);
        margin-bottom: 15px;
    }
    .film-name {
        margin-bottom: 2px;
        max-height: 36.5px;
        overflow: hidden;
        font-size: 14px;
        line-height: 1.3em;
        font-weight: 500;
        color: white;
    }
    .text-center{
        text-decoration: none;
    }
    @media only screen and (max-width: 576px) {
        .col-sm-6{
           width: 45%;
        }
        .mt-1 {
            margin-top: 0.25rem !important;
            margin-right: -4rem;
        }
    }
</style>
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <a href="?type=movies" class="btn btn-primary btn-sm text-white mb-0 me-0 account">
                            <i class="mdi mdi-movie"></i>Movies</a>
                        <a href="?type=series" class="btn btn-primary btn-sm text-white mb-0 me-0 account">
                            <i class="mdi mdi-movie"></i> Series</a>
                        <a href="?type=animation_movies" class="btn btn-primary btn-sm text-white mb-0 me-0 account" >
                            <i class="mdi mdi-movie"></i> Animated Movies</a>
                        <a href="?type=animation_series" class="btn btn-primary btn-sm text-white mb-0 me-0 account" >
                            <i class="mdi mdi-movie"></i> Animated Series</a>
                    </div>
                </div>
                <div class=" tab-content-basic">
                    <div class="table-responsive  mt-3 row">
                        <?php
                        $query_pgs = mysqli_query($conn, $sql_pgs);
                        if($u_check_pgs > 0){
                            while ($row = mysqli_fetch_array($query_pgs, MYSQLI_ASSOC)){
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
                                    <div class="col-lg-2 col-md-4 col-sm-6 show_movies">
                                        <a href="/detail?movie=<?php echo $code; ?>" class="text-center">
                                            <img src="<?php echo $image; ?>" class="show_movie" alt="">
                                            <div class="film-detail-fix text-center">
                                                <h6 class="film-name">
                                                    <?php echo $movie; ?>
                                                </h6>
                                            </div>
                                        </a>
                                    </div>
                            <?php }
                        } ?>
                        <?php
                        include ("src/Includes/pagination.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
