<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    exit("User is not logged in");
}

if (!isset($_POST['movie_id'])) {
    exit("Movie ID is not provided");
}

require_once '../../controllers/VoteController.php';

$userId = $_SESSION['user_id'];
$movieId = $_POST['movie_id'];

$controller = new VoteController();
$controller->handleVote($userId, $movieId,'hate');
?>
