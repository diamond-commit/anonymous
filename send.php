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
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="anon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap">
  <style>
    body {
  background-color: #f4f4f4;
  font-family: Arial, sans-serif;
  padding: 40px;
}

/* 🔲 Overlay for blur background */
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

/* 📨 The message form */
#container {
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  width: 90%;
  max-width: 500px;
}

  input {
  width: 100%;
  height: 120px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 16px;
  resize: vertical;
}

button {
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

button:hover {
  background-color: #AF8CB9;
}

.footer-text {
  text-align: center;
  margin-top: 15px;
  font-size: 13px;
  color: #888;
}
  </style>
</head>
<body>
    <center style="font-family: 'sacramento'; font-size: 2rem">Welcome to anonymous messages</center>
<button onclick="document.getElementById('overlay').style.display = 'flex'" style="background-color:#631D76">Send anonymous message</button>

<div id="overlay">
  <div id="container">
    <h2 style="font-family: 'sacramento'">Send an Anonymous Message</h2>
    <form id="form">
      <input type="hidden" name="id" value="<?=htmlspecialchars($id)?>">
      <input name="message" placeholder="Type your message here..." required maxlength ="200"></input>
      <button type="submit" id="submit">Send Message</button>
      <button type="button" onclick="document.getElementById('overlay').style.display = 'none'">Cancel</button>
    </form>
    <p class="footer-text">This message will be sent anonymously 👻</p>
  </div>
</div>

    <center style="font-family: 'sacramento'; font-size: 2rem; margin-top: 1rem">
      Want ur own anonymous link?
       <a href="index.php">Register here</a>
    </center>
   

</body>
<script>
  let form = document.getElementById("form")

  form.addEventListener("submit", function(e){
    document.getElementById("overlay").style.display = "none"
    e.preventDefault()
    let formData = new FormData(form)
    send(formData)
  })
  async function send(formData) {
     try {
      let response = await fetch("sendval.php",{
        method : "POST",
        body : formData
      })
      if(!response.ok){
        console.log(`error: ${response.status}`)
      }
      let data = await response.json()
      if(data.success){
        alert(data.message)
      }else{
        console.log(data.message)
      }
     } catch (error) {
      console.log(error)
     }
  }
</script>
</html>