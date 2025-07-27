<?php 
include "dbjson.php";
   
    if(!$_SERVER["REQUEST_METHOD"]=== "POST"){
        echo json_encode(["success"=> false, "message"=> "where u from gng"]);
        exit;
    }
     $message = $_POST["message"];
     $id = $_POST["id"];

     $sql = "INSERT INTO inbox(message, user_id) VALUES (?,?)";
     $stmt = $conn->prepare($sql);
     if(!$stmt){
    echo json_encode(["success"=> false, "message" => "Failed"]);
        exit;
     }

     if(!$stmt->execute([$message, $id])){
       echo json_encode(["success"=> false, "message" => "failed"]);
        exit;
     }
      echo json_encode(["success"=> true, "message" => "Message sent successfully"]);
     $conn = null;
?>