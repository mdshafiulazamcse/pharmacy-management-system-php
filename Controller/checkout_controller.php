<?php
session_start();
require_once '../Model/cart_model.php';
require_once '../Model/order_model.php';

if (!isset($_COOKIE['flag']) || !isset($_SESSION['id'])) {
    echo "Please log in to proceed to checkout.";
    exit();
}

$userId = $_SESSION['id'];
$cartItems = getCartItems($userId);
$totalPrice = array_sum(array_column($cartItems, 'price'));


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $paymentMethod = $_POST['payment_method'];

    if (empty($address) || empty($phone)) {
        $error = "Address and phone number are required.";
    } elseif (empty($cartItems)) {
        $error = "Your cart is empty.";
    } else {
        $orderId = createOrder($userId, $cartItems, $totalPrice, $address, $phone, $paymentMethod);

        if ($orderId) {
            clearCart($userId);
            header("Location: ../view/order_success.php?order_id=" . $orderId);
            exit();
        } else {
            $error = "Failed to place order. Please try again.";
        }
    }
}

include('../View/checkout_view.php');
