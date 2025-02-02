<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <style>
        .main-content {
            padding: 1rem;
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e9ecef;
        }

        /* Checkout Container */
        .checkout-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }

        .checkout-container h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .checkout-container h3 {
            font-size: 1.2rem;
            margin: 1rem 0 0.8rem;
        }

        /* Form Elements */
        .checkout-container label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: bold;
        }

        .checkout-container input[type="tel"],
        .checkout-container textarea {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 0.8rem;
            font-size: 0.9rem;
        }

        .checkout-container textarea {
            resize: none;
            height: 80px;
        }

        /* Radio Buttons */
        .checkout-container label input[type="radio"] {
            margin-right: 0.4rem;
        }

        .checkout-container label {
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
        }

        /* Table */
        .checkout-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.8rem;
        }

        .checkout-container table th,
        .checkout-container table td {
            border: 1px solid #ddd;
            padding: 0.6rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .checkout-container table th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }

        .checkout-container table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .checkout-container table tr:hover {
            background-color: #f1f5ff;
        }

        /* Buttons */
        .checkout-button {
            display: block;
            width: 100%;
            padding: 0.6rem;
            background-color: rgb(40, 135, 167);
            color: white;
            text-align: center;
            border-radius: 5px;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: rgb(33, 91, 136);
        }

        /* Error Message */
        .error {
            color: #d9534f;
            font-weight: bold;
            margin-bottom: 0.8rem;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .checkout-container {
                padding: 1rem;
            }

            .checkout-container h2,
            .checkout-container h3 {
                font-size: 1.2rem;
            }

            .checkout-container table th,
            .checkout-container table td {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="brand">MediCare Plus</div>
        <div class="menu">
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../View/orders.php">My Orders</a>
            <a class="menu-item" href="../View/cart.php">Cart</a>
            <a class="menu-item" href="../View/account.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="checkout-container">
            <h2>Checkout</h2>
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="checkout_controller.php">
                <label for="address">Shipping Address:</label>
                <textarea id="address" name="address" required></textarea>
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
                <h3>Payment Method</h3>
                <label><input type="radio" name="payment_method" value="Cash on Delivery" checked> Cash on Delivery</label>
                <label><input type="radio" name="payment_method" value="Credit Card"> Credit Card</label>
                <h3>Order Summary</h3>
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                    </tr>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><strong>Total:</strong></td>
                        <td><strong>$<?php echo number_format($totalPrice, 2); ?></strong></td>
                    </tr>
                </table>
                <button type="submit" class="checkout-button">Place Order</button>
            </form>
        </div>
    </main>
</body>

</html>