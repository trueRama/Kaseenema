<?php
if(isset($_POST["add_movies"]))
{
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    $movie_code = $_POST["movie_code"];
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
                    $episode = "";
                    if(isset($Row[0])) {
                        $episode = mysqli_real_escape_string($conn,$Row[0]);
                    }
                    $episode_url = "";
                    if(isset($Row[1])) {
                        $episode_url = mysqli_real_escape_string($conn,$Row[1]);
                    }
                    $season = "";
                    if(isset($Row[2])) {
                        $season = mysqli_real_escape_string($conn,$Row[2]);
                    }
                    //ignore empty data strings
                    if($episode != "episode_name" && $episode != ""){
                        //check duplicate data before adding new data
                        $movie_dup = mysqli_query($conn, "SELECT * FROM movie_episodes WHERE 
                        movie_code = '$movie_code' AND episode = '$episode' AND  season = '$season'");
                        if(mysqli_num_rows($movie_dup) == 0){
                            mysqli_query($conn, "INSERT INTO movie_episodes(movie_code,episode,episode_url,season)
                            VALUES ('$movie_code','$episode','$episode_url','$season')")
                            or die(mysqli_error($conn));
                        }
                    }
                }
            }
            redirect("Episodes Uploaded","/detail?movie=$movie_code");
        } catch (Exception $e) {
            echo $e->__toString() ."<br/>";
        }
    }
}