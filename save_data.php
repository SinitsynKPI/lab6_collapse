<?php
require 'db_config.php'; 
header('Content-Type: application/json');

// 1. Отримання та декодування даних
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400); 
    echo json_encode(['success' => false, 'message' => 'Invalid request method. Only POST is allowed.']);
    exit();
}

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (!is_array($data)) {
    http_response_code(400); 
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data received or data is not an array.']);
    exit();
}

$conn->query("TRUNCATE TABLE collapse_items");

$stmt = $conn->prepare("INSERT INTO collapse_items (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content); 

foreach ($data as $item) {
    if (isset($item['title']) && isset($item['content'])) {
        $title = $item['title'];
        $content = $item['content'];
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'message' => 'Дані успішно збережено в базі даних.']);
?>