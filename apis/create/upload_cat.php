<?php
$user_type = 1;
$pgs_role = 0;
$current_members = 0;
$new_members = 0;
$user_message = "";
$create_log = 0;
$user_log_new = 0;
$group_SMS = "Uploaded New Categories";
$state = 0;
if(isset($_POST["add_cat"]))
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
                    $category = "";
                    if(isset($Row[0])) {
                        $category = mysqli_real_escape_string($conn,$Row[0]);
                    }
                    $cover = "";
                    if(isset($Row[1])) {
                        $cover = mysqli_real_escape_string($conn,$Row[1]);
                    }
                    //ignore empty data strings
                    if($category != "category" && $category != ""){
                        //check duplicate data before adding new data
                        $movie_dup = mysqli_query($conn, "SELECT * FROM categories WHERE category = '$category'");
                        if(mysqli_num_rows($movie_dup) == 0){
                            mysqli_query($conn, "INSERT INTO categories(category,category_pic)
                            VALUES ('$category','$cover')")
                            or die(mysqli_error($conn));
                        }
                    }
                }
            }
            redirect("Categories Uploaded",'/studio');
        } catch (Exception $e) {
            echo $e->__toString() ."<br/>";
        }
    }
}