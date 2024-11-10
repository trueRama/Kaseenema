<!-- Admin Settings Area Section -->
<style>
    .detail_card{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background: linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.4));
    }
    .detail_card_content{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background: linear-gradient(to right, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.4));
    }
</style>
<div class="row flex-grow player_container">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded detail_card">
            <div class="card-body">
                <div>
                    <h4 class="card-title card-title-dash text-white">Movie Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6" data-select2-id="10">
                        <div class="card detail_card_content" data-select2-id="9">
                            <div class="card-body" data-select2-id="8">
                                <?php if($poster != "" && $poster != "url" && $poster != Null && $poster != "assets/images/favicon.png"){ ?>
                                <iframe class="movie_poster"  src="<?php echo $poster; ?>/preview"></iframe>
                                <?php }else{ ?>
                                <img src="assets/images/icons/movies.png" alt="No Media Content" class="movie_poster" style="color: white; font-size: 25px; font-weight: 700;">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-2">
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