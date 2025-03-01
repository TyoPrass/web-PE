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
    header('Location: tambah_part.php');
    exit();
}

// Handle update operation
if (isset($_POST['update'])) {
    $id_part = $_POST['id_part'];
    $nama_part = $_POST['projectname'];
    $tanggal = $_POST['startdate'];
    $tgl_selesai = $_POST['duedate'];
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
    $sql = "UPDATE data_part SET nama_part = ?, gambar_part = ?, tanggal = ?, tgl_selesai = ? WHERE id_part = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nama_part, $gambar_part, $tanggal, $tgl_selesai, $id_part);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Data updated successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Data updated successfully.'); window.location.href='tambah_part.php';</script>";
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
    $sql = "INSERT INTO data_part (nama_part, gambar_part, tanggal, tgl_selesai) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama_part, $gambar_part, $tanggal, $tgl_selesai);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Data inserted successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Data inserted successfully.'); window.location.href='tambah_part.php';</script>";
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

                                    <?php if (!isset($_GET['edit']) && !isset($_GET['insert'])): ?>
                                        <!-- Display Records Table -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Image</th>
                                                        <th>Start Date</th>
                                                        <th>Due Date</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM data_part ORDER BY id_part DESC";
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
                                    <?php else: ?>
                                        <!-- Insert/Update Form -->
                                        <form id="dataForm" action="halo.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_part" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label for="projectname" class="form-label">Name</label>
                                                        <input type="text" id="projectname" name="projectname" class="form-control" required
                                                               value="<?php echo isset($edit_data['nama_part']) ? htmlspecialchars($edit_data['nama_part']) : ''; ?>">
                                                    </div>
                                                    <div class="mb-3 position-relative" id="datepicker1">
                                                        <label class="form-label">Start Date</label>
                                                        <input type="text" name="startdate" class="form-control" required
                                                               data-provide="datepicker" data-date-format="d-M-yyyy" data-date-autoclose="true"
                                                               value="<?php echo isset($edit_data['tanggal']) ? date('d-M-Y', strtotime($edit_data['tanggal'])) : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="mb-3 mt-3 mt-xl-0">
                                                        <label class="mb-0">Gambar Part</label>
                                                        <div class="dropzone" id="myAwesomeDropzone"></div>
                                                    </div>
                                                    <div class="mb-3 position-relative" id="datepicker2">
                                                        <label class="form-label">Due Date</label>
                                                        <input type="text" name="duedate" class="form-control" required
                                                               data-provide="datepicker" data-date-format="d-M-yyyy" data-date-autoclose="true"
                                                               value="<?php echo isset($edit_data['tgl_selesai']) ? date('d-M-Y', strtotime($edit_data['tgl_selesai'])) : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'submit'; ?>" 
                                                    class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'Update' : 'Submit'; ?></button>
                                        </form>
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
    </script>
</body>
</html>