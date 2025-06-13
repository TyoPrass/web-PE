<?php
include_once('../../Database/koneksi.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php"); // Redirect ke halaman login
    exit();
}

// Handle delete operation
if (isset($_GET['delete'])) {
    $id_customer = $_GET['delete'];
    $sql = "DELETE FROM customer WHERE id_customer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_customer);

    try {
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Customer berhasil dihapus.';
            $_SESSION['message_type'] = 'success';
        }
    } catch (mysqli_sql_exception $e) {
        // Tangani error karena foreign key constraint
        if ($e->getCode() == 1451) {
            $_SESSION['message'] = 'Data customer tidak dapat dihapus karena merupakan data utama dan masih terhubung dengan data lain. Silahkan hapus data terkait terlebih dahulu.';
            $_SESSION['message_type'] = 'danger';
        } else {
            $_SESSION['message'] = 'Terjadi kesalahan: ' . $e->getMessage();
            $_SESSION['message_type'] = 'danger';
        }
    }

    $stmt->close();
    header('Location: view.php');
    exit();
}

// Handle update operation
if (isset($_POST['update'])) {
    $id_customer = $_POST['id_customer'];
    $nama_customer = $_POST['nama_customer'];
    $project = $_POST['project'];

    $sql = "UPDATE customer SET nama_customer = ?, project = ? WHERE id_customer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama_customer, $project, $id_customer);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Customer berhasil diperbarui.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Customer berhasil diperbarui.'); window.location.href='view.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Terjadi kesalahan: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

// Handle insert operation
if (isset($_POST['submit'])) {
    $nama_customer = $_POST['nama_customer'];
    $project = $_POST['project'];

    $sql = "INSERT INTO customer (nama_customer, project) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama_customer, $project);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Customer berhasil ditambahkan.';
        $_SESSION['message_type'] = 'success';
        echo "<script>alert('Customer berhasil ditambahkan.'); window.location.href='view.php';</script>";
        exit();
    } else {
        $_SESSION['message'] = 'Terjadi kesalahan: ' . $stmt->error;
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
