<?php
session_start();

if (!isset($_COOKIE['flag'])) {
   $flag = true;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MediCare Plus - Online Pharmacy</title>
   <link rel="stylesheet" type="text/css" href="Style.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
   <nav class="navbar">
      <a href="customerDashboard.php">
         <div class="brand">MediCare Plus</div>
      </a>
      <div class="menu">
         <div class="search-container">
            <form action="./Controller/search_controller.php" method="GET">
               <input type="search" name="q" placeholder="Search products..." class="search-input">
               <button type="submit" class="search-button"><i class="fas fa-search"></i> Search</button>
            </form>
         </div>
         <a class="menu-item" href="customerDashboard.php"><i class="fas fa-home"></i> Home</a>
         <a class="menu-item" href="customerDashboard.php#categories"><i class="fas fa-list"></i> Categories</a>
         <a class="menu-item" href="./Controller/orders_controller.php"><i class="fas fa-box"></i> My Orders</a>
         <a class="menu-item" href="controller/cart_controller.php"><i class="fas fa-shopping-cart"></i> Cart</a>
         <a class="menu-item" href="./view/profile.php"><i class="fas fa-user"></i> Account</a>
         <?php if (isset($_COOKIE['flag'])) { ?>
            <a class="menu-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
         <?php } else { ?>
            <a class="menu-item" href="view/loginView.php"><i class="fas fa-sign-out-alt"></i> Login</a>
         <?php } ?>

      </div>
   </nav>
   <div class="banner">
      <div class="banner-content">
         <h1>Your Health, Our Priority</h1>
         <p>Browse through our wide range of medicines, healthcare products, and wellness essentials.</p>
      </div>
   </div>
   <main class="main">
      <section id="categories">
         <div class="categories">
            <h2>Shop by Category</h2>
            <div class="category-grid">
               <a href="view/Prescription_Medicines.php">
                  <div class="category-card">
                     <div class="category-image">
                        <img src="pictures/prescription.jpg" alt="Prescription Medicines">
                     </div>
                     <div class="category-content">
                        <h3>Prescription Medicines</h3>
                        <p>Upload your prescription and order medicines</p>
                     </div>
                  </div>
               </a>
               <a href="./controller/over_the_counter_controller.php">
                  <div class="category-card">
                     <div class="category-image">
                        <img src="pictures/otc.jpg" alt="Over-the-Counter">
                     </div>
                     <div class="category-content">
                        <h3>Over-the-Counter</h3>
                        <p>Common medicines for fever, cold, and pain</p>
                     </div>
                  </div>
               </a>
               <a href="./controller/Healthcare_Devices_controller.php">
                  <div class="category-card">
                     <div class="category-image">
                        <img src="pictures/medicaldevices.jpeg" alt="Healthcare Devices">
                     </div>
                     <div class="category-content">
                        <h3>Healthcare Devices</h3>
                        <p>BP monitors, glucometers, and more</p>
                     </div>
                  </div>
               </a>
               <a href="./controller/personal_care_controller.php">
                  <div class="category-card">
                     <div class="category-image">
                        <img src="pictures/personalcare.jpg" alt="Personal Care">
                     </div>
                     <div class="category-content">
                        <h3>Personal Care</h3>
                        <p>Skincare, haircare, and oral care products</p>
                     </div>
                  </div>
               </a>
               <a href="./controller/supplements_controller.php">
                  <div class="category-card">
                     <div class="category-image">
                        <img src="pictures/vitamin.jpg" alt="Supplements">
                     </div>
                     <div class="category-content">
                        <h3>Vitamins & Supplements</h3>
                        <p>Nutritional supplements and vitamins</p>
                     </div>
                  </div>
               </a>
               <a href="./Controller/ayurvedic_controller.php">
                  <div class="category-card">
                     <div class="category-image">
                        <img src="pictures/ayurvadic.jpg" alt="Ayurvedic">
                     </div>
                     <div class="category-content">
                        <h3>Ayurvedic Products</h3>
                        <p>Traditional herbs and natural remedies</p>
                     </div>
                  </div>
               </a>
      </section>
      </div>
      </div>
   </main>
</body>

</html>