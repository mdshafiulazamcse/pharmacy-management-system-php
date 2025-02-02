<?php
require_once '../Model/VerifyToken.php';
session_start();

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    
    require_once '../config.php';

    if (validateToken($email, $token, $conn)) {
        header("Location: ../controller/ResetPasswordController.php?email=$email&token=$token");
        exit();
    }
}

include('../View/verifyTokenView.php');
?>
