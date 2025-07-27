<?php 
  if(!isset($_GET["id"])){
    echo "no user specified";
    exit;
  }
  $id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Send Anonymous Message</title>
  <link rel="icon" href="anon.png" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap">
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      
    }
   html, body {
  overflow-x: hidden;
}
    .title {
      text-align: center;
      font-size: 3rem;
      font-family: 'Sacramento', cursive;
      color: black;
      margin-top: 40px;
    }

    .main-btn-container {
      display: flex;
      justify-content: center;
      margin-top: 2rem;
    }

    .main-btn-container button {
      padding: 18px 35px;
      background-color: #631D76;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1.1rem;
      cursor: pointer;
      margin-top: 6rem
    }

    .main-btn-container button:hover {
      background-color: #AF8CB9;
    }

    #overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(5px);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    #container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 70%;
      
      text-align: center;
    }

    input[name="message"] {
      width: 100%;
      height: 120px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      resize: vertical;
      margin-top: 10px;
    }

    button[type="submit"], button[type="button"] {
      margin-top: 15px;
      padding: 10px 20px;
      width: 100%;
      font-size: 16px;
      background-color: #631D76;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button[type="submit"]:hover, button[type="button"]:hover {
      background-color: #AF8CB9;
    }

    .footer-text {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
      color: #888;
    }

    .link-box {
      text-align: center;
      font-family: 'Sacramento';
      font-size: 2rem;
      margin-top: 2rem;
    }

    @media (max-width: 600px) {
      .title {
        font-size: 2.3rem;
      }
      .link-box {
        font-size: 1.6rem;
      }
    }
  </style>
</head>
<body>
  <div class="title" style="margin-top: 5rem">Welcome to anonymous message 🕺</div>

  <div class="main-btn-container">
    <button onclick="document.getElementById('overlay').style.display = 'flex'">
      Send anonymous message
    </button>
  </div>

  <div id="overlay">
    <div id="container">
      <h2 style="font-family: 'Sacramento'">Send an Anonymous Message</h2>
      <form id="form">
        <input type="hidden" name="id" value="<?=htmlspecialchars($id)?>">
        <input name="message" placeholder="Type your message here..." required maxlength="200"></input>
        <button type="submit" id="submit">Send Message</button>
        <button type="button" onclick="document.getElementById('overlay').style.display = 'none'">Cancel</button>
      </form>
      <p class="footer-text">This message will be sent anonymously 👻</p>
    </div>
  </div>

  <div class="link-box">
    Want your own anonymous link? <a href="index.php">Register here</a>
  </div>

  <script>
    let form = document.getElementById("form");
    form.addEventListener("submit", function(e){
      document.getElementById("overlay").style.display = "none";
      e.preventDefault();
      let formData = new FormData(form);
      send(formData);
    });

    async function send(formData) {
      try {
        let response = await fetch("sendval.php", {
          method: "POST",
          body: formData
        });
        if (!response.ok) {
          console.log(error: ${response.status});
        }
        let data = await response.json();
        if (data.success) {
          alert(data.message);
        } else {
          console.log(data.message);
        }
      } catch (error) {
        console.log(error);
      }
    }
  </script>
</body>
</html>