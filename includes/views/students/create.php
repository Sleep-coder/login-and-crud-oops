<?php
require_once __DIR__ . '/../../../config/app.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
    $data = [
        'f_name' => $_POST['f_name'],
        'l_name' => $_POST['l_name'],
        'age' => $_POST['age']
    ];
    
    $result = $studentController->create($data);
    
    if ($result === true) {
        header("Location: index.php?insert_msg=Student added successfully!");
    } else {
        header("Location: index.php?message=" . urlencode($result));
    }
    exit();
}

header("Location: index.php");