<?php
function validateToken($email, $token, $conn) {
    $sql = "SELECT * FROM users WHERE email = ? AND token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}
?>
