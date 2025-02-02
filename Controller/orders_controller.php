<?php
session_start();
require_once '../Model/order_model.php';

if (!isset($_COOKIE['flag']) || !isset($_SESSION['id'])) {
    echo "Please log in to view your orders.";
    exit();
}

$userId = $_SESSION['id'];
$orders = getUserOrders($userId);

include('../View/orders_view.php');
