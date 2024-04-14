<?php
require_once '../../controllers/LogoutController.php';

$logoutController = new LogoutController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $logoutController->logoutUser();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieRama - Logout</title>
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-3">Logout</h1>
    <form action="" method="post">
        <p>Are you sure you want to logout?</p>
        <button type="submit" class="btn btn-primary" name="logout">Logout</button>
    </form>
</div>
</body>
</html>
