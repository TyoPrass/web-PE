<?php
include_once('Database/koneksi.php');
// Handle CRUD operations
$action = isset($_GET['action']) ? $_GET['action'] : 'view';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $nama_part = $_POST['nama_part'];
        $no_project = $_POST['no_project'];
        $status = $_POST['status'];
        $gantt_data = json_encode([
            "tasks" => [],
            "view_mode" => "Week"
        ]);

        $sql = "INSERT INTO projects (nama_part, no_project, status, gantt_data) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nama_part, $no_project, $status, $gantt_data);
        $stmt->execute();
        header("Location: gant.php");
        exit();
    } elseif ($action === 'edit') {
        $nama_part = $_POST['nama_part'];
        $no_project = $_POST['no_project'];
        $status = $_POST['status'];
        $gantt_data = $_POST['gantt_data'];

        $sql = "UPDATE projects SET nama_part = ?, no_project = ?, status = ?, gantt_data = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nama_part, $no_project, $status, $gantt_data, $id);
        $stmt->execute();
        header("Location: gant.php");
        exit();
    }
} elseif ($action === 'delete' && $id > 0) {
    $sql = "DELETE FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: gant.php");
    exit();
}

// Fetch projects for display
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/hyper/saas/apps-projects-gantt.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:06 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Projects Calendar | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- third party css -->
        <link href="assets/css/vendor/frappe-gantt.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
      
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
        

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                            <li class="breadcrumb-item active">Gantt</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Gantt</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <!-- Projects and Gantt Chart Section -->
                            <div class="col-xxl-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mt-0 mb-3">Projects</h5>
                                        <div class="app-search">
                                            <form>
                                                <div class="mb-2 position-relative">
                                                    <input type="text" class="form-control" placeholder="search by name..." />
                                                    <span class="mdi mdi-magnify search-icon"></span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="container mt-3">
                                            <?php if ($action === 'view'): ?>
                                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#taskModal">Add New Project</button>
                                                <div class="row">
                                                    <?php foreach ($projects as $project): ?>
                                                        <div class="col-md-12">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5><?php echo htmlspecialchars($project['nama_part']); ?></h5>
                                                                    <p>Project No: <?php echo htmlspecialchars($project['no_project']); ?></p>
                                                                    <p>Status: <?php echo htmlspecialchars($project['status']); ?></p>
                                                                    <a href="gant.php?action=edit&id=<?php echo $project['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                                    <a href="gant.php?action=delete&id=<?php echo $project['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Task Modal -->
                                        <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="gant.php?action=add" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="taskModalLabel">Add New Project</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_part" class="form-label">Nama Part</label>
                                                                <input type="text" class="form-control" id="nama_part" name="nama_part" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="no_project" class="form-label">No Project</label>
                                                                <input type="text" class="form-control" id="no_project" name="no_project" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status" required>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="In Progress">In Progress</option>
                                                                    <option value="Completed">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mt-0 mb-3">Gantt Chart</h5>
                                        <svg id="tasks-gantt"></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="assets/js/vendor/frappe-gantt.min.js"></script>
                        <script>
                            <?php if ($action === 'view' && !empty($projects)): ?>
                            const ganttData = <?php echo $projects[0]['gantt_data']; ?>; // Load Gantt data for the first project
                            const tasks = ganttData.tasks;

                            const gantt = new Gantt("#tasks-gantt", tasks, {
                                view_mode: ganttData.view_mode,
                                date_format: 'YYYY-MM-DD'
                            });
                            <?php endif; ?>
                        </script>
                                    <!-- end projects -->

                                    <!-- gantt view -->
                                    <!-- <div class="col-xxl-9 mt-4 mt-xl-0 col-lg-8">
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
                                    </div> -->
                                    <!-- end gantt view -->
                                </div>
                            </div>
                        </div>

                    </div> <!-- container -->

                </div> <!-- content -->

            
            </div>

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <!-- gantt js-->
        <script src="assets/js/vendor/frappe-gantt.min.js"></script>

        <!-- demo app -->
        <script src="assets/js/pages/demo.project-gantt.js"></script>
        <!-- end demo js-->

    </body>


<!-- Mirrored from coderthemes.com/hyper/saas/apps-projects-gantt.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:21:07 GMT -->
</html>
