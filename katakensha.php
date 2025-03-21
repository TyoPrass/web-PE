<?php
// filepath: c:\laragon\www\coba\schedulu.php
include_once('Database/koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $part_no = $_POST['part_no'];
    $part_name = $_POST['part_name'];
    $date = $_POST['date'];
    $process = $_POST['process'];
    $checklist_data = json_encode($_POST['checklist']); // Simpan checklist sebagai JSON

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
    header('Location: schedulu.php');
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Group</th>
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
                                ['group' => 'A', 'point' => 'Part No/Name'],
                                ['group' => 'B', 'point' => 'Drawing No/Name'],
                                ['group' => 'C', 'point' => 'Upper plate sudah di Chamfer'],
                                ['group' => 'D', 'point' => 'Hook sudah dibuat'],
                                ['group' => 'E', 'point' => 'Stroke Cam sudah sesuai spesifikasi'],
                                ['group' => 'F', 'point' => 'PAD sudah berfungsi dengan baik'],
                                ['group' => 'G', 'point' => 'Guide Post sudah sesuai posisi center'],
                                ['group' => 'H', 'point' => 'Die sudah dipainting'],
                                ['group' => 'I', 'point' => 'Pengecekan dimensi produk'],
                                ['group' => 'J', 'point' => 'Kesesuaian material'],
                                ['group' => 'K', 'point' => 'Kerataan permukaan die'],
                                ['group' => 'L', 'point' => 'Ketajaman cutting edge'],
                                ['group' => 'M', 'point' => 'Kondisi spring'],
                                ['group' => 'N', 'point' => 'Pelumasan komponen'],
                                ['group' => 'O', 'point' => 'Kebersihan area kerja'],
                                ['group' => 'P', 'point' => 'Setting parameter mesin'],
                                ['group' => 'Q', 'point' => 'Pengecekan keamanan die'],
                                ['group' => 'R', 'point' => 'Inspeksi visual produk'],
                                ['group' => 'S', 'point' => 'Pengecekan pilot pin'],
                                ['group' => 'T', 'point' => 'Kondisi stopper'],
                                ['group' => 'U', 'point' => 'Pengecekan sensor'],
                                ['group' => 'V', 'point' => 'Kalibrasi alat ukur'],
                            ];

                            foreach ($checklist as $index => $item) {
                                echo "<tr>
                                    <td>{$item['group']}</td>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Group</th>
                                <th>Point Check</th>
                                <th>P1</th>
                                <th>P2</th>
                                <th>P3</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Contoh data checklist berdasarkan gambar (lanjutan)
                            $checklist2 = [
                                ['group' => 'W', 'point' => 'Pengecekan hydraulic system'],
                                ['group' => 'X', 'point' => 'Kondisi pneumatic system'],
                                ['group' => 'Y', 'point' => 'Pengecekan cooling system'],
                                ['group' => 'Z', 'point' => 'Kondisi electrical system'],
                                ['group' => 'AA', 'point' => 'Pengecekan emergency stop'],
                                ['group' => 'AB', 'point' => 'Setup waktu cycle'],
                                ['group' => 'AC', 'point' => 'Pengecekan kebisingan mesin'],
                                ['group' => 'AD', 'point' => 'Kondisi belt conveyor'],
                                ['group' => 'AE', 'point' => 'Pengecekan material handling'],
                                ['group' => 'AF', 'point' => 'Setting parameter produksi'],
                                ['group' => 'AG', 'point' => 'Pengecekan scrap handling'],
                                ['group' => 'AH', 'point' => 'Dokumentasi proses'],
                                ['group' => 'AI', 'point' => 'Training operator'],
                                ['group' => 'AJ', 'point' => 'Pengecekan SOP'],
                                ['group' => 'AK', 'point' => 'Kalibrasi sensor'],
                                ['group' => 'AL', 'point' => 'Kondisi robot arm'],
                                ['group' => 'AM', 'point' => 'Pengecekan tempat penyimpanan'],
                                ['group' => 'AN', 'point' => 'Ketepatan waktu produksi'],
                                ['group' => 'AO', 'point' => 'Pengecekan quality control'],
                                ['group' => 'AP', 'point' => 'Kondisi alat bantu'],
                                ['group' => 'AQ', 'point' => 'Pengecekan sistem otomasi'],
                                ['group' => 'AR', 'point' => 'Identifikasi risiko keamanan'],
                                ['group' => 'AS', 'point' => 'Pengecekan packaging'],
                                ['group' => 'AT', 'point' => 'Evaluasi performa produksi'],
                                ['group' => 'AU', 'point' => 'Pengecekan sistem pelaporan']
                            ];

                            foreach ($checklist2 as $index => $item) {
                                $realIndex = $index + count($checklist);
                                echo "<tr>
                                    <td>{$item['group']}</td>
                                    <td>{$item['point']}</td>
                                    <td><input type='text' name='checklist[{$realIndex}][P1]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$realIndex}][P2]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$realIndex}][P3]' class='form-control'></td>
                                    <td><input type='text' name='checklist[{$realIndex}][keterangan]' class='form-control'></td>
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