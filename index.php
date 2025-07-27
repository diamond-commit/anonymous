<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" type="image/png" href="anon.png">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
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
      height: 100vh;
      color: #000;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      width: 90%;
      max-width: 500px;
      margin: 40px auto;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    input {
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    button {
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

    .footer {
      text-align: center;
      font-size: 14px;
      margin-top: 10px;
      color: #777;
    }

    .footer a {
      color: #007BFF;
      text-decoration: none;
    }

    .footer a:hover {
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
  <center style="color: black; font-size: 3rem; font-family: 'Sacramento', cursive; margin-top: 30px;">
    Welcome to anonymous message🕺
  </center>

  <div class="container">
    <h2>Create Account</h2>
    <form id="form">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" id="password" name="password" placeholder="Create Password" required>
      <input type="password" id="confirm" placeholder="Confirm Password" required>
      <button type="submit" id="submit">Register</button>
    </form>
    <div class="footer">
      Already have an account? <a href="login.php">Login</a>
    </div>
  </div>

  <div id="loader" style="display: none;">
    <div class="spinner"></div>
  </div>

  <div class="error-message" id="errorBox" style="display: none;"></div>

  <script src="register.js"></script>
</body>
</html>
