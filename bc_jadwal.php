<?php
include_once('Database/koneksi.php')
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
         <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/vendor/fixedHeader.bootstrap5.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/vendor/fixedColumns.bootstrap5.css" rel="stylesheet" type="text/css" />
         <!-- third party css end -->

         <link href="assets/css/vendor/frappe-gantt.css" rel="stylesheet" type="text/css" />

 
         <!-- App css -->
         <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
         <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
 
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
                         
                       
                        <!-- Gantt Chart Section -->
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
                                                            <input type="text" class="form-control" id="project-search"
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
                                                        <?php
                                                        // Fetch projects from the database
                                                        $sql = "SELECT * FROM projects ORDER BY id DESC";
                                                        $result = mysqli_query($conn, $sql);
                                                        
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $projectId = $row['id'];
                                                            $projectName = $row['name'];
                                                            $projectCode = $row['project_code'];
                                                            $status = $row['status'];
                                                            
                                                            // Determine badge color based on status
                                                            $badgeClass = "badge-success-lighten";
                                                            $statusText = "On Track";
                                                            $iconClass = "success";
                                                            
                                                            if ($status == 'delayed') {
                                                                $badgeClass = "badge-danger-lighten";
                                                                $statusText = "Delayed";
                                                                $iconClass = "danger";
                                                            } else if ($status == 'locked') {
                                                                $badgeClass = "badge-warning-lighten";
                                                                $statusText = "Locked";
                                                                $iconClass = "warning";
                                                            }
                                                        ?>
                                                        <a href="javascript:void(0);" class="text-body project-item" data-project-id="<?php echo $projectId; ?>">
                                                            <div class="d-flex mt-2 p-2">
                                                                <div class="avatar-sm d-table">
                                                                    <span class="avatar-title bg-<?php echo $iconClass; ?>-lighten rounded-circle text-<?php echo $iconClass; ?>">
                                                                        <i class='uil uil-moonset font-24'></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h5 class="mt-0 mb-0">
                                                                        <?php echo $projectName; ?>
                                                                        <span class="badge <?php echo $badgeClass; ?> ms-1"><?php echo $statusText; ?></span>
                                                                    </h5>
                                                                    <p class="mt-1 mb-0 text-muted">
                                                                        ID: <?php echo $projectCode; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <?php
                                                        }
                                                        
                                                        if (mysqli_num_rows($result) == 0) {
                                                            echo '<div class="text-center p-3">No projects found</div>';
                                                        }
                                                        ?>
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
                                                        <button type="button" class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-task-modal">
                                                            Add New Task
                                                        </button>
                                                    </div>
                                                    <div class="col text-sm-end">
                                                        <div class="btn-group btn-group-sm mb-2" data-bs-toggle="buttons" id="modes-filter">
                                                            <label class="btn btn-primary active">
                                                                <input class="btn-check" type="radio" name="modes" id="hday" value="Half Day" checked> Half Day
                                                            </label>
                                                            <label class="btn btn-primary">
                                                                <input class="btn-check" type="radio" name="modes" id="day" value="Day"> Day
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
                        </div>

                        <!-- Task Modal -->
                        <div id="add-task-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-task-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="add-task-modalLabel">Add Task</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <form id="task-form">
                                        <div class="modal-body">
                                            <input type="hidden" id="task-id" name="task_id">
                                            <input type="hidden" id="project-id" name="project_id">
                                            
                                            <div class="mb-3">
                                                <label for="task-name" class="form-label">Task Name</label>
                                                <input type="text" class="form-control" id="task-name" name="name" required>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="task-start" class="form-label">Start Date</label>
                                                        <input type="date" class="form-control" id="task-start" name="start" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="task-end" class="form-label">End Date</label>
                                                        <input type="date" class="form-control" id="task-end" name="end" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="task-progress" class="form-label">Progress (%)</label>
                                                <input type="number" class="form-control" id="task-progress" name="progress" min="0" max="100" value="0" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="task-status" class="form-label">Status</label>
                                                <select class="form-select" id="task-status" name="status" required>
                                                    <option value="on_track">On Track</option>
                                                    <option value="delayed">Delayed</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="task-dependencies" class="form-label">Dependencies (Task IDs, comma separated)</label>
                                                <input type="text" class="form-control" id="task-dependencies" name="dependencies" placeholder="e.g., 1, 2, 3">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="save-task-btn">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let currentProjectId = null;
                            let ganttChart = null;
                            let tasks = [];

                            // Load tasks when a project is clicked
                            document.querySelectorAll('.project-item').forEach(item => {
                                item.addEventListener('click', function() {
                                    const projectId = this.getAttribute('data-project-id');
                                    currentProjectId = projectId;
                                    document.getElementById('project-id').value = projectId;
                                    
                                    // Mark this project as active
                                    document.querySelectorAll('.project-item').forEach(p => {
                                        p.querySelector('.d-flex').classList.remove('bg-light');
                                    });
                                    this.querySelector('.d-flex').classList.add('bg-light');
                                    
                                    loadTasks(projectId);
                                });
                            });

                            // Search functionality
                            document.getElementById('project-search').addEventListener('keyup', function() {
                                const searchText = this.value.toLowerCase();
                                document.querySelectorAll('.project-item').forEach(item => {
                                    const projectName = item.querySelector('h5').textContent.toLowerCase();
                                    const projectId = item.querySelector('.text-muted').textContent.toLowerCase();
                                    if (projectName.includes(searchText) || projectId.includes(searchText)) {
                                        item.style.display = '';
                                    } else {
                                        item.style.display = 'none';
                                    }
                                });
                            });

                            // Task form submit handler
                            document.getElementById('task-form').addEventListener('submit', function(e) {
                                e.preventDefault();
                                
                                const taskId = document.getElementById('task-id').value;
                                const formData = new FormData(this);
                                
                                // Send to server
                                fetch('actions/task_actions.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Close modal and reload tasks
                                        $('#add-task-modal').modal('hide');
                                        loadTasks(currentProjectId);
                                        // Show success message
                                        alert('Task saved successfully!');
                                        // Reset form
                                        document.getElementById('task-form').reset();
                                        document.getElementById('task-id').value = '';
                                    } else {
                                        alert('Error: ' + data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred while saving the task');
                                });
                            });

                            // Load tasks for a project
                            function loadTasks(projectId) {
                                fetch(`actions/task_actions.php?project_id=${projectId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            tasks = data.tasks;
                                            renderGantt(tasks);
                                        } else {
                                            console.error('Error loading tasks:', data.message);
                                            tasks = [];
                                            renderGantt([]);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        tasks = [];
                                        renderGantt([]);
                                    });
                            }

                            // Render Gantt chart
                            function renderGantt(tasks) {
                                const ganttData = tasks.map(task => ({
                                    id: task.id.toString(),
                                    name: task.name,
                                    start: task.start_date,
                                    end: task.end_date,
                                    progress: task.progress,
                                    dependencies: task.dependencies ? task.dependencies.split(',').map(id => id.trim()) : [],
                                    custom_class: getTaskStatusClass(task.status)
                                }));

                                if (ganttChart) {
                                    ganttChart.refresh(ganttData);
                                } else {
                                    ganttChart = new Gantt("#tasks-gantt", ganttData, {
                                        view_mode: 'Day',
                                        on_click: function(task) {
                                            editTask(task.id);
                                        },
                                        on_date_change: function(task, start, end) {
                                            updateTaskDates(task.id, start, end);
                                        },
                                        on_progress_change: function(task, progress) {
                                            updateTaskProgress(task.id, progress);
                                        },
                                        on_view_change: function(mode) {
                                            console.log('View changed to ' + mode);
                                        }
                                    });
                                }
                            }

                            // Edit task
                            function editTask(taskId) {
                                const task = tasks.find(t => t.id.toString() === taskId.toString());
                                if (!task) return;
                                
                                document.getElementById('task-id').value = task.id;
                                document.getElementById('project-id').value = task.project_id;
                                document.getElementById('task-name').value = task.name;
                                document.getElementById('task-start').value = formatDateForInput(task.start_date);
                                document.getElementById('task-end').value = formatDateForInput(task.end_date);
                                document.getElementById('task-progress').value = task.progress;
                                document.getElementById('task-status').value = task.status;
                                document.getElementById('task-dependencies').value = task.dependencies || '';
                                
                                $('#add-task-modal').modal('show');
                            }

                            // Update task dates
                            function updateTaskDates(taskId, start, end) {
                                const formData = new FormData();
                                formData.append('action', 'update_dates');
                                formData.append('task_id', taskId);
                                formData.append('start', formatDateForDB(start));
                                formData.append('end', formatDateForDB(end));
                                
                                fetch('actions/task_actions.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        loadTasks(currentProjectId);
                                    } else {
                                        alert('Error: ' + data.message);
                                    }
                                });
                            }

                            // Update task progress
                            function updateTaskProgress(taskId, progress) {
                                const formData = new FormData();
                                formData.append('action', 'update_progress');
                                formData.append('task_id', taskId);
                                formData.append('progress', progress);
                                
                                fetch('actions/task_actions.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        loadTasks(currentProjectId);
                                    } else {
                                        alert('Error: ' + data.message);
                                    }
                                });
                            }

                            // Helper functions
                            function getTaskStatusClass(status) {
                                switch(status) {
                                    case 'delayed': return 'gantt-bar-danger';
                                    case 'completed': return 'gantt-bar-success';
                                    default: return 'gantt-bar-primary';
                                }
                            }

                            function formatDateForInput(dateStr) {
                                const date = new Date(dateStr);
                                return date.toISOString().split('T')[0];
                            }

                            function formatDateForDB(date) {
                                if (typeof date === 'string') {
                                    return date;
                                }
                                return date.toISOString().split('T')[0];
                            }

                            // View mode change listeners
                            document.getElementById('hday').addEventListener('change', function() {
                                if (this.checked && ganttChart) {
                                    ganttChart.change_view_mode('Half Day');
                                }
                            });

                            document.getElementById('day').addEventListener('change', function() {
                                if (this.checked && ganttChart) {
                                    ganttChart.change_view_mode('Day');
                                }
                            });
                        });
                        </script>

                        <!-- Create task_actions.php in actions folder with the following content: -->
                        <?php
                    
                        // This file should be created at actions/task_actions.php
                        include_once('Database/koneksi.php');

                        // Handle GET requests (loading tasks)
                        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['project_id'])) {
                            $projectId = intval($_GET['project_id']);
                            
                            // Fetch tasks for the project
                            $sql = "SELECT * FROM tasks WHERE project_id = ? ORDER BY id ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $projectId);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            $tasks = [];
                            while ($row = $result->fetch_assoc()) {
                                $tasks[] = $row;
                            }
                            
                            echo json_encode(['success' => true, 'tasks' => $tasks]);
                            exit;
                        }

                        // Handle POST requests (create/update tasks)
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['action']) && $_POST['action'] === 'update_dates') {
                                // Update task dates
                                $taskId = intval($_POST['task_id']);
                                $start = $_POST['start'];
                                $end = $_POST['end'];
                                
                                $sql = "UPDATE tasks SET start_date = ?, end_date = ? WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ssi", $start, $end, $taskId);
                                
                                if ($stmt->execute()) {
                                    echo json_encode(['success' => true]);
                                } else {
                                    echo json_encode(['success' => false, 'message' => 'Failed to update task dates']);
                                }
                                exit;
                            }
                            
                            if (isset($_POST['action']) && $_POST['action'] === 'update_progress') {
                                // Update task progress
                                $taskId = intval($_POST['task_id']);
                                $progress = intval($_POST['progress']);
                                
                                $sql = "UPDATE tasks SET progress = ? WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ii", $progress, $taskId);
                                
                                if ($stmt->execute()) {
                                    echo json_encode(['success' => true]);
                                } else {
                                    echo json_encode(['success' => false, 'message' => 'Failed to update task progress']);
                                }
                                exit;
                            }
                            
                            // Create or update a task
                            $taskId = isset($_POST['task_id']) && !empty($_POST['task_id']) ? intval($_POST['task_id']) : null;
                            $projectId = isset($_POST['project_id']) ? intval($_POST['project_id']) : null;
                            $name = $_POST['name'];
                            $start = $_POST['start'];
                            $end = $_POST['end'];
                            $progress = intval($_POST['progress']);
                            $status = $_POST['status'];
                            $dependencies = isset($_POST['dependencies']) ? $_POST['dependencies'] : '';
                            
                            if ($taskId) {
                                // Update existing task
                                $sql = "UPDATE tasks SET 
                                        name = ?, 
                                        start_date = ?, 
                                        end_date = ?, 
                                        progress = ?, 
                                        status = ?, 
                                        dependencies = ? 
                                        WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sssissi", $name, $start, $end, $progress, $status, $dependencies, $taskId);
                            } else {
                                // Create new task
                                $sql = "INSERT INTO tasks (project_id, name, start_date, end_date, progress, status, dependencies) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("isssiss", $projectId, $name, $start, $end, $progress, $status, $dependencies);
                            }
                            
                            if ($stmt->execute()) {
                                echo json_encode(['success' => true]);
                            } else {
                                echo json_encode(['success' => false, 'message' => 'Failed to save task: ' . $conn->error]);
                            }
                            exit;
                        }

                        echo json_encode(['success' => false, 'message' => 'Invalid request']);
                        
                        ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <!-- Parts Management Section -->
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
 
 
         <!-- bundle -->
         <script src="assets/js/vendor.min.js"></script>
         <script src="assets/js/app.min.js"></script>
 
         <!-- third party js -->
         <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
         <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
         <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
         <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
         <script src="assets/js/vendor/dataTables.buttons.min.js"></script>
         <script src="assets/js/vendor/buttons.bootstrap5.min.js"></script>
         <script src="assets/js/vendor/buttons.html5.min.js"></script>
         <script src="assets/js/vendor/buttons.flash.min.js"></script>
         <script src="assets/js/vendor/buttons.print.min.js"></script>
         <script src="assets/js/vendor/dataTables.keyTable.min.js"></script>
         <script src="assets/js/vendor/dataTables.select.min.js"></script>
         <script src="assets/js/vendor/fixedColumns.bootstrap5.min.js"></script>
         <script src="assets/js/vendor/fixedHeader.bootstrap5.min.js"></script>
         <!-- third party js ends -->
 
         <!-- demo app -->
         <script src="assets/js/pages/demo.datatable-init.js"></script>


           <!-- gantt js-->
        <script src="assets/js/vendor/frappe-gantt.min.js"></script>

        <!-- demo app -->
        <script src="assets/js/pages/demo.project-gantt.js"></script>
        <!-- end demo js-->
         <!-- end demo js-->
 
     </body>
 
 <!-- Mirrored from coderthemes.com/hyper/saas/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:22:01 GMT -->
 </html>
