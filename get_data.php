<?php
header('Content-Type: application/json');
$file_path = 'collapse_data.json';

if (file_exists($file_path)) {
    $data = file_get_contents($file_path);
    if (trim($data) === '' || json_decode($data) === null) {
        echo json_encode([]); 
    } else {
        echo $data;
    }
} else {
    echo json_encode([]); 
}
?>