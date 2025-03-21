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
    ['group' => 'A-Indicate Die', 'no' => '1', 'point' => 'Part No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '2', 'point' => 'Process No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '3', 'point' => 'Dies Code No'],
    ['group' => 'A-Indicate Die', 'no' => '4', 'point' => 'Die Maker'],
    ['group' => 'A-Indicate Die', 'no' => '5', 'point' => 'Tahun Maker'],
    ['group' => 'A-Indicate Die', 'no' => '1', 'point' => 'Part No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '2', 'point' => 'Process No / Name'],
    ['group' => 'A-Indicate Die', 'no' => '3', 'point' => 'Dies Code No'],
    ['group' => 'A-Indicate Die', 'no' => '4', 'point' => 'Die Maker'],
    ['group' => 'A-Indicate Die', 'no' => '5', 'point' => 'Tahun Maker'],
];
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

        <?php if (!isset($_GET['insert']) && !isset($_GET['edit'])): ?>
            <!-- Main List View -->
            <div class="mb-3">
                <a href="katakensha.php?insert" class="btn btn-success">Add New Checklist</a>
            </div>

            <!-- Read -->
            <h3>Checklist Data</h3>
            <table class="table">
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

                <div class="card mb-4">
                    <div class="card-header">
                        <h3>Checklist Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Part No:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($viewData['part_no']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Part Name:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($viewData['part_name']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Date:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($viewData['date']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Process:</strong></div>
                            <div class="col-md-9"><?php echo htmlspecialchars($viewData['process']); ?></div>
                        </div>
                    </div>
                </div>

                <h4>Checklist Details</h4>
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
                        <?php foreach ($checklist as $index => $item): ?>
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

                        <h4>Checklist</h4>
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
                                $checklist_data = isset($editData) ? json_decode($editData['checklist_data'], true) : [];
                                
                                foreach ($checklist as $index => $item): 
                                ?>
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
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'Update' : 'Save'; ?> Checklist</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>