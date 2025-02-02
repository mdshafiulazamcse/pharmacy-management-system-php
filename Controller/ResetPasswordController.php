<?php
require_once '../Model/ForgetPassword.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        require_once '../config.php';
        if (resetPassword($email, $newPassword, $conn)) {
            header("Location: ../controller/LoginController.php");
            exit();
        }
    }
}

include('../View/resetPasswordView.php');
?>
