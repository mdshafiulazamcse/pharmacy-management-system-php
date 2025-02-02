<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get products based on filters
function getProducts($categories = [], $brands = [], $minPrice = null, $maxPrice = null, $minRating = null, $sort = null) {
    global $conn;
    $sql = "SELECT * FROM personal_care WHERE 1=1";
    $params = [];
    $types = "";

    // Category filter
    if (!empty($categories)) {
        $placeholders = str_repeat("?,", count($categories) - 1) . "?";
        $sql .= " AND category IN ($placeholders)";
        $params = array_merge($params, $categories);
        $types .= str_repeat("s", count($categories));
    }

    // Brand filter
    if (!empty($brands)) {
        $placeholders = str_repeat("?,", count($brands) - 1) . "?";
        $sql .= " AND brand IN ($placeholders)";
        $params = array_merge($params, $brands);
        $types .= str_repeat("s", count($brands));
    }

    // Price range filter
    if ($minPrice !== null && $minPrice !== '') {
        $sql .= " AND price >= ?";
        $params[] = $minPrice;
        $types .= "d";
    }
    if ($maxPrice !== null && $maxPrice !== '') {
        $sql .= " AND price <= ?";
        $params[] = $maxPrice;
        $types .= "d";
    }

    // Rating filter
    if ($minRating !== null && $minRating !== '') {
        $sql .= " AND rating >= ?";
        $params[] = $minRating;
        $types .= "d";
    }

    // Sorting
    switch ($sort) {
        case 'price_asc':
            $sql .= " ORDER BY price ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY price DESC";
            break;
        case 'rating':
            $sql .= " ORDER BY rating DESC, rating_count DESC";
            break;
        case 'newest':
            $sql .= " ORDER BY created_at DESC";
            break;
        default:
            $sql .= " ORDER BY rating_count DESC"; // Default sort
    }

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    return $products;
}

// Function to get categories
function getCategories() {
    global $conn;
    $sql = "SELECT DISTINCT category FROM personal_care";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get brands
function getBrands() {
    global $conn;
    $sql = "SELECT DISTINCT brand FROM personal_care";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>