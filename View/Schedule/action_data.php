<?php
include '../../Database/koneksi.php';

// Tambah data
if (isset($_POST['add'])) {
    $id_customer = $_POST['id_customer'];
    $conn->query("INSERT INTO gant_customer (id_customer) VALUES ('$id_customer')");
    header("Location: view.php");
}

// Update data
if (isset($_POST['update'])) {
    $id_gant = $_POST['id_gant'];
    $id_customer = $_POST['id_customer'];
    $conn->query("UPDATE gant_customer SET id_customer = '$id_customer' WHERE id_gant = '$id_gant'");
    header("Location: view.php");
}

// Hapus data
if (isset($_GET['delete'])) {
    $id_gant = $_GET['delete'];
    $conn->query("DELETE FROM gant_customer WHERE id_gant = '$id_gant'");
    header("Location: view.php");
}

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id_gant = $_GET['edit'];
    $result = $conn->query("SELECT * FROM gant_customer WHERE id_gant = '$id_gant'");
    $edit_data = $result->fetch_assoc();
}
?>

