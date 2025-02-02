<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
</head>

<body>
    <nav class="navbar">
        <a href="../customerDashboard.php">
            <div class="brand">MediCare Plus</div>
        </a>
        <div class="menu">
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../customerDashboard.php#categories">Categories</a>
            <a class="menu-item" href="../Controller/orders_controller.php">My Orders</a>
            <a class="menu-item" href="../controller/cart_controller.php">Cart</a>
            <a class="menu-item" href="../view/profile.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <h2>Search Results for "<?php echo htmlspecialchars($_GET['q']); ?>"</h2>

        <?php if (empty($products)): ?>
            <p>No products found.</p>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            $imagePath = '../pictures/' . (!empty($product['name']) ? $product['name'] : 'default') . '.jpg';
                            if (file_exists($imagePath)) {
                                echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($product['name']) . '">';
                            } else {
                                echo '<img src="/api/placeholder/250/200" alt="' . htmlspecialchars($product['name']) . '">';
                            }
                            ?>
                        </div>
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p><strong>Price: $<?php echo number_format($product['price'], 2); ?></strong></p>
                        <div class="product-actions">
                            <button class="add-to-cart"
                                onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo isset($_COOKIE['flag']) ? $_COOKIE['flag'] : ''; ?>')">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>


    <script>
        function addToCart(productId, flag) {
            if (!flag) {
                alert('You must be logged in to add to the cart.');
                return;
            }
            fetch('add_to_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.text()) // Use .text() instead of .json() since you're not returning JSON anymore
                .then(data => {
                    console.log(data); // Log the response from the server
                    if (data.includes("Product added to cart successfully!")) {
                        alert('Product added to cart!');
                    } else {
                        alert('An error occurred: ' + data); // Show the error message if there's a problem
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding to cart.');
                });
        }
    </script>

</body>

</html>