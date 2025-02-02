<?php
require_once '../config.php';

function createOrder($userId, $cartItems, $totalPrice, $address, $phone, $paymentMethod)
{
    global $conn;

    // Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, address, phone, payment_method, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("idsss", $userId, $totalPrice, $address, $phone, $paymentMethod);
    if ($stmt->execute()) {
        $orderId = $stmt->insert_id;
        $stmt->close();

        // Insert each product into order_items table
        foreach ($cartItems as $item) {
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, price) VALUES (?, ?, ?)");
            $stmt->bind_param("iid", $orderId, $item['product_id'], $item['price']);
            $stmt->execute();
        }
        $stmt->close();
        return $orderId;
    }

    return false;
}

function clearCart($userId)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

function getOrderDetails($userId, $orderId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? AND order_id = ?");
    $stmt->bind_param("ii", $userId, $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Fetch order items
function getOrderItems($orderId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT oi.product_id, p.name, p.description, oi.price
                            FROM order_items oi
                            JOIN products p ON oi.product_id = p.product_id
                            WHERE oi.order_id = ?");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];

    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    return $items;
}

require_once '../config.php';

// Fetch all orders of a user
function getUserOrders($userId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    return $orders;
}

?>
