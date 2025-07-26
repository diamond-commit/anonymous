<?php 
    if(!$_SERVER["REQUEST_METHOD"]=== "POST"){
        echo "where u from gng";
        exit;
    }
     $message = $_POST["message"];
     $id = $_POST["id"];
     $conn = new mysqli("localhost", "root", "","anon_project");
     if($conn->connect_error){
    echo json_encode(["success"=> false, "message" => "connection with db failed"]);
        exit;
     }
     $sql = "INSERT INTO inbox(message, user_id) VALUES (?,?)";
     $stmt = $conn->prepare($sql);
     if(!$stmt){
    echo json_encode(["success"=> false, "message" => "Failed"]);
        exit;
     }
     $stmt->bind_param("si", $message, $id);
     if(!$stmt->execute()){
       echo json_encode(["success"=> false, "message" => "failed"]);
        exit;
     }
      echo json_encode(["success"=> true, "message" => "Message sent successfully"]);
     $stmt->close();
     $conn->close();
?>