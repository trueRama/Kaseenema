<?php
$season_count = 1;
$season_name = "";
//select series Seasons
$sql_seasons = "SELECT DISTINCT(season) FROM movie_episodes WHERE movie_code = '$move_code' order by season ASC";
$query_seasons = mysqli_query($conn, $sql_seasons);
$u_check_seasons = mysqli_num_rows($query_seasons);
if($u_check_seasons > 0){
    while ($row_season = mysqli_fetch_array($query_seasons, MYSQLI_ASSOC)){
//        $season_count++;
        $season_name = $row_season['season'];
        echo $season_name;
    }
}
?>
<h5 class="mt-4"><?=$season_name; ?></h5>
<?php if($season_count == 1) { ?>
<div class="col-lg-2 col-md-3 col-sm-6 mt-2" xmlns="http://www.w3.org/1999/html">
    <div class="d-flex">
        <form method="post" action="/detail?movie=<?= $move_code; ?>">
            <h6>Episode 1</h6>
            <img class="img-sm rounded-10" src="<?php echo $cover_image; ?>" alt="profile">
            <input type="hidden" name="episode_url" value="">
            <button type="submit" name="play_episode" class="btn btn-outline-secondary btn-rounded btn-icon">
                <i class="ti-control-play text-dark"></i> Play
            </button>
        </form>
    </div>
</div>
<?php } ?>
<?php
//select series Seasons
$sql_pgs_movie = "SELECT * FROM movie_episodes WHERE movie_code = '$move_code' order by id ASC";
$query_pgs_movie = mysqli_query($conn, $sql_pgs_movie);
$u_check_pgs_movie = mysqli_num_rows($query_pgs_movie);
$has = 0;
if($season_count == 1) {
    $has = 1;
}
if($u_check_pgs_movie > 0){
    while ($row_movie = mysqli_fetch_array($query_pgs_movie, MYSQLI_ASSOC)){
        $has++;
        $season = $row_movie['season'];
        $id = $row_movie['id'];
        $episode_url = $row_movie['episode_url'];
?>
    <div class="col-lg-2 col-md-3 col-sm-6 mt-2" xmlns="http://www.w3.org/1999/html">
        <div class="d-flex">
            <form method="post" action="/detail?movie=<?= $move_code; ?>">
                <h6>Episode <?= $has; ?></h6>
                <img class="img-sm rounded-10" src="<?php echo $cover_image; ?>" alt="profile">
                <input type="hidden" name="episode_url" value="<?= $episode_url; ?>">
                <button type="submit" name="play_episode" class="btn btn-outline-secondary btn-rounded btn-icon">
                    <i class="ti-control-play text-dark"></i> Play
                </button>
            </form>
        </div>
    </div>
<?php
        }
    }
if($has == 0){ echo "No New Episodes Yet"; } ?>