<?php
session_start();
require_once '../Model/order_model.php';

if (!isset($_COOKIE['flag']) || !isset($_SESSION['id'])) {
    echo "Please log in to view your orders.";
    exit();
}

$userId = $_SESSION['id'];

if (!isset($_GET['order_id'])) {
    echo "Invalid Order ID.";
    exit();
}

$orderId = $_GET['order_id'];
$orderDetails = getOrderDetails($userId, $orderId);
$orderItems = getOrderItems($orderId);

if (!$orderDetails) {
    echo "Order not found or you do not have permission to view this order.";
    exit();
}

include('../View/order_details_view.php');
