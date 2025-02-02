<?php

session_start();


if (!isset($_SESSION['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Please log in first.'
    ]);
    exit();
}

require_once '../config.php';


$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
if (!$user_id) {
    echo json_encode([
        'success' => false,
        'message' => 'Session user ID not found.'
    ]);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['product_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Product ID is missing in the request.'
    ]);
    exit();
}

$product_id = intval($input['product_id']);

$query = "SELECT product_id, name, price FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();

    $insertQuery = "INSERT INTO cart (user_id, product_id, name, Net_Price, price, quantity) 
                VALUES (?, ?, ?, ?, ?, 1) 
                ON DUPLICATE KEY UPDATE quantity = quantity + 1, price = price * quantity";
    $insertStmt = $conn->prepare($insertQuery);

    // Get product details and calculate total price
    $total_price = $product['price']; // Since initial quantity is 1, total price is the same as price

    $insertStmt->bind_param(
        "iissd", // updated type: 'd' for decimal value
        $user_id,
        $product['product_id'],
        $product['name'],
        $product['price'],
        $total_price
    );


    if ($insertStmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Product added to cart successfully!',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to add product to cart!'
        ]);
    }

    $insertStmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Product not found!'
    ]);
}

$stmt->close();
