<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <style>
        .main-content {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .orders-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            box-sizing: border-box;
        }

        .orders-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .orders-container p {
            font-size: 16px;
            color: #666;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #2c3e50;
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

        .details-button {
            display: inline-block;
            padding: 6px 12px;
            background-color: rgb(40, 112, 167);
            color: white;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .details-button:hover {
            background-color: rgb(33, 74, 136);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .orders-container {
                padding: 20px;
            }

            table th,
            table td {
                padding: 8px 12px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="brand">MediCare Plus</div>
        <div class="menu">
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../controller/cart_controller.php.php">Cart</a>
            <a class="menu-item" href="../View/profile.php">Account</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="orders-container">
            <h2>My Orders</h2>

            <?php if (empty($orders)): ?>
                <p>You have not placed any orders yet.</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td>
                                <a href="order_details_controller.php?order_id=<?php echo $order['order_id']; ?>" class="details-button">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>