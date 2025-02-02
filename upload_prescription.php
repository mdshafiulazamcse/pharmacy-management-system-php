<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['prescription_file'])) {
    // Database connection
    $host = 'localhost';
    $db = 'medicare';
    $user = 'root';  // Your DB username
    $pass = '';  // Your DB password

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // File upload logic
    $file = $_FILES['prescription_file'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    if ($file_error === 0) {
        if ($file_size <= 5000000) {  // 5MB max size
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];

            if (in_array(strtolower($file_extension), $allowed_extensions)) {
                // Generate a unique name for the file
                $file_new_name = uniqid('', true) . "." . $file_extension;
                $file_destination = 'uploads/' . $file_new_name;

                // Move the file to the uploads folder
                if (move_uploaded_file($file_tmp_name, $file_destination)) {
                    // Insert file data into the database
                    $user_id = $_SESSION['user_id'];
                    $query = "INSERT INTO prescriptions (user_id, prescription_image_path, upload_date) 
                              VALUES (?, ?, NOW())";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('is', $user_id, $file_destination);

                    if ($stmt->execute()) {
                        echo "Prescription uploaded successfully!";
                    } else {
                        echo "Error uploading prescription.";
                    }

                    $stmt->close();
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file type. Only JPG, PNG, and PDF are allowed.";
            }
        } else {
            echo "File size exceeds the maximum limit of 5MB.";
        }
    } else {
        echo "There was an error uploading your file.";
    }

    $conn->close();
}
?>
