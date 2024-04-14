<?php

require_once __DIR__ . '/../models/RegisterModel.php';

class RegisterController {
    public function registerUser($name, $email, $password) {
        $registerModel = new RegisterModel();
        return $registerModel->registerUser($name, $email, $password);
    }
}

?>
