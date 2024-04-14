<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);

// Database connection
require_once './database/db.php'; // Adjust the path as needed

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to get the user's full name from the database
function getUserFullName($userId, $conn) {
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    } else {
        return false;
    }
}

// Get the user's full name if logged in
$userFullName = '';
if ($loggedIn && isset($_SESSION['user_id'])) {
    $userFullName = getUserFullName($_SESSION['user_id'], $conn);
}

// Set the welcome message
$welcomeMessage = $loggedIn ? "Welcome back, $userFullName" : "Welcome to MovieRama";

// Set default sorting order
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'date_added';
$sortOptions = ['date_added', 'likes', 'hates'];

// Validate sorting order
if (!in_array($sort, $sortOptions)) {
    $sort = 'date_added'; // Default to date_added if invalid option is provided
}

// Fetch movies from the database along with likes and hates count
$sql = "SELECT movies.*, 
               users.id AS user_id,
               users.name AS user_name,
               COALESCE(SUM(CASE WHEN uv.vote = 'like' THEN 1 ELSE 0 END), 0) AS likes,
               COALESCE(SUM(CASE WHEN uv.vote = 'hate' THEN 1 ELSE 0 END), 0) AS hates
        FROM movies 
        LEFT JOIN users ON movies.user_id = users.id
        LEFT JOIN user_votes uv ON movies.id = uv.movie_id
        GROUP BY movies.id
        ORDER BY $sort DESC"; // Sort by specified field in descending order
$result = $conn->query($sql);

// Check if movies were fetched successfully
if ($result && $result->num_rows > 0) {
    $movies = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $movies = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieRama - Movies</title>
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
        .like-dislike-buttons {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MovieRama</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="nav-link"><?php echo $welcomeMessage; ?></span>
            </li>
            <?php if ($loggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="resources/views/movies/add.php">Add New Movie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resources/views/users/logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="resources/views/users/register.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resources/views/users/login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-3">MovieRama - Movies</h1>
    <div class="mb-3">
        <strong>Sort By:</strong>
        <a href="?sort=date_added">Date Added</a> |
        <a href="?sort=likes">Likes</a> |
        <a href="?sort=hates">Hates</a>
    </div>
    <?php foreach ($movies as $movie): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title movie-title"><?php echo $movie['title']; ?></h5>
                <p class="card-text movie-details">
                    Created by: <a href="resources/views/movies/user_movies.php?user_id=<?php echo $movie['user_id']; ?>"><?php echo $movie['user_name']; ?></a>,
                    Added <?php echo date('F j, Y, g:i a', strtotime($movie['date_added'])); ?> ago
                </p>
                <p class="card-text"><?php echo $movie['description']; ?></p>
                <p class="card-text">
                    Likes: <?php echo $movie['likes']; ?> |
                    Hates: <?php echo $movie['hates']; ?>
                </p>
                <?php if ($loggedIn): ?>
                    <div class="like-dislike-buttons">
                        <!-- Add like/dislike buttons here -->
                        <!-- You can style these buttons as needed -->
                        <button type="button" class="btn btn-success like-btn" data-movie-id="<?php echo $movie['id']; ?>">Like</button>
                        <button type="button" class="btn btn-danger hate-btn" data-movie-id="<?php echo $movie['id']; ?>">Hate</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.like-btn').click(function(){
            var movieId = $(this).data('movie-id');
            $.ajax({
                url: './resources/views/movies/like.php',
                method: 'POST',
                data: {movie_id: movieId},
                success: function(response){
                    // Reload the page after successful like
                    location.reload();
                }
            });
        });

        $('.hate-btn').click(function(){
            var movieId = $(this).data('movie-id');
            $.ajax({
                url: './resources/views/movies/hate.php',
                method: 'POST',
                data: {movie_id: movieId},
                success: function(response){
                    // Reload the page after successful hate
                    location.reload();
                }
            });
        });
    });
</script>
</body>
</html>