<?php
$user_type = 1;
$pgs_role = 0;
$current_members = 0;
$new_members = 0;
$user_message = "";
$create_log = 0;
$user_log_new = 0;
$group_SMS = "Uploaded New Movies";
$state = 0;
if(isset($_POST["add_movies"]))
{
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    //extract excel user data from Upload
    if(in_array($_FILES["file_upload"]["type"],$allowedFileType)){
        //create backup copy of the data for the user to always update member details
        $targetPath = "assets/templates/".$account_user_cord.'_'.$_FILES['file_upload']['name'];
        move_uploaded_file($_FILES['file_upload']['tmp_name'], $targetPath);
        //update or create new records of the members in the database
        try {
            $Reader = new SpreadsheetReader($targetPath);
            $sheetCount = count($Reader->sheets());
            //analyse each row of the document
            for($i=0;$i<$sheetCount;$i++)
            {
                $Reader->ChangeSheet($i);
                foreach ($Reader as $Row)
                {
                    $movie_name = "";
                    if(isset($Row[0])) {
                        $movie_name = mysqli_real_escape_string($conn,$Row[0]);
                    }
                    $cover = "";
                    if(isset($Row[1])) {
                        $cover = mysqli_real_escape_string($conn,$Row[1]);
                    }
                    $poster = "";
                    if(isset($Row[2])) {
                        $poster = mysqli_real_escape_string($conn,$Row[2]);
                    }
                    $vj = "";
                    if(isset($Row[3])) {
                        $vj = mysqli_real_escape_string($conn,$Row[3]);
                    }
                    $movie = "";
                    if(isset($Row[4])) {
                        $movie = mysqli_real_escape_string($conn,$Row[4]);
                    }
                    $trailer = "";
                    if(isset($Row[5])) {
                        $trailer = mysqli_real_escape_string($conn,$Row[5]);
                    }
                    $description = "";
                    if(isset($Row[6])) {
                        $description = mysqli_real_escape_string($conn,$Row[6]);
                    }
                    $type = "";
                    if(isset($Row[7])) {
                        $type = mysqli_real_escape_string($conn,$Row[7]);
                    }
                    $anime_status = "";
                    if(isset($Row[8])) {
                        $anime_status = mysqli_real_escape_string($conn,$Row[8]);
                        if($anime_status == "yes"){
                           $state = 1;
                        }
                    }
                    //ignore empty data strings
                    if($movie_name != "Type" && $movie_name != "movie_name" && $movie_name != ""){
                        //create and update new user records and data
                        $movie_code = "MV0000KS";
                        $user = mysqli_query($conn, "SELECT * FROM movies order by id DESC LIMIT 1");
                        if(mysqli_num_rows($user)>0){
                            $row = mysqli_fetch_array($user);
                            $ID = $row['id'];
                            $movie_code = "MV".rand(100, 999);
                            $movie_code = $movie_code.$ID."KS";
                        }
                        //check duplicate data before adding new data
                        $movie_dup = mysqli_query($conn, "SELECT * FROM movies WHERE name = '$movie_name'");
                        if(mysqli_num_rows($movie_dup) == 0){
                            mysqli_query($conn, "INSERT INTO movies(movie_code,name,cover_image,poster_image,voice,movie_url,trailer_url,description,movie_type,animetion_status)
                            VALUES ('$movie_code','$movie_name','$cover','$poster','$vj','$movie','$trailer','$description','$type','$state')")
                            or die(mysqli_error($conn));
                        }
                    }
                }
            }
            redirect("Movies Uploaded",'/studio');
        } catch (Exception $e) {
            echo $e->__toString() ."<br/>";
        }
    }
}