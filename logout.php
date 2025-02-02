<?php
setcookie('flag', 'abc', time() - 10, '/');
setcookie('id', '', time() - 3600, '/');
header('location: view/loginview.php');
?>
