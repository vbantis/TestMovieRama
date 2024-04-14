<?php

require_once __DIR__ . '/../models/VoteModel.php';

class VoteController {
    public function handleVote($userId, $movieId, $voteType) {
        // Instantiate the model
        $voteModel = new VoteModel();

        // Check if the user has already voted for this movie
        if ($voteModel->hasUserVoted($userId, $movieId, $voteType)) {
            exit("You have already voted for this movie");
        }

        // Check if the movie belongs to the user
        if ($voteModel->isUserMovieOwner($userId, $movieId)) {
            exit("You cannot like a movie you have created");
        }

        // Add the user's vote
        $voteModel->addVote($userId, $movieId, $voteType);

        // Return a success message
        echo "Movie liked successfully";
    }
}

?>
