<?php
session_start();
require_once '../Model/Register.php';
require_once '../config.php';

// Check if the user is logged in
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
    <title>Edit Profile - MediCare Plus</title>
    <link rel="stylesheet" type="text/css" href="../Style.css">
    <style>


.user-table {
    width: 100%;
    max-width: 600px;
    border-collapse: collapse;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    backdrop-filter: blur(10px); /* Adds a blur effect for better aesthetics */
}

.user-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Semi-transparent border */
    font-size: 16px;
    color: white; /* Ensures the text is white */
}

.user-table .label {
    font-weight: bold;
    color: #ffffff;
    background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent background for labels */
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
            <a class="menu-item" href="customerDashboard.php"><i class="fas fa-home"></i> Home</a>
            <a class="menu-item" href="orders.php"><i class="fas fa-box"></i> My Orders</a>
            <a class="menu-item" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a class="menu-item" href="profile.php"><i class="fas fa-user"></i> Account</a>
            <?php if (isset($_COOKIE['flag'])) { ?>
                <a class="menu-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php } else { ?>
                <a class="menu-item" href="view/loginView.php"><i class="fas fa-sign-out-alt"></i> Login</a>
            <?php } ?>
        </div>
    </nav>

    <div class="banner">
        <div class="banner-content">
            <h1>Edit Your Profile</h1>
            <form method="POST" action="../controller/editProfileCheck.php">
                <table class="user-table">
                    <tr>
                        <td class="label">Name</td>
                        <td><input type="text" name="name" value="<?php echo htmlspecialchars($users['name']); ?>" required></td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td><input type="email" name="email" value="<?php echo htmlspecialchars($users['email']); ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="button-cell">
                            <button type="submit" class="change-password-btn">Save Changes</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
