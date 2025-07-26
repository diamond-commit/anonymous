<?php
$servername = "db.pxxl.pro";
$port = 14157;
$username = "user_3f39a3d9";
$password = "22082aff070e0f1cf90dfa023a38e4bb"; // your real password
$dbname = "db_63978047";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Handle connection error as JSON
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed",
        "error" => $conn->connect_error
    ]);
    exit;
}
?>