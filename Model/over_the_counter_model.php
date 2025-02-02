<?php
// product_model.php

// Database connection
function getDbConnection()
{
    $conn = new mysqli("localhost", "root", "", "pharmacy");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Get products based on category and sort
function getProducts($category = null, $sort = null)
{
    $conn = getDbConnection();
    $sql = "SELECT * FROM products";
    $whereClauses = [];

    if ($category && $category != 'All Medicines') {
        $whereClauses[] = "category = ?";
    }

    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }

    // Add sorting
    switch ($sort) {
        case 'price_asc':
            $sql .= " ORDER BY price ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY price DESC";
            break;
        case 'name_asc':
            $sql .= " ORDER BY name ASC";
            break;
        case 'name_desc':
            $sql .= " ORDER BY name DESC";
            break;
        default:
            $sql .= " ORDER BY product_id ASC";
    }

    // Prepare statement and bind parameters
    $stmt = $conn->prepare($sql);
    if ($category && $category != 'All Medicines') {
        $stmt->bind_param("s", $category);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    $conn->close();
    return $products;
}

// Insert a new product
function insertProduct($name, $description, $price, $category)
{
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $description, $price, $category);

    // Execute the query
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

function searchProducts($query)
{
    $conn = getDbConnection();
    $searchTerm = "%" . $query . "%";

    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ?");
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}
