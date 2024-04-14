<?php

class LogoutController {
    public function logoutUser() {
        session_start();
        session_unset();
        session_destroy();

        header("Location: ./../../../index.php");
        exit;
    }
}

?>
