<?php

require_once __DIR__ . '/../models/RegisterModel.php';

class RegisterController {
    public function registerUser($name, $email, $password) {
        // Instantiate the model
        $registerModel = new RegisterModel();

        // Register the user
        return $registerModel->registerUser($name, $email, $password);
    }
}

?>
