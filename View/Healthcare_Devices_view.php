<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Plus - Healthcare Devices</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
</head>

<body>
    <!-- Navigation bar remains the same -->
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
                <!-- Keep the current view mode when form is submitted -->
                <input type="hidden" name="view" value="<?php echo htmlspecialchars($viewMode); ?>">

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
                    <ul class="filter-rating-list">
                        <?php
                        $ratings = [
                            ['value' => 4, 'label' => '4★ & above'],
                            ['value' => 3, 'label' => '3★ & above'],
                            ['value' => 2, 'label' => '2★ & above'],
                            ['value' => 1, 'label' => '1★ & above']
                        ];
                        foreach ($ratings as $rating) {
                            $checked = $minRating == $rating['value'] ? 'checked' : '';
                            echo "<li class='rating-item'>
                                    <label class='checkbox-label'>
                                        <input type='radio' name='rating' value='{$rating['value']}' 
                                               {$checked}> {$rating['label']}
                                    </label>
                                  </li>";
                        }
                        ?>
                    </ul>
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
                <?php foreach ($devices as $device): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            $imagePath = '../pictures/' . ($device['name'] ?: 'default') . '.jpg';
                            if (file_exists($imagePath)) {
                                echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($device['name']) . '">';
                            } else {
                                echo '<img src="/api/placeholder/250/200" alt="' . htmlspecialchars($device['name']) . '">';
                            }
                            ?>
                        </div>
                        <div class="product-details">
                            <h3 class="product-name"><?php echo htmlspecialchars($device['name']); ?></h3>
                            <p class="product-category"><?php echo htmlspecialchars($device['brand']); ?></p>
                            <div class="product-info">
                                <span class="stars">
                                    <?php
                                    $rating = round($device['rating']);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo $i <= $rating ? '★' : '☆';
                                    }
                                    ?>
                                </span>
                                <span class="rating-count">(<?php echo $device['rating_count']; ?>)</span>
                            </div>
                            <p class="product-price">$<?php echo number_format($device['price'], 2); ?></p>
                            <div class="product-actions">
                                <button class="add-to-cart"
                                    onclick="addToCart(<?php echo $device['device_id']; ?>)">
                                    Add to Cart
                                </button>
                            </div>
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
            // Preserve the current view mode
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