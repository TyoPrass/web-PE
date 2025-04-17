<?php
include_once('../../Database/koneksi.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php"); // Redirect ke halaman login
    exit();
}

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
    header('Location: view.php');
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
        echo "<script>alert('Data updated successfully.'); window.location.href='view.php';</script>";
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
        echo "<script>alert('Data inserted successfully.'); window.location.href='view.php';</script>";
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