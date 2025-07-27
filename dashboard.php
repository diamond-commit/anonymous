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
if(!$nameStmt->execute([$user_id])){
        die("Failed to execute");
    }
$nameRow = $nameStmt->fetch(PDO::FETCH_ASSOC);
if(count($nameRow) ==0){
        die("user not found");
    }

 
$sql = "SELECT inbox.id AS inbox_id, message 
        FROM inbox 
        WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if(!$stmt){
        die("failed");
    }
    if(!$stmt->execute([$user_id])){
        die("Failed to execute");
    }
    $results = $stmt->fetchAll(pdo::FETCH_ASSOC);


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
  font-size: 1.35rem;
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
<?php if (count($results) > 0): ?>
    <?php foreach($results as $row): ?>
        <div style="display: flex">
            <div class="message-card">
                <p><?= htmlspecialchars($row["message"]) ?></p>
            </div>
            <span data-id="<?= htmlspecialchars($row["inbox_id"]) ?>" class="delete">🗑</span>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align: center; margin-top: 30px; color: #888; font-size: 1.8rem;">
        No messages yet... 😴
    </p>
<?php endif; ?>
  </main>
 <input type="hidden" value="https://anonymous.pxxl.click/send.php?id=<?= htmlspecialchars($_SESSION['id']) ?>" id="link">
  <button class="share-btn" id="share"> copy link </button>
</body>
<script src="dashboard.js"></script>
</html>