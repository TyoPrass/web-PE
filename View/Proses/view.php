<?php
include_once('../../Database/koneksi.php');
include_once('action.php');
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
                            <a href="../Dashboard/dashboard.php" class="side-nav-link">
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
                                        <a href="#">Proses</a>
                                    </li>
                                    <li>
                                        <a href="../Trial/view.php">Trial & Report</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a href="../Katakensha/view.php" class="side-nav-link">
                                <i class="uil-rss"></i>
                                <span> Katakensha  </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                        <a href="../Schedule/view.php" class="side-nav-link">
                        <i class="uil-clipboard-alt"></i>
                                 <span> Tasks </span>
                             </a>
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
                                        <span class="account-user-name"><?= $_SESSION['username'];?></span>
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
                                    <a href="../../index.php" class="dropdown-item notify-item">
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
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Basic Data Table</h4>

                                        <div class="mt-2">
                                                <a href="view.php?insert" class="btn btn-success">
                                                    <i class="mdi mdi-plus"></i>  Insert New Proses
                                                </a>
                                            </div>
                                            <br>
                                      
                 
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
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h6 class="text-uppercase fw-bold">Proses Information</h6>
                                                        <table class="table table-sm">
                                                          
                                                            <tr>
                                                                <th>Part No</th>
                                                                <td>: <?php echo htmlspecialchars($detail_data['part_no']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Proses</th>
                                                                <td>: <?php echo htmlspecialchars($detail_data['Proses']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Material Specification</th>
                                                                <td>: <?php echo htmlspecialchars($detail_data['mat_spec']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Material Size</th>
                                                                <td>: <?php echo htmlspecialchars($detail_data['mat_size']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Part Sketch</th>
                                                                <td>: <img src="uploads/<?php echo htmlspecialchars($detail_data['part_sketch']); ?>" alt="Part Sketch" width="100"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Layout Sketch</th>
                                                                <td>: <img src="uploads/<?php echo htmlspecialchars($detail_data['layout_sketch']); ?>" alt="Layout Sketch" width="100"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Target Trial</th>
                                                                <td>: <?php echo htmlspecialchars($detail_data['target_trial']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Part Name</th>
                                                                <td>: <?php echo htmlspecialchars($detail_data['nama_part']); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="view.php" class="btn btn-secondary">
                                                    <i class="mdi mdi-arrow-left"></i> Back
                                                </a>
                                                <a href="view.php?edit=<?php echo $detail_data['id_proses']; ?>" class="btn btn-info">
                                                    <i class="mdi mdi-pencil"></i> Edit
                                                </a>
                                            </div>
                                        <?php elseif (isset($_GET['edit'])): ?>
                                            <!-- Edit Form -->
                                            <form action="action.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_proses" value="<?php echo htmlspecialchars($edit_data['id_proses']); ?>">
                                                <input type="hidden" name="update" value="true">
                                                <div class="mb-3">
                                                    <label for="part_no" class="form-label">Part No</label>
                                                    <input type="text" class="form-control" id="part_no" name="part_no" value="<?php echo htmlspecialchars($edit_data['part_no']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="proses" class="form-label">Proses</label>
                                                    <input type="text" class="form-control" id="proses" name="proses" value="<?php echo htmlspecialchars($edit_data['Proses']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mat_spec" class="form-label">Material Specification</label>
                                                    <input type="text" class="form-control" id="mat_spec" name="mat_spec" value="<?php echo htmlspecialchars($edit_data['mat_spec']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mat_size" class="form-label">Material Size</label>
                                                    <input type="text" class="form-control" id="mat_size" name="mat_size" value="<?php echo htmlspecialchars($edit_data['mat_size']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="part_sketch" class="form-label">Part Sketch</label>
                                                    <input type="file" class="form-control" id="part_sketch" name="part_sketch" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="layout_sketch" class="form-label">Layout Sketch</label>
                                                    <input type="file" class="form-control" id="layout_sketch" name="layout_sketch" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="target_trial" class="form-label">Target Trial</label>
                                                    <input type="text" class="form-control" id="target_trial" name="target_trial" value="<?php echo htmlspecialchars($edit_data['target_trial']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_part" class="form-label">Part Name</label>
                                                    <select class="form-control" id="id_part" name="id_part" required>
                                                        <?php
                                                        $sql = "SELECT id_part, nama_part FROM data_part";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $selected = $row['id_part'] == $edit_data['id_part'] ? 'selected' : '';
                                                            echo "<option value='{$row['id_part']}' $selected>{$row['nama_part']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        <?php elseif (isset($_GET['insert'])): ?>
                                            <!-- Insert Form -->
                                            <form action="action.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="submit" value="true">
                                                <div class="mb-3">
                                                    <label for="part_no" class="form-label">Part No</label>
                                                    <input type="text" class="form-control" id="part_no" name="part_no" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="proses" class="form-label">Proses</label>
                                                    <input type="text" class="form-control" id="proses" name="proses" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mat_spec" class="form-label">Material Specification</label>
                                                    <input type="text" class="form-control" id="mat_spec" name="mat_spec" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mat_size" class="form-label">Material Size</label>
                                                    <input type="text" class="form-control" id="mat_size" name="mat_size" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="part_sketch" class="form-label">Part Sketch</label>
                                                    <input type="file" class="form-control" id="part_sketch" name="part_sketch" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="layout_sketch" class="form-label">Layout Sketch</label>
                                                    <input type="file" class="form-control" id="layout_sketch" name="layout_sketch" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="target_trial" class="form-label">Target Trial</label>
                                                    <input type="text" class="form-control" id="target_trial" name="target_trial" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_part" class="form-label">Part Name</label>
                                                    <select class="form-control" id="id_part" name="id_part" required>
                                                        <?php
                                                        $sql = "SELECT id_part, nama_part FROM data_part";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='{$row['id_part']}'>{$row['nama_part']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="d-d-flex justify-content-between mt-3">
                                                    <a href="view.php" class="btn btn-secondary">
                                                        <i class="mdi mdi-arrow-left"></i> Back
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">Insert</button>
                                                </div>
                                            </form>
                                        <?php else: ?>
                                            <!-- Display Records Table -->
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="basic-datatable-preview">
                                                    <div class="table-responsive">
                                                        <table id="basic-datatable" class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Part No</th>
                                                                    <th>Proses</th>
                                                                    <th>Material Specification</th>
                                                                    <th>Material Size</th>
                                                                    <th>Part Sketch</th>
                                                                    <th>Layout Sketch</th>
                                                                    <th>Target Trial</th>
                                                                    <th>Part Name</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $sql = "SELECT p.*, dp.nama_part FROM proses p JOIN data_part dp ON p.id_part = dp.id_part ORDER BY p.id_proses ASC";
                                                                $result = $conn->query($sql);
                                                                $no = 1;
                                                                while ($row = $result->fetch_assoc()): ?>
                                                                    <tr>
                                                                        <td><?php echo $no++; ?></td>
                                                                        <td><?php echo htmlspecialchars($row['part_no']); ?></td>
                                                                        <td><?php echo htmlspecialchars($row['Proses']); ?></td>
                                                                        <td><?php echo htmlspecialchars($row['mat_spec']); ?></td>
                                                                        <td><?php echo htmlspecialchars($row['mat_size']); ?></td>
                                                                        <td><img src="uploads/<?php echo htmlspecialchars($row['part_sketch']); ?>" alt="Part Sketch" width="50"></td>
                                                                        <td><img src="uploads/<?php echo htmlspecialchars($row['layout_sketch']); ?>" alt="Layout Sketch" width="50"></td>
                                                                        <td><?php echo htmlspecialchars($row['target_trial']); ?></td>
                                                                        <td><?php echo htmlspecialchars($row['nama_part']); ?></td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <a href="view.php?edit=<?php echo $row['id_proses']; ?>" 
                                                                                   class="btn btn-info btn-sm" 
                                                                                   data-bs-toggle="tooltip" 
                                                                                   title="Edit">
                                                                                    <i class="mdi mdi-pencil"></i>
                                                                                </a>
                                                                                <a href="view.php?delete=<?php echo $row['id_proses']; ?>" 
                                                                                   class="btn btn-danger btn-sm" 
                                                                                   data-bs-toggle="tooltip" 
                                                                                   title="Delete"
                                                                                   onclick="return confirm('Are you sure you want to delete this record?')">
                                                                                    <i class="mdi mdi-trash-can"></i>
                                                                                </a>
                                                                                <a href="view.php?detail=<?php echo $row['id_proses']; ?>" 
                                                                                   class="btn btn-secondary btn-sm" 
                                                                                   data-bs-toggle="tooltip" 
                                                                                   title="Detail">
                                                                                    <i class="mdi mdi-eye"></i>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php endwhile; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                         
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
