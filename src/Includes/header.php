<!--
=========================================================
* Kaseenema UI Dashboard - v2.0.0
=========================================================
* Coded by Nkuutu Ramadhan
=========================================================
* The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kaseenema</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script type="text/javascript" src="assets/js/instascan.min.js"></script>
    <style>
        .sidebar{
            background-color: black;
        }
        .navbar .navbar-menu-wrapper {
            /*background: black;*/
            background:linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9), rgb(80, 73, 63));
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            color: white;
        }
        .navbar {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9), rgb(80, 73, 63));
        }
        .account{
            background:linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9), rgb(80, 73, 63));
        }
        .navbar.headerLight {
            background: black;
            box-shadow: 0px 0px 3px 0px rgba(173, 163, 163, 0.75);
        }
        .navbar .navbar-brand-wrapper .navbar-toggler {
            color: white;
            font-size: 1.5rem;
        }
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item .search-form i {
            font-size: 1.25rem;
            color: white;
        }
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item .search-form input:focus {
            width: 200px;
            color: white;
        }
        .navbar .navbar-brand-wrapper {
            background: black;
        }
        .sidebar .nav .nav-item .nav-link {
            color: white;
        }
        .sidebar .nav .nav-item .nav-link i.menu-icon {
            color: white;
        }
        .sidebar .nav .nav-item:hover > .nav-link i, .sidebar .nav .nav-item:hover > .nav-link .menu-title, .sidebar .nav .nav-item:hover > .nav-link .menu-arrow {
            color: black;
        }
        .sidebar .nav:not(.sub-menu) > .nav-item:hover > .nav-link, .sidebar .nav:not(.sub-menu) > .nav-item:hover[aria-expanded="true"] {
            color: black;
        }
        .footer {
            background:linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9), rgb(80, 73, 63));
            /*background-color: #50493f;*/
            padding: 0.5rem 1rem 0.5rem 1rem;
            border-top: red solid 2px;
        }
        .navbar .navbar-brand-wrapper .navbar-brand img {
            max-width: 100%;
            height: 45px;
            margin: auto;
            vertical-align: middle;
            border-radius: 10px;
        }
        .icons{
            width: 35px;
            height: 35px;
            border-radius: 10px;
        }
        .navbar .navbar-brand-wrapper .navbar-toggler {
            color: white;
            font-size: 1.5rem;
        }
        .btn-outline-primary {
            border: 1px solid white;
            color: white;
        }
        @media (min-width: 992px) {
            .sidebar-icon-only .navbar .navbar-brand-wrapper {
                background:linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(255, 165, 0, 0.9), rgba(0, 0, 0, 0.6));
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            .sidebar-icon-only .sidebar {
                background:linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(255, 165, 0, 0.9), rgba(0, 0, 0, 0.6));
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
        }
        .auth .auth-form-light {
            /*background: #ffffff;*/
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 10px;
        }
        .card.card-rounded {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .auth form .form-group .form-control, .auth form .form-group .select2-container--default .select2-selection--single, .select2-container--default .auth form .form-group .select2-selection--single, .auth form .form-group .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single .auth form .form-group .select2-search__field, .auth form .form-group .typeahead, .auth form .form-group .tt-query, .auth form .form-group .tt-hint {
            border-radius: 10px;
        }
        .auth form .auth-form-btn {
            border-radius: 10px;
        }
        .theme-footer-bottom {
            padding-bottom: 4rem;
            padding-top: 4rem;
        }
        .sidebar .nav .nav-item.active > .nav-link i, .sidebar .nav .nav-item.active > .nav-link .menu-title, .sidebar .nav .nav-item.active > .nav-link .menu-arrow {
            color: black;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .stoggle-password {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .password-container {
            position: relative;
        }
        .sidebar .nav:not(.sub-menu) > .nav-item.active .nav-link {
            border: 1px red solid;
        }
        @media only screen and (max-width: 991px) {
            .navbar .navbar-brand-wrapper {
                width: 55px;
                height: 55px;
            }
            .sidebar-offcanvas {
                top: 55px;
            }
            .page-body-wrapper {
                padding-top: 55px;
            }
        }
        @media only screen and (max-width: 480px) {
            .off {
               display: none;
            }
            .navbar .navbar-brand-wrapper {
                width: 55px;
                height: 55px;
            }
            .sidebar-offcanvas {
                top: 55px;
            }
            .page-body-wrapper {
                padding-top: 55px;
            }
        }
    </style>
</head>
<body class="with-welcome-text">
<div class="container-scroller">
