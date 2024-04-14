<?php

require_once __DIR__ . '/../../database/db.php'; // Adjust the path as needed

class UserMovieModel {
    public function getUserMovies($userId) {
        global $conn;

        // Fetch movies created by the specified user from the database
        $sql = "SELECT * FROM movies WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if movies were fetched successfully
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}

?>
