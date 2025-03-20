<?php
include_once('../../Database/koneksi.php');
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
    header('Location: view.php');
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
        echo "<script>alert('Proses updated successfully.'); window.location.href='view.php';</script>";
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
        echo "<script>alert('Proses inserted successfully.'); window.location.href='view.php';</script>";
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