<?php
include_once("../../Database/koneksi.php");
session_start();


// Initialize session if not already started
if (session_status() == PHP_SESSION_NONE || !isset($_SESSION)) {
    session_start();
}

// Handle AJAX requests for Gantt chart data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $request = json_decode(file_get_contents("php://input"), true);
    
    if (isset($request['action'])) {
        switch ($request['action']) {
            case 'create':
            case 'update':
            case 'delete':
                // Get the current task_data JSON for the given id_gant
                $id_gant = $request['id_gant'];
                $sql = "SELECT task_data FROM gant_customer WHERE id_gant = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_gant);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
                
                $tasks = [];
                if ($row && !empty($row['task_data'])) {
                    $tasks = json_decode($row['task_data'], true);
                }
                
                // Modify the tasks array based on the action
                if ($request['action'] == 'create') {
                    $tasks[] = [
                        'id' => count($tasks) + 1, // Generate a new ID
                        'text' => $request['text'],
                        'start_date' => $request['start_date'],
                        'duration' => $request['duration'],
                        'progress' => $request['progress'],
                        'parent' => $request['parent']
                    ];
                    $response = ['success' => true, 'id' => count($tasks)];
                } elseif ($request['action'] == 'update') {
                    foreach ($tasks as &$task) {
                        if ($task['id'] == $request['id']) {
                            $task['text'] = $request['text'];
                            $task['start_date'] = $request['start_date'];
                            $task['duration'] = $request['duration'];
                            $task['progress'] = $request['progress'];
                            $task['parent'] = $request['parent'];
                            break;
                        }
                    }
                    $response = ['success' => true];
                } elseif ($request['action'] == 'delete') {
                    foreach ($tasks as $key => $task) {
                        if ($task['id'] == $request['id']) {
                            unset($tasks[$key]);
                            break;
                        }
                    }
                    $tasks = array_values($tasks); // Reindex array
                    $response = ['success' => true];
                }
                
                // Update the task_data JSON in the database
                $task_data_json = json_encode($tasks);
                $sql = "UPDATE gant_customer SET task_data = ? WHERE id_gant = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $task_data_json, $id_gant);
                $stmt->execute();
                $stmt->close();
                
                echo json_encode($response);
                exit();
        }
    }
}

// Fetch Gantt chart data for a specific id_gant
if (isset($_GET['get_tasks']) && isset($_GET['id_gant'])) {
    $id_gant = $_GET['id_gant'];
    $sql = "SELECT task_data FROM gant_customer WHERE id_gant = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_gant);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if ($row && !empty($row['task_data'])) {
        echo $row['task_data'];
    } else {
        echo '[]';
    }
    exit();
}

// Function to handle insert, update, and delete operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Insert operation
        $id_customer = $_POST['id_customer'];
        $tanggal = $_POST['tanggal'];
        
        // Process task_data from the form submission
        $task_data = isset($_POST['task_data_json']) ? $_POST['task_data_json'] : '[]';
        
        $sql = "INSERT INTO gant_customer (id_customer, tanggal, task_data) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $id_customer, $tanggal, $task_data);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Record inserted successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error inserting record: " . $conn->error;
            $_SESSION['message_type'] = "danger";
        }
        $stmt->close();
        header("Location: view.php");
        exit();
    } elseif (isset($_POST['update'])) {
        // Update operation
        $id_gant = $_POST['id_gant'];
        $id_customer = $_POST['id_customer'];
        $tanggal = $_POST['tanggal'];
        
        // Process task_data from the form submission
        $task_data = isset($_POST['task_data_json']) ? $_POST['task_data_json'] : null;
        
        // If task data is provided, update it along with other fields
        if ($task_data !== null) {
            $sql = "UPDATE gant_customer SET id_customer = ?, tanggal = ?, task_data = ? WHERE id_gant = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $id_customer, $tanggal, $task_data, $id_gant);
        } else {
            // Otherwise, just update the other fields
            $sql = "UPDATE gant_customer SET id_customer = ?, tanggal = ? WHERE id_gant = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $id_customer, $tanggal, $id_gant);
        }
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Record updated successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating record: " . $conn->error;
            $_SESSION['message_type'] = "danger";
        }
        $stmt->close();
        header("Location: view.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    // Delete operation
    $id_gant = $_GET['delete'];
    
    $sql = "DELETE FROM gant_customer WHERE id_gant = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_gant);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Record deleted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error deleting record: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }
    $stmt->close();
    header("Location: view.php");
    exit();
}
?>
