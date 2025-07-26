<?php 
 include "db.php";
   if($_SERVER["REQUEST_METHOD"]!== "GET"){
    echo "Try again";
    exit;
   }
   if(!isset($_GET["token"])){
     echo "Try again";
     exit;
   }
   $token = $_GET["token"];
       

   $sql = "SELECT email, expire FROM reset WHERE token =?";
   $stmt = $conn->prepare($sql);
   if (!$stmt) {
    echo  "DB query failed";
    exit;
   }
   $stmt->bind_param("s", $token);
      if (!$stmt->execute()) {
    echo "DB execution failed";
    exit;
  }
  $results = $stmt->get_result();
  if($results->num_rows === 0){
    echo "Token does not exist";
    exit;
  }
  $row = $results->fetch_assoc();
  $expire = $row["expire"];
  if(strtotime($expire) < time()){
    echo "Token is expired";
    exit;
  }
   header("Location: update_pass.php?token=$token");
   exit;
?>