<?php
// Database connection
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

// Function to get devices based on filters and sorting
function getDevices($conn, $minPrice = null, $maxPrice = null, $minRating = null, $sort = null)
{
    $sql = "SELECT * FROM devices WHERE 1=1";
    $params = [];
    $types = "";

    // Add price range filter
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

    // Add rating filter
    if ($minRating !== null && $minRating !== '') {
        $sql .= " AND rating >= ?";
        $params[] = $minRating;
        $types .= "d";
    }

    // Add sorting
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
            $sql .= " ORDER BY device_id DESC";
            break;
        default:
            $sql .= " ORDER BY rating_count DESC"; // Featured items by default
    }

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        // Bind parameters
        $stmt->bind_param($types, ...$params);
    }

    // Execute statement and fetch results
    $stmt->execute();
    $result = $stmt->get_result();
    $devices = [];

    while ($row = $result->fetch_assoc()) {
        $devices[] = $row;
    }

    // Close statement
    $stmt->close();
    return $devices;
}
