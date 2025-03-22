<?php
include_once('../../Database/koneksi.php');
include 'action.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist Katakanesha</title>
    <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <style>
     
        th, td {
            text-align: center;
        }
   
    </style>
    <!-- Datatables css -->
    <link href="../../assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <h2>Checklist Katakanesha Dinamis</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>

        <?php if (!isset($_GET['insert']) && !isset($_GET['edit']) && !isset($_GET['detail'])): ?>
            <!-- Main List View -->
            <div class="mb-3">
                <a href="view.php?insert" class="btn btn-success">Add New Checklist</a>
            </div>

            <!-- Read -->
            <h3>Checklist Data</h3>
            <div class="table-responsive">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
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
                                        <a href="view.php?detail=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="view.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="view.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
            </div>

            <?php elseif (isset($_GET['detail'])): ?>
            <!-- View Detail -->
            <?php
            $id = $_GET['detail'];
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
                <a href="view.php" class="btn btn-secondary">Back to List</a>
                <a href="view.php?insert" class="btn btn-success">Add New Checklist</a>
                <a href="view.php?edit" class="btn btn-warning">Edit Data</a>
                
            </div>

            <div class="card">
                <div class="card-header">
                <h3>View Checklist</h3>
                </div>
                <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                    <label class="form-label">Part No</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($viewData['part_no']); ?></p>
                    </div>
                    <div class="col-md-6">
                    <label class="form-label">Part Name</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($viewData['part_name']); ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($viewData['date']); ?></p>
                    </div>
                    <div class="col-md-6">
                    <label class="form-label">Process</label>
                    <p class="form-control-static"><?php echo htmlspecialchars($viewData['process']); ?></p>
                    </div>
                </div>

                <h4>Checklist</h4>
                <table class="table table-bordered table-centered mb-0">
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
                    $currentGroup = '';
                    
                    foreach ($checklist as $index => $item): 
                        // Add group header row if new group starts
                        if ($currentGroup != $item['group']):
                        $currentGroup = $item['group'];
                    ?>
                        <tr class="table-secondary">
                        <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                        </tr>
                    <?php endif; ?>
                        <tr>
                        <td><?php echo $item['group']; ?></td>
                        <td><?php echo $item['no']; ?></td>
                        <td><?php echo $item['point']; ?></td>
                        <td><?php echo htmlspecialchars($checklist_data[$index]['P1'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($checklist_data[$index]['P2'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($checklist_data[$index]['P3'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($checklist_data[$index]['keterangan'] ?? ''); ?></td>
                        </tr>
                        <?php if ($item['is_last_in_group']): ?>
                        <tr class="table-light">
                        <td colspan="7"></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-danger">Checklist not found.</div>
            <a href="katakensha.php" class="btn btn-secondary">Back to List</a>
            <?php endif; ?>

        <?php else: ?>
            <!-- Insert/Edit Form -->
            <div class="mb-3">
                <a href="action.php" class="btn btn-secondary">Back to List</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><?php echo isset($_GET['edit']) ? 'Edit Checklist' : 'Add New Checklist'; ?></h3>
                </div>
                <div class="card-body">
                    <form action="action.php" method="POST">
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
                        <table class="table table-bordered table-centered mb-0">
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
                                $currentGroup = '';
                                
                                foreach ($checklist as $index => $item): 
                                    // Add group header row if new group starts
                                    if ($currentGroup != $item['group']):
                                        $currentGroup = $item['group'];
                                ?>
                                    <tr class="table-secondary">
                                        <td colspan="7"><strong><?php echo htmlspecialchars($currentGroup); ?></strong></td>
                                    </tr>
                                <?php endif; ?>
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
                                    <?php if ($item['is_last_in_group']): ?>
                                    <tr class="table-light">
                                        <td colspan="7"></td>
                                    </tr>
                                    <?php endif; ?>
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

    <!-- Datatables js -->
<script src="../../assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="../../assets/js/vendor/dataTables.bootstrap5.js"></script>
<script src="../../assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="../../assets/js/vendor/responsive.bootstrap5.min.js"></script>
<!-- Datatable Init js -->
<script src="../../assets/js/pages/demo.datatable-init.js"></script>
</body>
</html>