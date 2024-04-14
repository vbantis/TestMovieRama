<?php

require_once __DIR__ . '/../models/MovieModel.php';

class AddMovieController {
    public function addMovie($title, $description, $userId) {
        // Instantiate the model
        $movieModel = new MovieModel();

        // Call the model's method to add the movie
        $movieModel->addMovie($title, $description, $userId);
    }
}

?>
