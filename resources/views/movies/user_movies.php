<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, handle this case accordingly (e.g., redirect to login page)
    header("Location: /login.php"); // Adjust the path if needed
    exit();
}

require_once '../../controllers/UserMovieController.php';

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Instantiate the controller and get user movies
$controller = new UserMovieController();
$movies = $controller->getUserMovies($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Movies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        /* Additional CSS styles as needed */
        .movie-title {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .movie-details {
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-3">Movies Created by User</h1>
    <?php foreach ($movies as $movie): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title movie-title"><?php echo $movie['title']; ?></h5>
                <p class="card-text movie-details">
                    Added <?php echo date('F j, Y, g:i a', strtotime($movie['date_added'])); ?> ago
                </p>
                <p class="card-text"><?php echo $movie['description']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <a href="../../../index.php" class="btn btn-primary">Back to Homepage</a>
</div>

<!-- JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
