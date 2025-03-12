<?php
include_once('Database/koneksi.php');
session_start();

// Handle delete operation
if (isset($_GET['delete'])) {
    $id_trial = $_GET['delete'];
    $sql = "DELETE FROM trial WHERE id_trial = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_trial);
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Trial deleted successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: trial.php');
    exit();
}

// Handle update operation
if (isset($_POST['update'])) {
    $id_trial = $_POST['id_trial'];
    $tanggal = $_POST['tanggal'];
    $jam_start = $_POST['jam_start'];
    $jam_finish = $_POST['jam_finish'];
    $mc_name = $_POST['mc_name'];
    $kapasitas = $_POST['kapasitas'];
    $cush_prec = $_POST['cush_prec'];
    $pin_cus_qtt = $_POST['pin_cus_qtt'];
    $die_height = $_POST['die_height'];
    $die_dim = $_POST['die_dim'];
    $problem_tool = $_POST['problem_tool'];
    $analisa_sebab_tool = $_POST['analisa_sebab_tool'];
    $counter_measure_tool = $_POST['counter_measure_tool'];
    $problem_part = $_POST['problem_part'];
    $analisa_sebab_part = $_POST['analisa_sebab_part'];
    $counter_measure_part = $_POST['counter_measure_part'];
    $PIC = $_POST['PIC'];
    $target = $_POST['target'];
    $keterangan = $_POST['keterangan'];
    $kelengkapan_dies = $_POST['kelengkapan_dies'];
    $accuracy_part = $_POST['accuracy_part'];
    $id_proses = $_POST['id_proses'];

    // Update data in database
    $sql = "UPDATE trial SET tanggal = ?, jam_start = ?, jam_finish = ?, mc_name = ?, kapasitas = ?, cush_prec = ?, pin_cus_qtt = ?, die_height = ?, die_dim = ?, problem_tool = ?, analisa_sebab_tool = ?, counter_measure_tool = ?, problem_part = ?, analisa_sebab_part = ?, counter_measure_part = ?, PIC = ?, target = ?, keterangan = ?, kelengkapan_dies = ?, accuracy_part = ?, id_proses = ? WHERE id_trial = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiiisssssssssiisi", $tanggal, $jam_start, $jam_finish, $mc_name, $kapasitas, $cush_prec, $pin_cus_qtt, $die_height, $die_dim, $problem_tool, $analisa_sebab_tool, $counter_measure_tool, $problem_part, $analisa_sebab_part, $counter_measure_part, $PIC, $target, $keterangan, $kelengkapan_dies, $accuracy_part, $id_proses, $id_trial);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Trial updated successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Trial updated successfully.'); window.location.href='trial.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Handle insert operation
if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $jam_start = $_POST['jam_start'];
    $jam_finish = $_POST['jam_finish'];
    $mc_name = $_POST['mc_name'];
    $kapasitas = $_POST['kapasitas'];
    $cush_prec = $_POST['cush_prec'];
    $pin_cus_qtt = $_POST['pin_cus_qtt'];
    $die_height = $_POST['die_height'];
    $die_dim = $_POST['die_dim'];
    $problem_tool = $_POST['problem_tool'];
    $analisa_sebab_tool = $_POST['analisa_sebab_tool'];
    $counter_measure_tool = $_POST['counter_measure_tool'];
    $problem_part = $_POST['problem_part'];
    $analisa_sebab_part = $_POST['analisa_sebab_part'];
    $counter_measure_part = $_POST['counter_measure_part'];
    $PIC = $_POST['PIC'];
    $target = $_POST['target'];
    $keterangan = $_POST['keterangan'];
    $kelengkapan_dies = $_POST['kelengkapan_dies'];
    $accuracy_part = $_POST['accuracy_part'];
    $id_proses = $_POST['id_proses'];

    // Insert data into database
    $sql = "INSERT INTO trial (tanggal, jam_start, jam_finish, mc_name, kapasitas, cush_prec, pin_cus_qtt, die_height, die_dim, problem_tool, analisa_sebab_tool, counter_measure_tool, problem_part, analisa_sebab_part, counter_measure_part, PIC, target, keterangan, kelengkapan_dies, accuracy_part, id_proses) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiiisssssssssiis", $tanggal, $jam_start, $jam_finish, $mc_name, $kapasitas, $cush_prec, $pin_cus_qtt, $die_height, $die_dim, $problem_tool, $analisa_sebab_tool, $counter_measure_tool, $problem_part, $analisa_sebab_part, $counter_measure_part, $PIC, $target, $keterangan, $kelengkapan_dies, $accuracy_part, $id_proses);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Trial inserted successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Trial inserted successfully.'); window.location.href='trial.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Fetch data for editing
if (isset($_GET['edit'])) {
    $id_trial = $_GET['edit'];
    $sql = "SELECT * FROM trial WHERE id_trial = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_trial);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch data for detail view
if (isset($_GET['detail'])) {
    $id_trial = $_GET['detail'];
    $sql = "SELECT t.*, p.part_no FROM trial t JOIN proses p ON t.id_proses = p.id_proses WHERE t.id_trial = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_trial);
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
    <title>Create Trial | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
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
                                                    <h6 class="text-uppercase fw-bold">Trial Information</h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['tanggal']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jam Start</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['jam_start']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jam Finish</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['jam_finish']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>M/C Name</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['mc_name']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kapasitas</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['kapasitas']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cush Prec</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['cush_prec']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pin Cus Qtt</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['pin_cus_qtt']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Die Height</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['die_height']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Die Dim</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['die_dim']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Problem Tool</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['problem_tool']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Analisa Sebab Tool</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['analisa_sebab_tool']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Counter Measure Tool</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['counter_measure_tool']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Problem Part</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['problem_part']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Analisa Sebab Part</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['analisa_sebab_part']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Counter Measure Part</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['counter_measure_part']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>PIC</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['PIC']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Target</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['target']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Keterangan</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['keterangan']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kelengkapan Dies</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['kelengkapan_dies']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Accuracy Part</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['accuracy_part']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Part No</th>
                                                            <td>: <?php echo htmlspecialchars($detail_data['part_no']); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="trial.php" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left"></i> Back
                                            </a>
                                            <a href="trial.php?edit=<?php echo $detail_data['id_trial']; ?>" class="btn btn-info">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                        </div>
                                    <?php elseif (isset($_GET['edit'])): ?>
                                        <!-- Edit Form -->
                                        <form action="trial.php" method="post">
                                            <input type="hidden" name="id_trial" value="<?php echo htmlspecialchars($edit_data['id_trial']); ?>">
                                            <input type="hidden" name="update" value="true">
                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($edit_data['tanggal']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jam_start" class="form-label">Jam Start</label>
                                                <input type="text" class="form-control" id="jam_start" name="jam_start" value="<?php echo htmlspecialchars($edit_data['jam_start']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jam_finish" class="form-label">Jam Finish</label>
                                                <input type="text" class="form-control" id="jam_finish" name="jam_finish" value="<?php echo htmlspecialchars($edit_data['jam_finish']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mc_name" class="form-label">M/C Name</label>
                                                <input type="text" class="form-control" id="mc_name" name="mc_name" value="<?php echo htmlspecialchars($edit_data['mc_name']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                                <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="<?php echo htmlspecialchars($edit_data['kapasitas']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cush_prec" class="form-label">Cush Prec</label>
                                                <input type="text" class="form-control" id="cush_prec" name="cush_prec" value="<?php echo htmlspecialchars($edit_data['cush_prec']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pin_cus_qtt" class="form-label">Pin Cus Qtt</label>
                                                <input type="text" class="form-control" id="pin_cus_qtt" name="pin_cus_qtt" value="<?php echo htmlspecialchars($edit_data['pin_cus_qtt']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="die_height" class="form-label">Die Height</label>
                                                <input type="text" class="form-control" id="die_height" name="die_height" value="<?php echo htmlspecialchars($edit_data['die_height']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="die_dim" class="form-label">Die Dim</label>
                                                <input type="text" class="form-control" id="die_dim" name="die_dim" value="<?php echo htmlspecialchars($edit_data['die_dim']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="problem_tool" class="form-label">Problem Tool</label>
                                                <input type="text" class="form-control" id="problem_tool" name="problem_tool" value="<?php echo htmlspecialchars($edit_data['problem_tool']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="analisa_sebab_tool" class="form-label">Analisa Sebab Tool</label>
                                                <input type="text" class="form-control" id="analisa_sebab_tool" name="analisa_sebab_tool" value="<?php echo htmlspecialchars($edit_data['analisa_sebab_tool']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="counter_measure_tool" class="form-label">Counter Measure Tool</label>
                                                <input type="text" class="form-control" id="counter_measure_tool" name="counter_measure_tool" value="<?php echo htmlspecialchars($edit_data['counter_measure_tool']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="problem_part" class="form-label">Problem Part</label>
                                                <input type="text" class="form-control" id="problem_part" name="problem_part" value="<?php echo htmlspecialchars($edit_data['problem_part']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="analisa_sebab_part" class="form-label">Analisa Sebab Part</label>
                                                <input type="text" class="form-control" id="analisa_sebab_part" name="analisa_sebab_part" value="<?php echo htmlspecialchars($edit_data['analisa_sebab_part']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="counter_measure_part" class="form-label">Counter Measure Part</label>
                                                <input type="text" class="form-control" id="counter_measure_part" name="counter_measure_part" value="<?php echo htmlspecialchars($edit_data['counter_measure_part']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="PIC" class="form-label">PIC</label>
                                                <input type="text" class="form-control" id="PIC" name="PIC" value="<?php echo htmlspecialchars($edit_data['PIC']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="target" class="form-label">Target</label>
                                                <input type="text" class="form-control" id="target" name="target" value="<?php echo htmlspecialchars($edit_data['target']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo htmlspecialchars($edit_data['keterangan']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kelengkapan_dies" class="form-label">Kelengkapan Dies</label>
                                                <input type="text" class="form-control" id="kelengkapan_dies" name="kelengkapan_dies" value="<?php echo htmlspecialchars($edit_data['kelengkapan_dies']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="accuracy_part" class="form-label
                                                ">Accuracy Part</label>
                                                <input type="text" class="form-control" id="accuracy_part" name="accuracy_part" value="<?php echo htmlspecialchars($edit_data['accuracy_part']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_proses" class="form-label">Proses</label>
                                                <select class="form-select" id="id_proses" name="id_proses" required>
                                                    <option value="">Select Proses</option>
                                                    <?php
                                                    $sql = "SELECT id_proses, Proses FROM proses";
                                                    $result = $conn->query($sql);
                                                    while ($row = $result->fetch_assoc()) {
                                                        $selected = ($edit_data['id_proses'] == $row['id_proses']) ? 'selected' : '';
                                                        echo '<option value="' . $row['id_proses'] . '" ' . $selected . '>' . $row['Proses'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="trial.php" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </form>
                                        <?php else: ?>
<!-- Create Form -->
<button class="btn btn-primary" id="show-insert-form">Insert New Trial</button>
<form action="trial.php" method="post" id="insert-form" style="display: none;">
    <input type="hidden" name="submit" value="true">
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
    </div>
    <div class="mb-3">
        <label for="id_proses" class="form-label">Proses</label>
        <select class="form-select" id="id_proses" name="id_proses" required>
            <option value="">Select Proses</option>
            <?php
            $sql = "SELECT id_proses, Proses FROM proses";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_proses'] . '">' . $row['Proses'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="jam_start" class="form-label">Jam Start</label>
        <input type="text" class="form-control" id="jam_start" name="jam_start" required>
    </div>
    <div class="mb-3">
        <label for="jam_finish" class="form-label">Jam Finish</label>
        <input type="text" class="form-control" id="jam_finish" name="jam_finish" required>
    </div>
    <div class="mb-3">
        <label for="mc_name" class="form-label">M/C Name</label>
        <input type="text" class="form-control" id="mc_name" name="mc_name" required>
    </div>
    <div class="mb-3">
        <label for="kapasitas" class="form-label">Kapasitas</label>
        <input type="text" class="form-control" id="kapasitas" name="kapasitas" required>
    </div>
    <div class="mb-3">
        <label for="cush_prec" class="form-label">Cush Prec</label>
        <input type="text" class="form-control" id="cush_prec" name="cush_prec" required>
    </div>
    <div class="mb-3">
        <label for="pin_cus_qtt" class="form-label">Pin Cus Qtt</label>
        <input type="text" class="form-control" id="pin_cus_qtt" name="pin_cus_qtt" required>
    </div>
    <div class="mb-3">
        <label for="die_height" class="form-label">Die Height</label>
        <input type="text" class="form-control" id="die_height" name="die_height" required>
    </div>
    <div class="mb-3">
        <label for="die_dim" class="form-label">Die Dim</label>
        <input type="number" class="form-control" id="die_dim" name="die_dim" required>
    </div>
    <div class="mb-3">
        <label for="problem_tool" class="form-label">Problem Tool</label>
        <input type="text" class="form-control" id="problem_tool" name="problem_tool" required>
    </div>
    <div class="mb-3">
        <label for="analisa_sebab_tool" class="form-label">Analisa Sebab Tool</label>
        <input type="text" class="form-control" id="analisa_sebab_tool" name="analisa_sebab_tool" required>
    </div>
    <div class="mb-3">
        <label for="counter_measure_tool" class="form-label">Counter Measure Tool</label>
        <input type="text" class="form-control" id="counter_measure_tool" name="counter_measure_tool" required>
    </div>
    <div class="mb-3">
        <label for="problem_part" class="form-label">Problem Part</label>
        <input type="text" class="form-control" id="problem_part" name="problem_part" required>
    </div>
    <div class="mb-3">
        <label for="analisa_sebab_part" class="form-label">Analisa Sebab Part</label>
        <input type="text" class="form-control" id="analisa_sebab_part" name="analisa_sebab_part" required>
    </div>
    <div class="mb-3">
        <label for="counter_measure_part" class="form-label">Counter Measure Part</label>
        <input type="text" class="form-control" id="counter_measure_part" name="counter_measure_part" required>
    </div>
    <div class="mb-3">
        <label for="PIC" class="form-label">PIC</label>
        <input type="text" class="form-control" id="PIC" name="PIC" required>
    </div>
    <div class="mb-3">
        <label for="target" class="form-label">Target</label>
        <input type="text" class="form-control" id="target" name="target" required>
    </div>
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
    </div>
    <div class="mb-3">
        <label for="kelengkapan_dies" class="form-label">Kelengkapan Dies</label>
        <input type="text" class="form-control" id="kelengkapan_dies" name="kelengkapan_dies" required>
    </div>
    <div class="mb-3">
        <label for="accuracy_part" class="form-label">Accuracy Part</label>
        <input type="text" class="form-control" id="accuracy_part" name="accuracy_part" required>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" id="hide-insert-form">Back</button>
    </div>
</form>
<?php endif; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body" id="table-container">
    <h4 class="card-title">Trial List</h4>
    <div class="table-responsive">
        <table class="table table-centered table-nowrap table-hover mb-0">
            <thead>
                <tr>
                    <th class="border-0">No</th>
                    <th class="border-0">Tanggal</th>
                    <th class="border-0">Jam Start</th>
                    <th class="border-0">Jam Finish</th>
                    <th class="border-0">M/C Name</th>
                    <th class="border-0">Kapasitas</th>
                    <th class="border-0">PIC</th>
                    <th class="border-0">Proses</th>
                    <th class="border-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT t.*, p.Proses FROM trial t JOIN proses p ON t.id_proses = p.id_proses";
                $result = $conn->query($sql);
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $row['tanggal'] . '</td>';
                    echo '<td>' . $row['jam_start'] . '</td>';
                    echo '<td>' . $row['jam_finish'] . '</td>';
                    echo '<td>' . $row['mc_name'] . '</td>';
                    echo '<td>' . $row['kapasitas'] . '</td>';
                    echo '<td>' . $row['PIC'] . '</td>';
                    echo '<td>' . $row['Proses'] . '</td>';
                    echo '<td>';
                    echo '<a href="trial.php?detail=' . $row['id_trial'] . '" class="btn btn-info btn-sm">Detail</a>';
                    echo '<a href="trial.php?edit=' . $row['id_trial'] . '" class="btn btn-warning btn-sm">Edit</a>';
                    echo '<a href="trial.php?delete=' . $row['id_trial'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<script>
document.getElementById('show-insert-form').addEventListener('click', function() {
    document.getElementById('insert-form').style.display = 'block';
    document.getElementById('table-container').style.display = 'none';
    this.style.display = 'none';
});

document.getElementById('hide-insert-form').addEventListener('click', function() {
    document.getElementById('insert-form').style.display = 'none';
    document.getElementById('table-container').style.display = 'block';
    document.getElementById('show-insert-form').style.display = 'block';
});
</script>
</div>
</div>
</div>

</div>
</div>
<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>
</body>
</html>