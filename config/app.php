<?php
// Database credentials
define('AUTH_DB_HOST', 'localhost');
define('AUTH_DB_USER', 'root'); 
define('AUTH_DB_PASSWORD', ''); 
define('AUTH_DB_NAME', 'user');

define('CRUD_DB_HOST', 'localhost');
define('CRUD_DB_USER', 'root'); 
define('CRUD_DB_PASSWORD', ''); 
define('CRUD_DB_NAME', 'crud_operations');



// Database connections
try {
    require_once __DIR__ . '/DatabaseConnection.php';
    
    // Authentication DB
    $authDb = new DatabaseConnection(AUTH_DB_HOST, AUTH_DB_USER, AUTH_DB_PASSWORD, AUTH_DB_NAME);
    $authConn = $authDb->getConnection();
    
    // CRUD DB
    $crudDb = new DatabaseConnection(CRUD_DB_HOST, CRUD_DB_USER, CRUD_DB_PASSWORD, CRUD_DB_NAME);
    $crudConn = $crudDb->getConnection();

} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Load models and controllers
require_once __DIR__ . '/../includes/models/User.php';
require_once __DIR__ . '/../includes/controllers/UserController.php';
require_once __DIR__ . '/../includes/models/Student.php';
require_once __DIR__ . '/../includes/controllers/StudentController.php';

// Initialize controllers
$userController = new UserController($authConn);
$studentModel = new Student($crudConn);
$studentController = new StudentController($studentModel);
?>