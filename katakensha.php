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

// Define checklist2 structure
$checklist2 = [
    // A-Indicate Die
    ['group' => 'A-Indicate Die', 'no' => '1', 'point' => 'Part No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '2', 'point' => 'Process No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '3', 'point' => 'Dies Code No'],
    ['group' => 'A-Indicate Die', 'no' => '4', 'point' => 'Die Maker'],
    ['group' => 'A-Indicate Die', 'no' => '5', 'point' => 'Tahun Maker'],
    ['group' => 'A-Indicate Die', 'no' => '6', 'point' => 'Tanda F'],
    ['group' => 'A-Indicate Die', 'no' => '7', 'point' => 'Tanda Insert'],
    ['group' => 'A-Indicate Die', 'no' => '8', 'point' => 'Posisi Insert'],
    ['group' => 'A-Indicate Die', 'no' => '9', 'point' => 'Die Height'],
    ['group' => 'A-Indicate Die', 'no' => '10', 'point' => 'Cushion Posision'],
    ['group' => 'A-Indicate Die', 'no' => '11', 'point' => 'Tinggi Cushion'],
    ['group' => 'A-Indicate Die', 'no' => '12', 'point' => 'Presure Cushion'],

    // B-Stopper
    ['group' => 'Stopper', 'no' => '1', 'point' => 'Apakah stamping dimulai setelah pad menekan panel'],
    ['group' => 'Stopper', 'no' => '2', 'point' => 'Posisi Material'],
    ['group' => 'Stopper', 'no' => '3', 'point' => 'Dowel Pin Stopper'],

    // C-Clearence
    ['group' => 'C-Clearence', 'no' => '1', 'point' => 'Clearance sudah sesuai Standart'],
    ['group' => 'C-Clearence', 'no' => '2', 'point' => 'Apakah ada Ventilasi Udara'],
    ['group' => 'C-Clearence', 'no' => '3', 'point' => 'Surface Die / Punch'],

    // D-Spring/Urethane
    ['group' => 'D-Spring/Urethane', 'no' => '1', 'point' => 'Stroke Spring / Urethane sudah benar'],
    ['group' => 'D-Spring/Urethane', 'no' => '2', 'point' => 'Kekuatan Spring / Urethane sudah benar'],
    ['group' => 'D-Spring/Urethane', 'no' => '3', 'point' => 'Penempatan Urethane / Spring sudah benar'],
    ['group' => 'D-Spring/Urethane', 'no' => '4', 'point' => 'Posisi Striper Bolt sudah benar'],
    ['group' => 'D-Spring/Urethane', 'no' => '5', 'point' => 'Retainer Pinset sudah benar'],

    // E-Pad
    ['group' => 'E-Pad', 'no' => '1', 'point' => 'Slide PAD sudah sesuai spesifikasi'],
    ['group' => 'E-Pad', 'no' => '2', 'point' => 'Clearence PAD sesuai kebutuhan'],
    ['group' => 'E-Pad', 'no' => '3', 'point' => 'Sudut tajam sudah dihilangkan'],
    ['group' => 'E-Pad', 'no' => '4', 'point' => 'PAD sudah berfungsi dengan baik'],

    // F-Hardent
    ['group' => 'F-Hardent', 'no' => '1', 'point' => 'Punch sudah dihardent'],
    ['group' => 'F-Hardent', 'no' => '2', 'point' => 'Die sudah dihardent'],
    ['group' => 'F-Hardent', 'no' => '3', 'point' => 'Check Insert Die / Punch tidak boleh retak'],

    // G-Dowel Pin
    ['group' => 'G-Dowel Pin', 'no' => '1', 'point' => 'Dowel PIN sudah terpasang sesuai kebutuhan'],
    ['group' => 'G-Dowel Pin', 'no' => '2', 'point' => 'Dowel PIN Upper Die terpasang Screw Plug'],
    ['group' => 'G-Dowel Pin', 'no' => '3', 'point' => 'Penempatan posisi Dowel PIN sudah benar'],

    // H-Rip
    ['group' => 'H-Rip', 'no' => '1', 'point' => 'Rip sudah dibaut'],
    ['group' => 'H-Rip', 'no' => '2', 'point' => 'Rip sudah diwelding'],
    ['group' => 'H-Rip', 'no' => '3', 'point' => 'Penempatan Rib sudah sesuai'],
    ['group' => 'H-Rip', 'no' => '4', 'point' => 'Jarak welding Rib sudah sesuai'],

    // I-Guide Post
    ['group' => 'I-Guide Post', 'no' => '1', 'point' => 'Pokayoke Guide Post'],
    ['group' => 'I-Guide Post', 'no' => '2', 'point' => 'Guide Post sudah pada posisi center'],
    ['group' => 'I-Guide Post', 'no' => '3', 'point' => 'Tinggi Guide Post sudah sesuai'],
    ['group' => 'I-Guide Post', 'no' => '4', 'point' => 'Jumlah Guide Post sudah sesuai'],
    ['group' => 'I-Guide Post', 'no' => '5', 'point' => 'Baut & PIN Guide Post sudah dipasang'],

    // J-Bolt
    ['group' => 'J-Bolt', 'no' => '1', 'point' => 'Dies sudah menggunakan baut standar'],
    ['group' => 'J-Bolt', 'no' => '2', 'point' => 'Sistem pemasangan baut mudah untuk setting'],
    ['group' => 'J-Bolt', 'no' => '3', 'point' => 'Semua komponent Dies sudah di Baut dan di PIN'],

    // K-Cover
    ['group' => 'K-Cover', 'no' => '1', 'point' => 'Cover PAD sudah terpasang'],
    ['group' => 'K-Cover', 'no' => '2', 'point' => 'Cover spring CAM sudah terpasang'],




    // Additional groups can be added here...
];

// CheckList 3
$checklist3 = [
 
    // L-Chamfer
    ['group' => 'L-Chamfer', 'no' => '1', 'point' => 'Upper plate sudah di Chamfer'],
    ['group' => 'L-Chamfer', 'no' => '2', 'point' => 'Lower plate sudah di Chamfer'],
    ['group' => 'L-Chamfer', 'no' => '3', 'point' => 'Pada semua sudut sudah di Chamfer'],
    ['group' => 'L-Chamfer', 'no' => '4', 'point' => 'Semua hole baut & PIN sudah di Chamfer'],

    // M-Hook
    ['group' => 'M-Hook', 'no' => '1', 'point' => 'Hook sudah dibaut'],
    ['group' => 'M-Hook', 'no' => '2', 'point' => 'Hook sudah diwelding'],
    ['group' => 'M-Hook', 'no' => '3', 'point' => 'Hook ditambah safety behel'],

    // N-Shutter
    ['group' => 'N-Shutter', 'no' => '1', 'point' => 'Scrap shutter sudah ada & dipasang'],
    ['group' => 'N-Shutter', 'no' => '2', 'point' => 'Kemiringan shutter membuat scrap mudah jatuh'],
    ['group' => 'N-Shutter', 'no' => '3', 'point' => 'Pemasangan shutter sudah benar'],
    ['group' => 'N-Shutter', 'no' => '4', 'point' => 'Check apakah scrap mudah jatuh ( pada bagian dlm Die )'],
    ['group' => 'N-Shutter', 'no' => '5', 'point' => 'Check shutter tidak mengganggu operator dalam bekerja'],
    ['group' => 'N-Shutter', 'no' => '6', 'point' => 'Scrap Cam Pie dapat jatuh dengan mudah'],
    ['group' => 'N-Shutter', 'no' => '7', 'point' => 'Box scrap sudah ada'],
    ['group' => 'N-Shutter', 'no' => '8', 'point' => 'Arah jatuh scrap dengan arah jatuh Part berlainan'],

    // O-Pilot Pin
    ['group' => 'O-Pilot Pin', 'no' => '1', 'point' => 'Posisi Pillot Pin sudah satu sumbu ( Center )'],
    ['group' => 'O-Pilot Pin', 'no' => '2', 'point' => 'Posisi masuk Pillot Pin sudah standart'],

    // P-Pin Ejector
    ['group' => 'P-Pin Ejector', 'no' => '1', 'point' => 'Penempatan Ejector Pin sudah pada posisi yang benar'],
    ['group' => 'P-Pin Ejector', 'no' => '2', 'point' => 'Jumlah Ejector PIN sudah sesuai kebutuhan'],

    // Q-Dandori
    ['group' => 'Q-Dandori', 'no' => '1', 'point' => 'Pada Die Dipasang stopper Dandori'],

    // R-Cam
    ['group' => 'R-Cam', 'no' => '1', 'point' => 'Slide Cam sudah sesuai spesifikasi'],
    ['group' => 'R-Cam', 'no' => '2', 'point' => 'Cam sudah dibaut dan di Pin'],
    ['group' => 'R-Cam', 'no' => '3', 'point' => 'Stroke Cam sesuai dengan kebutuhan'],

    // S-Cut
    ['group' => 'S-Cut', 'no' => '1', 'point' => 'Prinsip kerja Cut / Blank sudah seperti gunting'],

    // T-Punch
    ['group' => 'T-Punch', 'no' => '1', 'point' => 'Bentuk Punch sudah standart kontruksi'],
    ['group' => 'T-Punch', 'no' => '2', 'point' => 'Pada penempatan Punch dipasang Back Up'],
    ['group' => 'T-Punch', 'no' => '3', 'point' => 'Jarak antara Baut dengan Blank Line sudah aman'],
    ['group' => 'T-Punch', 'no' => '4', 'point' => 'Penempatan Insert, Back Up sudah siku benar'],
    ['group' => 'T-Punch', 'no' => '5', 'point' => 'Tebal Back Up sudah standar ( 70% )'],

    // U-Ringstroke
    ['group' => 'U', 'no' => '1', 'point' => 'Ringstroke sudah dipasang'],
    ['group' => 'U', 'no' => '2', 'point' => 'Tinggi Ringstroke sesuai kebutuhan'],
    ['group' => 'U', 'no' => '3', 'point' => 'Ringstroke sudah dibaut ke Guide Post'],
    ['group' => 'U', 'no' => '4', 'point' => 'Ringstroke sudah dipainting kuning'],

    // V-End Block
    ['group' => 'V-End Block', 'no' => '1', 'point' => 'End blok sudah dipasang'],
    ['group' => 'V-End Block', 'no' => '2', 'point' => 'Tinggi End blok sesuai kebutuhan'],
    ['group' => 'V-End Block', 'no' => '3', 'point' => 'End blok sudah dibaut'],
    ['group' => 'V-End Block', 'no' => '4', 'point' => 'End blok sudah dipainting kuning'],

    // W-Safety
    ['group' => 'W-Safety', 'no' => '1', 'point' => 'Safety stroke sudah terpasang'],
    ['group' => 'W-Safety', 'no' => '2', 'point' => 'Tinggi safety sudah sesuai kebutuhan'],
    ['group' => 'W-Safety', 'no' => '3', 'point' => 'Safety stroke sudah di ikat'],
    ['group' => 'W-Safety', 'no' => '4', 'point' => 'Safety stroke sudah dipainting Merah'],
    ['group' => 'W-Safety', 'no' => '5', 'point' => 'Safety sensor sudah terpasang'],

    // X-Painting
    ['group' => 'X-Painting', 'no' => '1', 'point' => 'Dies sudah dipainting'],
    ['group' => 'X-Painting', 'no' => '2', 'point' => 'Painting dies sesuai permintaan Customer'],

    // Additional groups can be added here...
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

                    <ul class="nav nav-tabs mb-3" id="viewTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="view-dinamis-tab" data-bs-toggle="tab" data-bs-target="#view-dinamis" type="button" role="tab" aria-controls="view-dinamis" aria-selected="true">
                                <span class="d-none d-md-block">Dinamis</span>
                                <i class="mdi mdi-pencil-box d-md-none d-block"></i>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="view-statis-tab" data-bs-toggle="tab" data-bs-target="#view-statis" type="button" role="tab" aria-controls="view-statis" aria-selected="false">
                                <span class="d-none d-md-block">Statis</span>
                                <i class="mdi mdi-information-outline d-md-none d-block"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="viewTabContent">
                        <div class="tab-pane fade show active" id="view-dinamis" role="tabpanel" aria-labelledby="view-dinamis-tab">
                            <h4>Checklist Dinamis</h4>
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
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="view-statis" role="tabpanel" aria-labelledby="view-statis-tab">
                            <h4>Checklist Statis</h4>
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
                                    $startIndex = count($checklist);
                                    foreach ($checklist2 as $i => $item): 
                                        $index = $startIndex + $i;
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
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                                <!-- Statis content - Now editable like dinamis -->
                                <h4>Checklist 2 Items</h4>
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
                                        $checklist_data_combined = isset($editData) ? json_decode($editData['checklist_data'], true) : [];
                                        $currentGroup = '';
                                        $startIndex = count($checklist); // Start index for checklist2

                                        foreach ($checklist2 as $i => $item): 
                                            $index = $startIndex + $i; // Calculate actual index in the combined data
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
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][keterangan]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['keterangan'] ?? '') : ''; ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <h4>Checklist 3 Items</h4>
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
                                        $startIndex += count($checklist2); // Start index for checklist3

                                        foreach ($checklist3 as $i => $item): 
                                            $index = $startIndex + $i; // Calculate actual index in the combined data
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
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P1'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P2]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P2'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][P3]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['P3'] ?? '') : ''; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="checklist[<?php echo $index; ?>][keterangan]" 
                                                        class="form-control"
                                                        value="<?php echo isset($checklist_data_combined[$index]) ? htmlspecialchars($checklist_data_combined[$index]['keterangan'] ?? '') : ''; ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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