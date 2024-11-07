<?php
// Include configuration file
include_once 'src/Includes/google_config.php';
$status = $statusMsg = '';
if(!empty($_SESSION['status_response'])){
    $status_response = $_SESSION['status_response'];
    $status = $status_response['status'];
    $statusMsg = $status_response['status_msg'];
    unset($_SESSION['status_response']);
}
?>
<!-- Status message -->
<?php if(!empty($statusMsg)){ ?>
    <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>
<?php } ?>

<div class="col-md-12">
    <form method="post" action="apis/google_config/upload_to_drive.php" class="form" enctype="multipart/form-data">
        <div class="form-group">
            <label>Movie Name</label>
            <input type="text" name="movie_name" class="form-control">
        </div>
        <div class="form-group">
            <label>File</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn-primary" name="submit" value="Upload"/>
        </div>
    </form>
</div>