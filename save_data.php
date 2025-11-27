<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400); 
    echo json_encode(['success' => false, 'message' => 'Invalid request method. Only POST is allowed.']);
    exit;
}

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data received or data is not an array.']);
    exit;
}

$file_path = 'collapse_data.json';

$result = file_put_contents($file_path, json_encode($data, JSON_PRETTY_PRINT));

if ($result !== false) {
    echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
} else {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => 'Failed to write data to file. Check file permissions on ' . $file_path]);
}
?>