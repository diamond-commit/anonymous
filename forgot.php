<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>
     <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="anon.png">
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f0f2f5;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 20px;
}

.container {
  background: #fff;
  padding: 25px 20px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

form h2 {
  margin-bottom: 10px;
  font-size: 22px;
  color: #333;
  text-align: center;
}

form p {
  margin-bottom: 20px;
  color: #555;
  font-size: 14px;
  text-align: center;
}

input[type="email"] {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
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
  transition: 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}

#messageBox {
  margin-bottom: 15px;
  font-size: 14px;
  color: red;
  display: none;
}

@media (max-width: 480px) {
  .container {
    padding: 20px 15px;
    border-radius: 8px;
  }

  form h2 {
    font-size: 20px;
  }

  form p {
    font-size: 13px;
  }

  input[type="email"],
  button {
    font-size: 14px;
  }
}
  </style>
</head>
<body>

  <div class="container">
    <form id="form">
      <h2>Forgot Password</h2>
      <p>Enter your email and we’ll send a reset link</p>

      <input type="email" id="email" name="email" placeholder="Email address" required>

     

      <button>Send Reset Link</button>
    </form>
  </div>
  <a href="" id="message"></a>

</body>
<script src="forgot.js"></script>
</html>