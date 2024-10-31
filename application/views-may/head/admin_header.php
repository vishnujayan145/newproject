<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from skote-v-light.codeigniter.themesbrand.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Mar 2024 08:56:15 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        
<meta charset="utf-8" />
<title>Dashboard | IndianLiveCargo </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

<link rel="shortcut icon" href="<?=base_url()?>assets/media/favicons/favicon.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?=base_url()?>assets/media/favicons/favicon-192x192.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>assets/media/favicons/apple-touch-icon-180x180.png">


        <!-- Bootstrap Css -->
<link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- App js -->
<script src="<?=base_url()?>assets/js/plugin.js"></script>
 
<style>
.select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
    display:none !important;
}
</style>
    </head>

    <body data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <!-- <img src="<?=base_url()?>assets/images/logo.svg" alt="" height="22"> -->
                        <!-- <img src="<?=base_url()?>assets/cargologo.png" height="22"> -->
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="<?=base_url()?>assets/images/logo-dark.png" alt="" height="17"> -->
                        <!-- <img src="<?=base_url()?>assets/cargologo.png" height="17"> -->
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <!-- <img src="<?=base_url()?>assets/images/logo-light.svg" alt="" height="22"> -->
                        <!-- <img src="<?=base_url()?>assets/cargologo.png" height="22"> -->
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="<?=base_url()?>assets/images/logo-light.png" alt="" height="19"> -->
                        <!-- <img src="<?=base_url()?>assets/cargologo.png" height="19"> -->
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <!-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> -->

            <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
               
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?=base_url()?>assets/images/flags/us.jpg" alt="Header Language" height="16">                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->

                    <a href="<?=base_url()?>lang/en" class="dropdown-item notify-item language" data-lang="en">
                        <img src="<?=base_url()?>assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>

                    <a href="<?=base_url()?>lang/es" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="<?=base_url()?>assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <a href="<?=base_url()?>lang/de" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="<?=base_url()?>assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>

                    <a href="<?=base_url()?>lang/it" class="dropdown-item notify-item language" data-lang="it">
                        <img src="<?=base_url()?>assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <a href="<?=base_url()?>lang/ru" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="<?=base_url()?>assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>

                </div>
            </div>
 

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?=base_url()?>assets/images/users/avatar-1.jpg" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"> <?=$this->session->userdata['adminloginel']['username']?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?=base_url()?>profile/index"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                    <!-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                    <a class="dropdown-item" href="auth-lock-screen.html"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?=base_url()?>logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div> -->

        </div>
    </div>
</header>
<!-- ========== Left Sidebar Start ========== -->


<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li <?php if($page_id=='admindashboard'){ echo 'class="mm-active"'; }?> >
                <a href="<?=base_url()?>admindashboard" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a> 
                </li>

               
 
                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="bx bx-detail"></i>
                        <span key="t-vehicle">Branch</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li <?php if($page_id=='branches'){ echo 'class="mm-active"'; }?>>
                            <a  href="<?=base_url()?>branches">All Branches </a>
                        </li>
                        <li <?php if($page_id=='branches_create'){ echo 'class="mm-active"'; }?>>
                            <a href="<?=base_url()?>branches/create">Add New Branch</a>
                        </li>                         
                    </ul>
                </li>


                
                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="bx bx-detail"></i>
                        <span key="t-vehicle">Agency</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li <?php if($page_id=='cargo'){ echo 'class="mm-active"'; }?>>
                            <a  href="<?=base_url()?>cargo">All Agency</a>
                        </li>
                        <li <?php if($page_id=='cargo_create'){ echo 'class="mm-active"'; }?>>
                            <a  href="<?=base_url()?>cargo/create">Add New Agency</a>
                        </li>                                               
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="bx bx-detail"></i>
                        <span key="t-vehicle">Vendor</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li <?php if($page_id=='vendors'){ echo 'class="mm-active"'; }?>>
                            <a href="<?=base_url()?>vendors">All Vendor</a>
                        </li>
                        <li  <?php if($page_id=='vendors_create'){ echo 'class="mm-active"'; }?>>
                            <a href="<?=base_url()?>vendors/create">Add New Vendor</a>
                        </li>                                                
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="bx bx-detail"></i>
                        <span key="t-vehicle">Vehicles</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li  <?php if($page_id=='vehicles'){ echo 'class="mm-active"'; }?>>
                        <a href="<?=base_url()?>vehicles_admin">All Vehicles</a>
                    </li>
                    <li  <?php if($page_id=='vehicles_create'){ echo 'class="mm-active"'; }?> >
                        <a href="<?=base_url()?>vehicles_admin/create">Add New Vehicle</a>
                    </li>                                              
                    </ul>
                </li>


                




                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="bx bx-detail"></i>
                        <span key="t-vehicle">Goods details</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li  <?php if($page_id=='goods_details'){ echo 'class="mm-active"'; }?>>
                            <a href="<?=base_url()?>goods_details_admin">All Goods details</a>
                        </li> 

                        <li  <?php if($page_id=='goods_details_import'){ echo 'class="mm-active"'; }?>>
                            <a href="<?=base_url()?>goods_details_admin/import">Import</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect has-arrow">
                        <i class="bx bx-detail"></i>
                        <span key="t-vehicle">Trip Sheet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li  <?php if($page_id=='goods_details'){ echo 'class="mm-active"'; }?>>
                            <a href="<?=base_url()?>trip_sheet_admin">All Trip Sheet</a>
                        </li> 
                    </ul>
                </li>


                <li>
                    <a href="<?=base_url()?>mis_report_admin" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Mis Reports</span>
                    </a> 
                </li>

               

                <li>
                <a href="<?=base_url()?>trip_sheet_admin/reports" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Reports</span>
                    </a>                    
                </li>
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->