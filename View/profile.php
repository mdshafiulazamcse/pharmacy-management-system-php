<?php
session_start();
require_once '../Model/Register.php';
require_once '../config.php';

if (!isset($_COOKIE['flag'])) {
    header('location: loginView.php');
    exit();
}


$userId = $_SESSION['id'];
$users = getById($userId, $conn);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Plus - Online Pharmacy</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .user-table {
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            /* Adds a blur effect for better aesthetics */
        }

        .user-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            /* Semi-transparent border */
            font-size: 16px;
            color: white;
            /* Ensures the text is white */
        }

        .user-table .label {
            font-weight: bold;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.3);
            /* Semi-transparent background for labels */
        }

        .user-table tr:last-child td {
            border-bottom: none;
        }

        .profile-pic-cell {
            text-align: center;
            padding: 20px;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #007bff;
        }

        .button-cell {
            text-align: center;
            padding: 15px;
        }

        .change-password-btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .change-password-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="../customerDashboard.php">
            <div class="brand">MediCare Plus</div>
        </a>
        <div class="menu">
            <div class="search-container">
                <form action="search.php" method="GET">
                    <input type="search" name="q" placeholder="Search products..." class="search-input">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i> Search</button>
                </form>
            </div>
            <a class="menu-item" href="../customerDashboard.php"><i class="fas fa-home"></i> Home</a>
            <a class="menu-item" href="../customerDashboard.php#categories"><i class="fas fa-list"></i> Categories</a>
            <a class="menu-item" href="../Controller/orders_controller.php"><i class="fas fa-box"></i> My Orders</a>
            <a class="menu-item" href="../controller/cart_controller.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a class="menu-item" href="profile.php"><i class="fas fa-user"></i> Account</a>
            <?php if (isset($_COOKIE['flag'])) { ?>
                <a class="menu-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php } else { ?>
                <a class="menu-item" href="view/loginView.php"><i class="fas fa-sign-out-alt"></i> Login</a>
            <?php } ?>

        </div>
    </nav>

    <div class="banner">
        <div class="banner-content">
            <h1>Your Health, Our Priority</h1>
            <table class="user-table">
                <tr>
                    <td class="label">Name</td>
                    <td><?php echo htmlspecialchars($users['name']); ?></td>
                    <td colspan="3" class="profile-pic-cell">
                        <img src="../pictures/profile.png" alt="Profile Picture" class="profile-pic">
                    </td>
                </tr>
                <tr>
                    <td class="label">Email</td>
                    <td><?php echo htmlspecialchars($users['email']); ?></td>
                </tr>
                <tr>
                    <td class="label">Password</td>
                    <td>***********</td>
                </tr>
                <tr>
                    <td colspan="3" class="button-cell">
                        <a href="../view/editProfile.php"><button type="button" class="change-password-btn">Edit Profile</button></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>