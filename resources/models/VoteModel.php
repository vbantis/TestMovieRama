<?php

require_once __DIR__ . '/../../database/db.php';

class VoteModel {
    public function hasUserVoted($userId, $movieId, $voteType) {
        global $conn;

        // Check if the user has already voted for this movie
        $stmt = $conn->prepare("SELECT * FROM user_votes WHERE user_id = ? AND movie_id = ? AND vote = ?");
        $stmt->bind_param("iis", $userId, $movieId, $voteType);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function isUserMovieOwner($userId, $movieId) {
        global $conn;

        // Check if the movie belongs to the user
        $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $movieId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function addVote($userId, $movieId, $voteType) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO user_votes (user_id, movie_id, vote) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $movieId, $voteType);
        $stmt->execute();
    }
}

?>
