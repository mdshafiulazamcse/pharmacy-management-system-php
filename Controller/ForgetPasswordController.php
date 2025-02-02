<?php
require_once '../Model/ForgetPassword.php';
session_start();

$successMessage = $errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    require_once '../config.php';

    $token = generateToken($email, $conn);

    header("Location: ../controller/VerifyTokenController.php?email=" . urlencode($email));
    exit();
}

include('../View/forgetPasswordView.php');
?>
