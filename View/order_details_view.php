<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 2px;
            display: flex;
            justify-content: center;
        }

        .order-details-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            box-sizing: border-box;
        }

        .order-details-container h2 {
            font-size: 25px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .order-info p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .order-info strong {
            color: rgb(33, 74, 136);
        }

        .order-status {
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 5px;
        }

        .order-status.pending {
            background-color: rgb(241, 212, 93);
            color: #fff;
        }

        .order-status.completed {
            background-color: #28a745;
            color: #fff;
        }

        .order-status.failed {
            background-color: rgb(245, 141, 152);
            color: #fff;
        }

        h3 {
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: rgb(33, 74, 136);
            color: white;
            font-weight: 600;
        }

        table td {
            font-size: 14px;
            color: #333;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td strong {
            font-weight: 600;
        }

        .back-button {
            display: inline-block;
            padding: 8px 20px;
            background-color: rgb(33, 74, 136);
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: rgb(33, 74, 136);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .order-details-container {
                padding: 20px;
            }

            table th,
            table td {
                padding: 10px 15px;
            }

            table {
                font-size: 14px;
            }

            .order-details-container h2 {
                font-size: 24px;
            }

            .back-button {
                padding: 8px 18px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="brand">MediCare Plus</div>
        <div class="menu">
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../Controller/orders_controller.php">My Orders</a>
            <a class="menu-item" href="..controller/cart_controller.php">Cart</a>
            <a class="menu-item" href="../View/profile.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="order-details-container">
            <h2>Order Details</h2>

            <div class="order-info">
                <p><strong>Order ID:</strong> #<?php echo htmlspecialchars($orderDetails['order_id']); ?></p>
                <p><strong>Order Date:</strong> <?php echo htmlspecialchars($orderDetails['order_date']); ?></p>
                <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($orderDetails['address']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($orderDetails['phone']); ?></p>
                <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($orderDetails['payment_method']); ?></p>
                <p><strong>Status:</strong> <span class="order-status <?php echo strtolower($orderDetails['status']); ?>"><?php echo htmlspecialchars($orderDetails['status']); ?></span></p>
            </div>

            <h3>Products in Order</h3>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Total:</strong></td>
                    <td><strong>$<?php echo number_format($orderDetails['total_price'], 2); ?></strong></td>
                </tr>
            </table>

            <a href="../customerDashboard.php" class="back-button">Back to Orders</a>
        </div>
    </main>
</body>

</html>