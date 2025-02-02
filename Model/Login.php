<?php
function authenticate($email, $password, $conn) {
    $sql = "SELECT id FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Log the error if query preparation fails
        error_log("SQL error: " . $conn->error);
        return null;
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['id']; // Return the user's ID
    } else {
        return null; // Return null if authentication fails
    }
}

?>