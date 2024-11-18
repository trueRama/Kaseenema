<?php
$movie_name = "";
$cover_image = "assets/images/favicon.png";
$poster = "assets/images/favicon.png";
$description = "";
$movie_url = "";
$trailer_url = "";
$voice = "";
$move_code = filter_input(INPUT_GET, 'movie')??"";
$episode_url = filter_input(INPUT_POST, 'episode_url')??"";
$type = "";
$anime = "";
//get movie details
$sql_get_movie = "SELECT * FROM movies WHERE movie_code = '$move_code'";
$query_get_movie = mysqli_query($conn, $sql_get_movie);
$u_check_get_movie = mysqli_num_rows($query_get_movie);
if($u_check_get_movie > 0){
     $move_row = mysqli_fetch_assoc($query_get_movie);
     $movie_name = $move_row['name'];
     if($move_row['cover_image'] != NULL && $move_row['cover_image'] != "" && $move_row['cover_image'] != "url"){
         $cover_image = $move_row['cover_image'];
     }
     $description = $move_row['description'];
     $movie_url = $move_row['movie_url'];
     if($episode_url != NULL && $episode_url != ""){
         $movie_url = $episode_url;
     }
     $trailer_url = $move_row['trailer_url'];
     $voice = $move_row['voice'];
    if($move_row['poster_image'] != NULL && $move_row['poster_image'] != "" && $move_row['poster_image'] != "url"){
        $poster = $move_row['poster_image'];
    }
     $type = $move_row['movie_type'];
     $anime = $move_row['animetion_status'];
}
// if isset post edit move details
if(isset($_POST['edit'])){
    $edit_movie_name = filter_input(INPUT_POST, 'movie_name');
    $edit_cover_image = $cover_image;
    if($edit_movie_name == ""){
        $edit_movie_name = $movie_name;
    }
    $valErr = '';
    // Validate form input fields
    if(empty($_FILES["file"]["name"])){
        $valErr .= 'Please select a file to upload.<br/>';
    }
    // Check whether user inputs are empty
    if(empty($valErr)){
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $edit_movie_name.".png";
        // Upload file to local server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $edit_cover_image = $targetFilePath;
        }
    }
    $edit_poster = filter_input(INPUT_POST, 'poster');
    if($edit_poster == ""){
        $edit_poster = $poster;
    }
    $edit_poster = $conn->real_escape_string($edit_poster);
    $edit_description = filter_input(INPUT_POST, 'description');
    if($edit_description == ""){
        $edit_description = $description;
    }
    $edit_description = $conn->real_escape_string($edit_description);
    $edit_movie_url = filter_input(INPUT_POST, 'movie_url');
    if($edit_movie_url == ""){
        $edit_movie_url = $movie_url;
    }
    $edit_movie_url = $conn->real_escape_string($edit_movie_url);
    $edit_trailer_url = filter_input(INPUT_POST, 'trailer_url');
    if($edit_trailer_url == ""){
        $edit_trailer_url = $trailer_url;
    }
    $edit_trailer_url = $conn->real_escape_string($edit_trailer_url);
    $edit_voice = filter_input(INPUT_POST, 'voice');
    if($edit_voice == ""){
        $edit_voice = $voice;
    }
    $movie_type = filter_input(INPUT_POST, 'movie_type');
    if($movie_type == ""){
        $movie_type = $type;
    }
    $anime_status = filter_input(INPUT_POST, 'anime_status');
    if($anime_status == ""){
        $anime_status = $anime;
    }
//    check empty columns
    $messageInsertSQL = ("UPDATE movies Set 
      name = '$edit_movie_name',
      cover_image = '$edit_cover_image',
      poster_image = '$edit_cover_image',
      voice  = '$edit_voice',
      movie_url = '$edit_movie_url',
      trailer_url = '$edit_trailer_url',
      description = '$edit_description',
      movie_type = '$movie_type',
      animetion_status  = '$anime_status',
      created_at = now() 
    WHERE  movie_code = '$move_code'");
    $messageInsertSQL = mysqli_query($conn, $messageInsertSQL);
    redirect("Movie Details Updated","/detail?movie=$move_code");
}
//adding categories to movie
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
        height: 600px;
    }
    .movie_poster{
        width: 100%;
        height: 450px;
        object-fit: contain;
        object-position: center;
        border-radius: 10px;
        border: 1px solid rgba(255, 0, 0, 0.9);
    }
    .player_content{
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
                <?php if($movie_url != "" && $movie_url != "url" && $movie_url != Null){ ?>
                <iframe width="100%" height="100%" class="player_content"
                src="<?php echo $movie_url; ?>/preview"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
                <?php }else{ ?>
                    <img src="assets/images/icons/movies.png" alt="No Media Content" class="movie_poster" style="color: white; font-size: 25px; font-weight: 700;">
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once ('src/views/user/movie_detail_sections/add_cat_details.php');
if($type == "series"){
?>
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Episodes</h4>
                    </div>
                    <?php if($account_user_type == "admin") { ?>
                    <div>
                        <button class="btn btn-primary btn-sm text-white mb-0 me-0 account" type="button"
                                onclick="add_trader_open()">
                            <i class="mdi mdi-movie"></i> Upload Episodes</button>
                    </div>
                    <?php } ?>
                </div>
                <h6>
                    <p class="text-danger"><?php echo $system_message; ?></p>
                </h6>
                <div class="row" >
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php include_once ('src/views/user/movie_detail_sections/episodes.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if($account_user_type == "admin") {
        include_once ('src/views/admin/studio/upload_episodes.php');
    }
}
include_once ('src/views/user/movie_detail_sections/details.php');

