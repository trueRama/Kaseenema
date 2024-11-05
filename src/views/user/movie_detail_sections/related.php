<?php
$sql_pgs_movie = "SELECT * FROM movie_categories WHERE movie_code = '$move_code' order by id ASC";
$query_pgs_movie = mysqli_query($conn, $sql_pgs_movie);
$u_check_pgs_movie = mysqli_num_rows($query_pgs_movie);
$has = 0;
if($u_check_pgs_movie > 0){
    while ($row_movie = mysqli_fetch_array($query_pgs_movie, MYSQLI_ASSOC)){
    $id = $row_movie['category_id'];
    $sql_pgs_cat = "SELECT * FROM movie_categories WHERE category_id = '$id' AND movie_code != '$move_code' ORDER BY RAND() LIMIT 2";
    $query_pgs_cat = mysqli_query($conn, $sql_pgs_cat);
    $u_check_pgs_cat = mysqli_num_rows($query_pgs_cat);
    if($u_check_pgs_cat > 0){
        while ($row_m = mysqli_fetch_array($query_pgs_cat, MYSQLI_ASSOC)) {
            $has ++;
            $m_code = $row_m['movie_code'];
            //get movie
            $sql_movie = "SELECT * FROM movies WHERE movie_code = '$m_code'";
            $query_movie = mysqli_query($conn, $sql_movie);
            $row = mysqli_fetch_array($query_movie, MYSQLI_ASSOC);
            $get_movie_name = $row['name'];
            $get_movie_pic = $row['cover_image'];
            $image_pic = "assets/images/favicon.png";
            if ($get_movie_pic != NULL && $get_movie_pic != "" && $get_movie_pic != "url") {
                $image_pic = $get_movie_pic;
            }
?>
    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
        <div class="d-flex">
            <img class="img-sm rounded-10" src="<?php echo $image_pic; ?>" alt="profile">
            <a href="/detail?movie=<?php echo $m_code; ?>" class="wrapper ms-3">
                <p class="ms-1 mb-1 fw-bold"><?php echo $get_movie_name; ?></p>
            </a>
        </div>
    </div>
<?php
        }
    }
} }
if($has == 0){ echo "No Relations"; } ?>