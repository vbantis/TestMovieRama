<?php

require_once __DIR__ . '/../models/UserMovieModel.php';

class UserMovieController {
    public function getUserMovies($userId) {
        // Instantiate the model
        $userMovieModel = new UserMovieModel();

        // Get user movies from the model
        return $userMovieModel->getUserMovies($userId);
    }
}
