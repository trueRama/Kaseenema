<?php
$cover_image = "assets/images/favicon.png";
$poster = "assets/images/favicon.png";
$description = "";
$movie_url = "";
$move_code = filter_input(INPUT_GET, 'movie')??"";
//get movie details
if(isset($_POST['cat'])){
    $cat = filter_input(INPUT_POST, 'cat');
//    echo $cat;
    $sql_pgs_movie = "SELECT * FROM movie_categories WHERE movie_code = '$move_code' AND category_id = '$cat' order by id ASC";
    $query_pgs_movie = mysqli_query($conn, $sql_pgs_movie);
    $u_check_pgs_movie = mysqli_num_rows($query_pgs_movie);
    if($u_check_pgs_movie == 0){
        mysqli_query($conn, "INSERT INTO movie_categories(movie_code,category_id)
        VALUES ('$move_code','$cat')")
        or die(mysqli_error($conn));
    }
}
?>
<style>
    .content-wrapper {
        background: linear-gradient(to right, rgba(255, 255, 255, 0.8), rgba(203, 173, 13, 0.4), rgba(255, 255, 255, 0.8)),
        url("<?php echo $cover_image; ?>") no-repeat center;
        background-size: cover;
    }
    .content-wrapper {
        padding: 1.5rem 1rem 1.5rem .5rem;
    }
    .player{
        border: 1px solid rgba(255, 0, 0, 0.9);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 8px;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
        height: 450px;
    }
    .movie_poster{
        width: 100%;
        height: 450px;
        object-fit: contain;
        object-position: center;
    }
    @media only screen and (max-width: 700px) {
        .player{
            height: 350px;
        }

    }
    @media only screen and (max-width: 480px) {
        .player{
            height: 250px;
        }
    }
</style>
<!-- Streaming Area Section -->
<div class="row flex-grow player_container">
    <div class="col-12 grid-margin stretch-card">
        <div class="card player">
            <div class="card-body">
                <img src="" class="mdi-video" alt="embed" />
            </div>
        </div>
    </div>
</div>
<?php
include_once ('src/views/user/movie_detail_sections/add_cat_details.php');
include_once ('src/views/user/movie_detail_sections/details.php');

