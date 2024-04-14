<?php

require_once __DIR__ . '/../models/VoteModel.php';

class VoteController {
    public function handleVote($userId, $movieId, $voteType) {
        $voteModel = new VoteModel();


        if ($voteModel->hasUserVoted($userId, $movieId, $voteType)) {
            exit("You have already voted for this movie");
        }


        if ($voteModel->isUserMovieOwner($userId, $movieId)) {
            exit("You cannot like a movie you have created");
        }


        $voteModel->addVote($userId, $movieId, $voteType);

        echo "Movie liked successfully";
    }
}

?>
