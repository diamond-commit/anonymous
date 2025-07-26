<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Go to the login page"]);
    exit;
}

$email = $_POST["email"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Input valid email"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "anon_project");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection with DB failed"]);
    exit;
}

// Check if user exists
$sql = "SELECT id FROM users WHERE email = ?";
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
    echo json_encode(["success" => false, "message" => "User does not exist"]);
    exit;
}

// Cooldown logic: check if recent token already exists
/*$cooldownsql = "SELECT created_at FROM reset WHERE email = ? ORDER BY created_at DESC LIMIT 1";
$stmt2 = $conn->prepare($cooldownsql);
if (!$stmt2) {
    echo json_encode(["success" => false, "message" => "DB query failed"]);
    exit;
}
$stmt2->bind_param("s", $email);
if (!$stmt2->execute()) {
    echo json_encode(["success" => false, "message" => "DB execution failed"]);
    exit;
}
$cooldown = $stmt2->get_result();
 
    
    $cooldownrow = $cooldown->fetch_assoc();
    $created = strtotime($cooldownrow["created_at"]);

   /* if (time() - $created < 300) { // 300 seconds = 5 minutes
        echo json_encode(["success" => false, "message" => "Please wait 5 minutes before trying again."]);
        exit;
    }*/


// All clear: create new reset token
$token = bin2hex(random_bytes(32));
$expire = date("Y-m-d H:i:s", strtotime("+1 hour"));

$sql1 = "INSERT INTO reset(email, token, expire) VALUES (?, ?, ?)";
$stmt1 = $conn->prepare($sql1);
if (!$stmt1) {
    echo json_encode(["success" => false, "message" => "DB query failed"]);
    exit;
}
$stmt1->bind_param("sss", $email, $token, $expire);
if (!$stmt1->execute()) {
    echo json_encode(["success" => false, "message" => "DB execution failed"]);
    exit;
}
   try {
    // smtp settings 
            $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'fawasdiamond2007@gmail.com';
        $mail->Password = 'lzzg xvow judw tgbi'; // app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Email setup
        $mail->setFrom('fawasdiamond2007@gmail.com', "Diamond");
        $mail->addAddress($email);

         $mail->isHTML(true);
         $mail->Subject = "Reset your password";
$resetLink = "http://localhost/anonymous/reset.php?token=$token";

$mail->Body = "
    <h2>Password Reset</h2>
    <p>Click the button below to reset your password:</p>
    <a href='$resetLink' style='
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
        margin-top: 10px;
    '>Reset Password</a>
    <p>If you didn’t request this, just ignore it.</p>
";
  $mail->send();
    echo json_encode([
    "success" => true,
    "message" => "Reset link has been sent to the email you provided",
]);
   } catch (\Throwable $th) {
    echo json_encode([
    "success" => false,
    "message" => "Message could not be sent. Mailer Error : $mail->Errorinfo",
]);
   }
?>