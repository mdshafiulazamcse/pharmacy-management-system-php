<?php
function generateToken($email, $conn) {
    $token = bin2hex(random_bytes(16));
    $sql = "UPDATE users SET token = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $token, $email);
    
    if ($stmt->execute()) {
        return $token;
    }
    return false;
}

function validateToken($email, $token, $conn) {
    $sql = "SELECT * FROM users WHERE email = ? AND token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

function resetPassword($email, $newPassword, $conn) {
    $sql = "UPDATE users SET password = ?, token = NULL WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPassword, $email);
    return $stmt->execute();
}
?>
