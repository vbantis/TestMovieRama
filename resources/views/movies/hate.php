<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, handle this case accordingly (e.g., redirect to login page)
    exit("User is not logged in");
}

if (!isset($_POST['movie_id'])) {
    exit("Movie ID is not provided");
}

require_once '../../controllers/VoteController.php';

// Retrieve user ID and movie ID from POST data
$userId = $_SESSION['user_id'];
$movieId = $_POST['movie_id'];

// Instantiate the controller and handle the vote
$controller = new VoteController();
$controller->handleVote($userId, $movieId,'hate');
?>
