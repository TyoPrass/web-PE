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

         <style>
     
     th, td {
         text-align: center;
     }

 </style>
 
     </head>
 
     <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
         <!-- Begin page -->
         <div class="wrapper">
             <!-- ========== Left Sidebar Start ========== -->
             <div class="leftside-menu">
     
                 <!-- LOGO -->
                 <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="../../assets/images/logo2.png" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="../../assets/images/logo3.png" alt="" height="16">
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
                                        <a href="../Proses/view.php">Proses</a>
                                    </li>
                                    <li>
                                        <a href="../Trial/view.php">Trial & Report</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
 
                         <li class="side-nav-item">
                             <a href="#" class="side-nav-link">
                                 <i class="uil-rss"></i>
                                 <span> Katakensha </span>
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
                     <!-- <div class="help-box text-white text-center">
                         <a href="javascript: void(0);" class="float-end close-btn text-white">
                             <i class="mdi mdi-close"></i>
                         </a>
                         <img src="../../assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
                         <h5 class="mt-3">PE-STAMPING</h5>
                         <p class="mb-3">TES JERAPAHNAIKKUDA</p>
                     </div> -->
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
                                       
                                         <ul class="nav nav-tabs nav-bordered mb-3">
                                         
                                            
                                         </ul> <!-- end nav-->
                                         <div class="tab-content">
                                         <h2>Checklist Katakanesha</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
             <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?> 
        <?php endif; ?>

        <?php if (!isset($_GET['insert']) && !isset($_GET['edit']) && !isset($_GET['view'])): ?>
            <!-- Main List View -->
            <div class="mb-3">
                <a href="view.php?insert" class="btn btn-success">+ Insert New Checklist</a>
            </div>

            <!-- Read -->
            <h3>Checklist Data</h3>
            
            <div class="table-responsive">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Part No</th>
                            <th>Part Name</th>
                            <th>Date</th>
                            <th>Process</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT checklist_katakanesha.*, customer.nama_customer, data_part.nama_part, proses.proses 
                                FROM checklist_katakanesha
                                LEFT JOIN customer ON checklist_katakanesha.id_customer = customer.id_customer
                                LEFT JOIN data_part ON checklist_katakanesha.id_part = data_part.id_part
                                LEFT JOIN proses ON checklist_katakanesha.id_proses = proses.id_proses
                                ORDER BY checklist_katakanesha.id DESC";
                        $result = $conn->query($sql);
                        ?>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $nomer = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $nomer++; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_customer']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_part']); ?></td>
                                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['proses']); ?></td>
                                    <td>
                                        <a href="view.php?view=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="view.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="view.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif (isset($_GET['view'])): ?>
            <!-- View Detail -->
            <?php
            $id = $_GET['view'];
            $sql = "SELECT * FROM checklist_katakanesha WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $viewResult = $stmt->get_result();
            $viewData = $viewResult->fetch_assoc();
            $stmt->close();

            if ($viewData):
            $checklist_data = json_decode($viewData['checklist_data'], true);
            ?>
            <div class="mb-3">
                <a href="view.php" class="btn btn-secondary">Back to List</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>View Checklist</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Customer</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['nama_customer']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Part</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['nama_part']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Process</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['proses']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['date']); ?></p>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-3" id="viewTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="view-dinamis-tab" data-bs-toggle="tab" data-bs-target="#view-dinamis" type="button" role="tab" aria-controls="view-dinamis" aria-selected="true">
                                <span class="d-none d-md-block">Dinamis</span>
                                <i class="mdi mdi-pencil-box d-md-none d-block"></i>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="view-statis-tab" data-bs-toggle="tab" data-bs-target="#view-statis" type="button" role="tab" aria-controls="view-statis" aria-selected="false">
                                <span class="d-none d-md-block">Statis</span>
                                <i class="mdi mdi-information-outline d-md-none d-block"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="viewTabContent">
                        <div class="tab-pane fade show active" id="view-dinamis" role="tabpanel" aria-labelledby="view-dinamis-tab">
                            <h4>Checklist Dinamis</h4>
                            <table class="table table-bordered table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Group</th>
                                        <th>No</th>
                                        <th>Point Check</th>
                                        <th>P1</th>
                                        <th>P2</th>
                                        <th>P3</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $currentGroup = '';
                                    foreach ($checklist as $index => $item): 
                                        if ($currentGroup != $item['group']):
                                            $currentGroup = $item['group'];
                                    ?>
                                        <tr class="table-secondary">
                                            <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                        </tr>
                                    <?php endif; ?>
                                        <tr>
                                            <td><?php echo $item['group']; ?></td>
                                            <td><?php echo $item['no']; ?></td>
                                            <td><?php echo $item['point']; ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['P1'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['P2'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['P3'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['keterangan'] ?? ''); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="view-statis" role="tabpanel" aria-labelledby="view-statis-tab">
                            <h4>Checklist Statis</h4>
                            <table class="table table-bordered table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Group</th>
                                        <th>No</th>
                                        <th>Point Check</th>
                                        <th>P1</th>
                                        <th>P2</th>
                                        <th>P3</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $currentGroup = '';
                                    $startIndex = count($checklist);
                                    foreach ($checklist2 as $i => $item): 
                                        $index = $startIndex + $i;
                                        if ($currentGroup != $item['group']):
                                            $currentGroup = $item['group'];
                                    ?>
                                        <tr class="table-secondary">
                                            <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                        </tr>
                                    <?php endif; ?>
                                        <tr>
                                            <td><?php echo $item['group']; ?></td>
                                            <td><?php echo $item['no']; ?></td>
                                            <td><?php echo $item['point']; ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['P1'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['P2'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['P3'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($checklist_data[$index]['keterangan'] ?? ''); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-danger">Checklist not found.</div>
            <a href="view.php" class="btn btn-secondary">Back to List</a>
            <?php endif; ?>

        <?php else: ?>
            <!-- Insert/Edit Form -->
            <div class="mb-3">
                <a href="view.php" class="btn btn-secondary">Back to List</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><?php echo isset($_GET['edit']) ? 'Edit Checklist' : 'Add New Checklist'; ?></h3>
                </div>
                <div class="card-body">
                    <form action="action.php" method="POST">
                        <?php if (isset($_GET['edit']) && $editData): ?>
                            <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                        <?php endif; ?>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_customer" class="form-label">Customer</label>
                                <select class="form-control" id="id_customer" name="id_customer" required>
                                    <option value="">Select Customer</option>
                                    <?php
                                    $customerQuery = "SELECT id_customer, nama_customer FROM customer";
                                    $customerResult = $conn->query($customerQuery);
                                    while ($customerRow = $customerResult->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $customerRow['id_customer']; ?>" 
                                            <?php echo (isset($editData) && $editData['id_customer'] == $customerRow['id_customer']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($customerRow['nama_customer']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_part" class="form-label">Part</label>
                                <select class="form-control" id="id_part" name="id_part" required>
                                    <option value="">Select Part</option>
                                    <?php
                                    $partQuery = "SELECT id_part, nama_part FROM data_part";
                                    $partResult = $conn->query($partQuery);
                                    while ($partRow = $partResult->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $partRow['id_part']; ?>" 
                                            <?php echo (isset($editData) && $editData['id_part'] == $partRow['id_part']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($partRow['nama_part']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_proses" class="form-label">Process</label>
                                <select class="form-control" id="id_proses" name="id_proses" required>
                                    <option value="">Select Process</option>
                                    <?php
                                    $processQuery = "SELECT id_proses, proses FROM proses";
                                    $processResult = $conn->query($processQuery);
                                    while ($processRow = $processResult->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $processRow['id_proses']; ?>" 
                                            <?php echo (isset($editData) && $editData['id_proses'] == $processRow['id_proses']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($processRow['proses']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?php echo isset($editData) ? htmlspecialchars($editData['date']) : ''; ?>" required>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="dinamis-tab" data-bs-toggle="tab" data-bs-target="#dinamis" type="button" role="tab" aria-controls="dinamis" aria-selected="true">
                                    <span class="d-none d-md-block">Dinamis</span>
                                    <i class="mdi mdi-pencil-box d-md-none d-block"></i>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="statis-tab" data-bs-toggle="tab" data-bs-target="#statis" type="button" role="tab" aria-controls="statis" aria-selected="false">
                                    <span class="d-none d-md-block">Statis</span>
                                    <i class="mdi mdi-information-outline d-md-none d-block"></i>
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dinamis" role="tabpanel" aria-labelledby="dinamis-tab">
                                <!-- Dinamis content -->
                                <h4>Checklist</h4>
                                <table class="table table-bordered table-centered mb-0">
                                    <!-- Your existing dinamis table code -->
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>No</th>
                                            <th>Point Check</th>
                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $checklist_data = isset($editData) ? json_decode($editData['checklist_data'], true) : [];
                                        $currentGroup = '';
                                        
                                        foreach ($checklist as $index => $item): 
                                            if ($currentGroup != $item['group']):
                                                $currentGroup = $item['group'];
                                        ?>
                                            <tr class="table-secondary">
                                                <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                            <tr>
                                                <td><?php echo $item['group']; ?></td>
                                                <td><?php echo $item['no']; ?></td>
                                                <td><?php echo $item['point']; ?></td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P1]" 
                                                        class="form-control" 
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][keterangan]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['keterangan'] ?? '') : ''; ?>">
                                                </td>
                                            </tr>
                                            <?php if ($item['is_last_in_group']): ?>
                                            <tr class="table-light">
                                                <td colspan="7"></td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <h4>Approvment</h4>
                                <table class="table table-bordered table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>No</th>
                                            <th>Point Check</th>
                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $startIndex = 0; // Initialize $startIndex
                                        $startIndex += count($checklist_data); // Start index for checklist

                                        foreach ($checklist5 as $i => $item): 
                                            $index = $startIndex + $i; // Calculate actual index in the combined data
                                            if ($currentGroup != $item['group']):
                                                $currentGroup = $item['group'];
                                        ?>
                                            <tr class="table-secondary">
                                                <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                            <tr>
                                                <td><?php echo $item['group']; ?></td>
                                                <td><?php echo $item['no'] ?? ''; ?></td>
                                                <td><?php echo $item['point']; ?></td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P1]" 
                                                        class="form-control" 
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data[$index]) ? htmlspecialchars($checklist_data[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                 
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                          
                            </div>
                            <div class="tab-pane fade" id="statis" role="tabpanel" aria-labelledby="statis-tab">
                                <!-- Statis content - Now editable like dinamis -->
                                <h4>Checklist 2 Items</h4>
                                <table class="table table-bordered table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>No</th>
                                            <th>Point Check</th>
                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $checklist_data_combined = isset($editData) ? json_decode($editData['checklist_data'], true) : [];
                                        $currentGroup = '';
                                        $startIndex = count($checklist); // Start index for checklist2

                                        foreach ($checklist2 as $i => $item): 
                                            $index = $startIndex + $i; // Calculate actual index in the combined data
                                            if ($currentGroup != $item['group']):
                                                $currentGroup = $item['group'];
                                        ?>
                                            <tr class="table-secondary">
                                                <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                            <tr>
                                                <td><?php echo $item['group']; ?></td>
                                                <td><?php echo $item['no']; ?></td>
                                                <td><?php echo $item['point']; ?></td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P1]" 
                                                        class="form-control" 
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][keterangan]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['keterangan'] ?? '') : ''; ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <h4>Checklist 3 Items</h4>
                                <table class="table table-bordered table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>No</th>
                                            <th>Point Check</th>
                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $startIndex += count($checklist2); // Start index for checklist3

                                        foreach ($checklist3 as $i => $item): 
                                            $index = $startIndex + $i; // Calculate actual index in the combined data
                                            if ($currentGroup != $item['group']):
                                                $currentGroup = $item['group'];
                                        ?>
                                            <tr class="table-secondary">
                                                <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                            <tr>
                                                <td><?php echo $item['group']; ?></td>
                                                <td><?php echo $item['no']; ?></td>
                                                <td><?php echo $item['point']; ?></td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P1]" 
                                                        class="form-control" 
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][keterangan]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['keterangan'] ?? '') : ''; ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <h4>Approvment</h4>
                                <table class="table table-bordered table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>No</th>
                                            <th>Point Check</th>
                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $startIndex += count($checklist3); // Start index for checklist4

                                        foreach ($checklist4 as $i => $item): 
                                            $index = $startIndex + $i; // Calculate actual index in the combined data
                                            if ($currentGroup != $item['group']):
                                                $currentGroup = $item['group'];
                                        ?>
                                            <tr class="table-secondary">
                                                <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                            </tr>
                                        <?php endif; ?>
                                            <tr>
                                                <td><?php echo $item['group']; ?></td>
                                                <td><?php echo $item['no'] ?? ''; ?></td>
                                                <td><?php echo $item['point']; ?></td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P1]" 
                                                        class="form-control" 
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                 
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'Update' : 'Save'; ?> Checklist</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
         <!-- end preview-->
                                         </div> <!-- end tab-content-->
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