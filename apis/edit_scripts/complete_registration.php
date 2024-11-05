
<?php if($ordinary_member != 0){ ?>
    <div class="form-popup-role" id="myRoles">
        <form action="/pgs_add_member" method="post" enctype="multipart/form-data" class="form-container">
            <h6><?php if(isset($_POST['edit'])){ echo "Update Member Details"; }else{ echo  "Add This user as a Member"; } ?></h6>
            <div class="row" >
                <input type="hidden"  id="user_type[]" name="user_type[]" value="1" />
                <input type="hidden"  id="add[]" name="add[]" value="1" />
                <input type="hidden" name="user_code[]" id="user_code[]" value="<?php echo $new_user_code; ?>"/>
                <input type="hidden" name="belongs" id="belongs" value="<?php echo $pgs_belongs; ?>"/>
                <input type="hidden" id="gender[]" name="gender[]" value="<?php echo $gender; ?>"/>
                <input type="hidden" id="dob[]" name="dob[]" value="<?php echo $dob; ?>"/>
                <input type="hidden" id="email[]" name="email[]" value="<?php echo $email; ?>"/>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text"  class="form-control" id="username[]" name="username[]"  value="<?php echo $pgs_username; ?>"
                               readonly/>
                    </div>
                    <div class="mb-3">
                        <label>Firstname</label>
                        <input type="text"   class="form-control" id="fname[]" name="fname[]"  value="<?php echo $fname; ?>" readonly/>
                    </div>
                    <div class="mb-3">
                        <label>Lastname</label>
                        <input type="text"   class="form-control" id="lname[]" name="lname[]"  value="<?php echo $lname; ?>" readonly/>
                    </div>
                    <div class="mb-3">
                        <label>Contact </label>
                        <input type="text" class="form-control" class="form-control" id="contact[]" name="contact[]"
                               value="<?php echo $contact; ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label>Executive Village</label>
                        <input type="text" class="form-control"
                            <?php if($myVillage == ""){ ?>
                                placeholder="Enter Your Village"
                            <?php }else{ echo "value='$myVillage'"; } ?>
                               aria-label="District/ City Name"
                               name="village[]" id="village[]" required>
                    </div>
                    <div class="mb-3">
                        <label>Location Latitude</label>
                        <input type="text" class="form-control"
                            <?php if($myLatitude == ""){ ?>
                                placeholder="Click GEO LOCATOR to get Location"
                            <?php }else{ echo "value='$myLatitude'"; } ?>
                               aria-label="Latitude"
                               name="mylat[]" id="lat"  required>
                    </div>
                    <div class="mb-3">
                        <label>Location Longitude</label>
                        <input type="text" class="form-control"
                            <?php if($myLongitude == ""){ ?>
                                placeholder="Click GEO LOCATOR to get Location"
                            <?php }else{ echo "value='$myLongitude'"; } ?>
                               aria-label="Longitude"
                               name="mylong[]" id="long"  required>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-sm-12 text-center">
                    <input type="hidden" name="id" id="id" value="<?php echo $pgs_id; ?>"/>
                    <input type="hidden" name="manage" id="manage" value="<?php echo $pgs_name; ?>"/>
                    <button type="button" id="btnAction" class="btn btn-success btn-sm mb-0" onClick="locate()" style="margin-top: 5px; width: 50%">
                        Geo Locator
                    </button>
                </div>
                <div class="col-sm-12 text-center" id="confim" style="<?php if($myLongitude == ""){ echo "display:none"; } ?>">
                    <button type="submit" class="btn btn-success btn-sm mb-0" style="margin-top: 5px;"
                            name="add_executive" >
                        <?php if(isset($_POST['edit'])){ echo "Update Details"; }else{ echo "Add Member"; } ?>
                    </button>
                </div>
                <div class="col-sm-12 text-end">
                    <button type="button" class="btn btn-danger btn-sm mb-0 cancel" style="margin-top: 5px;"
                            onclick="closeFormRoles()">Close</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        //roles
        function closeFormRoles() {
            document.getElementById("myRoles").style.display = "none";
        }
    </script>
<?php } ?>