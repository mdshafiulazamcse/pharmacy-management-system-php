<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Plus - Online Pharmacy</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
</head>

<body>
    <nav class="navbar">
        <div class="brand">MediCare Plus</div>
        <div class="menu">
            <div class="search-container">
                <form action="./search_controller.php" method="GET">
                    <input type="search" name="q" placeholder="Search products..." class="search-input">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i> Search</button>
                </form>
            </div>
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../customerDashboard.php#categories">Categories</a>
            <a class="menu-item" href="../Controller/orders_controller.php.php">My Orders</a>
            <a class="menu-item" href="../controller/cart_controller.php">Cart</a>
            <a class="menu-item" href="../view/profile.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="products-container">
            <!-- Category Tabs -->
            <div class="category-tabs-container">
                <div class="category-tabs">
                    <?php
                    $categories = ['All Medicines', 'Pain Relief', 'Cold & Flu', 'Allergy Relief', 'Digestive Health', 'First Aid'];
                    foreach ($categories as $cat) {
                        $activeClass = (!$category && $cat == 'All Medicines') || $category == $cat ? 'active' : '';
                        echo '<button class="category-tab ' . $activeClass . '" 
                              onclick="window.location.href=\'?category=' . urlencode($cat) . '\'">' .
                            htmlspecialchars($cat) . '</button>';
                    }
                    ?>
                </div>

                <div class="sort-container">
                    <span class="sort-label">Sort by:</span>
                    <select class="sort-select" onchange="handleSort(this.value)">
                        <option value="" <?php echo !$sort ? 'selected' : ''; ?>>Default</option>
                        <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>Price: High to Low</option>
                        <option value="name_asc" <?php echo $sort == 'name_asc' ? 'selected' : ''; ?>>Name: A to Z</option>
                        <option value="name_desc" <?php echo $sort == 'name_desc' ? 'selected' : ''; ?>>Name: Z to A</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid -->
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
                        <div class="product-details">
                            <div class="product-category"><?php echo htmlspecialchars($product['category']); ?></div>
                            <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="product-info"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                            <div class="product-actions">
                                <button class="add-to-cart"
                                    onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo isset($_COOKIE['flag']) ? $_COOKIE['flag'] : ''; ?>')">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        function handleSort(value) {
            // Get current URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Update or add sort parameter
            if (value) {
                urlParams.set('sort', value);
            } else {
                urlParams.delete('sort');
            }

            // Redirect to new URL with sort parameter
            window.location.href = '?' + urlParams.toString();
        }

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
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    if (data.includes("Product added to cart successfully!")) {
                        alert('Product added to cart!');
                    } else {
                        alert('An error occurred: ' + data);
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