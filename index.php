<?php
// index.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/DatabaseConnection.php';
require_once __DIR__ . '/includes/controllers/UserController.php';

// Initialize database connection
// $db = new DatabaseConnection();
// $conn = $db->getConnection();

// Initialize controller
$userController = new UserController($authConn);

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Sanitize inputs
        $name = $authConn->real_escape_string($_POST['name']);
        $email = $authConn->real_escape_string($_POST['email']);
        $number = $authConn->real_escape_string($_POST['number']);
        $password = $_POST['password']; 
        
        $result = $userController->registerUser($name, $email, $number, $password);
        
        if ($result === "Registration successful!") {
            header("Location: includes/views/login.php?success=1");
            exit();
        } else {
            header("Location: includes/views/signup.php?error=" . urlencode($result));
            exit();
        }
    }
    
    if (isset($_POST['login'])) {
        $email = $authConn->real_escape_string($_POST['useremail']);
        $password = $_POST['userpassword']; // Don't escape passwords
        
        if ($userController->loginUser($email, $password)) {
            header("Location: includes/views/dashboard.php");
            exit();
        } else {
            header("Location: includes/views/login.php?error=1");
            exit();
        }
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    $userController->logoutUser();
    header("Location: includes/views/login.php");
    exit();
}

// Default view (if no other actions)
header("Location: includes/views/login.php");
exit();