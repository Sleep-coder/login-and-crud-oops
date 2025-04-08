<?php
require_once __DIR__ . '/../../../config/app.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit();
}

$result = $studentController->delete($id);

if ($result) {
    header("Location: index.php?delete_msg=Student deleted successfully!");
} else {
    header("Location: index.php?message=Delete failed");
}
exit();