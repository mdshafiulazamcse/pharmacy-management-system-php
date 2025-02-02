<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Account - MediCare Plus</title>
   <link rel="stylesheet" type="text/css" href="account.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="Style.css">

</head>
<body>
   <nav class="navbar">
      <div class="brand">MediCare Plus</div>
      <div class="menu">
         <a class="menu-item" href="customerDashboard.php"><i class="fas fa-home"></i> Home</a>
         <a class="menu-item" href="my_orders.php"><i class="fas fa-box"></i> My Orders</a>
         <a class="menu-item" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
         <a class="menu-item" href="account.php"><i class="fas fa-user"></i> Account</a>
         <a class="menu-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
   </nav>

   <div class="account-container">
      <div class="account-header">
         <h2>Your Account</h2>
      </div>

      <div class="account-details">
         <h3>Personal Information</h3>
         <div class="user-info">
            <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
         </div>
         <a href="update_account.php" class="button">Update Details</a>
      </div>

      <div class="account-orders">
         <h3>Order History</h3>
         <table class="order-table">
            <thead>
               <tr>
                  <th>Order ID</th>
                  <th>Product</th>
                  <th>Status</th>
                  <th>Date</th>
               </tr>
            </thead>
            <tbody>
               <!-- Example Order (dynamically generated) -->
               <tr>
                  <td>#12345</td>
                  <td>Prescription Medicine</td>
                  <td>Shipped</td>
                  <td>2025-01-10</td>
               </tr>
               <tr>
                  <td>#12346</td>
                  <td>Personal Care Kit</td>
                  <td>Delivered</td>
                  <td>2025-01-05</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</body>
</html>
