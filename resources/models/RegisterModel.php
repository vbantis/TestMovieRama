<?php

require_once __DIR__ . '/../../database/db.php'; // Adjust the path as needed

class RegisterModel {
    public function registerUser($name, $email, $password) {
        global $conn;

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful
            return true;
        } else {
            // Registration failed
            return false;
        }
    }
}

?>
