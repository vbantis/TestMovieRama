<?php

require_once __DIR__ . '/../models/UserMovieModel.php';

class UserMovieController {
    public function getUserMovies($userId) {
        $userMovieModel = new UserMovieModel();
        return $userMovieModel->getUserMovies($userId);
    }
}
