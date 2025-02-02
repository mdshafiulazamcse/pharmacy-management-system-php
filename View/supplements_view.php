<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Plus - Supplements</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
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
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../customerDashboard.php#categories">Categories</a>
            <a class="menu-item" href="../Controller/orders_controller.php.php">My Orders</a>
            <a class="menu-item" href="../controller/cart_controller.php">Cart</a>
            <a class="menu-item" href="../view/profile.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <aside class="filters">
            <form id="filterForm" method="GET" action="">
                <input type="hidden" name="view" value="<?php echo htmlspecialchars($viewMode); ?>">

                <div class="filter-section">
                    <h3 class="filter-title">Supplement Type</h3>
                    <div class="checkbox-group">
                        <?php foreach ($categories_list as $cat): ?>
                            <label class="checkbox-label">
                                <input type="checkbox" name="categories[]"
                                    value="<?php echo htmlspecialchars($cat['category']); ?>"
                                    <?php echo in_array($cat['category'], $categories) ? 'checked' : ''; ?>>
                                <?php echo htmlspecialchars($cat['category']); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Brand</h3>
                    <div class="checkbox-group">
                        <?php foreach ($brands_list as $brand): ?>
                            <label class="checkbox-label">
                                <input type="checkbox" name="brands[]"
                                    value="<?php echo htmlspecialchars($brand['brand']); ?>"
                                    <?php echo in_array($brand['brand'], $brands) ? 'checked' : ''; ?>>
                                <?php echo htmlspecialchars($brand['brand']); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Price Range</h3>
                    <div class="price-inputs">
                        <input type="number" name="min_price" class="price-input"
                            placeholder="Min" value="<?php echo $minPrice ?? ''; ?>">
                        <span>-</span>
                        <input type="number" name="max_price" class="price-input"
                            placeholder="Max" value="<?php echo $maxPrice ?? ''; ?>">
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Rating</h3>
                    <div class="checkbox-group">
                        <?php
                        $ratings = [
                            ['value' => 4, 'label' => '4★ & above'],
                            ['value' => 3, 'label' => '3★ & above'],
                            ['value' => 2, 'label' => '2★ & above']
                        ];
                        foreach ($ratings as $rating) {
                            $checked = $minRating == $rating['value'] ? 'checked' : '';
                            echo "<label class='checkbox-label'>
                                    <input type='radio' name='rating' value='{$rating['value']}' {$checked}>
                                    {$rating['label']}
                                  </label>";
                        }
                        ?>
                    </div>
                </div>

                <button type="submit" class="apply-filters">Apply Filters</button>
            </form>
        </aside>

        <div class="products-container">
            <div class="controls">
                <select class="sort-select" name="sort" onchange="updateSort(this.value)">
                    <option value="">Sort by: Featured</option>
                    <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>
                        Price: Low to High
                    </option>
                    <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>
                        Price: High to Low
                    </option>
                    <option value="rating" <?php echo $sort == 'rating' ? 'selected' : ''; ?>>
                        Customer Rating
                    </option>
                    <option value="newest" <?php echo $sort == 'newest' ? 'selected' : ''; ?>>
                        Newest First
                    </option>
                </select>

                <div class="view-options">
                    <button type="button" class="view-button <?php echo $viewMode == 'grid' ? 'active' : ''; ?>"
                        onclick="changeView('grid')">Grid</button>
                    <button type="button" class="view-button <?php echo $viewMode == 'list' ? 'active' : ''; ?>"
                        onclick="changeView('list')">List</button>
                </div>
            </div>

            <div class="product-grid <?php echo $viewMode == 'list' ? 'list-view' : ''; ?>">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            $imagePath = 'images/' . ($product['image_url'] ?: 'default.jpg');
                            if (file_exists($imagePath)) {
                                echo '<img src="' . htmlspecialchars($imagePath) . '" 
                                      alt="' . htmlspecialchars($product['name']) . '">';
                            } else {
                                echo '<img src="/api/placeholder/250/200" 
                                      alt="' . htmlspecialchars($product['name']) . '">';
                            }
                            ?>
                        </div>
                        <div class="product-details">
                            <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="product-brand"><?php echo htmlspecialchars($product['brand']); ?></p>
                            <div class="product-rating">
                                <span class="stars">
                                    <?php
                                    $rating = round($product['rating']);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo $i <= $rating ? '★' : '☆';
                                    }
                                    ?>
                                </span>
                                <span class="rating-count">(<?php echo $product['rating_count']; ?>)</span>
                            </div>
                            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                            <button class="add-to-cart"
                                onclick="addToCart(<?php echo $product['product_id']; ?>)">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        function updateSort(value) {
            const urlParams = new URLSearchParams(window.location.search);
            if (value) {
                urlParams.set('sort', value);
            } else {
                urlParams.delete('sort');
            }
            urlParams.set('view', '<?php echo $viewMode; ?>');
            window.location.href = '?' + urlParams.toString();
        }

        function changeView(view) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('view', view);
            window.location.href = '?' + urlParams.toString();
        }
    </script>
</body>

</html>
<?php
$conn->close();
?>