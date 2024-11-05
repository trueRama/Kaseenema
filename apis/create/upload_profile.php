<?php
$target_dir = "uploads_images/";

//process image profile picture
$target_file_profilePic = $target_dir.$account_user_cord."signature.png";
$uploadOkSignatures = 1;
$imageFileTypeSignatures = strtolower(pathinfo($target_file_profilePic,PATHINFO_EXTENSION));
$checkSignatures = getimagesize($user_signature);
$message = '';

// Check if image file is an actual image or fake image
if($checkSignatures) {
    $message = "File is an image - " . $checkSignatures["mime"] . ".<br/>";
} else {
    $message = "File is not an image.<br/>";
    $uploadOkSignatures = 0;
}
// Check file size
if ($user_signature_size > 5000000) {
    $message = $message." & Sorry, your file is too large.<br/>";
    $uploadOkSignatures = 0;
}
// Allow certain file formats
if($imageFileTypeSignatures != "jpg" && $imageFileTypeSignatures != "png" && $imageFileTypeSignatures != "jpeg"
    && $imageFileTypeSignatures != "gif" ) {
    $message = $message." & Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
    $uploadOkSignatures = 0;
}

/* Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br/>";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOkSignatures == 0) {
    $message = $message." & Sorry, your file was not uploaded.<br/>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($user_signature, $target_file_profilePic)) {
        $message = $message." & The file ".basename($user_signature_base)." has been uploaded.<br/>";
    } else {
        $message = $message." & Sorry, there was an error uploading your file.<br/>";
    }
}

