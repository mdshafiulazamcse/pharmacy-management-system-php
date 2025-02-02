<!DOCTYPE html>
<html>

<head>
   <title>Login - Vogue Threads</title>
   <style>
      .login-container {
         width: 300px;
         margin: 100px auto;
         padding: 20px;
         border: 1px solid #ddd;
         border-radius: 5px;
      }

      .form-group {
         margin-bottom: 15px;
      }

      input {
         width: 100%;
         padding: 8px;
         margin-top: 5px;
      }

      .btn {
         width: 100%;
         padding: 10px;
         background: #2c3e50;
         color: white;
         border: none;
         cursor: pointer;
      }

      .error {
         color: red;
         margin-bottom: 10px;
      }
   </style>
</head>

<body>
   <div class="login-container">
      <h2>Login</h2>
      <?php if (!empty($error)): ?> <!-- Check if there's an error -->
         <div class="error"><?= htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <form method="post" action="../controller/loginController.php">
         <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email">
         </div>
         <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password">
         </div>
         <button type="submit" class="btn">Login</button>
      </form>
      <p>
         <a href="../controller/RegisterController.php">Create Account</a> |
         <a href="../controller/ForgetPasswordController.php">Forgot Password?</a>
      </p>
   </div>
</body>

</html>