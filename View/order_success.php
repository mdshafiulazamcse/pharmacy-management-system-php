<?php
session_start();

if (!isset($_GET['order_id'])) {
    header("Location: ../View/cart.php");
    exit();
}

$orderId = $_GET['order_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #eef2f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 10px;
            margin: 0;
        }

        .order-success-container {
            background-color: #ffffff;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .order-success-container h2 {
            font-size: 22px;
            color: rgb(40, 68, 167);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .order-success-container p {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .order-success-container strong {
            color: rgb(57, 80, 104);
            font-weight: 700;
        }

        .order-success-container a {
            display: inline-block;
            font-size: 14px;
            color: #ffffff;
            background-color: rgb(57, 80, 104);
            padding: 8px 20px;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-weight: 500;
            margin-top: 10px;
        }

        .order-success-container a:hover {
            background-color: rgb(57, 80, 104);
        }

        /* Smaller Icon Size */
        .order-success-container .icon {
            font-size: 18px;
            /* Further reduced icon size */
            color: #28a745;
            margin-bottom: 10px;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .order-success-container {
                padding: 15px;
                width: 100%;
                /* Ensure it takes up full width but no more */
                max-width: 100%;
            }

            .order-success-container h2 {
                font-size: 20px;
            }

            .order-success-container p {
                font-size: 12px;
            }

            .order-success-container a {
                padding: 8px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="order-success-container">
        <div class="icon">
            <img src="../pictures/medical.jpg" alt="Success Icon">

        </div>
        <h2>Order Placed Successfully!</h2>
        <p>Your order ID is <strong>#<?php echo htmlspecialchars($orderId); ?></strong>.</p>
        <p>Thank you for choosing MediCare Plus! We are processing your order and will notify you once it ships.</p>
        <a href="../customerDashboard.php">Return to Home</a>
    </div>
</body>

</html>