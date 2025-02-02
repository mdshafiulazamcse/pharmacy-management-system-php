<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <style>
        .main-content {
            padding: 2rem;
            width: 100%;
            /* Span full width */
            height: 100vh;
            /* Span full height */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e9ecef;
            box-sizing: border-box;
        }

        .cart-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 90%;
            /* Adjust width to fit nicely on large screens */
            max-width: 1200px;
            /* Limit the maximum width for readability */
            height: auto;
            box-sizing: border-box;
        }

        .cart-container h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Cart Table */
        .cart-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .cart-content table th,
        .cart-content table td {
            border: 1px solid #ddd;
            padding: 0.8rem;
            text-align: center;
        }

        .cart-content table th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }

        .cart-content table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .cart-content table tr:hover {
            background-color: #f1f5ff;
        }

        .cart-content table td a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
            transition: color 0.3s;
        }

        .cart-content table td a:hover {
            color: rgb(23, 52, 84);
        }

        /* Total and Checkout Button */
        .cart-content strong {
            font-size: 1.2rem;
        }

        .cart-content a {
            display: inline-block;
            background-color: rgb(40, 135, 167);
            color: white;
            padding: 0.8rem 1.5rem;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 1rem;
            transition: background-color 0.3s;
        }

        .cart-content a:hover {
            background-color: rgb(33, 91, 136);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cart-content table {
                font-size: 0.9rem;
            }

            .cart-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="brand">MediCare Plus</div>
        <div class="menu">
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../customerDashboard.php#categories">Categories</a>
            <a class="menu-item" href="../Controller/orders_controller.php">My Orders</a>
            <a class="menu-item" href="../controller/cart_controller.php">Cart</a>
            <a class="menu-item" href="../View/profile.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="cart-container">
            <h2 class="cart-header">Your Cart</h2>

            <div class="cart-content">
                <?php if (empty($cartItems)): ?>
                    <p class="empty-cart">Your cart is empty.</p>
                <?php else: ?>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalPrice = 0;
                            foreach ($cartItems as $item):
                                $totalPrice += $item['price'];
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                                    <td>
                                        <button class="remove-link" onclick="confirmRemove(<?php echo $item['product_id']; ?>)">Remove</button>
                                    </td>

                                    <script>
                                        function confirmRemove(productId) {
                                            if (confirm("Are you sure you want to remove this item from your cart?")) {
                                                window.location.href = "remove_from_cart.php?product_id=" + productId;
                                            }
                                        }
                                    </script>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="cart-total">
                                <td colspan="2"><strong>Total:</strong></td>
                                <td><strong>$<?php echo number_format($totalPrice, 2); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout-button-container">
                        <a class="checkout-button" href="checkout_controller.php">Proceed to Checkout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>

</html>