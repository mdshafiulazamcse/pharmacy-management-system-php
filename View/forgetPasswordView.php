<!DOCTYPE html>
<html>
   <head>
      <title>Forgot Password - Vogue Threads</title>
      <style>
         .forget-container {
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
      <div class="forget-container">
         <h2>Forgot Password</h2>
         <form method="post">
            <div class="form-group">
               <label>Email:</label>
               <input type="email" name="email">
            </div>
            <button type="submit" class="btn">Submit</button>
         </form>
      </div>
   </body>
</html>