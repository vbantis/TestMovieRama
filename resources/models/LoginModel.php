<?php

require_once __DIR__ . '/../../database/db.php'; // Adjust the path as needed

class LoginModel {
    public function loginUser($email, $password) {
        global $conn;

        // Retrieve user from database
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, return user ID
                return $user['id'];
            }
        }

        // User not found or password incorrect
        return false;
    }
}

?>
