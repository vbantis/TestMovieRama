<?php
require_once '../../controllers/RegisterController.php';

// Instantiate the controller
$registerController = new RegisterController();

// Initialize error variable
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format. Please enter a valid email.";
    } elseif ($password !== $confirmPassword) {
        // Check if passwords match
        $error = "Passwords do not match. Please make sure your passwords match.";
    } elseif (strlen($password) < 8 || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[0-9]+#", $password) || !preg_match("#\W+#", $password)) {
        // Check if password meets complexity requirements
        $error = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        // Attempt to register the user
        if ($registerController->registerUser($name, $email, $password)) {
            // Registration successful
            // Redirect to login page
            header("Location: login.php");
            exit;
        } else {
            // Registration failed
            $error = "Registration failed. Please try again.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieRama - Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .registration-form {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 100px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .registration-form h1 {
            text-align: center;
            color: #333333;
        }
        .registration-form label {
            font-weight: bold;
        }
        .registration-form .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 48%; /* Adjusted width for both buttons */
        }
        .registration-form .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            width: 48%; /* Adjusted width for both buttons */
        }
        .registration-form .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="registration-form">
        <h1 class="mb-4">Register</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                <a href="../../../index.php" class="btn btn-secondary btn-block">Back</a> <!-- Back button -->
            </div>
        </form>
    </div>
</div>
</body>
</html>
