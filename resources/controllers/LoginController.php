<?php

require_once __DIR__ . '/../models/LoginModel.php';

class LoginController {
    public function loginUser($email, $password) {
        // Instantiate the model
        $loginModel = new LoginModel();

        // Login the user
        return $loginModel->loginUser($email, $password);
    }
}

?>
