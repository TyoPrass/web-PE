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
    $trial = $_POST['trial'];
    $mc_name = $_POST['mc_name'];
    $kapasitas = $_POST['kapasitas'];
    $cush_prec = $_POST['cush_prec'];
    $pin_cus_qtt = $_POST['pin_cus_qtt'];
    $die_height = $_POST['die_height'];
    $die_dim = $_POST['die_dim'];
    $problem_tool = $_POST['problem_tool'];
    $analisa_sebab_tool = $_POST['analisa_sebab_tool'];
    $counter_measure_tool = $_POST['counter_measure_tool'];
    $pic_tool = $_POST['pic_tool'];
    $target_tool = $_POST['target_tool'];
    $keterangan_tool = $_POST['keterangan_tool'];
    
    $target = $_POST['target'];
    $keterangan = $_POST['keterangan'];
    $problem_part = $_POST['problem_part'];
    $analisa_sebab_part = $_POST['analisa_sebab_part'];
    $counter_measure_part = $_POST['counter_measure_part'];
    $PIC = $_POST['PIC'];
    $target = $_POST['target'];
    $keterangan = $_POST['keterangan'];
    $kelengkapan_dies = $_POST['kelengkapan_dies'];
    $accuracy_part = $_POST['accuracy_part'];
    $id_proses = $_POST['id_proses'];
    $id_part = $_POST['id_part'];
    $id_customer = $_POST['id_customer'];
    $qty_trial = $_POST['qty_trial'];
    $jumlah_ok = $_POST['jumlah_ok'];
    $jumlah_ng = $_POST['jumlah_ng'];
    $visual = $_POST['visual'];
    $dimensi = $_POST['dimensi'];
    $fungsi = $_POST['fungsi'];
    $judgement = $_POST['judgement'];
    $dibuat = $_POST['dibuat'];
    $diperiksa = $_POST['diperiksa'];
    $diketahui = $_POST['diketahui'];
    $peserta = $_POST['peserta'];

    // Update data in database
    $sql = "UPDATE trial SET tanggal = ?, jam_start = ?, jam_finish = ?, trial= ?, mc_name = ?, kapasitas = ?, cush_prec = ?, pin_cus_qtt = ?, die_height = ?, die_dim = ?, problem_tool = ?, analisa_sebab_tool = ?, pic_tool = ?, target_tool = ?, keterangan_tool = ?, counter_measure_tool = ?, problem_part = ?, analisa_sebab_part = ?, counter_measure_part = ?, PIC = ?, target = ?, keterangan = ?, kelengkapan_dies = ?, accuracy_part = ?, id_proses = ?, id_part = ?, id_customer = ?, qty_trial = ?, jumlah_ok = ?, jumlah_ng = ?, visual = ?, dimensi = ?, fungsi = ?, judgement = ?, dibuat = ?, diperiksa = ?, diketahui = ?, peserta = ? WHERE id_trial = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiiiiisssssssssssssiiiiissssssssssi", $tanggal, $jam_start, $jam_finish, $trial, $mc_name, $kapasitas, $cush_prec, $pin_cus_qtt, $die_height, $die_dim, $problem_tool, $analisa_sebab_tool, $pic_tool, $target_tool, $keterangan_tool,  $counter_measure_tool, $problem_part, $analisa_sebab_part, $counter_measure_part, $PIC, $target, $keterangan, $kelengkapan_dies, $accuracy_part, $id_proses, $id_part, $id_customer, $qty_trial, $jumlah_ok, $jumlah_ng, $visual, $dimensi, $fungsi, $judgement, $dibuat, $diperiksa, $diketahui, $peserta, $id_trial);

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

// Handling Insert Operation
// Pastikan koneksi database tersedia

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id_customer = $_POST['id_customer'];
    $id_part = $_POST['id_part'];
    $id_proses = $_POST['id_proses'];

    // Fetch the corresponding names based on the selected IDs
    $sql_customer = "SELECT nama_customer FROM customer WHERE id_customer = ?";
    $stmt_customer = $conn->prepare($sql_customer);
    $stmt_customer->bind_param("i", $id_customer);
    $stmt_customer->execute();
    $result_customer = $stmt_customer->get_result();
    $nama_customer = $result_customer->fetch_assoc()['nama_customer'];
    $stmt_customer->close();

    $sql_part = "SELECT nama_part FROM data_part WHERE id_part = ?";
    $stmt_part = $conn->prepare($sql_part);
    $stmt_part->bind_param("i", $id_part);
    $stmt_part->execute();
    $result_part = $stmt_part->get_result();
    $nama_part = $result_part->fetch_assoc()['nama_part'];
    $stmt_part->close();

    $sql_proses = "SELECT Proses FROM proses WHERE id_proses = ?";
    $stmt_proses = $conn->prepare($sql_proses);
    $stmt_proses->bind_param("i", $id_proses);
    $stmt_proses->execute();
    $result_proses = $stmt_proses->get_result();
    $Proses = $result_proses->fetch_assoc()['Proses'];
    $stmt_proses->close();

    // Ambil data lainnya dari form
    $tanggal = $_POST['tanggal'];
    $jam_start = $_POST['jam_start'];
    $jam_finish = $_POST['jam_finish'];
    $mc_name = $_POST['mc_name'];
    $trial = $_POST['trial'];
    $kapasitas = $_POST['kapasitas'];
    $cush_prec = $_POST['cush_prec'];
    $pin_cus_qtt = $_POST['pin_cus_qtt'];
    $die_height = $_POST['die_height'];
    $die_dim = $_POST['die_dim'];
    $problem_tool = $_POST['problem_tool'];
    $analisa_sebab_tool = $_POST['analisa_sebab_tool'];
    $counter_measure_tool = $_POST['counter_measure_tool'];
    $pic_tool = $_POST['pic_tool'];
    $target_tool = $_POST['target_tool'];
    $keterangan_tool = $_POST['keterangan_tool'];
    $problem_part = $_POST['problem_part'];
    $analisa_sebab_part = $_POST['analisa_sebab_part'];
    $counter_measure_part = $_POST['counter_measure_part'];
    $PIC = $_POST['PIC'];
    $target = $_POST['target'];
    $keterangan = $_POST['keterangan'];
    $kelengkapan_dies = $_POST['kelengkapan_dies'];
    $accuracy_part = $_POST['accuracy_part'];
    $qty_trial = $_POST['qty_trial'];
    $jumlah_ok = $_POST['jumlah_ok'];
    $jumlah_ng = $_POST['jumlah_ng'];
    $visual = $_POST['visual'];
    $dimensi = $_POST['dimensi'];
    $fungsi = $_POST['fungsi'];
    $judgement = $_POST['judgement'];
    $dibuat = $_POST['dibuat'];
    $diperiksa = $_POST['diperiksa'];
    $diketahui = $_POST['diketahui'];
    $peserta = $_POST['peserta'];

    // Tambahan kolom baru
    $part_no = $_POST['part_no'];
    $project = $_POST['project'];
    $mat_spec = $_POST['mat_spec'];
    $mat_size = $_POST['mat_size'];

    // Query INSERT dengan kolom tambahan
    $sql = "INSERT INTO trial 
        (tanggal, jam_start, jam_finish, trial, mc_name, kapasitas, cush_prec, pin_cus_qtt, die_height, die_dim, 
        problem_tool, analisa_sebab_tool, counter_measure_tool, pic_tool, target_tool, keterangan_tool, problem_part, analisa_sebab_part, 
        counter_measure_part, PIC, target, keterangan, kelengkapan_dies, accuracy_part, id_proses, id_part, id_customer, 
        qty_trial, jumlah_ok, jumlah_ng, visual, dimensi, fungsi, judgement, dibuat, diperiksa, diketahui, peserta, 
        part_no, project, mat_spec, mat_size, nama_customer, nama_part, Proses) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters (sesuai jumlah dan tipe data)
    $stmt->bind_param(
        "sssssiiiiisssssssssssssiiiiisssssssssssssssss",
        $tanggal, $jam_start, $jam_finish, $trial, $mc_name, 
        $kapasitas, $cush_prec, $pin_cus_qtt, $die_height, $die_dim, 
        $problem_tool, $analisa_sebab_tool, $counter_measure_tool, 
        $pic_tool, $target_tool, $keterangan_tool,
        $problem_part, $analisa_sebab_part, $counter_measure_part, 
        $PIC, $target, $keterangan, $kelengkapan_dies, $accuracy_part, 
        $id_proses, $id_part, $id_customer,
        $qty_trial, $jumlah_ok, $jumlah_ng, $visual, $dimensi, $fungsi, $judgement,
        $dibuat, $diperiksa, $diketahui, $peserta,
        $part_no, $project, $mat_spec, $mat_size,
        $nama_customer, $nama_part, $Proses
    );

    // Eksekusi statement
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Trial inserted successfully.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Trial inserted successfully.'); window.location.href='trial.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
        echo "<script>alert('Error saat insert data: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Tutup statement
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
    <title>Create Trial | TRIAL & REPORT | PE STAMPING </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- Quill css -->
    <!-- Quill css -->
    <link href="assets/css/vendor/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/quill.snow.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">



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
                                            <div class="col-12 mb-3">
                                                <button class="btn btn-primary" onclick="printReport()">
                                                    <i class="mdi mdi-printer"></i> Print Report
                                                </button>
                                                <button class="btn btn-success" onclick="exportPDF()">
                                                    <i class="mdi mdi-file-pdf"></i> Save as PDF
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body" id="printable-content">
                                                        <h4 class="card-title">Trial Details</h4>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Basic Information</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Customer</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['nama_customer']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Part Name</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['nama_part']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Process</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['Proses']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Part No</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['part_no']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Project</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['project']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Material Specification</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['mat_spec']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Material Size</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['mat_size']); ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Trial Information</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Trial</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['trial']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Date</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['tanggal']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Start Time</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jam_start']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Finish Time</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jam_finish']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Machine Name</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['mc_name']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Capacity</th>
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
                                                                                <th>Die Dimension</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['die_dim']); ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Production Results</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Qty Trial</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['qty_trial']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>OK Parts</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jumlah_ok']); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>NG Parts</th>
                                                                                <td>: <?php echo htmlspecialchars($detail_data['jumlah_ng']); ?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Final Assessment</h5>
                                                                        <table class="table table-sm table-borderless">
                                                                            <tr>
                                                                                <th style="width: 35%;">Visual</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['visual'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['visual']; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Dimension</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['dimensi'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['dimensi']; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Function</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['fungsi'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['fungsi']; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Final Judgement</th>
                                                                                <td>: <span class="badge bg-<?php echo ($detail_data['judgement'] == 'OK') ? 'success' : 'danger'; ?>"><?php echo $detail_data['judgement']; ?></span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                   <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Approvals</h5>
                                                                        <div class="timeline">
                                                                            <div class="timeline-item">
                                                                                <i class="mdi mdi-account-check text-primary"></i>
                                                                                <span class="time">Created by</span>
                                                                                <p><?php echo htmlspecialchars($detail_data['dibuat']); ?></p>
                                                                            </div>
                                                                            <div class="timeline-item">
                                                                                <i class="mdi mdi-clipboard-check text-info"></i>
                                                                                <span class="time">Checked by</span>
                                                                                <p><?php echo htmlspecialchars($detail_data['diperiksa']); ?></p>
                                                                            </div>
                                                                            <div class="timeline-item">
                                                                                <i class="mdi mdi-shield-check text-success"></i>
                                                                                <span class="time">Approved by</span>
                                                                                <p><?php echo htmlspecialchars($detail_data['diketahui']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <h6 class="mt-3">Participants:</h6>
                                                                        <p><?php echo htmlspecialchars($detail_data['peserta']); ?></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Tool Problems</h5>
                                                                        <div class="mb-3">
                                                                            <h6 class="mt-3">Problem Description:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['problem_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Root Cause Analysis:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['analisa_sebab_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Countermeasures:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['counter_measure_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">PIC:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['pic_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Target:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['target_tool']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Remarks:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['keterangan_tool']); ?>
                                                                            </div>

                                                                            <h6 class="mt-3">Kelengkapan Dies:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['kelengkapan_dies']); ?>
                                                                            </div>
                                                                            
                                                                      
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card mb-3">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Part Problems</h5>
                                                                        <div class="mb-3">
                                                                            <h6 class="mt-3">Problem Description:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['problem_part']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Root Cause Analysis:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['analisa_sebab_part']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Countermeasures:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['counter_measure_part']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">PIC:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['PIC']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Target:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['target']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Remarks:</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['keterangan']); ?>
                                                                            </div>
                                                                            
                                                                            <h6 class="mt-3">Accuracy Part :</h6>
                                                                            <div class="border rounded p-3 bg-light">
                                                                                <?php echo htmlspecialchars_decode($detail_data['accuracy_part']); ?>
                                                                            </div>
                                                                            
                                                                   
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                        </div>



<!-- Script for printing and PDF export -->
<script>
function printReport() {
    // Prepare for printing
    window.onbeforeprint = function() {
        // Add any preparation you need before printing
        document.body.classList.add('printing');
    };
    
    window.onafterprint = function() {
        // Cleanup after printing
        document.body.classList.remove('printing');
    };
    
    // Trigger print dialog
    window.print();
}

function exportPDF() {
    // Show loading message
    alert("Preparing PDF for download...");
    
    // In a real implementation, you would use a library like html2pdf.js or jsPDF
    // For now, we'll just use the browser's print to PDF functionality
    printReport();
    
    /* 
    // If you want to implement a proper PDF export, you would do something like:
    
    // Using html2pdf.js
    html2pdf()
        .set({
            margin: 10,
            filename: 'trial_report_<?php echo $detail_data['id_trial']; ?>.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, letterRendering: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        })
        .from(document.getElementById('printable-content'))
        .save();
    */
}
</script>
                                      

                                    <?php elseif (isset($_GET['edit'])): ?>
                                        <!-- Edit Form -->
                                    <!-- Edit Form -->
                                    <form action="trial.php" method="post" id="edit-form">
                                        <input type="hidden" name="id_trial" value="<?php echo htmlspecialchars($edit_data['id_trial']); ?>">
                                        <input type="hidden" name="update" value="true">

                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="id_customer" class="form-label">Nama Customer</label>
                                                    <select class="form-select" id="id_customer" name="id_customer" required>
                                                        <option value="">Nama Customer</option>
                                                        <?php
                                                        $sql = "SELECT id_customer, nama_customer FROM customer";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $selected = ($edit_data['id_customer'] == $row['id_customer']) ? 'selected' : '';
                                                            echo '<option value="' . $row['id_customer'] . '" ' . $selected . '>' . $row['nama_customer'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="id_part" class="form-label">Nama Part</label>
                                                    <select class="form-select" id="id_part" name="id_part" required>
                                                        <option value="">Nama Part</option>
                                                        <?php
                                                        $sql = "SELECT id_part, nama_part FROM data_part";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $selected = ($edit_data['id_part'] == $row['id_part']) ? 'selected' : '';
                                                            echo '<option value="' . $row['id_part'] . '" ' . $selected . '>' . $row['nama_part'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
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

                                                <!-- Part No -->
                                                <div class="mb-3">
                                                    <label for="part_no" class="form-label">Part No</label>
                                                    <select class="form-select" id="part_no" name="part_no" required>
                                                        <option value="">Select Part No</option>
                                                        <?php
                                                        // Get part_no from proses table based on selected id_part
                                                        $sql_part_no = "SELECT DISTINCT p.part_no 
                                                                        FROM proses p 
                                                                        INNER JOIN data_part dp ON p.id_part = dp.id_part";
                                                        if (!empty($edit_data['id_part'])) {
                                                            $sql_part_no .= " WHERE p.id_part = " . $edit_data['id_part'];
                                                        }
                                                        $result_part_no = $conn->query($sql_part_no);
                                                        while ($row = $result_part_no->fetch_assoc()) {
                                                            $selected = ($edit_data['part_no'] == $row['part_no']) ? 'selected' : '';
                                                            echo '<option value="' . htmlspecialchars($row['part_no']) . '" ' . $selected . '>' . htmlspecialchars($row['part_no']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Nama Project -->
                                                <div class="mb-3">
                                                    <label for="project" class="form-label">Nama Project</label>
                                                    <select class="form-select" id="project" name="project" required>
                                                        <option value="">Nama Project</option>
                                                        <?php
                                                        // Get project from customer table based on selected id_customer
                                                        $sql_project = "SELECT DISTINCT c.project 
                                                                       FROM customer c 
                                                                       INNER JOIN data_part dp ON c.id_customer = dp.id_customer";
                                                        if (!empty($edit_data['id_customer'])) {
                                                            $sql_project .= " WHERE c.id_customer = " . $edit_data['id_customer'];
                                                        }
                                                        $result_project = $conn->query($sql_project);
                                                        while ($row = $result_project->fetch_assoc()) {
                                                            $selected = ($edit_data['project'] == $row['project']) ? 'selected' : '';
                                                            echo '<option value="' . htmlspecialchars($row['project']) . '" ' . $selected . '>' . htmlspecialchars($row['project']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Mat Spec -->
                                                <div class="mb-3">
                                                    <label for="mat_spec" class="form-label">Mat Spec</label>
                                                    <select class="form-select" id="mat_spec" name="mat_spec" required>
                                                        <option value="">Mat Spec</option>
                                                        <?php
                                                        // Get mat_spec from proses table based on selected id_part
                                                        $sql_mat_spec = "SELECT DISTINCT p.mat_spec 
                                                                        FROM proses p 
                                                                        INNER JOIN data_part dp ON p.id_part = dp.id_part";
                                                        if (!empty($edit_data['id_part'])) {
                                                            $sql_mat_spec .= " WHERE p.id_part = " . $edit_data['id_part'];
                                                        }
                                                        $result_mat_spec = $conn->query($sql_mat_spec);
                                                        while ($row = $result_mat_spec->fetch_assoc()) {
                                                            $selected = ($edit_data['mat_spec'] == $row['mat_spec']) ? 'selected' : '';
                                                            echo '<option value="' . htmlspecialchars($row['mat_spec']) . '" ' . $selected . '>' . htmlspecialchars($row['mat_spec']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Mat Size -->
                                                <div class="mb-3">
                                                    <label for="mat_size" class="form-label">Mat Size</label>
                                                    <select class="form-select" id="mat_size" name="mat_size" required>
                                                        <option value="">Mat Size</option>
                                                        <?php
                                                        // Get mat_size from proses table based on selected id_part
                                                        $sql_mat_size = "SELECT DISTINCT p.mat_size 
                                                                        FROM proses p 
                                                                        INNER JOIN data_part dp ON p.id_part = dp.id_part";
                                                        if (!empty($edit_data['id_part'])) {
                                                            $sql_mat_size .= " WHERE p.id_part = " . $edit_data['id_part'];
                                                        }
                                                        $result_mat_size = $conn->query($sql_mat_size);
                                                        while ($row = $result_mat_size->fetch_assoc()) {
                                                            $selected = ($edit_data['mat_size'] == $row['mat_size']) ? 'selected' : '';
                                                            echo '<option value="' . htmlspecialchars($row['mat_size']) . '" ' . $selected . '>' . htmlspecialchars($row['mat_size']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <script>
                                                // Add event listener for id_part change to update related fields
                                                document.getElementById('id_part').addEventListener('change', function() {
                                                    const id_part = this.value;
                                                    if (id_part) {
                                                        // Update Part No dropdown
                                                        fetch(`get_part_data.php?type=part_no&id_part=${id_part}`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                updateDropdown('part_no', data);
                                                            });
                                                        
                                                        // Update Mat Spec dropdown
                                                        fetch(`get_part_data.php?type=mat_spec&id_part=${id_part}`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                updateDropdown('mat_spec', data);
                                                            });
                                                        
                                                        // Update Mat Size dropdown
                                                        fetch(`get_part_data.php?type=mat_size&id_part=${id_part}`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                updateDropdown('mat_size', data);
                                                            });
                                                    }
                                                });

                                                // Add event listener for id_customer change to update project field
                                                document.getElementById('id_customer').addEventListener('change', function() {
                                                    const id_customer = this.value;
                                                    if (id_customer) {
                                                        fetch(`get_part_data.php?type=project&id_customer=${id_customer}`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                updateDropdown('project', data);
                                                            });
                                                    }
                                                });

                                                // Helper function to update dropdowns
                                                function updateDropdown(dropdownId, data) {
                                                    const dropdown = document.getElementById(dropdownId);
                                                    dropdown.innerHTML = '<option value="">Select ' + dropdownId.replace('_', ' ') + '</option>';
                                                    data.forEach(item => {
                                                        const option = document.createElement('option');
                                                        option.value = item;
                                                        option.textContent = item;
                                                        dropdown.appendChild(option);
                                                    });
                                                }
                                                </script>

                                            </div>
                                        </div>

                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Trial</h5>
                                                <div class="mb-3">
                                                    <label for="trial" class="form-label">Trial</label>
                                                    <input type="text" class="form-control" id="trial" name="trial" required
                                                           value="<?php echo htmlspecialchars($edit_data['trial']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                                           value="<?php echo htmlspecialchars($edit_data['tanggal']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="jam_start" class="form-label">Jam Start</label>
                                                    <input type="time" class="form-control" id="jam_start" name="jam_start" required
                                                           value="<?php echo htmlspecialchars($edit_data['jam_start']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="jam_finish" class="form-label">Jam Finish</label>
                                                    <input type="time" class="form-control" id="jam_finish" name="jam_finish" required
                                                           value="<?php echo htmlspecialchars($edit_data['jam_finish']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="mc_name" class="form-label">M/C Name</label>
                                                    <input type="text" class="form-control" id="mc_name" name="mc_name" required
                                                           value="<?php echo htmlspecialchars($edit_data['mc_name']); ?>">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="kapasitas" class="form-label">Kapasitas</label>
                                                        <input type="text" class="form-control" id="kapasitas" name="kapasitas" required
                                                               value="<?php echo htmlspecialchars($edit_data['kapasitas']); ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="cush_prec" class="form-label">Cush Prec</label>
                                                        <input type="text" class="form-control" id="cush_prec" name="cush_prec" required
                                                               value="<?php echo htmlspecialchars($edit_data['cush_prec']); ?>">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label for="die_dim" class="form-label">Die Dim</label>
                                                        <input type="text" class="form-control" id="die_dim" name="die_dim" required
                                                               value="<?php echo htmlspecialchars($edit_data['die_dim']); ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="die_height" class="form-label">Die Height</label>
                                                        <input type="text" class="form-control" id="die_height" name="die_height" required
                                                               value="<?php echo htmlspecialchars($edit_data['die_height']); ?>">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label for="pin_cus_qtt" class="form-label">Pin Cus Qtt</label>
                                                        <input type="text" class="form-control" id="pin_cus_qtt" name="pin_cus_qtt" required
                                                               value="<?php echo htmlspecialchars($edit_data['pin_cus_qtt']); ?>">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label for="qty_trial" class="form-label">Qty Trial</label>
                                                        <input type="text" class="form-control" id="qty_trial" name="qty_trial" required
                                                               value="<?php echo htmlspecialchars($edit_data['qty_trial']); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="jumlah_ok" class="form-label">Jumlah OK</label>
                                                        <input type="text" class="form-control" id="jumlah_ok" name="jumlah_ok" required
                                                               value="<?php echo htmlspecialchars($edit_data['jumlah_ok']); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="jumlah_ng" class="form-label">Jumlah NG</label>
                                                        <input type="text" class="form-control" id="jumlah_ng" name="jumlah_ng" required
                                                               value="<?php echo htmlspecialchars($edit_data['jumlah_ng']); ?>">
                                                    </div>
                                                </div>
                                                
                                           
                                            </div>
                                        </div>

                                        <!-- Problem Tool Section -->
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Problem Tool</h5>

                                                <div class="mb-3">
                                                    <label for="problem_tool_editor" class="form-label">Problem Tool</label>
                                                    <div id="problem_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['problem_tool'] ?? ''); ?></div>
                                                    <input type="hidden" name="problem_tool" id="problem_tool_input" value="<?php echo htmlspecialchars($edit_data['problem_tool'] ?? ''); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="analisa_sebab_tool_editor" class="form-label">Analisa Sebab Tool</label>
                                                    <div id="analisa_sebab_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['analisa_sebab_tool'] ?? ''); ?></div>
                                                    <input type="hidden" name="analisa_sebab_tool" id="analisa_sebab_tool_input" value="<?php echo htmlspecialchars($edit_data['analisa_sebab_tool'] ?? ''); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="counter_measure_tool_editor" class="form-label">Counter Measure Tool</label>
                                                    <div id="counter_measure_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['counter_measure_tool'] ?? ''); ?></div>
                                                    <input type="hidden" name="counter_measure_tool" id="counter_measure_tool_input" value="<?php echo htmlspecialchars($edit_data['counter_measure_tool'] ?? ''); ?>">
                                                </div>
                                                
                                                <!-- Form fields for tool section -->
                                                <div class="mb-3">
                                                    <label for="pic_tool_editor" class="form-label">PIC Tool</label>
                                                    <div id="pic_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['pic_tool'] ?? ''); ?></div>
                                                    <input type="hidden" name="pic_tool" id="pic_tool_input" value="<?php echo htmlspecialchars($edit_data['pic_tool'] ?? ''); ?>">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="target_tool_editor" class="form-label">Target Tool</label>
                                                    <div id="target_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['target_tool'] ?? ''); ?></div>
                                                    <input type="hidden" name="target_tool" id="target_tool_input" value="<?php echo htmlspecialchars($edit_data['target_tool'] ?? ''); ?>">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="keterangan_tool_editor" class="form-label">Keterangan Tool</label>
                                                    <div id="keterangan_tool_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['keterangan_tool'] ?? ''); ?></div>
                                                    <input type="hidden" name="keterangan_tool" id="keterangan_tool_input" value="<?php echo htmlspecialchars($edit_data['keterangan_tool'] ?? ''); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="kelengkapan_dies" class="form-label">Kelengkapan Dies</label>
                                                    <input type="text" class="form-control" id="kelengkapan_dies" name="kelengkapan_dies" required
                                                           value="<?php echo htmlspecialchars($edit_data['kelengkapan_dies']); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Problem Part</h5>

                                                <div class="mb-3">
                                                    <label for="problem_part_editor" class="form-label">Problem Part</label>
                                                    <div id="problem_part_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['problem_part']); ?></div>
                                                    <input type="hidden" name="problem_part" id="problem_part_input" value="<?php echo htmlspecialchars($edit_data['problem_part']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="analisa_sebab_part_editor" class="form-label">Analisa Sebab Part</label>
                                                    <div id="analisa_sebab_part_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['analisa_sebab_part']); ?></div>
                                                    <input type="hidden" name="analisa_sebab_part" id="analisa_sebab_part_input" value="<?php echo htmlspecialchars($edit_data['analisa_sebab_part']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="counter_measure_part_editor" class="form-label">Counter Measure Part</label>
                                                    <div id="counter_measure_part_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['counter_measure_part']); ?></div>
                                                    <input type="hidden" name="counter_measure_part" id="counter_measure_part_input" value="<?php echo htmlspecialchars($edit_data['counter_measure_part']); ?>">
                                                </div>
                                                
                                                <!-- Tidak bisa di update bagian part -->
                                                <div class="mb-3">
                                                    <label for="PIC_editor" class="form-label">PIC</label>
                                                    <div id="PIC_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['PIC']); ?></div>
                                                    <input type="hidden" name="PIC" id="PIC_input" value="<?php echo htmlspecialchars($edit_data['PIC']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="target_editor" class="form-label">Target</label>
                                                    <div id="target_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['target']); ?></div>
                                                    <input type="hidden" name="target" id="target_input" value="<?php echo htmlspecialchars($edit_data['target']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="keterangan_editor" class="form-label">Keterangan</label>
                                                    <div id="keterangan_editor" style="height: 300px;"><?php echo htmlspecialchars_decode($edit_data['keterangan']); ?></div>
                                                    <input type="hidden" name="keterangan" id="keterangan_input" value="<?php echo htmlspecialchars($edit_data['keterangan']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="accuracy_part" class="form-label">Accuracy Part</label>
                                                    <input type="text" class="form-control" id="accuracy_part" name="accuracy_part" required value="<?php echo htmlspecialchars($edit_data['accuracy_part']); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Result Section -->
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Result</h5>
                                                <div class="mb-3">
                                                    <label for="visual" class="form-label">Visual</label>
                                                    <select class="form-select" id="visual" name="visual" required>
                                                        <option value="OK" <?php echo ($edit_data['visual'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                        <option value="NG" <?php echo ($edit_data['visual'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="dimensi" class="form-label">Dimensi</label>
                                                    <select class="form-select" id="dimensi" name="dimensi" required>
                                                        <option value="OK" <?php echo ($edit_data['dimensi'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                        <option value="NG" <?php echo ($edit_data['dimensi'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="fungsi" class="form-label">Fungsi</label>
                                                    <select class="form-select" id="fungsi" name="fungsi" required>
                                                        <option value="OK" <?php echo ($edit_data['fungsi'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                        <option value="NG" <?php echo ($edit_data['fungsi'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="judgement" class="form-label">Judgement</label>
                                                    <select class="form-select" id="judgement" name="judgement" required>
                                                        <option value="OK" <?php echo ($edit_data['judgement'] == 'OK') ? 'selected' : ''; ?>>OK</option>
                                                        <option value="NG" <?php echo ($edit_data['judgement'] == 'NG') ? 'selected' : ''; ?>>NG</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Approval Section -->
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Approval</h5>
                                                <div class="mb-3">
                                                    <label for="dibuat" class="form-label">Dibuat Oleh</label>
                                                    <input type="text" class="form-control" id="dibuat" name="dibuat" required
                                                           value="<?php echo htmlspecialchars($edit_data['dibuat']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="diperiksa" class="form-label">Diperiksa Oleh</label>
                                                    <input type="text" class="form-control" id="diperiksa" name="diperiksa" required
                                                           value="<?php echo htmlspecialchars($edit_data['diperiksa']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="diketahui" class="form-label">Diketahui Oleh</label>
                                                    <input type="text" class="form-control" id="diketahui" name="diketahui" required
                                                           value="<?php echo htmlspecialchars($edit_data['diketahui']); ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="peserta" class="form-label">Peserta</label>
                                                    <input type="text" class="form-control" id="peserta" name="peserta" required
                                                           value="<?php echo htmlspecialchars($edit_data['peserta']); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="trial.php" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </form>

                                 
                                        <?php else: ?>
<!-- Button untuk menampilkan form -->

<!-- Form Insert -->
<form action="trial.php" method="post" id="insert-form" style="display: none;">
    <input type="hidden" name="submit" value="true">

    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                <label for="id_customer" class="form-label">Nama Customer</label>
                <select class="form-select" id="id_customer" name="id_customer" required>
                    <option value="">Nama Customer</option>
                    <?php
                    $sql = "SELECT id_customer, nama_customer FROM customer";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_customer'] . '">' . $row['nama_customer'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_part" class="form-label">Nama Part</label>
                <select class="form-select" id="id_part" name="id_part" required>
                    <option value="">Nama Part</option>
                    <?php
                    $sql = "SELECT id_part, nama_part FROM data_part";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_part'] . '">' . $row['nama_part'] . '</option>';
                    }
                    ?>
                </select>
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
            <!-- Part No -->
            <div class="mb-3">
                <label for="part_no" class="form-label">Part No</label>
                <select class="form-select" id="part_no" name="part_no" required>
                    <option value="">Select Part No</option>
                    <?php
                    $sql = "SELECT DISTINCT part_no FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['part_no']) . '">' . htmlspecialchars($row['part_no']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Nama Project -->
            <div class="mb-3">
                <label for="project" class="form-label">Nama Project</label>
                <select class="form-select" id="project" name="project" required>
                    <option value="">Nama Project</option>
                    <?php
                    $sql = "SELECT DISTINCT project FROM customer";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['project']) . '">' . htmlspecialchars($row['project']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Mat Spec -->
            <div class="mb-3">
                <label for="mat_spec" class="form-label">Mat Spec</label>
                <select class="form-select" id="mat_spec" name="mat_spec" required>
                    <option value="">Mat Spec</option>
                    <?php
                    $sql = "SELECT DISTINCT mat_spec FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['mat_spec']) . '">' . htmlspecialchars($row['mat_spec']) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Mat Size -->
            <div class="mb-3">
                <label for="mat_size" class="form-label">Mat Size</label>
                <select class="form-select" id="mat_size" name="mat_size" required>
                    <option value="">Mat Size</option>
                    <?php
                    $sql = "SELECT DISTINCT mat_size FROM proses";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row['mat_size']) . '">' . htmlspecialchars($row['mat_size']) . '</option>';
                    }
                    ?>
                </select>
            </div>



        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Trial</h5>
            <div class="mb-3">
                <label for="trial" class="form-label">Trial</label>
                <input type="text" class="form-control" id="trial" name="trial" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            
            <div class="mb-3">
                <label for="jam_start" class="form-label">Jam Start</label>
                <input type="time" class="form-control" id="jam_start" name="jam_start" required>
            </div>
            
            <div class="mb-3">
                <label for="jam_finish" class="form-label">Jam Finish</label>
                <input type="time" class="form-control" id="jam_finish" name="jam_finish" required>
            </div>
            
            <div class="mb-3">
                <label for="mc_name" class="form-label">M/C Name</label>
                <input type="text" class="form-control" id="mc_name" name="mc_name" required>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="text" class="form-control" id="kapasitas" name="kapasitas" required>
                </div>
                <div class="col-md-6">
                    <label for="cush_prec" class="form-label">Cush Prec</label>
                    <input type="text" class="form-control" id="cush_prec" name="cush_prec" required>
                </div>
                <div class="col-md-6">
                    <label for="die_dim" class="form-label">Die Dim</label>
                    <input type="text" class="form-control" id="die_dim" name="die_dim" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="pin_cus_qtt" class="form-label">Pin Cus Qtt</label>
                    <input type="text" class="form-control" id="pin_cus_qtt" name="pin_cus_qtt" required>
                </div>
                <div class="col-md-6">
                    <label for="die_height" class="form-label">Die Height</label>
                    <input type="text" class="form-control" id="die_height" name="die_height" required>
                </div>

                <div class="mb-3">
                <label for="qty_trial" class="form-label">Qty Trial/Total Produksi</label>
                <input type="text" class="form-control" id="qty_trial" name="qty_trial" required>
                </div>
    
                <div class="row">
                    <div class="col-md-4">
                        <label for="jumlah_ok" class="form-label">Jumlah OK</label>
                        <input type="text" class="form-control" id="jumlah_ok" name="jumlah_ok" required>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah_ng" class="form-label">Jumlah NG</label>
                        <input type="text" class="form-control" id="jumlah_ng" name="jumlah_ng" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Problem Tool</h5>


        
         <!-- Uji Coba -->
         <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Problem Tools</h5>
                        <div id="snow-editor" style="height: 300px;">
                        </div>
                         <!-- Add hidden input to store Quill content -->
                        <input type="hidden" name="problem_tool" id="problem_tool">
                    </div>
                 </div>  

                <!-- Uji Coba  -->
                 <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Problem Analisa Penyebab</h5>
                    <div id="snow-editor2" style="height: 300px;">
                    </div>
                    <!-- Add hidden input to store Quill content -->
                    <input type="hidden" name="analisa_sebab_tool" id="analisa_sebab_tool">
                </div>
            </div>
      
            <!-- Uji Coba  -->
                 <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Counter Meassure</h5>
                    <div id="snow-editor3" style="height: 300px;">
                    </div>
                    <!-- Add hidden input to store Quill content -->
                    <input type="hidden" name="counter_measure_tool" id="counter_measure_tool">
                </div>
            </div>
          
            <!-- Uji Coba  -->
                 <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">PIC Tools</h5>
                    <div id="snow-editor4" style="height: 300px;">
                    </div>
                    <!-- Add hidden input to store Quill content -->
                    <input type="hidden" name="pic_tool" id="pic_tool">
                </div>
            </div>
            <!-- Uji Coba  -->
                 <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Target</h5>
                    <div id="snow-editor5" style="height: 300px;">
                    </div>
                    <!-- Add hidden input to store Quill content -->
                    <input type="hidden" name="target_tool" id="target_tool">
                </div>
            </div>
            <!-- Uji Coba  -->
                 <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Keterangan</h5>
                    <div id="snow-editor6" style="height: 300px;">
                    </div>
                    <!-- Add hidden input to store Quill content -->
                    <input type="hidden" name="keterangan_tool" id="keterangan_tool">
                </div>
                </div>

            <div class="mb-3">
            <label for="kelengkapan_dies" class="form-label">Kelengkapan Dies</label>
            <input type="text" class="form-control" id="kelengkapan_dies" name="kelengkapan_dies" required>
            </div>
    
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Problem Part</h5>
                    <!-- Uji 3 Ini -->

                    <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Problem Part</h5>
                        <div id="snow-editor7" style="height: 300px;"></div>
                        <input type="hidden" name="problem_part" id="problem_part">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Analisa Penyebab Part</h5>
                        <div id="snow-editor8" style="height: 300px;"></div>
                        <input type="hidden" name="analisa_sebab_part" id="analisa_sebab_part">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Counter Meassure Part</h5>
                        <div id="snow-editor9" style="height: 300px;"></div>
                        <input type="hidden" name="counter_measure_part" id="counter_measure_part">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">PIC</h5>
                        <div id="snow-editor10" style="height: 300px;"></div>
                        <input type="hidden" name="PIC" id="PIC">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Target</h5>
                        <div id="snow-editor11" style="height: 300px;"></div>
                        <input type="hidden" name="target" id="target">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Keterangan</h5>
                        <div id="snow-editor12" style="height: 300px;"></div>
                        <input type="hidden" name="keterangan" id="keterangan">
                    </div>
                </div>

            <div class="mb-3">
            <label for="accuracy_part" class="form-label">Accuracy Part</label>
            <input type="text" class="form-control" id="accuracy_part" name="accuracy_part" required>
            </div>
    
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Result</h5>
            <div class="mb-3">
                <label for="visual" class="form-label">Visual</label>
                <select class="form-select" id="visual" name="visual" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="dimensi" class="form-label">Dimensi</label>
                <select class="form-select" id="dimensi" name="dimensi" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fungsi" class="form-label">Fungsi</label>
                <select class="form-select" id="fungsi" name="fungsi" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="judgement" class="form-label">Judgement</label>
                <select class="form-select" id="judgement" name="judgement" required>
                    <option value="OK">OK</option>
                    <option value="NG">NG</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Approval</h5>
            
            <div class="mb-3">
                <label for="dibuat" class="form-label">Dibuat Oleh</label>
                <input type="text" class="form-control" id="dibuat" name="dibuat" required>
            </div>
            
            <div class="mb-3">
                <label for="diperiksa" class="form-label">Diperiksa Oleh</label>
                <input type="text" class="form-control" id="diperiksa" name="diperiksa" required>
            </div>
            
            <div class="mb-3">
                <label for="diketahui" class="form-label">Diketahui Oleh</label>
                <input type="text" class="form-control" id="diketahui" name="diketahui" required>
            </div>
            
            <div class="mb-3">
                <label for="peserta" class="form-label">Peserta</label>
                <input type="text" class="form-control" id="peserta" name="peserta" required>
            </div>
        </div>
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
<?php if (!isset($_GET['detail']) && !isset($_GET['edit'])): ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" id="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Trial List</h4>
                    <button class="btn btn-primary" id="show-insert-form">Insert New Trial</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="border-0">No</th>
                                <th class="border-0">Nama Part</th>
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
                            $sql = "SELECT t.*, a.nama_part, p.Proses  
                            FROM trial t 
                            JOIN proses p ON t.id_proses = p.id_proses 
                            JOIN data_part a ON t.id_part = a.id_part ORDER BY t.id_trial DESC";  
                    
                            $result = $conn->query($sql);
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td>' . $row['nama_part'] . '</td>';
                                echo '<td>' . $row['jam_start'] . '</td>';
                                echo '<td>' . $row['jam_finish'] . '</td>';
                                echo '<td>' . $row['mc_name'] . '</td>';
                                echo '<td>' . $row['kapasitas'] . '</td>';
                                echo '<td>' . $row['PIC'] . '</td>';
                                echo '<td>' . $row['Proses'] . '</td>';
                                echo '<td>';
                                echo '<a href="trial.php?detail=' . $row['id_trial'] . '" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i> </a> ';
                                echo '<a href="trial.php?edit=' . $row['id_trial'] . '" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i> </a> ';
                                echo '<a href="trial.php?delete=' . $row['id_trial'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')"><i class="mdi mdi-trash-can"></i> </a>';
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
</div>
<?php endif; ?>
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

// Ini 2
document.addEventListener('DOMContentLoaded', function () {
    // Konfigurasi toolbar Quill
    const toolbarOptions = [
        [{ font: [] }, { size: [] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ color: [] }, { background: [] }],
        [{ script: 'super' }, { script: 'sub' }],
        [{ header: [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
        [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
        ['direction', { align: [] }],
        ['link', 'image', 'video'],
        ['clean']
    ];

    // Konfigurasi umum Quill
    const quillConfig = {
        theme: 'snow',
        modules: { toolbar: toolbarOptions }
    };

    // Daftar editor dan input tersembunyi yang terkait
    const editors = [
    { editorId: '#snow-editor', inputId: 'problem_tool' },
    { editorId: '#snow-editor2', inputId: 'analisa_sebab_tool' },
    { editorId: '#snow-editor3', inputId: 'counter_measure_tool' },
    { editorId: '#snow-editor4', inputId: 'pic_tool' },
    { editorId: '#snow-editor5', inputId: 'target_tool' },
    { editorId: '#snow-editor6', inputId: 'keterangan_tool' },
    { editorId: '#snow-editor7', inputId: 'problem_part' },
    { editorId: '#snow-editor8', inputId: 'analisa_sebab_part' },
    { editorId: '#snow-editor9', inputId: 'counter_measure_part' },
    { editorId: '#snow-editor10', inputId: 'PIC' },
    { editorId: '#snow-editor11', inputId: 'target' },
    { editorId: '#snow-editor12', inputId: 'keterangan' },

];

// Inisialisasi semua editor Quill
const quillEditors = {};
editors.forEach(({ editorId, inputId }) => {
    const editorElement = document.querySelector(editorId);
    if (editorElement) {
        quillEditors[inputId] = new Quill(editorId, quillConfig);
        // Set nilai awal dari hidden input ke editor
        const hiddenInput = document.getElementById(inputId);
        if (hiddenInput) {
            quillEditors[inputId].root.innerHTML = hiddenInput.value;
        }
    } else {
        console.warn(`Editor dengan ID "${editorId}" tidak ditemukan.`);
    }
});

// Tangani pengiriman form
const form = document.querySelector('form');
if (form) {
    form.addEventListener('submit', function () {
        // Perbarui semua input tersembunyi dengan konten editor terkait
        Object.entries(quillEditors).forEach(([inputId, editor]) => {
            const hiddenInput = document.getElementById(inputId);
            if (hiddenInput) {
                hiddenInput.value = editor.root.innerHTML;
            } else {
                console.warn(`Input tersembunyi dengan ID "${inputId}" tidak ditemukan.`);
            }
        });
    });
} else {
    console.error('Elemen form tidak ditemukan.');
}
});
</script>

<script>
         document.addEventListener('DOMContentLoaded', function () {
             // Configure Quill toolbar
                    const toolbarOptions = [
                     [{ font: [] }, { size: [] }],
                      ['bold', 'italic', 'underline', 'strike'],
                     [{ color: [] }, { background: [] }],
                                        [{ script: 'super' }, { script: 'sub' }],
                                        [{ header: [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
                                        [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                                        ['direction', { align: [] }],
                                        ['link', 'image', 'video'],
                                        ['clean']
                                        ];
                                                                        
                                        // Initialize Quill editors for edit form
                                        const editorMappings = [
                                            { editor: 'problem_tool_editor', input: 'problem_tool_input' },
                                            { editor: 'analisa_sebab_tool_editor', input: 'analisa_sebab_tool_input' },
                                            { editor: 'counter_measure_tool_editor', input: 'counter_measure_tool_input' },
                                            { editor: 'pic_tool_editor', input: 'pic_tool_input' },
                                            { editor: 'target_tool_editor', input: 'target_tool_input' },
                                            { editor: 'keterangan_tool_editor', input: 'keterangan_tool_input' },
                                            { editor: 'problem_part_editor', input: 'problem_part_input' },
                                            { editor: 'analisa_sebab_part_editor', input: 'analisa_sebab_part_input' },
                                            { editor: 'counter_measure_part_editor', input: 'counter_measure_part_input' },
                                            { editor: 'PIC_editor', input: 'PIC_input' },
                                            { editor: 'target_editor', input: 'target_input' },
                                            { editor: 'keterangan_editor', input: 'keterangan_input' }
                                        ];
                                        
                                        // Initialize all editors
                                        editorMappings.forEach(mapping => {
                                            const editorElement = document.getElementById(mapping.editor);
                                            if (editorElement) {
                                                const quill = new Quill('#' + mapping.editor, {
                                                    theme: 'snow',
                                                    modules: {
                                                        toolbar: toolbarOptions
                                                    }
                                                });
                                                
                                                // When form is submitted, update hidden input with editor content
                                                const form = document.getElementById('edit-form');
                                                form.addEventListener('submit', function() {
                                                    const input = document.getElementById(mapping.input);
                                                    input.value = quill.root.innerHTML;
                                                });
                                            }
                                        });
                                    });
                                    </script>
</div>
</div>
</div>

</div>
</div>
<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>
<!-- <script src="assets/js/vendor/quill.min.js"></script>
<script src="assets/js/pages/demo.quilljs.js"></script> -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
</body>
</html>