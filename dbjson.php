<?php
$host = 'localhost'; // or 127.0.0.1
$db   = 'anon_project';
$user = 'postgres';
$pass = 'yingyang'; 
$port = '5432'; 

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: set default fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode(["success"=> false, 
                      "message"=> " Error". $e->getMessage()]);
}
?>
