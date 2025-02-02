<!DOCTYPE html>
<html>
   <head>
      <title>Reset Password - Vogue Threads</title>
      <style>
         .reset-container {
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
      <div class="reset-container">
         <h2>Reset Password</h2>
         <?php
            if (!empty($errorMessage)) {
                echo "<div class='error'>$errorMessage</div>";
            }
            
            if (!empty($successMessage)) {
                echo "<div class='success'>$successMessage</div>";
            }
            ?>
         <form method="post">
            <div class="form-group">
               <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
               <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            </div>
            <div class="form-group">
               <label>New Password:</label>
               <input type="password" name="new_password">
            </div>
            <div class="form-group">
               <label>Confirm Password:</label>
               <input type="password" name="confirm_password">
            </div>
            <button type="submit" class="btn">Reset Password</button>
         </form>
      </div>
   </body>
</html>