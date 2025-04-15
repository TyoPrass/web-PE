<?php
$host = 'localhost';
$dbname = 'web_pe';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $pdo->query("SELECT data FROM gantt_chart WHERE id = 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $result ? $result['data'] : json_encode([]);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $input['action'];
        $stmt = $pdo->prepare("SELECT data FROM gantt_chart WHERE id = 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = $result ? json_decode($result['data'], true) : [];

        if ($action === 'create') {
            $newTask = [
                'id' => uniqid(),
                'text' => $input['text'],
                'start_date' => $input['start_date'],
                'duration' => $input['duration'],
                'progress' => $input['progress'],
                'parent' => $input['parent']
            ];
            $data[] = $newTask;
        } elseif ($action === 'update') {
            foreach ($data as &$task) {
                if ($task['id'] === $input['id']) {
                    $task['text'] = $input['text'];
                    $task['start_date'] = $input['start_date'];
                    $task['duration'] = $input['duration'];
                    $task['progress'] = $input['progress'];
                    $task['parent'] = $input['parent'];
                    break;
                }
            }
        } elseif ($action === 'delete') {
            $data = array_filter($data, function ($task) use ($input) {
                return $task['id'] !== $input['id'];
            });
        }

        $stmt = $pdo->prepare("INSERT INTO gantt_chart (id, data) VALUES (1, ?) ON DUPLICATE KEY UPDATE data = ?");
        $stmt->execute([json_encode($data), json_encode($data)]);
        echo json_encode(['status' => 'success']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
