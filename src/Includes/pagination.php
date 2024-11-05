<div class="d-block text-center card-footer">
    <h6 style="text-align: left;">Pages <?php echo  $number_of_pages?></h6>
    <nav class="" aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item my-text"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            <?php
            $activeLink = $pageNumber;
            // display the links to the pages
            for ($pageNumber=1;$pageNumber<=$number_of_pages;$pageNumber++) {
                $mystyle = "";
                if($activeLink == $pageNumber){
                    $mystyle = 'style="background-color: #500000; color: white"';
                }
                echo '<li class="page-item"><form action="'.$pageID.'" method="post">
                       <input type="hidden" name="pageNumber" id="pageNumber" value="' . $pageNumber . '"/>'
                    . '<button name="btn-upload" class="page-link" type="submit" id="btn-upload" '.$mystyle.'>' . $pageNumber . '</button></form></li>';
                ?>
                </li>
            <?php } ?>
            <li class="page-item"><a href="javascript:void(0);" class="page-link my-text" aria-label="Next"><span aria-hidden="true">»</span></a></li>
        </ul>
    </nav>
</div>