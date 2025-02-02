<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MediCare Plus - Online Pharmacy</title>
   <link rel="stylesheet" type="text/css" href="Style.css">
   
</head>
<body>
   <nav class="navbar">
      <div class="brand">MediCare Plus</div>
      <div class="menu">
         <div class="search-container">
            <form action="search.php" method="GET">
               <input type="search" name="q" placeholder="Search products..." class="search-input">
               <button type="submit" class="search-button">Search</button>
            </form>
         </div>
         <a class="menu-item" href="customerDashboard.php">Home</a>
         <a class="menu-item" href="customerDashboard.php#categories">Categories</a>
         <a class="menu-item" href="my_orders.php">My Orders</a>
         <a class="menu-item" href="cart.php">Cart</a>
         <a class="menu-item" href="account.php">Account</a>
      </div>
   </nav>

   <main class="mp-main-content">
      <div class="mp-page-header">
         <h1 class="mp-header-title">Prescription Medicines</h1>
         <p class="mp-header-desc">Upload your prescription and our pharmacists will process your order. We ensure 100% authentic medicines and timely delivery.</p>
      </div>

      <?php
      session_start();
      if (!isset($_SESSION['user_id'])) {
         echo "<script>window.location.href = 'login.php';</script>";
      } else {
      ?>
      <div class="mp-prescription-upload">
         <h2>Upload Prescription</h2>
         <form action="upload_prescription.php" method="POST" enctype="multipart/form-data">
               <div class="mp-upload-icon">📄</div>
               <p class="mp-upload-text">Drag and drop your prescription here or</p>
               <button class="mp-browse-button" type="button" onclick="document.getElementById('fileInput').click()">Browse Files</button>
               <input type="file" name="prescription_file" id="fileInput" hidden accept="image/*,.pdf" required>
            </div>

            <div class="mp-upload-instructions">
               <h3>Upload Instructions:</h3>
               <ul class="mp-instruction-list">
                  <li>Upload clear images of valid prescriptions only</li>
                  <li>Ensure the doctor's signature is clearly visible</li>
                  <li>Prescriptions should not be older than 6 months</li>
                  <li>Accepted formats: JPG, PNG, PDF (max size: 5MB)</li>
               </ul>
            </div>

            <button type="submit" class="mp-upload-button">Upload Prescription</button>
         </form>
      </div>
      <?php } ?>
   </main>
</body>
</html>
