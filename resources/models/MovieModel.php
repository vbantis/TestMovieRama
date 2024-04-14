<?php

require_once __DIR__ . '/../../database/db.php'; // Adjust the path as needed

class MovieModel {
    public function addMovie($title, $description, $userId) {
        global $conn;

        // Prepare and execute SQL INSERT query
        $sql = "INSERT INTO movies (title, description, user_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $userId);
        $stmt->execute();
    }
}

?>