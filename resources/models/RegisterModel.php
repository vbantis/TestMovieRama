<?php

require_once __DIR__ . '/../../database/db.php';

class RegisterModel {
    public function registerUser($name, $email, $password) {
        global $conn;


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>
