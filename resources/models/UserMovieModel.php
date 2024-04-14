<?php

require_once __DIR__ . '/../../database/db.php';

class UserMovieModel {
    public function getUserMovies($userId) {
        global $conn;

        $sql = "SELECT * FROM movies WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}

?>
