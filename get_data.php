<?php
require 'db_config.php'; 
header('Content-Type: application/json');

$response = [];

$result = $conn->query("SELECT title, content FROM collapse_items ORDER BY id ASC");

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $response[] = [
            'title' => $row['title'],
            'content' => $row['content']
        ];
    }
}

$conn->close();

echo json_encode($response);
?>