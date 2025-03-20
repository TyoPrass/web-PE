<?php
include('../../Database/koneksi.php');
include('action.php');


?>

<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/hyper/saas/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:55 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Datatables | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- third party css -->
        <link href="../../assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/vendor/fixedHeader.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/vendor/fixedColumns.bootstrap5.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="../../assets/images/logo.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="../../assets/images/logo_sm.png" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="index.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="../../assets/images/logo-dark.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="../../assets/images/logo_sm_dark.png" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>

                        <li class="side-nav-title side-nav-item">Apps</li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
                                <i class="uil-briefcase"></i>
                                <span> Projects </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarProjects">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="../Customer/view.php">Customer</a>
                                    </li>
                                    <li>
                                        <a href="../Project/view.php">Part</a>
                                    </li>
                                    <li>
                                        <a href="../Proses/view.php">Proses</a>
                                    </li>
                                    <li>
                                        <a href="#">Trial & Report</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a href="apps-social-feed.html" class="side-nav-link">
                                <i class="uil-rss"></i>
                                <span> Social Feed </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks" class="side-nav-link">
                                <i class="uil-clipboard-alt"></i>
                                <span> Tasks </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTasks">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="apps-tasks.html">List</a>
                                    </li>
                                    <li>
                                        <a href="apps-tasks-details.html">Details</a>
                                    </li>
                                    <li>
                                        <a href="apps-kanban.html">Kanban Board</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- end of list -->
                    </ul>

                    <!-- Help Box -->
                    <div class="help-box text-white text-center">
                        <a href="javascript: void(0);" class="float-end close-btn text-white">
                            <i class="mdi mdi-close"></i>
                        </a>
                        <img src="../../assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
                        <h5 class="mt-3">PE-STAMPING</h5>
                        <p class="mb-3">TES JERAPAHNAIKKUDA</p>
                    </div>
                    <!-- end Help Box -->
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>
                            <li class="dropdown notification-list topbar-dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="../../assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="12"> 
                                    <span class="align-middle d-none d-sm-inline-block">English</span> <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <img src="../../assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <img src="../../assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                    </a>
                
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <img src="../../assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <img src="../../assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                    </a>

                                </div>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                    <!-- item-->
                                    <div class="dropdown-item noti-title px-3">
                                        <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification
                                        </h5>
                                    </div>

                                    <div class="px-3" style="max-height: 300px;" data-simplebar>

                                        <h5 class="text-muted font-13 fw-normal mt-0">Today</h5>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">New user registered</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <h5 class="text-muted font-13 fw-normal mt-0">Yesterday</h5>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon">
                                                            <img src="../../assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <h5 class="text-muted font-13 fw-normal mt-0">30 Dec 2021</h5>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp</h5>
                                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                         <!-- item-->
                                         <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon">
                                                            <img src="../../assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Karen Robinson</h5>
                                                        <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                                    </div>
                                                  </div>
                                            </div>
                                        </a>

                                        <div class="text-center">
                                            <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                        </div>
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                        View All
                                    </a>

                                </div>
                            </li>

                            <li class="dropdown notification-list d-none d-sm-inline-block">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-view-apps noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                                    <div class="p-2">
                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="../../assets/images/brands/slack.png" alt="slack">
                                                    <span>Slack</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="../../assets/images/brands/github.png" alt="Github">
                                                    <span>GitHub</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="../../assets/images/brands/dribbble.png" alt="dribbble">
                                                    <span>Dribbble</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="../../assets/images/brands/bitbucket.png" alt="bitbucket">
                                                    <span>Bitbucket</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="../../assets/images/brands/dropbox.png" alt="dropbox">
                                                    <span>Dropbox</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="../../assets/images/brands/g-suite.png" alt="G Suite">
                                                    <span>G Suite</span>
                                                </a>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>

                                </div>
                            </li>

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        <img src="../../assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">Dominic Keller</span>
                                        <span class="account-position">Founder</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Settings</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lifebuoy me-1"></i>
                                        <span>Support</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lock-outline me-1"></i>
                                        <span>Lock Screen</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control dropdown-toggle"  placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn-primary" type="submit">Search</button>
                                </div>
                            </form>

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-notes font-16 me-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-life-ring font-16 me-1"></i>
                                    <span>How can I help you?</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-cog font-16 me-1"></i>
                                    <span>User profile settings</span>
                                </a>

                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                </div>

                                <div class="notification-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="../../assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Erwin Brown</h5>
                                                <span class="font-12 mb-0">UI Designer</span>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="../../assets/images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Jacob Deo</h5>
                                                <span class="font-12 mb-0">Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Data Tables</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Data Tables</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-12">
                                    <div class="card-body">
                                        <?php if (isset($_SESSION['message'])): ?>
                                        <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                                            <?php echo $_SESSION['message']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
                                    <?php endif; ?>

                                        <?php if (isset($_GET['detail'])): ?>
                                        <!-- Detail View -->
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <button class="btn btn-primary" onclick="printReport()">
                                                    <i class="mdi mdi-printer"></i> Print Report
                                                </button>
                                                <button class="btn btn-success" onclick="exportPDF()">
                                                    <i class="mdi mdi-file-pdf"></i> Save as PDF
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body" id="printable-content">
                                                        <h4 class="card-title">Trial Details</h4>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Basic Information</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Customer</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['nama_customer']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Part Name</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['nama_part']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Process</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['Proses']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Part No</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['part_no']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Project</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['project']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Material Specification</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['mat_spec']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Material Size</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['mat_size']); ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Trial Information</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Trial</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['trial']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Date</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['tanggal']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Start Time</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jam_start']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Finish Time</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jam_finish']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Machine Name</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['mc_name']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Capacity</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['kapasitas']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Cush Prec</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['cush_prec']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Pin Cus Qtt</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['pin_cus_qtt']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Die Height</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['die_height']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Die Dimension</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['die_dim']); ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Production Results</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Qty Trial</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['qty_trial']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>OK Parts</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jumlah_ok']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>NG Parts</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jumlah_ng']); ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Final Assessment</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Visual</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['visual'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['visual']; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Dimension</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['dimensi'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['dimensi']; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Function</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['fungsi'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['fungsi']; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Final Judgement</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['judgement'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['judgement']; ?></span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                   <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Approvals</h5>
                                                                        <div class="timeline">
                                                                            <div class="timeline-item">
                                                                                <i class="mdi mdi-account-check text-primary"></i>
                                                                                <span class="time">Created by</span>
                                                                                <p><?php echo htmlspecialchars($detail_data['dibuat']); ?></p>
                                                                            </div>
                                                                            <div class="timeline-item">
                                                                                <i class="mdi mdi-clipboard-check text-info"></i>
                                                                                <span class="time">Checked by</span>
                                                                                <p><?php echo htmlspecialchars($detail_data['diperiksa']); ?></p>
                                                                            </div>
                                                                            <div class="timeline-item">
                                                                                <i class="mdi mdi-shield-check text-success"></i>
                                                                                <span class="time">Approved by</span>
                                                                                <p><?php echo htmlspecialchars($detail_data['diketahui']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <h6 class="mt-3">Peserta:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['peserta']); ?>
                                                                            </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Tool Problems</h5>
                                                                        <div class="mb-3">
                                                                            <h6 class="mt-3">Problem Description:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['problem_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Root Cause Analysis:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['analisa_sebab_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Countermeasures:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['counter_measure_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">PIC:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['pic_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Target:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['target_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Remarks:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['keterangan_tool']); ?>
                                                                            </div>

                                                                            <h6 class="mt-3">Kelengkapan Dies:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['kelengkapan_dies']); ?>
                                                                            </div>
                                                                            
                                                                      
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                
                                                                                <div class="card mb-3">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">Part Problems</h5>
                                                                                        <div class="mb-3">
                                                                                            <h6 class="mt-3">Problem Description:</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['problem_part']); ?>
                                                                                            </div>
                                                                                            
                                                                                            <h6 class="mt-3">Root Cause Analysis:</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['analisa_sebab_part']); ?>
                                                                                            </div>
                                                                                            
                                                                                            <h6 class="mt-3">Countermeasures:</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['counter_measure_part']); ?>
                                                                                            </div>
                                                                                            
                                                                                            <h6 class="mt-3">PIC:</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['PIC']); ?>
                                                                                            </div>
                                                                                            
                                                                                            <h6 class="mt-3">Target:</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['target']); ?>
                                                                                            </div>
                                                                                            
                                                                                            <h6 class="mt-3">Remarks:</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['keterangan']); ?>
                                                                                            </div>
                                                                                            
                                                                                            <h6 class="mt-3">Accuracy Part :</h6>
                                                                                            <div class="border rounded p-3 bg-light">
                                                                                                <?php echo htmlspecialchars_decode($detail_data['accuracy_part']); ?>
                                                                                            </div>
                                                                                            
                                                                                
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="mt-4">
                                                            <a href="view.php" class="btn btn-secondary">
                                                                <i class="mdi mdi-arrow-left"></i> Back
                                                            </a>
                                                            <a href="view.php?edit=<?php echo $detail_data['id_trial']; ?>" class="btn btn-info">
                                                                <i class="mdi mdi-pencil"></i> Edit
                                                            </a>
                                                        </div>
                                                        </div>



                                <!-- Script for printing and PDF export -->
                                <script>
                                function printReport() {
                                    // Prepare for printing
                                    window.onbeforeprint = function() {
                                        // Add any preparation you need before printing
                                        document.body.classList.add('printing');
                                    };
                                    
                                    window.onafterprint = function() {
                                        // Cleanup after printing
                                        document.body.classList.remove('printing');
                                    };
                                    
                                    // Trigger print dialog
                                    window.print();
                                }

                                function exportPDF() {
                                    // Show loading message
                                    alert("Preparing PDF for download...");
                                    
                                    // In a real implementation, you would use a library like html2pdf.js or jsPDF
                                    // For now, we'll just use the browser's print to PDF functionality
                                    printReport();
                                    
                                    /* 
                                    // If you want to implement a proper PDF export, you would do something like:
                                    
                                    // Using html2pdf.js
                                    html2pdf()
                                        .set({
                                            margin: 10,
                                            filename: 'trial_report_<?php echo $detail_data['id_trial']; ?>.pdf',
                                            image: { type: 'jpeg', quality: 0.98 },
                                            html2canvas: { scale: 2, letterRendering: true },
                                            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
                                        })
                                        .from(document.getElementById('printable-content'))
                                        .save();
                                    */
                                }
                                </script>
                                                    

                                                    <?php elseif (isset($_GET['edit'])): ?>
                                                        <!-- Edit Form -->
                                                    <!-- Edit Form -->
                                                    <form action="action.php" method="post" id="edit-form">
                                                        <input type="hidden" name="id_trial" value="<?php echo htmlspecialchars($edit_data['id_trial']); ?>">
                                                        <input type="hidden" name="update" value="true">

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <div class="mb-3">
                                                                    <label for="id_customer" class="form-label">Nama Customer</label>
                                                                    <select class="form-select" id="id_customer" name="id_customer" required>
                                                                        <option value="">Nama Customer</option>
                                                                        <?php
                                                                        $sql = "SELECT id_customer, nama_customer FROM customer";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $selected = ($edit_data['id_customer'] == $row['id_customer']) ? 'selected' : '';
                                                                            echo '<option value="' . $row['id_customer'] . '" ' . $selected . '>' . $row['nama_customer'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="id_part" class="form-label">Nama Part</label>
                                                                    <select class="form-select" id="id_part" name="id_part" required>
                                                                        <option value="">Nama Part</option>
                                                                        <?php
                                                                        $sql = "SELECT id_part, nama_part FROM data_part";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $selected = ($edit_data['id_part'] == $row['id_part']) ? 'selected' : '';
                                                                            echo '<option value="' . $row['id_part'] . '" ' . $selected . '>' . $row['nama_part'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="id_proses" class="form-label">Proses</label>
                                                                    <select class="form-select" id="id_proses" name="id_proses" required>
                                                                        <option value="">Select Proses</option>
                                                                        <?php
                                                                        $sql = "SELECT id_proses, Proses FROM proses";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $selected = ($edit_data['id_proses'] == $row['id_proses']) ? 'selected' : '';
                                                                            echo '<option value="' . $row['id_proses'] . '" ' . $selected . '>' . $row['Proses'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                
                                                                <!-- Part No -->
                                                                <div class="mb-3">
                                                                    <label for="part_no" class="form-label">Part No</label>
                                                                    <select class="form-select" id="part_no" name="part_no" required>
                                                                        <option value="">Select Part No</option>
                                                                        <?php
                                                                        $sql_part_no = "SELECT DISTINCT part_no FROM proses";
                                                                        if (!empty($edit_data['id_part'])) {
                                                                            $sql_part_no .= " WHERE id_part = " . $edit_data['id_part'];
                                                                        }
                                                                        $result_part_no = $conn->query($sql_part_no);
                                                                        while ($row = $result_part_no->fetch_assoc()) {
                                                                            $selected = ($edit_data['part_no'] == $row['part_no']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['part_no']) . '" ' . $selected . '>' . htmlspecialchars($row['part_no']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <!-- Nama Project -->
                                                                <div class="mb-3">
                                                                    <label for="project" class="form-label">Project No</label>
                                                                    <select class="form-select" id="project" name="project" required>
                                                                        <option value="">Nama Project</option>
                                                                        <?php
                                                                        $sql_project = "SELECT DISTINCT project FROM customer";
                                                                        if (!empty($edit_data['id_customer'])) {
                                                                            $sql_project .= " WHERE id_customer = " . $edit_data['id_customer'];
                                                                        }
                                                                        $result_project = $conn->query($sql_project);
                                                                        while ($row = $result_project->fetch_assoc()) {
                                                                            $selected = ($edit_data['project'] == $row['project']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['project']) . '" ' . $selected . '>' . htmlspecialchars($row['project']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <!-- Mat Spec -->
                                                                <div class="mb-3">
                                                                    <label for="mat_spec" class="form-label">Mat Spec</label>
                                                                    <select class="form-select" id="mat_spec" name="mat_spec" required>
                                                                        <option value="">Mat Spec</option>
                                                                        <?php
                                                                        $sql_mat_spec = "SELECT DISTINCT mat_spec FROM proses";
                                                                        if (!empty($edit_data['id_part'])) {
                                                                            $sql_mat_spec .= " WHERE id_part = " . $edit_data['id_part'];
                                                                        }
                                                                        $result_mat_spec = $conn->query($sql_mat_spec);
                                                                        while ($row = $result_mat_spec->fetch_assoc()) {
                                                                            $selected = ($edit_data['mat_spec'] == $row['mat_spec']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['mat_spec']) . '" ' . $selected . '>' . htmlspecialchars($row['mat_spec']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <!-- Mat Size -->
                                                                <div class="mb-3">
                                                                    <label for="mat_size" class="form-label">Mat Size</label>
                                                                    <select class="form-select" id="mat_size" name="mat_size" required>
                                                                        <option value="">Mat Size</option>
                                                                        <?php
                                                                        $sql_mat_size = "SELECT DISTINCT mat_size FROM proses";
                                                                        if (!empty($edit_data['id_part'])) {
                                                                            $sql_mat_size .= " WHERE id_part = " . $edit_data['id_part'];
                                                                        }
                                                                        $result_mat_size = $conn->query($sql_mat_size);
                                                                        while ($row = $result_mat_size->fetch_assoc()) {
                                                                            $selected = ($edit_data['mat_size'] == $row['mat_size']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['mat_size']) . '" ' . $selected . '>' . htmlspecialchars($row['mat_size']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <!-- Nama Project -->
                                                                <div class="mb-3">
                                                                    <label for="project" class="form-label">Nama Project</label>
                                                                    <select class="form-select" id="project" name="project" required>
                                                                        <option value="">Nama Project</option>
                                                                        <?php
                                                                        // Get project from customer table based on selected id_customer
                                                                        $sql_project = "SELECT DISTINCT c.project 
                                                                                       FROM customer c 
                                                                                       INNER JOIN data_part dp ON c.id_customer = dp.id_customer";
                                                                        if (!empty($edit_data['id_customer'])) {
                                                                            $sql_project .= " WHERE c.id_customer = " . $edit_data['id_customer'];
                                                                        }
                                                                        $result_project = $conn->query($sql_project);
                                                                        while ($row = $result_project->fetch_assoc()) {
                                                                            $selected = ($edit_data['project'] == $row['project']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['project']) . '" ' . $selected . '>' . htmlspecialchars($row['project']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <!-- Mat Spec -->
                                                                <div class="mb-3">
                                                                    <label for="mat_spec" class="form-label">Mat Spec</label>
                                                                    <select class="form-select" id="mat_spec" name="mat_spec" required>
                                                                        <option value="">Mat Spec</option>
                                                                        <?php
                                                                        // Get mat_spec from proses table based on selected id_part
                                                                        $sql_mat_spec = "SELECT DISTINCT p.mat_spec 
                                                                                        FROM proses p 
                                                                                        INNER JOIN data_part dp ON p.id_part = dp.id_part";
                                                                        if (!empty($edit_data['id_part'])) {
                                                                            $sql_mat_spec .= " WHERE p.id_part = " . $edit_data['id_part'];
                                                                        }
                                                                        $result_mat_spec = $conn->query($sql_mat_spec);
                                                                        while ($row = $result_mat_spec->fetch_assoc()) {
                                                                            $selected = ($edit_data['mat_spec'] == $row['mat_spec']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['mat_spec']) . '" ' . $selected . '>' . htmlspecialchars($row['mat_spec']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <!-- Mat Size -->
                                                                <div class="mb-3">
                                                                    <label for="mat_size" class="form-label">Mat Size</label>
                                                                    <select class="form-select" id="mat_size" name="mat_size" required>
                                                                        <option value="">Mat Size</option>
                                                                        <?php
                                                                        // Get mat_size from proses table based on selected id_part
                                                                        $sql_mat_size = "SELECT DISTINCT p.mat_size 
                                                                                        FROM proses p 
                                                                                        INNER JOIN data_part dp ON p.id_part = dp.id_part";
                                                                        if (!empty($edit_data['id_part'])) {
                                                                            $sql_mat_size .= " WHERE p.id_part = " . $edit_data['id_part'];
                                                                        }
                                                                        $result_mat_size = $conn->query($sql_mat_size);
                                                                        while ($row = $result_mat_size->fetch_assoc()) {
                                                                            $selected = ($edit_data['mat_size'] == $row['mat_size']) ? 'selected' : '';
                                                                            echo '<option value="' . htmlspecialchars($row['mat_size']) . '" ' . $selected . '>' . htmlspecialchars($row['mat_size']) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <script>
                                                                // Add event listener for id_part change to update related fields
                                                                document.getElementById('id_part').addEventListener('change', function() {
                                                                    const id_part = this.value;
                                                                    if (id_part) {
                                                                        // Update Part No dropdown
                                                                        fetch(`get_part_data.php?type=part_no&id_part=${id_part}`)
                                                                            .then(response => response.json())
                                                                            .then(data => {
                                                                                updateDropdown('part_no', data);
                                                                            });
                                                                        
                                                                        // Update Mat Spec dropdown
                                                                        fetch(`get_part_data.php?type=mat_spec&id_part=${id_part}`)
                                                                            .then(response => response.json())
                                                                            .then(data => {
                                                                                updateDropdown('mat_spec', data);
                                                                            });
                                                                        
                                                                        // Update Mat Size dropdown
                                                                        fetch(`get_part_data.php?type=mat_size&id_part=${id_part}`)
                                                                            .then(response => response.json())
                                                                            .then(data => {
                                                                                updateDropdown('mat_size', data);
                                                                            });
                                                                    }
                                                                });

                                                                // Add event listener for id_customer change to update project field
                                                                document.getElementById('id_customer').addEventListener('change', function() {
                                                                    const id_customer = this.value;
                                                                    if (id_customer) {
                                                                        fetch(`get_part_data.php?type=project&id_customer=${id_customer}`)
                                                                            .then(response => response.json())
                                                                            .then(data => {
                                                                                updateDropdown('project', data);
                                                                            });
                                                                    }
                                                                });

                                                                // Helper function to update dropdowns
                                                                function updateDropdown(dropdownId, data) {
                                                                    const dropdown = document.getElementById(dropdownId);
                                                                    dropdown.innerHTML = '<option value="">Select ' + dropdownId.replace('_', ' ') + '</option>';
                                                                    data.forEach(item => {
                                                                        const option = document.createElement('option');
                                                                        option.value = item;
                                                                        option.textContent = item;
                                                                        dropdown.appendChild(option);
                                                                    });
                                                                }
                                                                </script>

                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Trial</h5>
                                                                <div class="mb-3">
                                                                    <label for="trial" class="form-label">Trial</label>
                                                                    <input type="text" class="form-control" id="trial" name="trial" required
                                                                           value="<?php echo htmlspecialchars($edit_data['trial']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                                                           value="<?php echo htmlspecialchars($edit_data['tanggal']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="jam_start" class="form-label">Jam Start</label>
                                                                    <input type="time" class="form-control" id="jam_start" name="jam_start" required
                                                                           value="<?php echo htmlspecialchars($edit_data['jam_start']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="jam_finish" class="form-label">Jam Finish</label>
                                                                    <input type="time" class="form-control" id="jam_finish" name="jam_finish" required
                                                                           value="<?php echo htmlspecialchars($edit_data['jam_finish']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="mc_name" class="form-label">M/C Name</label>
                                                                    <input type="text" class="form-control" id="mc_name" name="mc_name" required
                                                                           value="<?php echo htmlspecialchars($edit_data['mc_name']); ?>">
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="kapasitas" class="form-label">Kapasitas</label>
                                                                        <input type="text" class="form-control" id="kapasitas" name="kapasitas" required
                                                                               value="<?php echo htmlspecialchars($edit_data['kapasitas']); ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="cush_prec" class="form-label">Cush Prec</label>
                                                                        <input type="text" class="form-control" id="cush_prec" name="cush_prec" required
                                                                               value="<?php echo htmlspecialchars($edit_data['cush_prec']); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-6">
                                                                        <label for="die_dim" class="form-label">Die Dim</label>
                                                                        <input type="text" class="form-control" id="die_dim" name="die_dim" required
                                                                               value="<?php echo htmlspecialchars($edit_data['die_dim']); ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="die_height" class="form-label">Die Height</label>
                                                                        <input type="text" class="form-control" id="die_height" name="die_height" required
                                                                               value="<?php echo htmlspecialchars($edit_data['die_height']); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-4">
                                                                        <label for="pin_cus_qtt" class="form-label">Pin Cus Qtt</label>
                                                                        <input type="text" class="form-control" id="pin_cus_qtt" name="pin_cus_qtt" required
                                                                               value="<?php echo htmlspecialchars($edit_data['pin_cus_qtt']); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-4">
                                                                        <label for="qty_trial" class="form-label">Qty Trial</label>
                                                                        <input type="text" class="form-control" id="qty_trial" name="qty_trial" required
                                                                               value="<?php echo htmlspecialchars($edit_data['qty_trial']); ?>">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="jumlah_ok" class="form-label">Jumlah OK</label>
                                                                        <input type="text" class="form-control" id="jumlah_ok" name="jumlah_ok" required
                                                                               value="<?php echo htmlspecialchars($edit_data['jumlah_ok']); ?>">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="jumlah_ng" class="form-label">Jumlah NG</label>
                                                                        <input type="text" class="form-control" id="jumlah_ng" name="jumlah_ng" required
                                                                               value="<?php echo htmlspecialchars($edit_data['jumlah_ng']); ?>">
                                                                    </div>
                                                                </div>
                                                                
                                                           
                                                            </div>
                                                        </div>

                                                        <!-- Problem Tool Section -->
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Problem Tool</h5>

                                                                <div class="mb-3">
                                                                    <label for="problem_tool_editor" class="form-label">Problem Tool</label>
                                                                    <div id="problem_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['problem_tool'] ?? ''); ?></div>
                                                                    <input type="hidden" name="problem_tool" id="problem_tool_input" value="<?php echo htmlspecialchars($edit_data['problem_tool'] ?? ''); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="analisa_sebab_tool_editor" class="form-label">Analisa Sebab Tool</label>
                                                                    <div id="analisa_sebab_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['analisa_sebab_tool'] ?? ''); ?></div>
                                                                    <input type="hidden" name="analisa_sebab_tool" id="analisa_sebab_tool_input" value="<?php echo htmlspecialchars($edit_data['analisa_sebab_tool'] ?? ''); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="counter_measure_tool_editor" class="form-label">Counter Measure Tool</label>
                                                                    <div id="counter_measure_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['counter_measure_tool'] ?? ''); ?></div>
                                                                    <input type="hidden" name="counter_measure_tool" id="counter_measure_tool_input" value="<?php echo htmlspecialchars($edit_data['counter_measure_tool'] ?? ''); ?>">
                                                                </div>
                                                                
                                                                <!-- Form fields for tool section -->
                                                                <div class="mb-3">
                                                                    <label for="pic_tool_editor" class="form-label">PIC Tool</label>
                                                                    <div id="pic_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['pic_tool'] ?? ''); ?></div>
                                                                    <input type="hidden" name="pic_tool" id="pic_tool_input" value="<?php echo htmlspecialchars($edit_data['pic_tool'] ?? ''); ?>">
                                                                </div>
                                                                
                                                                <div class="mb-3">
                                                                    <label for="target_tool_editor" class="form-label">Target Tool</label>
                                                                    <div id="target_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['target_tool'] ?? ''); ?></div>
                                                                    <input type="hidden" name="target_tool" id="target_tool_input" value="<?php echo htmlspecialchars($edit_data['target_tool'] ?? ''); ?>">
                                                                </div>
                                                                
                                                                <div class="mb-3">
                                                                    <label for="keterangan_tool_editor" class="form-label">Keterangan Tool</label>
                                                                    <div id="keterangan_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['keterangan_tool'] ?? ''); ?></div>
                                                                    <input type="hidden" name="keterangan_tool" id="keterangan_tool_input" value="<?php echo htmlspecialchars($edit_data['keterangan_tool'] ?? ''); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="kelengkapan_dies" class="form-label">Kelengkapan Dies</label>
                                                                    <input type="text" class="form-control" id="kelengkapan_dies" name="kelengkapan_dies" required
                                                                           value="<?php echo htmlspecialchars($edit_data['kelengkapan_dies']); ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Problem Part</h5>

                                                                <div class="mb-3">
                                                                    <label for="problem_part_editor" class="form-label">Problem Part</label>
                                                                    <div id="problem_part_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['problem_part']); ?></div>
                                                                    <input type="hidden" name="problem_part" id="problem_part_input" value="<?php echo htmlspecialchars($edit_data['problem_part']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="analisa_sebab_part_editor" class="form-label">Analisa Sebab Part</label>
                                                                    <div id="analisa_sebab_part_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['analisa_sebab_part']); ?></div>
                                                                    <input type="hidden" name="analisa_sebab_part" id="analisa_sebab_part_input" value="<?php echo htmlspecialchars($edit_data['analisa_sebab_part']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="counter_measure_part_editor" class="form-label">Counter Measure Part</label>
                                                                    <div id="counter_measure_part_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['counter_measure_part']); ?></div>
                                                                    <input type="hidden" name="counter_measure_part" id="counter_measure_part_input" value="<?php echo htmlspecialchars($edit_data['counter_measure_part']); ?>">
                                                                </div>
                                                                
                                                                <!-- Tidak bisa di update bagian part -->
                                                                <div class="mb-3">
                                                                    <label for="PIC_editor" class="form-label">PIC</label>
                                                                    <div id="PIC_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['PIC']); ?></div>
                                                                    <input type="hidden" name="PIC" id="PIC_input" value="<?php echo htmlspecialchars($edit_data['PIC']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="target_editor" class="form-label">Target</label>
                                                                    <div id="target_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['target']); ?></div>
                                                                    <input type="hidden" name="target" id="target_input" value="<?php echo htmlspecialchars($edit_data['target']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="keterangan_editor" class="form-label">Keterangan</label>
                                                                    <div id="keterangan_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['keterangan']); ?></div>
                                                                    <input type="hidden" name="keterangan" id="keterangan_input" value="<?php echo htmlspecialchars($edit_data['keterangan']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="accuracy_part" class="form-label">Accuracy Part</label>
                                                                    <input type="text" class="form-control" id="accuracy_part" name="accuracy_part" required value="<?php echo htmlspecialchars($edit_data['accuracy_part']); ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Result Section -->
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Result</h5>
                                                                <div class="mb-3">
                                                                    <label for="visual" class="form-label">Visual</label>
                                                                    <select class="form-select" id="visual" name="visual" required>
                                                                        <option value="OK" <?php echo ($edit_data['visual'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                                        <option value="NG" <?php echo ($edit_data['visual'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="dimensi" class="form-label">Dimensi</label>
                                                                    <select class="form-select" id="dimensi" name="dimensi" required>
                                                                        <option value="OK" <?php echo ($edit_data['dimensi'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                                        <option value="NG" <?php echo ($edit_data['dimensi'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="fungsi" class="form-label">Fungsi</label>
                                                                    <select class="form-select" id="fungsi" name="fungsi" required>
                                                                        <option value="OK" <?php echo ($edit_data['fungsi'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                                        <option value="NG" <?php echo ($edit_data['fungsi'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="judgement" class="form-label">Judgement</label>
                                                                    <select class="form-select" id="judgement" name="judgement" required>
                                                                        <option value="OK" <?php echo ($edit_data['judgement'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                                        <option value="NG" <?php echo ($edit_data['judgement'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Approval Section -->
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Approval</h5>
                                                                <div class="mb-3">
                                                                    <label for="dibuat" class="form-label">Dibuat Oleh</label>
                                                                    <input type="text" class="form-control" id="dibuat" name="dibuat" required
                                                                           value="<?php echo htmlspecialchars($edit_data['dibuat']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="diperiksa" class="form-label">Diperiksa Oleh</label>
                                                                    <input type="text" class="form-control" id="diperiksa" name="diperiksa" required
                                                                           value="<?php echo htmlspecialchars($edit_data['diperiksa']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="diketahui" class="form-label">Diketahui Oleh</label>
                                                                    <input type="text" class="form-control" id="diketahui" name="diketahui" required
                                                                           value="<?php echo htmlspecialchars($edit_data['diketahui']); ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="peserta" class="form-label">Peserta</label>
                                                                    <input type="text" class="form-control" id="peserta" name="peserta" required
                                                                           value="<?php echo htmlspecialchars($edit_data['peserta']); ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <a href="view.php" class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                    </form>

                                                    <!-- Add necessary Quill CSS -->
                                                    <link href="../../assets/css/vendor/quill.snow.css" rel="stylesheet" type="text/css" />
                                                    <link href="../../assets/css/vendor/quill.bubble.css" rel="stylesheet" type="text/css" />

                                                    <!-- Add Quill JS library -->
                                                    <script src="../../assets/js/vendor/quill.min.js"></script>

                                                    <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        // Configure Quill toolbar
                                                        const toolbarOptions = [
                                                            [{ font: [] }, { size: [] }],
                                                            ['bold', 'italic', 'underline', 'strike'],
                                                            [{ color: [] }, { background: [] }],
                                                            [{ script: 'super' }, { script: 'sub' }],
                                                            [{ header: [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
                                                            [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                                                            ['direction', { align: [] }],
                                                            ['link', 'image', 'video'],
                                                            ['clean']
                                                        ];
                                                        
                                                        // Initialize Quill editors for edit form
                                                        const editorMappings = [
                                                            { editor: 'problem_tool_editor', input: 'problem_tool_input' },
                                                            { editor: 'analisa_sebab_tool_editor', input: 'analisa_sebab_tool_input' },
                                                            { editor: 'counter_measure_tool_editor', input: 'counter_measure_tool_input' },
                                                            { editor: 'pic_tool_editor', input: 'pic_tool_input' },
                                                            { editor: 'target_tool_editor', input: 'target_tool_input' },
                                                            { editor: 'keterangan_tool_editor', input: 'keterangan_tool_input' },
                                                            { editor: 'problem_part_editor', input: 'problem_part_input' },
                                                            { editor: 'analisa_sebab_part_editor', input: 'analisa_sebab_part_input' },
                                                            { editor: 'counter_measure_part_editor', input: 'counter_measure_part_input' },
                                                            { editor: 'PIC_editor', input: 'PIC_input' },
                                                            { editor: 'target_editor', input: 'target_input' },
                                                            { editor: 'keterangan_editor', input: 'keterangan_input' }
                                                        ];
                                                        
                                                        // Initialize all editors
                                                        editorMappings.forEach(mapping => {
                                                            const editorElement = document.getElementById(mapping.editor);
                                                            if (editorElement) {
                                                                const quill = new Quill('#' + mapping.editor, {
                                                                    theme: 'snow',
                                                                    modules: {
                                                                        toolbar: toolbarOptions
                                                                    }
                                                                });
                                                                
                                                                // When editor content changes, update the hidden input
                                                                quill.on('text-change', function() {
                                                                    const input = document.getElementById(mapping.input);
                                                                    input.value = quill.root.innerHTML;
                                                                });
                                                            }
                                                        });
                                                        
                                                        // Ensure form values are captured on submit
                                                        const form = document.getElementById('edit-form');
                                                        if (form) {
                                                            form.addEventListener('submit', function(e) {
                                                                // No need to prevent default, as we're updating inputs in real-time
                                                                // The event listeners above will have updated the hidden inputs already
                                                                console.log('Form submitted with Quill content captured');
                                                            });
                                                        }
                                                    });
                                                    </script>
                                                    <?php else: ?>
<!-- Button untuk menampilkan form -->

<!-- Form Insert -->
<?php if (isset($_GET['insert'])): ?>
<form action="action.php" method="post" id="insert-form">
    <input type="hidden" name="submit" value="true">

    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                <label for="id_customer" class="form-label">Nama Customer</label>
                <select class="form-select" id="id_customer" name="id_customer" required>
                    <option value="">Nama Customer</option>
                    <?php
                    $sql = "SELECT id_customer, nama_customer FROM customer";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_customer'] . '">' . $row['nama_customer'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_part" class="form-label">Nama Part</label>
                <select class="form-select" id="id_part" name="id_part" required>
                    <option value="">Nama Part</option>
                    <?php
                    $sql = "SELECT id_part, nama_part FROM data_part";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_part'] . '">' . $row['nama_part'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_proses" class="form-label">Proses</label>
                <select class="form-select" id="id_proses" name="id_proses" required>
                    <option value="">Select Proses</option>
                    <?php
                    $sql = "SELECT id_proses, Proses FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_proses'] . '">' . $row['Proses'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <!-- Part No -->
            <div class="mb-3">
                <label for="part_no" class="form-label">Part No</label>
                <select class="form-select" id="part_no" name="part_no" required>
                    <option value="">Select Part No</option>
                    <?php
                    $sql = "SELECT DISTINCT part_no FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['part_no']) . '">' . htmlspecialchars($row['part_no']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Nama Project -->
            <div class="mb-3">
                <label for="project" class="form-label">Nama Project</label>
                <select class="form-select" id="project" name="project" required>
                    <option value="">Nama Project</option>
                    <?php
                    $sql = "SELECT DISTINCT project FROM customer";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['project']) . '">' . htmlspecialchars($row['project']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Mat Spec -->
            <div class="mb-3">
                <label for="mat_spec" class="form-label">Mat Spec</label>
                <select class="form-select" id="mat_spec" name="mat_spec" required>
                    <option value="">Mat Spec</option>
                    <?php
                    $sql = "SELECT DISTINCT mat_spec FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['mat_spec']) . '">' . htmlspecialchars($row['mat_spec']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Mat Size -->
            <div class="mb-3">
                <label for="mat_size" class="form-label">Mat Size</label>
                <select class="form-select" id="mat_size" name="mat_size" required>
                    <option value="">Mat Size</option>
                    <?php
                    $sql = "SELECT DISTINCT mat_size FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['mat_size']) . '">' . htmlspecialchars($row['mat_size']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <script>
            // Add event listener for id_part change to update related fields
            document.getElementById('id_part').addEventListener('change', function() {
                const id_part = this.value;
                if (id_part) {
                    // Update Part No dropdown
                    fetch(`get_part_data.php?type=part_no&id_part=${id_part}`)
                        .then(response => response.json())
                        .then(data => {
                            updateDropdown('part_no', data);
                        });
                    
                    // Update Mat Spec dropdown
                    fetch(`get_part_data.php?type=mat_spec&id_part=${id_part}`)
                        .then(response => response.json())
                        .then(data => {
                            updateDropdown('mat_spec', data);
                        });
                    
                    // Update Mat Size dropdown
                    fetch(`get_part_data.php?type=mat_size&id_part=${id_part}`)
                        .then(response => response.json())
                        .then(data => {
                            updateDropdown('mat_size', data);
                        });
                }
            });

            // Add event listener for id_customer change to update project field
            document.getElementById('id_customer').addEventListener('change', function() {
                const id_customer = this.value;
                if (id_customer) {
                    fetch(`get_part_data.php?type=project&id_customer=${id_customer}`)
                        .then(response => response.json())
                        .then(data => {
                            updateDropdown('project', data);
                        });
                }
            });

            // Helper function to update dropdowns
            function updateDropdown(dropdownId, data) {
                const dropdown = document.getElementById(dropdownId);
                dropdown.innerHTML = '<option value="">Select ' + dropdownId.replace('_', ' ') + '</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item;
                    option.textContent = item;
                    dropdown.appendChild(option);
                });
            }
            </script>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Trial</h5>
            <div class="mb-3">
                <label for="trial" class="form-label">Trial</label>
                <input type="text" class="form-control" id="trial" name="trial" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="jam_start" class="form-label">Jam Start</label>
                <input type="time" class="form-control" id="jam_start" name="jam_start" required>
            </div>
            
            <div class="mb-3">
                <label for="jam_finish" class="form-label">Jam Finish</label>
                <input type="time" class="form-control" id="jam_finish" name="jam_finish" required>
            </div>
            
            <div class="mb-3">
                <label for="mc_name" class="form-label">M/C Name</label>
                <input type="text" class="form-control" id="mc_name" name="mc_name" required>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="text" class="form-control" id="kapasitas" name="kapasitas" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cush_prec" class="form-label">Cush Prec</label>
                    <input type="text" class="form-control" id="cush_prec" name="cush_prec" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="die_dim" class="form-label">Die Dim</label>
                    <input type="text" class="form-control" id="die_dim" name="die_dim" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="die_height" class="form-label">Die Height</label>
                    <input type="text" class="form-control" id="die_height" name="die_height" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="pin_cus_qtt" class="form-label">Pin Cus Qtt</label>
                <input type="text" class="form-control" id="pin_cus_qtt" name="pin_cus_qtt" required>
            </div>

            <div class="mb-3">
                <label for="qty_trial" class="form-label">Qty Trial/Total Produksi</label>
                <input type="text" class="form-control" id="qty_trial" name="qty_trial" required>
            </div>
    
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah_ok" class="form-label">Jumlah OK</label>
                    <input type="text" class="form-control" id="jumlah_ok" name="jumlah_ok" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jumlah_ng" class="form-label">Jumlah NG</label>
                    <input type="text" class="form-control" id="jumlah_ng" name="jumlah_ng" required>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Problem Tool</h5>

            <div class="mb-3">
                <label for="snow-editor" class="form-label">Problem Tool</label>
                <div id="snow-editor" style="height: 300px;"></div>
                <input type="hidden" name="problem_tool" id="problem_tool">
            </div>

            <div class="mb-3">
                <label for="snow-editor2" class="form-label">Analisa Penyebab</label>
                <div id="snow-editor2" style="height: 300px;"></div>
                <input type="hidden" name="analisa_sebab_tool" id="analisa_sebab_tool">
            </div>
      
            <div class="mb-3">
                <label for="snow-editor3" class="form-label">Counter Measure</label>
                <div id="snow-editor3" style="height: 300px;"></div>
                <input type="hidden" name="counter_measure_tool" id="counter_measure_tool">
            </div>
          
            <div class="mb-3">
                <label for="snow-editor4" class="form-label">PIC Tools</label>
                <div id="snow-editor4" style="height: 300px;"></div>
                <input type="hidden" name="pic_tool" id="pic_tool">
            </div>

            <div class="mb-3">
                <label for="snow-editor5" class="form-label">Target</label>
                <div id="snow-editor5" style="height: 300px;"></div>
                <input type="hidden" name="target_tool" id="target_tool">
            </div>

            <div class="mb-3">
                <label for="snow-editor6" class="form-label">Keterangan</label>
                <div id="snow-editor6" style="height: 300px;"></div>
                <input type="hidden" name="keterangan_tool" id="keterangan_tool">
            </div>

            <div class="mb-3">
                <label for="kelengkapan_dies" class="form-label">Kelengkapan Dies</label>
                <input type="text" class="form-control" id="kelengkapan_dies" name="kelengkapan_dies" required>
            </div>
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Problem Part</h5>

            <div class="mb-3">
                <label for="snow-editor7" class="form-label">Problem Part</label>
                <div id="snow-editor7" style="height: 300px;"></div>
                <input type="hidden" name="problem_part" id="problem_part">
            </div>

            <div class="mb-3">
                <label for="snow-editor8" class="form-label">Analisa Penyebab Part</label>
                <div id="snow-editor8" style="height: 300px;"></div>
                <input type="hidden" name="analisa_sebab_part" id="analisa_sebab_part">
            </div>

            <div class="mb-3">
                <label for="snow-editor9" class="form-label">Counter Measure Part</label>
                <div id="snow-editor9" style="height: 300px;"></div>
                <input type="hidden" name="counter_measure_part" id="counter_measure_part">
            </div>

            <div class="mb-3">
                <label for="snow-editor10" class="form-label">PIC</label>
                <div id="snow-editor10" style="height: 300px;"></div>
                <input type="hidden" name="PIC" id="PIC">
            </div>

            <div class="mb-3">
                <label for="snow-editor11" class="form-label">Target</label>
                <div id="snow-editor11" style="height: 300px;"></div>
                <input type="hidden" name="target" id="target">
            </div>

            <div class="mb-3">
                <label for="snow-editor12" class="form-label">Keterangan</label>
                <div id="snow-editor12" style="height: 300px;"></div>
                <input type="hidden" name="keterangan" id="keterangan">
            </div>

            <div class="mb-3">
                <label for="accuracy_part" class="form-label">Accuracy Part</label>
                <input type="text" class="form-control" id="accuracy_part" name="accuracy_part" required>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Result</h5>
            <div class="mb-3">
                <label for="visual" class="form-label">Visual</label>
                <select class="form-select" id="visual" name="visual" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="dimensi" class="form-label">Dimensi</label>
                <select class="form-select" id="dimensi" name="dimensi" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fungsi" class="form-label">Fungsi</label>
                <select class="form-select" id="fungsi" name="fungsi" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="judgement" class="form-label">Judgement</label>
                <select class="form-select" id="judgement" name="judgement" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Approval</h5>
            
            <div class="mb-3">
                <label for="dibuat" class="form-label">Dibuat Oleh</label>
                <input type="text" class="form-control" id="dibuat" name="dibuat" required>
            </div>
            
            <div class="mb-3">
                <label for="diperiksa" class="form-label">Diperiksa Oleh</label>
                <input type="text" class="form-control" id="diperiksa" name="diperiksa" required>
            </div>
            
            <div class="mb-3">
                <label for="diketahui" class="form-label">Diketahui Oleh</label>
                <input type="text" class="form-control" id="diketahui" name="diketahui" required>
            </div>
            
            <div class="mb-3">
                <label for="peserta" class="form-label">Peserta</label>
                <input type="text" class="form-control" id="peserta" name="peserta" required>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="view.php" class="btn btn-secondary">Back</a>
    </div>
</form>

<!-- Initialize Quill editors -->
<link href="../../assets/css/vendor/quill.snow.css" rel="stylesheet" type="text/css" />
<script src="../../assets/js/vendor/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all Quill editors
        const editorIds = [
            'snow-editor', 'snow-editor2', 'snow-editor3', 'snow-editor4', 
            'snow-editor5', 'snow-editor6', 'snow-editor7', 'snow-editor8',
            'snow-editor9', 'snow-editor10', 'snow-editor11', 'snow-editor12'
        ];
        
        const hiddenInputIds = [
            'problem_tool', 'analisa_sebab_tool', 'counter_measure_tool', 'pic_tool',
            'target_tool', 'keterangan_tool', 'problem_part', 'analisa_sebab_part',
            'counter_measure_part', 'PIC', 'target', 'keterangan'
        ];
        
        // Create Quill instances and set up form submission
        const quills = editorIds.map((id, index) => {
            const quill = new Quill(`#${id}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ font: [] }, { size: [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ color: [] }, { background: [] }],
                        [{ script: 'super' }, { script: 'sub' }],
                        [{ header: [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
                        [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                        ['direction', { align: [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });
            
            // Update hidden input when editor content changes
            quill.on('text-change', function() {
                document.getElementById(hiddenInputIds[index]).value = quill.root.innerHTML;
            });
            
            return quill;
        });
        
        // Handle form submission - ensure data is captured from Quill editors
        document.getElementById('insert-form').addEventListener('submit', function(e) {
            // Update all hidden inputs with Quill content before submission
            quills.forEach((quill, index) => {
                document.getElementById(hiddenInputIds[index]).value = quill.root.innerHTML;
            });
        });
    });
</script>
<?php else: ?>
<!-- This part will show if not in insert mode -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" id="table-container">
                <h4 class="card-title">Trial List</h4>
                <a href="view.php?insert" class="btn btn-primary">Insert New Trial</a>
                <div class="table-responsive mt-3">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Part</th>
                                <th>Jam Start</th>
                                <th>Jam Finish</th>
                                <th>M/C Name</th>
                                <th>Kapasitas</th>
                                <th>PIC</th>
                                <th>Proses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT t.*, a.nama_part, p.Proses  
                                    FROM trial t 
                                    JOIN proses p ON t.id_proses = p.id_proses 
                                    JOIN data_part a ON t.id_part = a.id_part 
                                    ORDER BY t.id_trial DESC";

                            $result = $conn->query($sql);
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . htmlspecialchars($row['nama_part']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['jam_start']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['jam_finish']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['mc_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['kapasitas']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['PIC']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['Proses']) . '</td>';
                                echo '<td>';
                                echo '<a href="view.php?detail=' . $row['id_trial'] . '" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a> ';
                                echo '<a href="view.php?edit=' . $row['id_trial'] . '" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a> ';
                                echo '<a href="view.php?delete=' . $row['id_trial'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')"><i class="mdi mdi-trash-can"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div> <!-- end row-->
                    </div> <!-- container -->
                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Hyper - Coderthemes.com
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Right Sidebar -->
        <div class="end-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar>

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <!-- Settings -->
                    <h5 class="mt-3">Color Scheme</h5>
                    <hr class="mt-1" />

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light" id="light-mode-check" checked>
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check">
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>
       

                    <!-- Width -->
                    <h5 class="mt-4">Width</h5>
                    <hr class="mt-1" />
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked>
                        <label class="form-check-label" for="fluid-check">Fluid</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                        <label class="form-check-label" for="boxed-check">Boxed</label>
                    </div>
        

                    <!-- Left Sidebar-->
                    <h5 class="mt-4">Left Sidebar</h5>
                    <hr class="mt-1" />
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                        <label class="form-check-label" for="default-check">Default</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked>
                        <label class="form-check-label" for="light-check">Light</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                        <label class="form-check-label" for="dark-check">Dark</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked>
                        <label class="form-check-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                        <label class="form-check-label" for="condensed-check">Condensed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                        <label class="form-check-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
            
                        <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
                            class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                    </div>
                </div> <!-- end padding-->

            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->
                            

        <!-- bundle -->
        <script src="../../assets/js/vendor.min.js"></script>
        <script src="../../assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="../../assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="../../assets/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="../../assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="../../assets/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="../../assets/js/vendor/dataTables.buttons.min.js"></script>
        <script src="../../assets/js/vendor/buttons.bootstrap5.min.js"></script>
        <script src="../../assets/js/vendor/buttons.html5.min.js"></script>
        <script src="../../assets/js/vendor/buttons.flash.min.js"></script>
        <script src="../../assets/js/vendor/buttons.print.min.js"></script>
        <script src="../../assets/js/vendor/dataTables.keyTable.min.js"></script>
        <script src="../../assets/js/vendor/dataTables.select.min.js"></script>
        <script src="../../assets/js/vendor/fixedColumns.bootstrap5.min.js"></script>
        <script src="../../assets/js/vendor/fixedHeader.bootstrap5.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="../../assets/js/pages/demo.datatable-init.js"></script>
        <!-- end demo js-->

    </body>

<!-- Mirrored from coderthemes.com/hyper/saas/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:22:01 GMT -->
</html>
