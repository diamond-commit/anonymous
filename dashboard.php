<?php 
   include "db.php";
  session_start();
  if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
  $user_id = $_SESSION["id"];
  
   $nameSql = "SELECT name FROM users WHERE id = ?";
$nameStmt = $conn->prepare($nameSql);
if(!$nameStmt){
        die("failedee");
    }
$nameStmt->bind_param("i", $user_id);
if(!$nameStmt->execute()){
        die("Failed to execute");
    }
$nameResult = $nameStmt->get_result();
if($nameResult->num_rows ==0){
        die("user not found");
    }
$nameRow = $nameResult->fetch_assoc(); 
 
$sql = "SELECT inbox.id AS inbox_id, message 
        FROM inbox 
        WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if(!$stmt){
        die("failed");
    }
    $stmt->bind_param("i", $user_id);
    if(!$stmt->execute()){
        die("Failed to execute");
    }
    $results = $stmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="anon.png">
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color : #F2D69F;
  padding-bottom: 80px; /* space for button */
}

header {
  background-color: #222;
  color: white;
  padding: 20px;
  text-align: center;
  font-family: 'Sacramento', cursive;
  font-size: 2.5rem;
}

.messages-container {
  padding: 20px;
  
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.message-card {
  background-color: white;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  overflow: hidden;
  max-height: 4.5rem;
  position: relative;
  transition: all 0.3s ease;
  cursor: pointer;
}

.message-card p {
  font-size: 15px;
  color: #333;
  line-height: 1.4;
  word-wrap: break-word;
}

.share-btn {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  padding: 14px 24px;
  background-color: #222;
  color: white;
  border: none;
  border-radius: 30px;
  font-size: 16px;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
}

.share-btn:hover {
  background-color: #444;
}
.delete {
  cursor: pointer;
  font-size: 2rem;
  color: red;
  margin-left: 10px;
}
  </style>
</head>
<body>
  <header>
    <h1>Welcome back,<?=htmlspecialchars($nameRow["name"])?> </h1>
  </header>
    
  <main class="messages-container">
<?php if ($results->num_rows > 0): ?>
    <?php while($row = $results->fetch_assoc()): ?>
        <div style="display: flex">
            <div class="message-card">
                <p><?= htmlspecialchars($row["message"]) ?></p>
            </div>
            <span data-id="<?= htmlspecialchars($row["inbox_id"]) ?>" class="delete">🗑</span>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align: center; margin-top: 30px; color: #888; font-size: 1.1rem;">
        No messages yet... 😴
    </p>
<?php endif; ?>
  </main>
 <input type="hidden" value="http://localhost/anon_project/send.php?id=<?= htmlspecialchars($_SESSION['id']) ?>" id="link">
  <button class="share-btn" id="share"> copy link </button>
</body>
<script src="dashboard.js"></script>
</html>