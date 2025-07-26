<?php 
  if($_SERVER["REQUEST_METHOD"]!== "POST"){
     echo json_encode(["success"=> false, "message"=> "Go register properly"]);
  }
    
  $name = trim($_POST["name"]);
  $email = $_POST["email"];
  $password = $_POST["password"];
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if(empty($name)){
    echo json_encode(["success"=> false, "message"=> "Name cannot be empty"]);
    exit;
    }
    if(strlen($password)<8){
    echo json_encode(["success"=> false, "message"=> "Password cannot be less than 8 characters"]);
    exit;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   echo json_encode(["success"=> false, "message"=> "input correct email format"]);
   exit;
    }
  $conn = new mysqli("localhost", "root", "","anon_project");
     if($conn->connect_error){
    echo json_encode(["success"=> false, "message" => "connection with db failed"]);
        exit;
     }
     // check if email has been used before
     $sql1 = "SELECT id FROM users WHERE email = ?";
     $stmt1 = $conn->prepare($sql1);
     if(!$stmt1){
    echo json_encode(["success"=> false, "message" => "Failed"]);
        exit;
     }
     $stmt1->bind_param("s", $email);
     if(!$stmt1->execute()){
       echo json_encode(["success"=> false, "message" => "failed"]);
        exit;
     }
     $results = $stmt1->get_result();
     if($results->num_rows>0){
            echo json_encode(["success"=> false, "message" => "Email has been registered already, Log in"]);
            exit;
     }
     
     $sql = "INSERT INTO users(name, email, password) VALUES (?,?,?)";
     $stmt = $conn->prepare($sql);
     if(!$stmt){
    echo json_encode(["success"=> false, "message" => "Failed"]);
        exit;
     }
     $stmt->bind_param("sss", $name, $email, $hashedPassword);
     if(!$stmt->execute()){
       echo json_encode(["success"=> false, "message" => "failed"]);
        exit;
     }
        echo json_encode(["success"=> true,
                         "message" => "Registeration successful, You can login now",
                          "redirect"=> "login.php"]);
     $stmt->close();
     $conn->close();
?>