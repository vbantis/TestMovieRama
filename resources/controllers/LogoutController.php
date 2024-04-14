<?php

class LogoutController {
    public function logoutUser() {
        // Destroy the session
        session_start();
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session

        // Redirect to the login page
        header("Location: ./../../../index.php");
        exit;
    }
}

?>
