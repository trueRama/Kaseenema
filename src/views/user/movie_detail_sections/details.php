<!-- Admin Settings Area Section -->
<div class="row flex-grow player_container">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div>
                    <h4 class="card-title card-title-dash">Movie Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6" data-select2-id="10">
                        <div class="card" data-select2-id="9">
                            <div class="card-body" data-select2-id="8">
                                <img src="<?php echo $poster; ?>" alt="movie poster" class="movie_poster">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title card-title-dash">Related Movies</h4>
                                <div class="mt-3 w-100">
                                    <?php include_once ('src/views/user/movie_detail_sections/related.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>