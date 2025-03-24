<?php
// filepath: c:\laragon\www\coba\katakensha.php
include_once('Database/koneksi.php');
session_start();

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $part_no = $_POST['part_no'];
    $part_name = $_POST['part_name'];
    $date = $_POST['date'];
    $process = $_POST['process'];
    $checklist_data = json_encode($_POST['checklist']);

    if ($id) {
        // Update
        $sql = "UPDATE checklist_katakanesha SET part_no = ?, part_name = ?, date = ?, process = ?, checklist_data = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $part_no, $part_name, $date, $process, $checklist_data, $id);
    } else {
        // Create
        $sql = "INSERT INTO checklist_katakanesha (part_no, part_name, date, process, checklist_data) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $part_no, $part_name, $date, $process, $checklist_data);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = $id ? 'Checklist updated successfully.' : 'Checklist saved successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: katakensha.php');
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM checklist_katakanesha WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Checklist deleted successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: katakensha.php');
    exit();
}

// Fetch data for read
$sql = "SELECT * FROM checklist_katakanesha";
$result = $conn->query($sql);

// Prepare edit data if needed
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM checklist_katakanesha WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $editResult = $stmt->get_result();
    $editData = $editResult->fetch_assoc();
    $stmt->close();
}

// Define checklist structure
$checklist = [
    // A-Indicate Die
    ['group' => 'A-Indicate Die', 'no' => '1', 'point' => 'Part No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '2', 'point' => 'Process No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '3', 'point' => 'Dies Code No'],
    ['group' => 'A-Indicate Die', 'no' => '4', 'point' => 'Die Maker'],
    ['group' => 'A-Indicate Die', 'no' => '5', 'point' => 'Tahun Maker'],
    
    // B-Material
    ['group' => 'B-Material', 'no' => '1', 'point' => 'Material Type'],
    ['group' => 'B-Material', 'no' => '2', 'point' => 'Material Thickness'],
    ['group' => 'B-Material', 'no' => '3', 'point' => 'Surface Treatment'],
    ['group' => 'B-Material', 'no' => '4', 'point' => 'Mechanical Properties'],
    ['group' => 'B-Material', 'no' => '5', 'point' => 'Chemical Composition'],
    
    // C-Die Condition
    ['group' => 'C-Die Condition', 'no' => '1', 'point' => 'Wear and Tear'],
    ['group' => 'C-Die Condition', 'no' => '2', 'point' => 'Lubrication Status'],
    ['group' => 'C-Die Condition', 'no' => '3', 'point' => 'Cleanliness'],
    ['group' => 'C-Die Condition', 'no' => '4', 'point' => 'Damage Inspection'],
    ['group' => 'C-Die Condition', 'no' => '5', 'point' => 'Alignment Check'],
    
    // D-Maintenance
    ['group' => 'D-Maintenance', 'no' => '1', 'point' => 'Last Maintenance Date'],
    ['group' => 'D-Maintenance', 'no' => '2', 'point' => 'Next Maintenance Schedule'],
    ['group' => 'D-Maintenance', 'no' => '3', 'point' => 'Responsible Person'],
    ['group' => 'D-Maintenance', 'no' => '4', 'point' => 'Replacement Parts'],
    ['group' => 'D-Maintenance', 'no' => '5', 'point' => 'Maintenance Record'],
    
    // E-Quality
    ['group' => 'E-Quality', 'no' => '1', 'point' => 'Surface Finish'],
    ['group' => 'E-Quality', 'no' => '2', 'point' => 'Dimensional Accuracy'],
    ['group' => 'E-Quality', 'no' => '3', 'point' => 'Burr Formation'],
    ['group' => 'E-Quality', 'no' => '4', 'point' => 'Visual Defects'],
    ['group' => 'E-Quality', 'no' => '5', 'point' => 'Reject Rate'],
    
    // F-Safety
    ['group' => 'F-Safety', 'no' => '1', 'point' => 'Safety Guards'],
    ['group' => 'F-Safety', 'no' => '2', 'point' => 'Emergency Stops'],
    ['group' => 'F-Safety', 'no' => '3', 'point' => 'Operator Training'],
    ['group' => 'F-Safety', 'no' => '4', 'point' => 'PPE Requirements'],
    ['group' => 'F-Safety', 'no' => '5', 'point' => 'Safety Documentation'],
    
    // G-Productivity
    ['group' => 'G-Productivity', 'no' => '1', 'point' => 'Cycle Time'],
    ['group' => 'G-Productivity', 'no' => '2', 'point' => 'Output Rate'],
    ['group' => 'G-Productivity', 'no' => '3', 'point' => 'Machine Uptime'],
    ['group' => 'G-Productivity', 'no' => '4', 'point' => 'Tool Changeover Time'],
    ['group' => 'G-Productivity', 'no' => '5', 'point' => 'Production Efficiency'],
    
    // H-Documentation
    ['group' => 'H-Documentation', 'no' => '1', 'point' => 'Technical Drawings'],
    ['group' => 'H-Documentation', 'no' => '2', 'point' => 'Process Specifications'],
    ['group' => 'H-Documentation', 'no' => '3', 'point' => 'Quality Standards'],
    ['group' => 'H-Documentation', 'no' => '4', 'point' => 'Revision History'],
    ['group' => 'H-Documentation', 'no' => '5', 'point' => 'Storage Location']
];

// Add an attribute to identify the last item in each group
$currentGroup = '';
for ($i = 0; $i < count($checklist); $i++) {
    if ($i < count($checklist) - 1 && $checklist[$i]['group'] !== $checklist[$i + 1]['group']) {
        $checklist[$i]['is_last_in_group'] = true;
    } else {
        $checklist[$i]['is_last_in_group'] = false;
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist Katakanesha</title>
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <style>
     
        th, td {
            text-align: center;
        }
   
    </style>
    <!-- Datatables css -->
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <h2>Checklist Katakanesha Dinamis</h2>
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
                <a href="katakensha.php?insert" class="btn btn-success">Add New Checklist</a>
            </div>

            <!-- Read -->
            <h3>Checklist Data</h3>
            
            <div class="table-responsive">
                <table id="dinamis-datatable" class="table table-striped dt-responsive nowrap w-100">
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
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['part_no']; ?></td>
                                    <td><?php echo $row['part_name']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['process']; ?></td>
                                    <td>
                                        <a href="katakensha.php?view=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="katakensha.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="katakensha.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
                <a href="katakensha.php" class="btn btn-secondary">Back to List</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>View Checklist</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Part No</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['part_no']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Part Name</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['part_name']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['date']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Process</label>
                            <p class="form-control-static"><?php echo htmlspecialchars($viewData['process']); ?></p>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a href="#checklist-data" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                <i class="mdi mdi-clipboard-check d-md-none d-block"></i>
                                <span class="d-none d-md-block">Checklist Data</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#standard-items" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-format-list-bulleted d-md-none d-block"></i>
                                <span class="d-none d-md-block">Standard Items</span>
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane show active" id="checklist-data">
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
                                    // Add group header row if new group starts
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
                                    <?php if ($item['is_last_in_group']): ?>
                                    <tr class="table-light">
                                    <td colspan="7"></td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="standard-items">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>No</th>
                                            <th>Point Check</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $currentGroup = '';
                                        foreach ($checklist as $item): 
                                            // Add group header row if new group starts
                                            if ($currentGroup != $item['group']):
                                                $currentGroup = $item['group'];
                                            endif; 
                                        ?>
                                            <tr>
                                                <td><?php echo $item['group']; ?></td>
                                                <td><?php echo $item['no']; ?></td>
                                                <td><?php echo $item['point']; ?></td>
                                                <td>Standard checklist item</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-danger">Checklist not found.</div>
            <a href="katakensha.php" class="btn btn-secondary">Back to List</a>
            <?php endif; ?>

        <?php else: ?>
            <!-- Insert/Edit Form -->
            <div class="mb-3">
                <a href="katakensha.php" class="btn btn-secondary">Back to List</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><?php echo isset($_GET['edit']) ? 'Edit Checklist' : 'Add New Checklist'; ?></h3>
                </div>
                <div class="card-body">
                    <form action="katakensha.php" method="POST">
                        <?php if (isset($_GET['edit']) && $editData): ?>
                            <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                        <?php endif; ?>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="part_no" class="form-label">Part No</label>
                                <input type="text" class="form-control" id="part_no" name="part_no" value="<?php echo isset($editData) ? htmlspecialchars($editData['part_no']) : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="part_name" class="form-label">Part Name</label>
                                <input type="text" class="form-control" id="part_name" name="part_name" value="<?php echo isset($editData) ? htmlspecialchars($editData['part_name']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?php echo isset($editData) ? htmlspecialchars($editData['date']) : ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="process" class="form-label">Process</label>
                                <input type="text" class="form-control" id="process" name="process" value="<?php echo isset($editData) ? htmlspecialchars($editData['process']) : ''; ?>" required>
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
                            </div>
                            <div class="tab-pane fade" id="statis" role="tabpanel" aria-labelledby="statis-tab">
                                <!-- Statis content -->
                                <h4>Standard Checklist Items</h4>
                                <div class="alert alert-info">
                                    <p>This tab shows reference information for each checklist item.</p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Group</th>
                                                <th>No</th>
                                                <th>Point Check</th>
                                                <th>Description</th>
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
                                                    <td colspan="4"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                                </tr>
                                            <?php endif; ?>
                                                <tr>
                                                    <td><?php echo $item['group']; ?></td>
                                                    <td><?php echo $item['no']; ?></td>
                                                    <td><?php echo $item['point']; ?></td>
                                                    <td>Standard checklist item</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'Update' : 'Save'; ?> Checklist</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Datatables js -->
<!-- Add jQuery if not already included -->
<script src="assets/js/vendor/jquery.min.js"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<!-- Datatables js -->
<script src="assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
<script src="assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
<!-- Datatable Init js -->
<script src="assets/js/pages/demo.datatable-init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))
    triggerTabList.forEach(function(triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)
        triggerEl.addEventListener('click', function(event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })
})
</script>

</body>
</html>