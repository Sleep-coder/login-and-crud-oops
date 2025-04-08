<?php
require_once __DIR__ . '/../../../config/app.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: index.php?message=Invalid student ID");
    exit();
}

$student = $studentController->show($id);
if (!$student) {
    header("Location: index.php?message=Student not found");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_student'])) {
    $data = [
        'f_name' => $_POST['f_name'],
        'l_name' => $_POST['l_name'],
        'age' => $_POST['age']
    ];

    $result = $studentController->update($id, $data);
    
    if ($result) {
        header("Location: index.php?update_msg=Student updated successfully");
    } else {
        header("Location: index.php?message=Update failed");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .container {
      max-width: 600px;
      margin-top: 50px;
    }

    .error {
      color: red;
      margin-bottom: 15px;
    }
    </style>
  </head>

  <body>
    <div class="container">
      <h2>Edit Student</h2>

      <?php if (isset($message)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="f_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="f_name" name="f_name"
            value="<?= htmlspecialchars($student['first_name']) ?>" required>
        </div>

        <div class="mb-3">
          <label for="l_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="l_name" name="l_name"
            value="<?= htmlspecialchars($student['last_name']) ?>" required>
        </div>

        <div class="mb-3">
          <label for="age" class="form-label">Age</label>
          <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($student['age']) ?>"
            required min="1">
        </div>

        <button type="submit" name="update_student" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</html>