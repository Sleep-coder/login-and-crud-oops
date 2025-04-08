<?php
// includes/controllers/UserController.php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../config/DatabaseConnection.php';

class UserController {
    private $authConn;
    private $userModel;

    public function __construct($authConn) {
        $this->authConn = $authConn;
        $this->userModel = new User($authConn);
    }

    public function registerUser($name, $email, $number, $password) {
        // Validate inputs
        $errors = [];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email ID format.";
        }

        if (!preg_match("/^[0-9]{10}$/", $number)) {
            $errors[] = "Phone number must be 10 digits.";
        }

        if (!preg_match("/^[a-zA-Z0-9_ ]*$/", $name)) {
            $errors[] = "Only letters, numbers, spaces and underscores allowed for name.";
        }

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        }

        if (!empty($errors)) {
            return implode("<br>", $errors);
        }

        // Hash password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Call model to register user
        return $this->userModel->register($name, $email, $number, $hashedPassword);
    }

    public function loginUser($email, $password) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        return $this->userModel->login($email, $password);
    }

    public function logoutUser() {
        return $this->userModel->logout();
    }
}