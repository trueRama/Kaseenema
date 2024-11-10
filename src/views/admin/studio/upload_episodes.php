<div class="modal p-5" id="add_traders">
    <div class="modal-body">
        <div class="modal-content">
            <div class="card card-rounded">
                <div class="card-header">
                    <button class="btn btn-dark btn-rounded btn-fw" onclick="add_trader_close()">x close window</button>
                    <a href="assets/templates/episodes.xlsx" class="btn btn-dark btn-rounded btn-fw">Download Template</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form class="forms-sample row" method="post" enctype="multipart/form-data" action="/upload_episodes">
                            <input type="hidden" name="movie_code" value="<?= $move_code; ?>">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Upload Movie Content</label>
                                            <input type="file" class="form-control form-control-lg" placeholder="Upload image"
                                                   accept=".xls, .xlsx"
                                                   name="file_upload" id="file_upload"  required>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-rounded btn-fw" name="add_movies">
                                            Upload Episodes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    try{
        let add_trader = document.getElementById("add_traders");
        //open add trader
        function add_trader_open(){
            add_trader.style.display = "block";
        }
        //close add trader
        function add_trader_close(){
            add_trader.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target === add_trader) {
                add_trader.style.display = "none";
            }
        }
    }catch (e) {

    }
</script>