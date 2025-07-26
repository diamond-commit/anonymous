<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Try logging in properly"]);
    exit;
}

$email = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';

// Basic validation
if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Email and password  required"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "anon_project");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection with DB failed"]);
    exit;
}

$sql = "SELECT id, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "DB query failed"]);
    exit;
}

$stmt->bind_param("s", $email);

if (!$stmt->execute()) {
    echo json_encode(["success" => false, "message" => "DB execution failed"]);
    exit;
}

$results = $stmt->get_result();

if ($results->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "User not found. Want to sign up?"]);
    exit;
}

$user = $results->fetch_assoc();

if (!password_verify($password, $user["password"])) {
    echo json_encode(["success" => false, "message" => "Wrong password"]);
    exit;
}

$_SESSION["id"] = $user["id"];
echo json_encode(["success" => true, "message" => "Login successful", "redirect" => "dashboard.php"]);
?>