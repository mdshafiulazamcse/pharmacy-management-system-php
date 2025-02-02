<?php
require_once '../Model/Register.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once '../config.php';

    if (registerUser($name, $email, $password, $conn)) {
        header("Location: ../controller/LoginController.php");
        exit();
    }
}

include('../View/registerView.php');
?>
