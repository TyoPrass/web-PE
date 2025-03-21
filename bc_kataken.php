<?php
// filepath: c:\laragon\www\coba\katakensha.php
include_once('Database/koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $part_no = $_POST['part_no'];
    $part_name = $_POST['part_name'];
    $date = $_POST['date'];
    $process = $_POST['process'];
    $checklist_data = json_encode($_POST['checklist']); // Konversi data checklist menjadi JSON

    // Simpan ke database
    $sql = "INSERT INTO checklist_katakanesha (part_no, part_name, date, process, checklist_data) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $part_no, $part_name, $date, $process, $checklist_data);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Checklist saved successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }
    $stmt->close();
    header('Location: katakensha.php');
    exit();
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checklist Katakanesha</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>

        <form action="schedulu.php" method="POST">
            <div class="mb-3">
                <label for="part_no" class="form-label">Part No</label>
                <input type="text" class="form-control" id="part_no" name="part_no" required>
            </div>
            <div class="mb-3">
                <label for="part_name" class="form-label">Part Name</label>
                <input type="text" class="form-control" id="part_name" name="part_name" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="process" class="form-label">Process</label>
                <input type="text" class="form-control" id="process" name="process" required>
            </div>

            <h4>Checklist</h4>
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
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
                                
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>

                            <!-- Bagian 2 -->
                        <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group B-Stopper
                                ['group' => 'B-Stopper', 'no' => '1', 'point' => 'Apakah stamping dimulai setelah pad menekan panel'],
                                ['group' => 'B-Stopper', 'no' => '2', 'point' => 'Posisi Material'],
                                ['group' => 'B-Stopper', 'no' => '3', 'point' => 'Dowel Pin Stopper'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>

                        <!-- Bagian 3 -->

                        <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'C-Clearence', 'no' => '1', 'point' => 'Clearance sudah sesuai Standart'],
                                ['group' => 'C-Clearence', 'no' => '2', 'point' => 'Apakah ada Ventilasi Udara'],
                                ['group' => 'C-Clearence', 'no' => '3', 'point' => 'Surface Die / Punch'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 4 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'D-Spring/Urethane', 'no' => '1', 'point' => 'Stroke Spring / Urethane sudah benar'],
                                ['group' => 'D-Spring/Urethane', 'no' => '2', 'point' => 'Kekuatan Spring / Urethane sudah benar'],
                                ['group' => 'D-Spring/Urethane', 'no' => '3', 'point' => 'Penempatan Urethane / Spring sudah benar'],
                                ['group' => 'D-Spring/Urethane', 'no' => '4', 'point' => 'Posisi Striper Bolt sudah benar'],
                                ['group' => 'D-Spring/Urethane', 'no' => '5', 'point' => 'Retainer Pinset sudah benar'],
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 5 -->
                   
                     <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'PAD', 'no' => '1', 'point' => 'Slide PAD sudah sesuai spesifikasi'],
                                ['group' => 'PAD', 'no' => '2', 'point' => 'Clearence PAD sesuai kebutuhan'],
                                ['group' => 'PAD', 'no' => '3', 'point' => 'Sudut tajam sudah dihilangkan'],
                                ['group' => 'PAD', 'no' => '4', 'point' => 'PAD sudah berfungsi dengan baik'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 6 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'F-Hardent', 'no' => '1', 'point' => 'Punch sudah dihardent'],
                                ['group' => 'F-Hardent', 'no' => '2', 'point' => 'Die sudah dihardent'],
                                ['group' => 'F-Hardent', 'no' => '3', 'point' => 'Check Insert Die / Punch tidak boleh retak'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 7 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'G-Dowel Pin', 'no' => '1', 'point' => 'Dowel PIN sudah terpasang sesuai kebutuhan'],
                                ['group' => 'G-Dowel Pin', 'no' => '2', 'point' => 'Dowel PIN Upper Die terpasang Screw Plug'],
                                ['group' => 'G-Dowel Pin', 'no' => '3', 'point' => 'Penempatan posisi Dowel PIN sudah benar'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 8 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'H-Rip', 'no' => '1', 'point' => 'Rip sudah dibaut'],
                                ['group' => 'H-Rip', 'no' => '2', 'point' => 'Rip sudah diwelding'],
                                ['group' => 'H-Rip', 'no' => '3', 'point' => 'Penempatan Rib sudah sesuai'],
                                ['group' => 'H-Rip', 'no' => '4', 'point' => 'Jarak welding Rib sudah sesuai'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 9 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'I-Guide Post', 'no' => '1', 'point' => 'Pokayoke Guide Post'],
                                ['group' => 'I-Guide Post', 'no' => '2', 'point' => 'Guide Post sudah pada posisi center'],
                                ['group' => 'I-Guide Post', 'no' => '3', 'point' => 'Tinggi Guide Post sudah sesuai'],
                                ['group' => 'I-Guide Post', 'no' => '4', 'point' => 'Jumlah Guide Post sudah sesuai'],
                                ['group' => 'I-Guide Post', 'no' => '5', 'point' => 'Baut & PIN Guide Post sudah dipasang'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 10 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'J-Bolt', 'no' => '1', 'point' => 'Dies sudah menggunakan baut standar'],
                                ['group' => 'J-Bolt', 'no' => '2', 'point' => 'Sistem pemasangan baut mudah untuk setting'],
                                ['group' => 'J-Bolt', 'no' => '3', 'point' => 'Semua komponent Dies sudah di Baut dan di PIN'],
                                ['group' => 'J-Bolt', 'no' => '4', 'point' => 'J Bolt sama kyk sebelumnya'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 11 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'K-Covwe', 'no' => '1', 'point' => 'Cover PAD sudah terpasang'],
                                ['group' => 'K-Covwe', 'no' => '2', 'point' => 'Cover spring CAM sudah terpasang'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    


                </div>
                <div class="col-md-6">
                <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                ['group' => 'L-Chamfer', 'no' => '1', 'point' => 'Upper plate sudah di Chamfer'],
                                ['group' => 'L-Chamfer', 'no' => '2', 'point' => 'Lower plate sudah di Chamfer'],
                                ['group' => 'L-Chamfer', 'no' => '3', 'point' => 'Pada semua sudut sudah di Chamfer'],
                                ['group' => 'L-Chamfer', 'no' => '4', 'point' => 'Semua hole baut & PIN sudah di Chamfer'],
                                
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>

                            <!-- Bagian 2 -->
                        <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group B-Stopper
                                ['group' => 'M-Hook', 'no' => '1', 'point' => 'Hook sudah dibaut'],
                                ['group' => 'M-Hook', 'no' => '2', 'point' => 'Hook sudah diwelding'],
                                ['group' => 'M-Hook', 'no' => '3', 'point' => 'Hook ditambah safety behel'],
                             
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>

                        <!-- Bagian 3 -->

                        <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'N-Shutter', 'no' => '1', 'point' => 'Scrap shutter sudah ada & dipasang'],
                                ['group' => 'N-Shutter', 'no' => '2', 'point' => 'Kemiringan shutter membuat scrap mudah jatuh'],
                                ['group' => 'N-Shutter', 'no' => '3', 'point' => 'Pemasangan shutter sudah benar'],
                                ['group' => 'N-Shutter', 'no' => '4', 'point' => 'Check apakah scrap mudah jatuh ( pada bagian dlm Die )'],
                                ['group' => 'N-Shutter', 'no' => '5', 'point' => 'Check shutter tidak mengganggu operator dalam bekerja'],
                                ['group' => 'N-Shutter', 'no' => '6', 'point' => 'Scrap Cam Pie dapat jatuh dengan mudah'],
                                ['group' => 'N-Shutter', 'no' => '7', 'point' => 'Box scrap sudah ada'],
                                ['group' => 'N-Shutter', 'no' => '8', 'point' => 'Arah jatuh scrap dengan arah jatuh Part berlainan'],
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 4 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group O-Pilot
                                ['group' => 'O-Pilot', 'no' => '1', 'point' => 'Posisi Pillot Pin sudah satu sumbu ( Center )'],
                                ['group' => 'O-Pilot', 'no' => '2', 'point' => 'Posisi masuk Pillot Pin sudah standart'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 5 -->
                   
                     <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group P-Pin Ejector
                                ['group' => 'P-Pin Ejector', 'no' => '1', 'point' => 'Penempatan Ejector Pin sudah pada posisi yang benar'],
                                ['group' => 'P-Pin Ejector', 'no' => '2', 'point' => 'Jumlah Ejector PIN sudah sesuai kebutuhan'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 6 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group Q-Dandari
                                ['group' => 'Q-Dandari', 'no' => '1', 'point' => 'Pada Die Dipasang stopper Dandori'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 7 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group R-Cam
                                ['group' => 'R-Cam', 'no' => '1', 'point' => 'Slide Cam sudah sesuai spesifikasi'],
                                ['group' => 'R-Cam', 'no' => '2', 'point' => 'Cam sudah dibaut dan di Pin'],
                                ['group' => 'R-Cam', 'no' => '3', 'point' => 'Stroke Cam sesuai dengan kebutuhan'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 8 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group S-Cut
                                ['group' => 'S-Cut', 'no' => '1', 'point' => 'Prinsip kerja Cut / Blank sudah seperti gunting'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 9 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'T-Punch', 'no' => '1', 'point' => 'Bentuk Punch sudah standart kontruksi'],
                                ['group' => 'T-Punch', 'no' => '2', 'point' => 'Pada penempatan Punch dipasang Back Up'],
                                ['group' => 'T-Punch', 'no' => '3', 'point' => 'Jarak antara Baut dengan Blank Line sudah aman'],
                                ['group' => 'T-Punch', 'no' => '4', 'point' => 'Penempatan Insert, Back Up sudah siku benar'],
                                ['group' => 'T-Punch', 'no' => '5', 'point' => 'Tebal Back Up sudah standar ( 70% )'],
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 10 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group U-Ringstroke
                                ['group' => 'U', 'no' => '1', 'point' => 'Ringstroke sudah dipasang'],
                                ['group' => 'U', 'no' => '2', 'point' => 'Tinggi Ringstroke sesuai kebutuhan'],
                                ['group' => 'U', 'no' => '3', 'point' => 'Ringstroke sudah dibaut ke Guide Post'],
                                ['group' => 'U', 'no' => '4', 'point' => 'Ring stroke sudah dipainting kuning'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 11 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group C-Clearence
                                ['group' => 'V', 'no' => '1', 'point' => 'End blok sudah dipasang'],
                                ['group' => 'V', 'no' => '2', 'point' => 'Tinggi End blok sesuai kebutuhan'],
                                ['group' => 'V', 'no' => '3', 'point' => 'End blok sudah dibaut'],
                                ['group' => 'V', 'no' => '4', 'point' => 'End blok sudah dipainting kuning'],
                       
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Bagian 12 -->
                    <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group M-Safety
                                ['group' => 'M-Safety', 'no' => '1', 'point' => 'Safety stroke sudah terpasang'],
                                ['group' => 'M-Safety', 'no' => '2', 'point' => 'Tinggi safety sudah sesuai kebutuhan'],
                                ['group' => 'M-Safety', 'no' => '3', 'point' => 'Safety stroke sudah di ikat'],
                                ['group' => 'M-Safety', 'no' => '4', 'point' => 'Safety stroke sudah dipainting Merah'],
                                ['group' => 'M-Safety', 'no' => '5', 'point' => 'Safety sensor sudah terpasang'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                      <!-- Bagian 12 -->
                      <table class="table">
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
                            // Contoh data checklist berdasarkan gambar
                            $checklist = [
                                // Group X-Painting
                                ['group' => 'X-Painting', 'no' => '1', 'point' => 'Dies sudah dipainting'],
                                ['group' => 'X-Painting', 'no' => '2', 'point' => 'Painting dies sesuai permintaan Customer'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['no']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$index}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$index}][keterangan]' class='form-control'></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Checklist</button>
            </div>
        </form>
    </div>
</body>
</html>