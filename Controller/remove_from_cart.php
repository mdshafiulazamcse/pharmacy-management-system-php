<?php
session_start();
require_once '../config.php';

if (!isset($_COOKIE['flag'])) {
    echo "Please log in to modify your cart.";
    exit();
}

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $userId = $_SESSION['id'];

    $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);

    if ($stmt->execute()) {
        echo "<script>alert('Item removed from cart!'); window.location.href='cart_controller.php';</script>";
    } else {
        echo "<script>alert('Failed to remove item.'); window.location.href='cart_controller.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='cart.php';</script>";
}
