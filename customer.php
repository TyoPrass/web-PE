<?php
include_once('Database/koneksi.php');
session_start();

// Handle delete operation
if (isset($_GET['delete'])) {
    $id_customer = $_GET['delete'];
    $sql = "DELETE FROM customer WHERE id_customer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_customer);
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Customer deleted successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: customer.php');
    exit();
}

// Handle update operation
if (isset($_POST['update'])) {
    $id_customer = $_POST['id_customer'];
    $nama_customer = $_POST['nama_customer'];
    $project = $_POST['project'];

    // Update data in database
    $sql = "UPDATE customer SET nama_customer = ?, project = ? WHERE id_customer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama_customer, $project, $id_customer);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Customer updated successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Customer updated successfully.'); window.location.href='customer.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Handle insert operation
if (isset($_POST['submit'])) {
    $nama_customer = $_POST['nama_customer'];
    $project = $_POST['project'];

    // Insert data into database
    $sql = "INSERT INTO customer (nama_customer, project) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama_customer, $project);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Customer inserted successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Customer inserted successfully.'); window.location.href='customer.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Fetch data for editing
if (isset($_GET['edit'])) {
    $id_customer = $_GET['edit'];
    $sql = "SELECT * FROM customer WHERE id_customer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_customer);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch data for detail view
if (isset($_GET['detail'])) {
    $id_customer = $_GET['detail'];
    $sql = "SELECT * FROM customer WHERE id_customer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_customer);
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
    <title>Create Customer | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
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
                                                    <h6 class="text-uppercase fw-bold">Customer Information</h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th width="130">ID Customer</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['id_customer']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['nama_customer']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Project</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['project']); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="customer.php" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left"></i> Back
                                            </a>
                                            <a href="customer.php?edit=<?php echo $detail_data['id_customer']; ?>" class="btn btn-info">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                        </div>
                                    <?php elseif (isset($_GET['edit'])): ?>
                                        <!-- Edit Form -->
                                        <form action="customer.php" method="post">
                                            <input type="hidden" name="id_customer" value="<?php echo htmlspecialchars($edit_data['id_customer']); ?>">
                                            <input type="hidden" name="update" value="true">
                                            <div class="mb-3">
                                                <label for="nama_customer" class="form-label">Customer Name</label>
                                                <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="<?php echo htmlspecialchars($edit_data['nama_customer']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="project" class="form-label">Project</label>
                                                <input type="text" class="form-control" id="project" name="project" value="<?php echo htmlspecialchars($edit_data['project']); ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    <?php elseif (isset($_GET['insert'])): ?>
                                        <!-- Insert Form -->
                                        <form action="customer.php" method="post">
                                            <input type="hidden" name="submit" value="true">
                                            <div class="mb-3">
                                                <label for="nama_customer" class="form-label">Customer Name</label>
                                                <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="project" class="form-label">Project</label>
                                                <input type="text" class="form-control" id="project" name="project" required>
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
                                                        <th>Project</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM customer ORDER BY id_customer ASC";
                                                    $result = $conn->query($sql);
                                                    $no = 1;
                                                    while ($row = $result->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo htmlspecialchars($row['nama_customer']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['project']); ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="customer.php?edit=<?php echo $row['id_customer']; ?>" 
                                                                       class="btn btn-info btn-sm" 
                                                                       data-bs-toggle="tooltip" 
                                                                       title="Edit">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </a>
                                                                    <a href="customer.php?delete=<?php echo $row['id_customer']; ?>" 
                                                                       class="btn btn-danger btn-sm" 
                                                                       onclick="return confirm('Are you sure you want to delete this record?');"
                                                                       data-bs-toggle="tooltip" 
                                                                       title="Delete">
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </a>
                                                                    <a href="customer.php?detail=<?php echo $row['id_customer']; ?>" 
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
                                            <a href="customer.php?insert=true" class="btn btn-success">
                                                <i class="mdi mdi-plus"></i> Insert New Customer
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
    </script>
</body>
</html>