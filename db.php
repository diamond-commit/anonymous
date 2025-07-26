<?php
$servername = "db.pxxl.pro";
$port = 14157;
$username = "user_3f39a3d9";
$password = "1a9434b2f48f599e042d6bed5994c401";
$dbname = "db_63978047";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>