<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title><?=$page_title?></title>
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url()?>assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->

        

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="<?=base_url()?>assets/css/codebase.min.css">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    </head>
    <body>
        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="<?=base_url()?>admindashboard">
                                    <img src="<?=base_url()?>assets/cargologo.png" style="    width: 170px;">
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->
                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">

                    <ul class="nav-main">
                            <li>
                                <a <?php if($page_id=='admindashboard'){ echo 'class="active"'; }?> href="<?=base_url()?>admindashboard"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                            </li>
                            <li  class="<?php if($page_id=='branches'){ echo 'open'; }elseif($page_id=='branches_create'){ echo 'open'; }?>">
                                <a  class="nav-submenu <?php if($page_id=='branches'){ echo 'active'; }elseif($page_id=='branches_create'){ echo 'active'; }?>" data-toggle="nav-submenu" href="#"><i class="si si-plus"></i><span class="sidebar-mini-hide">Branch</span></a>
                                <ul>
                                    <li>
                                        <a <?php if($page_id=='branches'){ echo 'class="active"'; }?> href="<?=base_url()?>branches">All Branches </a>
                                    </li>
                                    <li>
                                        <a <?php if($page_id=='branches_create'){ echo 'class="active"'; }?> href="<?=base_url()?>branches/create">Add New Branch</a>
                                    </li> 
                                      
                                </ul> 

                            </li>
                             
                            <li  class="<?php if($page_id=='cargo'){ echo 'open'; }elseif($page_id=='cargo_create'){ echo 'open'; }?>">
                                <a  class="nav-submenu <?php if($page_id=='cargo'){ echo 'active'; }elseif($page_id=='cargo_create'){ echo 'active'; }?>" data-toggle="nav-submenu" href="#"><i class="si si-plane"></i><span class="sidebar-mini-hide">Cargo</span></a>
                                <ul>
                                    <li>
                                        <a <?php if($page_id=='cargo'){ echo 'class="active"'; }?> href="<?=base_url()?>cargo">All Cargo</a>
                                    </li>
                                    <li>
                                        <a <?php if($page_id=='cargo_create'){ echo 'class="active"'; }?> href="<?=base_url()?>cargo/create">Add New Cargo</a>
                                    </li>
                                </ul>
                            </li>


                            <li  class="<?php if($page_id=='vendors'){ echo 'open'; }elseif($page_id=='vendors_create'){ echo 'open'; }?>">
                                <a  class="nav-submenu <?php if($page_id=='vendors'){ echo 'active'; }elseif($page_id=='vendors_create'){ echo 'active'; }?>" data-toggle="nav-submenu" href="#"><i class="si si-plus"></i><span class="sidebar-mini-hide">Vendor</span></a>
                                <ul>
                                    
                                    <li>
                                        <a <?php if($page_id=='vendors'){ echo 'class="active"'; }?> href="<?=base_url()?>vendors">All Vendor</a>
                                    </li>
                                    <li>
                                        <a <?php if($page_id=='vendors_create'){ echo 'class="active"'; }?> href="<?=base_url()?>vendors/create">Add New Vendor</a>
                                    </li>  
                                </ul> 

                            </li>

                            <li  class="<?php if($page_id=='vehicles'){ echo 'open'; }elseif($page_id=='vehicles_create'){ echo 'open'; }?>">
                                <a  class="nav-submenu <?php if($page_id=='vehicles'){ echo 'active'; }elseif($page_id=='vehicles_create'){ echo 'active'; }?>" data-toggle="nav-submenu" href="#"><i class="si si-plus"></i><span class="sidebar-mini-hide">Vehicles</span></a>
                                <ul>
                                    <li>
                                        <a <?php if($page_id=='vehicles'){ echo 'class="active"'; }?> href="<?=base_url()?>vehicles_admin">All Vehicles</a>
                                    </li>
                                    <li>
                                        <a <?php if($page_id=='vehicles_create'){ echo 'class="active"'; }?> href="<?=base_url()?>vehicles_admin/create">Add New Vehicle</a>
                                    </li>
                                </ul>
                            </li>
                           

                            <li  class="<?php if($page_id=='goods_details'){ echo 'open'; } ?>">
                                <a  class="nav-submenu <?php if($page_id=='goods_details'){ echo 'active'; }?>" data-toggle="nav-submenu" href="#"><i class="si si-plus"></i><span class="sidebar-mini-hide">Goods details</span></a>
                                <ul>
                                    
                                    <li>
                                        <a <?php if($page_id=='goods_details'){ echo 'class="active"'; }?> href="<?=base_url()?>goods_details_admin">All Goods details</a>
                                    </li> 

                                    <li>
                                        <a <?php if($page_id=='goods_details_import'){ echo 'class="active"'; }?> href="<?=base_url()?>goods_details_admin/import">Import</a>
                                    </li>

                                </ul> 

                            </li>

                            <li  class="<?php if($page_id=='goods_details'){ echo 'open'; } ?>">
                                <a  class="nav-submenu <?php if($page_id=='goods_details'){ echo 'active'; }?>" data-toggle="nav-submenu" href="#"><i class="si si-plus"></i><span class="sidebar-mini-hide">Trip Sheet</span></a>
                                <ul>
                                    
                                    <li>
                                        <a <?php if($page_id=='goods_details'){ echo 'class="active"'; }?> href="<?=base_url()?>trip_sheet_admin">All Trip Sheet</a>
                                    </li> 
                                </ul> 

                            </li>

                            <li>
                                <a <?php if($page_id=='misreport'){ echo 'class="active"'; }?> href="<?=base_url()?>mis_report_admin"><i class="si si-docs"></i><span class="sidebar-mini-hide">Mis Reports</span></a>
                            </li>

                            <li>
                                <a <?php if($page_id=='reports'){ echo 'class="active"'; }?> href="<?=base_url()?>trip_sheet_admin/reports"><i class="si si-docs"></i><span class="sidebar-mini-hide">Reports</span></a>
                            </li>


                    </ul>
                         
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header" style="margin-top: 0px;
    padding: 0px 2px;">
                <!-- Header Content -->
                <div class="content-header" style="padding: 34px 6px 5px 3px;">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span style="font-size=25px;"><?=$this->session->userdata['adminloginel']['username']?></span><i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                                <?php /*
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="si si-user mr-5"></i> Profile
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                                    <span class="badge badge-primary">3</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="si si-note mr-5"></i> Invoices
                                </a>
                                <div class="dropdown-divider"></div>

                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                    <i class="si si-wrench mr-5"></i> Settings
                                </a>
                                <!-- END Side Overlay -->
                                */ ?>
                                <div class="dropdown"></div>
                                <a class="dropdown-item" href="<?=base_url()?>logout">
                                    <i class="si si-logout mr-5"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <!-- <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>

                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary px-15">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div> -->
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->
