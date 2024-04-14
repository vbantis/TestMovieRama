<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);

// Redirect if user is not logged in
if (!$loggedIn) {
    header("Location: ../../resources/views/users/login.php");
    exit;
}

require_once '../../controllers/AddMovieController.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Instantiate the controller and add the movie
    $controller = new AddMovieController();
    $controller->addMovie($title, $description, $userId);

    // Redirect the user after processing the form
    header("Location: ./../../../index.php"); // Redirect to success page or homepage
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieRama - Add Movie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Navbar content -->
</nav>

<div class="container mt-5">
    <h1 class="mb-3">Add New Movie</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>