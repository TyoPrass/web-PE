<?php
include_once('../Database/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id_jadwal = $_POST['id_jadwal'] ?? null;
        $nama_customer = $_POST['nama_customer'];
        $project = $_POST['project'];

        if ($id_jadwal) {
            // Update existing record
            $sql = "UPDATE jadwal SET nama_customer = ?, project = ? WHERE id_jadwal = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nama_customer, $project, $id_jadwal);
        } else {
            // Insert new record
            $sql = "INSERT INTO jadwal (nama_customer, project) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nama_customer, $project);
        }

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save project']);
        }
        exit;
    }

    if ($action === 'delete') {
        $id_jadwal = $_POST['id_jadwal'];
        $sql = "DELETE FROM jadwal WHERE id_jadwal = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_jadwal);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete project']);
        }
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
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
         <link rel="shortcut icon" href="../../assets/images/favicon.ico">
 
         <!-- third party css -->
         <link href="../../assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="../../assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="../../assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="../../assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="../../assets/css/vendor/fixedHeader.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="../../assets/css/vendor/fixedColumns.bootstrap5.css" rel="stylesheet" type="text/css" />
         <!-- third party css end -->

         <link href="../../assets/css/vendor/frappe-gantt.css" rel="stylesheet" type="text/css" />

 
         <!-- App css -->
         <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
         <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
 
     </head>
 
     <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
         <!-- Begin page -->
         <div class="wrapper">
             <!-- ========== Left Sidebar Start ========== -->
     
                 <!-- Sidebar -left -->
 
             <!-- Left Sidebar End -->
 
             <!-- ============================================================== -->
             <!-- Start Page Content here -->
             <!-- ============================================================== -->
 
             <div class="content-page">
                 <div class="content">
                    
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
                         <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- start projects-->
                                    <div class="col-xxl-3 col-lg-4">
                                        <div class="pe-xl-3">
                                            <h5 class="mt-0 mb-3">Projects</h5>
                                            <!-- start search box -->
                                            <div class="app-search">
                                                <form>
                                                    <div class="mb-2 position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="search by name..." />
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- end search box -->
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="pe-xl-3" data-simplebar style="max-height: 535px;">
                                                    <!-- Add New Project Button -->
                                                    <button type="button" class="btn btn-primary btn-sm mb-3" id="addProjectBtn">Add New Project</button>

                                                    <!-- Project List -->
                                                    <div id="projectList">
                                                        <a href="javascript:void(0);" class="text-body">
                                                            <div class="d-flex mt-1 px-2 py-2">
                                                                <div class="avatar-sm d-table">
                                                                    <span class="avatar-title bg-danger-lighten rounded-circle text-danger">
                                                                        <i class='uil uil-gold font-24'></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h5 class="mt-0 mb-0">
                                                                        Eagle
                                                                        <span class="badge badge-danger-lighten ms-1">Delayed</span>
                                                                    </h5>
                                                                    <p class="mt-1 mb-0 text-muted">
                                                                        ID: proj108
                                                                    </p>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <button class="btn btn-sm btn-warning editProjectBtn">Edit</button>
                                                                    <button class="btn btn-sm btn-danger deleteProjectBtn">Delete</button>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    
                                    </div>
                                    <!-- end projects -->

                                    <!-- gantt view -->
                                    <div class="col-xxl-9 mt-4 mt-xl-0 col-lg-8">
                                        <div class="ps-xl-3">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <a href="javascript: void(0);" class="btn btn-success btn-sm mb-2">Add New Task</a>
                                                </div>
                                                <div class="col text-sm-end">
                                                    <div class="btn-group btn-group-sm mb-2" data-bs-toggle="buttons" id="modes-filter">
                                                        <label class="btn btn-primary d-none d-sm-inline-block">
                                                            <input  class="btn-check" type="radio" name="modes" id="qday" value="Quarter Day"> Quarter Day
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input  class="btn-check" type="radio" name="modes" id="hday" value="Half Day"> Half Day
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input  class="btn-check" type="radio" name="modes" id="day" value="Day"> Day
                                                        </label>
                                                        <label class="btn btn-primary active">
                                                            <input  class="btn-check" type="radio" name="modes" id="week" value="Week" checked> Week
                                                        </label>
                                                        <label class="btn btn-primary">
                                                            <input  class="btn-check" type="radio" name="modes" id="month" value="Month"> Month
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                                                                       
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <svg id="tasks-gantt"></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end gantt view -->
                                </div>
                            </div>
                        </div>
                         </div> <!-- end row-->
                     </div> <!-- container -->
                 </div> <!-- content -->
 
                 <!-- Footer Start -->
              
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

         <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Open Add Project Modal
    document.getElementById('addProjectBtn').addEventListener('click', function () {
        document.getElementById('projectForm').reset();
        document.getElementById('id_jadwal').value = '';
        document.getElementById('projectModalLabel').innerText = 'Add New Project';
        new bootstrap.Modal(document.getElementById('projectModal')).show();
    });

    // Edit Project
    document.querySelectorAll('.editProjectBtn').forEach(function (button) {
        button.addEventListener('click', function () {
            const projectRow = this.closest('.d-flex');
            document.getElementById('id_jadwal').value = projectRow.dataset.id;
            document.getElementById('nama_customer').value = projectRow.dataset.customer;
            document.getElementById('project').value = projectRow.dataset.project;
            document.getElementById('projectModalLabel').innerText = 'Edit Project';
            new bootstrap.Modal(document.getElementById('projectModal')).show();
        });
    });

    // Delete Project
    document.querySelectorAll('.deleteProjectBtn').forEach(function (button) {
        button.addEventListener('click', function () {
            if (confirm('Are you sure you want to delete this project?')) {
                const projectId = this.closest('.d-flex').dataset.id;
                fetch('actions/jadwal_actions.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `action=delete&id_jadwal=${projectId}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Project deleted successfully!');
                            location.reload();
                        } else {
                            alert('Failed to delete project: ' + data.message);
                        }
                    });
            }
        });
    });
});
                                        </script>
 
 
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


           <!-- gantt js-->
        <script src="../../assets/js/vendor/frappe-gantt.min.js"></script>

        <!-- demo app -->
        <script src="../../assets/js/pages/demo.project-gantt.js"></script>
        <!-- end demo js-->
         <!-- end demo js-->
 
     </body>
 
 <!-- Mirrored from coderthemes.com/hyper/saas/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:22:01 GMT -->
 </html>
