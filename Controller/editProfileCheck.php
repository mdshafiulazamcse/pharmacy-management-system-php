<?php
require_once '../config.php'; // Ensure correct database connection
session_start(); // Start session

if (!isset($_SESSION['id'])) {
    echo "User not logged in.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userId = $_SESSION['id']; // Fetch the user ID from the session

    // Validate input
    if (empty($name) || empty($email)) {
        echo "Name and email fields cannot be empty.";
        exit();
    }

    // Prepare and execute the update query
    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $name, $email, $userId);

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
            header('Location: ../view/profile.php'); // Redirect after successful update
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>
