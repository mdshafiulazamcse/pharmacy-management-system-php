<?php
session_start();

// Handle file upload if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {
    $src = $_FILES['myfile']['tmp_name'];
    $des = "../upload/" . $_FILES['myfile']['name'];

    if (move_uploaded_file($src, $des)) {
        $successMessage = "Prescription uploaded successfully!";
        $uploadedFile = $des;
    } else {
        $errorMessage = "Error uploading the prescription. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Plus - Upload Prescription</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <style>
        form {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 10px;
        }

        input[type="file"] {
            border: 2px dashed #ccc;
            border-radius: 6px;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            outline: none;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        input[type="file"]:hover {
            border-color: #007bff;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            text-align: center;
        }

        .alert.success {
            background-color: rgb(212, 234, 237);
            color: rgb(21, 59, 87);
            border: 1px solidrgb(195, 220, 230);
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert p {
            margin: 10px 0;
        }

        .link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .link:hover {
            text-decoration: underline;
        }

        .button {
            display: inline-block;
            background-color: rgb(40, 133, 167);
            color: #ffffff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: rgb(33, 91, 136);
        }
    </style>
</head>


<body>
    <nav class="navbar">
        <div class="brand">MediCare Plus</div>
        <div class="menu">
            <a class="menu-item" href="../customerDashboard.php">Home</a>
            <a class="menu-item" href="../customerDashboard.php#categories">Categories</a>
            <a class="menu-item" href="../Controller/orders_controller.php">My Orders</a>
            <a class="menu-item" href="../Controller/cart_controller.php">Cart</a>
            <a class="menu-item" href="../View/profile.php">Account</a>
            <a class="menu-item" href="../logout.php">Logout</a>
        </div>
    </nav>

    <div class="banner">
        <div class="banner-content">
            <h2>Upload Prescription</h2>
            <form method="post" enctype="multipart/form-data">
                <label for="myfile">Select an image:</label>
                <input type="file" name="myfile" id="myfile" required>
                <button type="submit">Upload</button>
            </form>

            <!-- Display success or error message -->
            <?php if (!empty($successMessage)): ?>
                <div class="alert success">
                    <p><?php echo htmlspecialchars($successMessage); ?></p>
                    <p><a href="<?php echo htmlspecialchars($uploadedFile); ?>" target="_blank" class="link">View Uploaded Prescription</a></p>
                    <a href="prescription_medicines.php" class="button">Go to Prescription Medicines</a>
                </div>
            <?php elseif (!empty($errorMessage)): ?>
                <div class="alert error">
                    <p><?php echo htmlspecialchars($errorMessage); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>