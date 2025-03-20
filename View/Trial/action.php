<?php
include_once('../../Database/koneksi.php');
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
    header('Location: view.php');
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
        echo "<script>alert('Trial updated successfully.'); window.location.href='view.php';</script>";
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