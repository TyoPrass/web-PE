<?php
// filepath: c:\laragon\www\coba\katakensha.php
include_once('../../Database/koneksi.php');
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

// Untuk Dinamis Checklist
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