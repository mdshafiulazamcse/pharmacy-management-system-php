<!DOCTYPE html>
<html>
   <head>
      <title>Verify Token - Vogue Threads</title>
      <style>
         .verify-container {
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
      <div class="verify-container">
         <h2>Verify Token</h2>
         <form method="get">
            <div class="form-group">
               <label>Token:</label>
               <input type="text" name="token">
            </div>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
            <button type="submit" class="btn">Verify Token</button>
         </form>
      </div>
   </body>
</html>