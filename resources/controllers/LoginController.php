<?php

require_once __DIR__ . '/../models/LoginModel.php';

class LoginController {
    public function loginUser($email, $password) {
        $loginModel = new LoginModel();
        return $loginModel->loginUser($email, $password);
    }
}

?>
