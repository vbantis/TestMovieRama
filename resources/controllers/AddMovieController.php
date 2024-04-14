<?php

require_once __DIR__ . '/../models/MovieModel.php';

class AddMovieController {
    public function addMovie($title, $description, $userId) {
        $movieModel = new MovieModel();
        $movieModel->addMovie($title, $description, $userId);
    }
}

?>
