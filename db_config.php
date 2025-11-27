<?php
$servername = "sql306.infinityfree.com"; 
$username = "if0_40538177";
$password = "3ljFXFuZiVj8y";
$dbname = "if0_40538177_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500); 
    echo json_encode(['success' => false, 'message' => "Помилка підключення до БД: " . $conn->connect_error]);
    exit();
}
?>