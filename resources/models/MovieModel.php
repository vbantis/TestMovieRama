<?php

require_once __DIR__ . '/../../database/db.php';

class MovieModel {
    public function addMovie($title, $description, $userId) {
        global $conn;

        $sql = "INSERT INTO movies (title, description, user_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $userId);
        $stmt->execute();
    }
}

?>