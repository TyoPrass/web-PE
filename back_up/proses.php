<?php
include_once('Database/koneksi.php');
session_start();

// Handle delete operation
if (isset($_GET['delete'])) {
    $id_proses = $_GET['delete'];
    $sql = "DELETE FROM proses WHERE id_proses = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_proses);
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Proses deleted successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: proses.php');
    exit();
}

// Handle update operation
if (isset($_POST['update'])) {
    $id_proses = $_POST['id_proses'];
    $part_no = $_POST['part_no'];
    $proses = $_POST['proses'];
    $mat_spec = $_POST['mat_spec'];
    $mat_size = $_POST['mat_size'];
    $target_trial = $_POST['target_trial'];
    $id_part = $_POST['id_part'];

    // Handle file uploads
    $part_sketch = $_FILES['part_sketch']['name'];
    $layout_sketch = $_FILES['layout_sketch']['name'];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    move_uploaded_file($_FILES['part_sketch']['tmp_name'], $uploadDir . $part_sketch);
    move_uploaded_file($_FILES['layout_sketch']['tmp_name'], $uploadDir . $layout_sketch);

    // Update data in database
    $sql = "UPDATE proses SET part_no = ?, Proses = ?, mat_spec = ?, mat_size = ?, part_sketch = ?, layout_sketch = ?, target_trial = ?, id_part = ? WHERE id_proses = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssii", $part_no, $proses, $mat_spec, $mat_size, $part_sketch, $layout_sketch, $target_trial, $id_part, $id_proses);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Proses updated successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Proses updated successfully.'); window.location.href='proses.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Handle insert operation
if (isset($_POST['submit'])) {
    $part_no = $_POST['part_no'];
    $proses = $_POST['proses'];
    $mat_spec = $_POST['mat_spec'];
    $mat_size = $_POST['mat_size'];
    $target_trial = $_POST['target_trial'];
    $id_part = $_POST['id_part'];

    // Handle file uploads
    $part_sketch = $_FILES['part_sketch']['name'];
    $layout_sketch = $_FILES['layout_sketch']['name'];
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    move_uploaded_file($_FILES['part_sketch']['tmp_name'], $uploadDir . $part_sketch);
    move_uploaded_file($_FILES['layout_sketch']['tmp_name'], $uploadDir . $layout_sketch);

    // Insert data into database
    $sql = "INSERT INTO proses (part_no, Proses, mat_spec, mat_size, part_sketch, layout_sketch, target_trial, id_part) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $part_no, $proses, $mat_spec, $mat_size, $part_sketch, $layout_sketch, $target_trial, $id_part);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Proses inserted successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Proses inserted successfully.'); window.location.href='proses.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Fetch data for editing
if (isset($_GET['edit'])) {
    $id_proses = $_GET['edit'];
    $sql = "SELECT * FROM proses WHERE id_proses = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_proses);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch data for detail view
if (isset($_GET['detail'])) {
    $id_proses = $_GET['detail'];
    $sql = "SELECT p.*, dp.nama_part FROM proses p JOIN data_part dp ON p.id_part = dp.id_part WHERE p.id_proses = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_proses);
    $stmt->execute();
    $result = $stmt->get_result();
    $detail_data = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Create Proses | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    <style>
.timeline {
    position: relative;
    padding: 10px 0;
}

.timeline-item {
    position: relative;
    padding-left: 30px;
    margin-bottom: 15px;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: 11px;
    top: 0;
    height: 100%;
    width: 2px;
    background: #e3e6f0;
}

.timeline-item:last-child:before {
    display: none;
}

.timeline-item i {
    position: absolute;
    left: 0;
    top: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 50%;
}

.timeline-item .time {
    display: block;
    font-size: 0.85rem;
    color: #666;
}

.timeline-item p {
    margin: 0;
    font-weight: 500;
}
</style>
</head>
<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <div class="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
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
                                            <a href="proses.php" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left"></i> Back
                                            </a>
                                            <a href="proses.php?edit=<?php echo $detail_data['id_proses']; ?>" class="btn btn-info">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                        </div>
                                    <?php elseif (isset($_GET['edit'])): ?>
                                        <!-- Edit Form -->
                                        <form action="proses.php" method="post" enctype="multipart/form-data">
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
                                        <form action="proses.php" method="post" enctype="multipart/form-data">
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
                                            <button type="submit" class="btn btn-primary">Insert</button>
                                        </form>
                                    <?php else: ?>
                                        <!-- Display Records Table -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
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
                                                                    <a href="proses.php?edit=<?php echo $row['id_proses']; ?>" 
                                                                       class="btn btn-info btn-sm" 
                                                                       data-bs-toggle="tooltip" 
                                                                       title="Edit">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </a>
                                                                    <a href="proses.php?delete=<?php



                                                    echo $row['id_proses']; ?>" 
                                                                       class="btn btn-danger btn-sm" 
                                                                       data-bs-toggle="tooltip" 
                                                                       title="Delete"
                                                                       onclick="return confirm('Are you sure you want to delete this record?')">
                                                                        <i class="mdi mdi-trash-can"></i>
                                                                    </a>
                                                                    <a href="proses.php?detail=<?php echo $row['id_proses']; ?>" 
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
                                        <div class="mt-4">
                                            <a href="proses.php?insert" class="btn btn-primary">
                                                <i class="mdi mdi-plus"></i> Add New
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });
    </script>
</body>
</html>
