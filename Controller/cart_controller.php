
<?php
session_start();

require_once '../Model/cart_model.php';

if (!isset($_COOKIE['flag']) || !isset($_SESSION['id'])) {
    echo "Please log in to view your cart.";
    exit();
}

$userId = $_SESSION['id'];
$cartItems = getCartItems($userId);

include('../View/cart_view.php');
?>
