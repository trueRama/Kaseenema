<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                    data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="/">
                <img src="assets/images/logo.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="/">
                <img src="assets/images/favicon.png" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav ms-auto">
            <?php if($account_user_cord != "0000"){ ?>
                <li class="nav-item d-none d-lg-block">
                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                        <span class="input-group-addon input-group-prepend border-right">
                            <span class="icon-calendar input-group-text calendar-icon"></span>
                        </span>
                        <label>
                            <input type="text" class="form-control" />
                        </label>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="search-form" action="<?php echo $pageID; ?>" method="post">
                        <i class="icon-search"></i>
                        <input type="search" name="search" class="form-control" placeholder="Search Here" title="Search here">
                    </form>
                </li>
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="dropdown-item" href="/logout">
                        <i class="dropdown-item-icon me-2">
                            <img src="assets/images/icons/signout_2.gif" class="icons" alt="">
                        </i>
                        Sign Out
                    </a>
                </li>
            <?php }else{ ?>
                <li class="nav-item d-none d-lg-block">
                    <a  href="/login" class="btn btn-outline-primary btn-icon-text">
                        <i class="icon-login login-half-bg btn-icon-prepend"></i> Get Started/ Login
                    </a>
                </li>
            <?php } ?>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>



