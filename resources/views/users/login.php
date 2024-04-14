<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ./../../../index.php");
    exit;
}

require_once '../../controllers/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $loginController = new LoginController();
    $userId = $loginController->loginUser($email, $password);

    if ($userId) {
        $_SESSION['user_id'] = $userId;

        header("Location: ./../../../index.php");
        exit;
    } else {
        $error = "Invalid email or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieRama - Login</title>
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <style>
        /* Center the container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title mb-4">Login</h1>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="/index.php" class="btn btn-secondary">Back</a> <!-- Move back button here -->
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
