<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit();
}

echo "
        <script>
        alert('Login Success');
        window.location.href='students/index.php';  // Redirect to CRUD page
        </script>
        ";
?>
<a href="../index.php?logout=true">Logout</a>