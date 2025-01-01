<?php
if ($account_user_cord != "0000") {
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?php echo $home_in; ?>">
            <a class="nav-link" href="/">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/home.gif" class="icons" alt="">
                </i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <?php if($account_user_type == "admin"){ ?>
        <li class="nav-item <?php echo $manage_in; ?>">
            <a class="nav-link" href="/app_users">
                <i class="menu-icon fa fa-group"></i>
                <span class="menu-title">Manage Users</span>
            </a>
        </li>
        <li class="nav-item <?php echo $studio_in; ?>">
            <a class="nav-link" href="/studio">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/studio.gif" class="icons" alt="">
                </i>
                <span class="menu-title">Manage Studio</span>
            </a>
        </li>
        <li class="nav-item <?php echo $vpy_in; ?>">
            <a class="nav-link" href="/payments_records?type=approved">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/approved.png" class="icons" alt="">
                </i>
                <span class="menu-title">Verified Payments</span>
            </a>
        </li>
<!--        <li class="nav-item --><?php //echo $ppy_in; ?><!--">-->
<!--            <a class="nav-link" href="/pending">-->
<!--                <i class="dropdown-item-icon me-2">-->
<!--                    <img src="assets/images/Icons/pending.jpg" class="icons" alt="">-->
<!--                </i>-->
<!--                <span class="menu-title">Pending Payments</span>-->
<!--            </a>-->
<!--        </li>-->
        <li class="nav-item <?php echo $fpy_in; ?>">
            <a class="nav-link" href="/payments_records?type=failed">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/rejected.jpg" class="icons" alt="">
                </i>
                <span class="menu-title">Failed Payments</span>
            </a>
        </li>
        <?php }
        if($account_user_type == "ordinary"){ ?>
        <li class="nav-item <?php echo $wallet_in; ?>">
            <a class="nav-link" href="/wallet">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/wallet.png" class="icons" alt="">
                </i>
                <span class="menu-title">My Wallet</span>
            </a>
        </li>
        <li class="nav-item <?php echo $movie_in; ?>">
            <a class="nav-link" href="/movies?type=movies">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/wallet_2.png" class="icons" alt="">
                </i>
                <span class="menu-title">Movies</span>
            </a>
        </li>
        <li class="nav-item <?php echo $series_in; ?>">
            <a class="nav-link" href="/series?type=series">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/series.gif" class="icons" alt="">
                </i>
                <span class="menu-title">Series</span>
            </a>
        </li>
        <li class="nav-item <?php echo $animation_in; ?>">
            <a class="nav-link" href="/animations?type=animation">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/anime.gif" class="icons" alt="">
                </i>
                <span class="menu-title">Animations</span>
            </a>
        </li>
        <?php } ?>
        <li class="nav-item <?php echo $help_in; ?>">
            <a class="nav-link" href="/help">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/help.gif" class="icons" alt="">
                </i>
                <span class="menu-title">Help Centre</span>
            </a>
        </li>
        <li class="nav-item <?php echo $terms_in; ?>">
            <a class="nav-link" href="https://kaseenema.com/terms-conditions/">
                <i class="menu-icon fa fa-info"></i>
                <span class="menu-title">Terms & Conditions</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout">
                <i class="dropdown-item-icon me-2">
                    <img src="assets/images/Icons/signout_2.gif" class="icons" alt="">
                </i>
                <span class="menu-title">Sign Out</span>
            </a>
        </li>
    </ul>
</nav>
<?php }