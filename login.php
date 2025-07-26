 
<!DOCTYPE html>
<html lang="en">
<head>
      <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="anon.png">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap">
  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f4f4f4;
  color: #000;
  height: 100vh;
}

.container {
  background-color: #fff;
  padding: 30px;
  width: 90%;
  max-width: 400px;
  margin: 40px auto;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

form h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
}

.input-group input {
  width: 100%;
  padding: 12px;
  font-size: 15px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

button {
  width: 100%;
  padding: 12px;
  background-color: #631D76;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 15px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #AF8CB9;
}

.redirect {
  margin-top: 15px;
  text-align: center;
  font-size: 14px;
  color: #777;
}

.redirect a {
  color: #007BFF;
  text-decoration: none;
}

.redirect a:hover {
  text-decoration: underline;
}

.error-message {
  margin-top: -1.2rem;
  background-color: #ffe5e5;
  width: 100%;
  color: #cc0000;
  padding: 10px 15px;
  border: 1px solid #ff9999;
  border-radius: 4px;
  font-size: 14px;
  text-align: center;
}

#loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

.spinner {
  width: 1.5rem;
  height: 1.5rem;
  border: 5px solid #ccc;
  border-top: 5px solid #222;
  border-radius: 50%;
  animation: spin 0.9s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
  </style>
</head>
<body>
       <center style="color: black; font-size: 3rem; font-family: 'sacramento';">Welcome to anonymous messages🕺</center>
  <div class="container">
    <form id="form">
      <h2>Login</h2>

      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email Address" required />
      </div>

      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Your Password" required />
      </div>

      <button >Login</button>
      <p class="redirect">Don't have an account? <a href="index.php">Register</a></p>
    </form>
  </div>
   <div id="loader" style="display: none;">
  <div class="spinner"></div>
</div>
    <center style="font-family: 'sacramento'; font-size: 2rem">
      Forgot ur password?
       <a href="forgot.php">Recover here</a>
    </center>
    <div class="error-message" id="errorBox" style="display: none;"></div>
</body>
<script src="login.js"></script>
</html>