<?php
// cart_model.php

require_once '../config.php';

function getCartItems($userId)
{
    global $conn;
    $sql = "SELECT cart.product_id, products.name, products.price 
            FROM cart
            JOIN products ON cart.product_id = products.product_id
            WHERE cart.user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }

    $stmt->close();
    return $cartItems;
}
