<!DOCTYPE html>
<html>

<head>
   <title>Create Account - Vogue Threads</title>
   <style>
      .register-container {
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

      .success {
         color: green;
         margin-bottom: 10px;
      }
   </style>
</head>

<body>
   <div class="register-container">
      <h2>Create Account</h2>
      <form method="post" action="../controller/registercontroller.php">
         <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name">
         </div>
         <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email">
         </div>
         <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password">
         </div>
         <button type="submit" class="btn">Create Account</button>
      </form>
      <p>
         <a href="../controller/loginController.php">Already have an account? Login</a>
      </p>
   </div>
</body>

</html>