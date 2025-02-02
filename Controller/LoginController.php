<?php
require_once '../Model/Login.php';
$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once '../config.php';

   
    $userId = authenticate($email, $password, $conn);
    if ($userId) {
 
        session_start();
        setcookie('flag', 'true', time() + 3000, '/');
 
        $_SESSION['id'] = $userId;
 
        header("Location: ../customerdashboard.php");
        exit();
    } else {
        $error = "Invalid User!";
    }
}


include('../View/loginview.php');
?>