<?php
// filepath: c:\laragon\www\coba\katakensha.php
include_once('../../Database/koneksi.php');
session_start();

// Handle Create and Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $id_customer = $_POST['id_customer'];
    $id_part = $_POST['id_part'];
    $id_proses = $_POST['id_proses'];
    $date = $_POST['date'];
    $checklist_data = json_encode($_POST['checklist']);

    // Fetch related names for customer, part, and process
    $customerQuery = "SELECT nama_customer FROM customer WHERE id_customer = ?";
    $stmt = $conn->prepare($customerQuery);
    $stmt->bind_param("i", $id_customer);
    $stmt->execute();
    $customerResult = $stmt->get_result();
    $nama_customer = $customerResult->fetch_assoc()['nama_customer'];
    $stmt->close();

    $partQuery = "SELECT nama_part FROM data_part WHERE id_part = ?";
    $stmt = $conn->prepare($partQuery);
    $stmt->bind_param("i", $id_part);
    $stmt->execute();
    $partResult = $stmt->get_result();
    $nama_part = $partResult->fetch_assoc()['nama_part'];
    $stmt->close();

    $processQuery = "SELECT proses FROM proses WHERE id_proses = ?";
    $stmt = $conn->prepare($processQuery);
    $stmt->bind_param("i", $id_proses);
    $stmt->execute();
    $processResult = $stmt->get_result();
    $proses = $processResult->fetch_assoc()['proses'];
    $stmt->close();

    if ($id) {
        // Update
        $sql = "UPDATE checklist_katakanesha 
                SET id_customer = ?, id_part = ?, id_proses = ?, date = ?, checklist_data = ?, 
                    nama_customer = ?, nama_part = ?, proses = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisssssi", $id_customer, $id_part, $id_proses, $date, $checklist_data, $nama_customer, $nama_part, $proses, $id);
    } else {
        // Create
        $sql = "INSERT INTO checklist_katakanesha (id_customer, id_part, id_proses, date, checklist_data, nama_customer, nama_part, proses) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisssss", $id_customer, $id_part, $id_proses, $date, $checklist_data, $nama_customer, $nama_part, $proses);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = $id ? 'Checklist updated successfully.' : 'Checklist saved successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: view.php');
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
    header('Location: view.php');
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