<?php
include_once('Database/koneksi.php');
session_start();

// Handle delete operation
if (isset($_GET['delete'])) {
    $id_part = $_GET['delete'];
    $sql = "SELECT gambar_part FROM data_part WHERE id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_part);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Delete old files
    if ($row['gambar_part']) {
        $old_files = explode(',', $row['gambar_part']);
        foreach ($old_files as $file) {
            $file_path = 'uploads/' . $file;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    $sql = "DELETE FROM data_part WHERE id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_part);
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Data deleted successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: halo.php');
    exit();
}

// Handle update operation
if (isset($_POST['update'])) {
    $id_part = $_POST['id_part'];
    $nama_part = $_POST['projectname'];
    $tanggal = $_POST['startdate'];
    $tgl_selesai = $_POST['duedate'];
    $id_customer = $_POST['id_customer'];
    $gambar_parts = [];

    // Convert date format from d-M-yyyy to yyyy-mm-dd
    $tanggal = date('Y-m-d', strtotime($tanggal));
    $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai));

    // Get existing images
    $sql = "SELECT gambar_part FROM data_part WHERE id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_part);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $existing_images = $row['gambar_part'] ? explode(',', $row['gambar_part']) : [];

    // Handle file uploads
    if (!empty($_FILES['file']['name'][0])) {
        $uploadFileDir = 'uploads/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Delete old files
        foreach ($existing_images as $old_file) {
            $file_path = $uploadFileDir . $old_file;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Upload new files
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $fileName = $_FILES['file']['name'][$key];
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($tmp_name, $dest_path)) {
                $gambar_parts[] = $fileName;
            }
        }
    } else {
        $gambar_parts = $existing_images;
    }

    // Update data in database
    $gambar_part = implode(',', $gambar_parts);
    $sql = "UPDATE data_part SET nama_part = ?, gambar_part = ?, tanggal = ?, tgl_selesai = ?, id_customer = ? WHERE id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $nama_part, $gambar_part, $tanggal, $tgl_selesai, $id_customer, $id_part);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Data updated successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Data updated successfully.'); window.location.href='halo.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Handle insert operation
if (isset($_POST['submit'])) {
    $nama_part = $_POST['projectname'];
    $tanggal = $_POST['startdate'];
    $tgl_selesai = $_POST['duedate'];
    $id_customer = $_POST['id_customer'];
    $gambar_parts = [];

    // Convert date format from d-M-yyyy to yyyy-mm-dd
    $tanggal = date('Y-m-d', strtotime($tanggal));
    $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai));

    // Handle file uploads
    if (!empty($_FILES['file']['name'][0])) {
        $uploadFileDir = 'uploads/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $fileName = $_FILES['file']['name'][$key];
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($tmp_name, $dest_path)) {
                $gambar_parts[] = $fileName;
            }
        }
    }

    // Insert data into database
    $gambar_part = implode(',', $gambar_parts);
    $sql = "INSERT INTO data_part (nama_part, gambar_part, tanggal, tgl_selesai, id_customer) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nama_part, $gambar_part, $tanggal, $tgl_selesai, $id_customer);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Data inserted successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Data inserted successfully.'); window.location.href='halo.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Fetch data for editing
if (isset($_GET['edit'])) {
    $id_part = $_GET['edit'];
    $sql = "SELECT * FROM data_part WHERE id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_part);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch data for detail view
if (isset($_GET['detail'])) {
    $id_part = $_GET['detail'];
    $sql = "SELECT dp.*, c.project FROM data_part dp JOIN customer c ON dp.id_customer = c.id_customer WHERE dp.id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_part);
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
    <title>Create Project | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="assets/css/dropzone.min.css" rel="stylesheet" type="text/css" />

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
<!-- filepath: /c:/laragon/www/coba/halo.php -->
<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
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
                                                    <h6 class="text-uppercase fw-bold">Part Information</h6>
                                                    <table class="table table-sm">
                                                       
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['nama_part']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Start Date</th>
                                                            <td>: <?php echo date('d M Y', strtotime($detail_data['tanggal'])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Due Date</th>
                                                            <td>: <?php echo date('d M Y', strtotime($detail_data['tgl_selesai'])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Created</th>
                                                            <td>: <?php echo date('d M Y H:i:s', strtotime($detail_data['created_at'] ?? 'now')); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Customer</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['project']); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-uppercase fw-bold">Status Timeline</h6>
                                                <div class="timeline">
                                                    <div class="timeline-item">
                                                        <i class="mdi mdi-clock-outline text-primary"></i>
                                                        <span class="time">Start: <?php echo date('d M Y', strtotime($detail_data['tanggal'])); ?></span>
                                                        <p>Project Started</p>
                                                    </div>
                                                    <div class="timeline-item">
                                                        <i class="mdi mdi-timer-sand text-warning"></i>
                                                        <span class="time">Due: <?php echo date('d M Y', strtotime($detail_data['tgl_selesai'])); ?></span>
                                                        <p>Expected Completion</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <h6 class="text-uppercase fw-bold">Part Images</h6>
                                            <div class="row g-2">
                                                <?php
                                                if (!empty($detail_data['gambar_part'])) {
                                                    $images = explode(',', $detail_data['gambar_part']);
                                                    foreach ($images as $image) {
                                                        if (file_exists('uploads/' . $image)) {
                                                            echo '<div class="col-md-4">
                                                                    <div class="card">
                                                                        <img src="uploads/' . htmlspecialchars($image) . '" 
                                                                             alt="Part Image" 
                                                                             class="card-img-top"
                                                                             style="height: 200px; object-fit: cover;">
                                                                        <div class="card-body p-2">
                                                                            <p class="card-text small text-muted mb-0">' . htmlspecialchars($image) . '</p>
                                                                            <a href="uploads/' . htmlspecialchars($image) . '" 
                                                                               class="btn btn-sm btn-primary mt-1"
                                                                               target="_blank">
                                                                                <i class="mdi mdi-eye"></i> View Full
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                  </div>';
                                                        }
                                                    }
                                                } else {
                                                    echo '<div class="col-12">
                                                            <div class="alert alert-info mb-0">
                                                                <i class="mdi mdi-information-outline me-1"></i>
                                                                No images available for this part.
                                                            </div>
                                                          </div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="halo.php" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left"></i> Back
                                            </a>
                                            <a href="halo.php?edit=<?php echo $detail_data['id_part']; ?>" class="btn btn-info">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                        </div>
                                    <?php elseif (isset($_GET['edit'])): ?>
                                        <!-- Edit Form -->
                                        <form action="halo.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_part" value="<?php echo htmlspecialchars($edit_data['id_part']); ?>">
                                            <input type="hidden" name="update" value="true">
                                            <div class="mb-3">
                                                <label for="projectname" class="form-label">Project Name</label>
                                                <input type="text" class="form-control" id="projectname" name="projectname" value="<?php echo htmlspecialchars($edit_data['nama_part']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="startdate" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="startdate" name="startdate" value="<?php echo htmlspecialchars($edit_data['tanggal']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="duedate" class="form-label">Due Date</label>
                                                <input type="date" class="form-control" id="duedate" name="duedate" value="<?php echo htmlspecialchars($edit_data['tgl_selesai']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_customer" class="form-label">Customer</label>
                                                <select class="form-control" id="id_customer" name="id_customer" required>
                                                    <?php
                                                    $sql = "SELECT id_customer, project FROM customer";
                                                    $result = $conn->query($sql);
                                                    while ($customer = $result->fetch_assoc()) {
                                                        $selected = $customer['id_customer'] == $edit_data['id_customer'] ? 'selected' : '';
                                                        echo "<option value='{$customer['id_customer']}' $selected>{$customer['project']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Upload Images</label>
                                                <input type="file" class="form-control" id="file" name="file[]" multiple>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    <?php elseif (isset($_GET['insert'])): ?>
                                        <!-- Insert Form -->
                                        <form action="halo.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="submit" value="true">
                                            <div class="mb-3">
                                                <label for="projectname" class="form-label">Project Name</label>
                                                <input type="text" class="form-control" id="projectname" name="projectname" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="startdate" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="startdate" name="startdate" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="duedate" class="form-label">Due Date</label>
                                                <input type="date" class="form-control" id="duedate" name="duedate" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_customer" class="form-label">Customer</label>
                                                <select class="form-control" id="id_customer" name="id_customer" required>
                                                    <?php
                                                    $sql = "SELECT id_customer, project FROM customer";
                                                    $result = $conn->query($sql);
                                                    while ($customer = $result->fetch_assoc()) {
                                                        echo "<option value='{$customer['id_customer']}'>{$customer['project']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Upload Images</label>
                                                <input type="file" class="form-control" id="file" name="file[]" multiple>
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
                                                        <th>Name</th>
                                                        <th>Gambar Part</th>
                                                        <th>Start Date</th>
                                                        <th>Due Date</th>
                                                        <th>Project</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT dp.*, c.project FROM data_part dp JOIN customer c ON dp.id_customer = c.id_customer ORDER BY dp.id_part ASC";
                                                    $result = $conn->query($sql);
                                                    $no = 1;
                                                    while ($row = $result->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo htmlspecialchars($row['nama_part']); ?></td>
                                                            <td>
                                                                <?php
                                                                if (!empty($row['gambar_part'])) {
                                                                    $images = explode(',', $row['gambar_part']);
                                                                    foreach ($images as $image) {
                                                                        if (file_exists('uploads/' . $image)) {
                                                                            echo '<img src="uploads/' . htmlspecialchars($image) . '" alt="Part Image" 
                                                                                  class="rounded" style="width: 50px; height: 50px; object-fit: cover; margin-right: 5px;">';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
                                                            <td><?php echo date('d M Y', strtotime($row['tgl_selesai'])); ?></td>
                                                            <td><?php echo htmlspecialchars($row['project']); ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="halo.php?edit=<?php echo $row['id_part']; ?>" 
                                                                       class="btn btn-info btn-sm" 
                                                                       data-bs-toggle="tooltip" 
                                                                       title="Edit">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </a>
                                                                    <a href="halo.php?delete=<?php echo $row['id_part']; ?>" 
                                                                       class="btn btn-danger btn-sm" 
                                                                       onclick="return confirm('Are you sure you want to delete this record?');"
                                                                       data-bs-toggle="tooltip" 
                                                                       title="Delete">
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </a>
                                                                    <a href="halo.php?detail=<?php echo $row['id_part']; ?>" 
                                                                       class="btn btn-primary btn-sm" 
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
                                        <div class="mt-3">
                                            <a href="halo.php?insert=true" class="btn btn-success">
                                                <i class="mdi mdi-plus"></i> Insert New Record
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
    <script src="assets/js/vendor/dropzone.min.js"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            url: 'halo.php',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 10,
            addRemoveLinks: true,
            paramName: 'file',
            init: function() {
                var myDropzone = this;
                var form = document.getElementById('dataForm');

                form.addEventListener('submit', function(e) {
                    if (myDropzone.getQueuedFiles().length > 0) {
                        e.preventDefault();
                        myDropzone.processQueue();
                    }
                });

                myDropzone.on("sendingmultiple", function(files, xhr, formData) {
                    var formElements = form.elements;
                    for (var i = 0; i < formElements.length; i++) {
                        formData.append(formElements[i].name, formElements[i].value);
                    }
                });

                myDropzone.on("successmultiple", function() {
                    window.location.href = 'halo.php';
                });

                myDropzone.on("errormultiple", function() {
                    alert('Error uploading files. Please try again.');
                });
            }
        };

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</body>
</html>
</html>