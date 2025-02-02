<?php
// Start the session to store success message
session_start();

// Define upload directory
$uploadDir = "../upload/";

// Get the file's temporary source path and destination path
$src = $_FILES['myfile']['tmp_name'];
$des = $uploadDir . basename($_FILES['myfile']['name']);

// Check if the file was successfully uploaded
if (move_uploaded_file($src, $des)) {
    // Set success message in session
    $_SESSION['success_message'] = "Prescription uploaded successfully!";

    // Store the uploaded file path in session to allow viewing
    $_SESSION['uploaded_file'] = $des;

    // Redirect to the prescription_medicines page
    header("Location: ../view/prescription_medicines.php");
    exit();
} else {
    // Set error message in session
    $_SESSION['error_message'] = "Error uploading the prescription. Please try again.";

    // Redirect back to the upload form
    header("Location: ../view/upload_prescription.php");
    exit();
}
