<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit();
}

require_once __DIR__ . '/../../../config/app.php';

// Get all students
$students = $studentController->index();
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .heading {
      background-color: black;
      color: white;
      padding: 20px;
      position: relative;
    }

    .box1 {
      overflow: hidden;
      margin-bottom: 20px;
    }

    .box1 h2 {
      float: left;
    }

    .box1 button {
      float: right;
    }

    .container {
      margin-top: 50px;
    }

    .logout-btn {
      position: absolute;
      top: 50%;
      right: 20px;
      transform: translateY(-50%);
    }

    .alert-custom {
      margin: 10px auto;
      max-width: 500px;
      text-align: center;
    }
    </style>
  </head>

  <body>
    <h1 class="heading">
      STUDENT MANAGEMENT SYSTEM
      <a href="../../../index.php?logout=true" class="btn btn-danger logout-btn">Logout</a>
    </h1>

    <div class="container">


      <div class="box1 mb-4">
        <h2>ALL STUDENTS</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
          ADD STUDENT
        </button>
      </div>

      <!-- Students Table -->
      <table class="table table-hover table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $student): ?>
          <tr>
            <td><?= htmlspecialchars($student['id']) ?></td>
            <td><?= htmlspecialchars($student['first_name']) ?></td>
            <td><?= htmlspecialchars($student['last_name']) ?></td>
            <td><?= htmlspecialchars($student['age']) ?></td>
            <td>
              <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-success">Edit</a>
              <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger"
                onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <br>
      <br>
      <!-- Display messages -->
      <?php if (isset($_GET['message'])): ?>
      <div class="alert alert-warning alert-custom"><?= htmlspecialchars($_GET['message']) ?></div>
      <?php endif; ?>

      <?php if (isset($_GET['insert_msg'])): ?>
      <div class="alert alert-success alert-custom"><?= htmlspecialchars($_GET['insert_msg']) ?></div>
      <?php endif; ?>

      <?php if (isset($_GET['update_msg'])): ?>
      <div class="alert alert-success alert-custom"><?= htmlspecialchars($_GET['update_msg']) ?></div>
      <?php endif; ?>


      <!-- Add Student Modal -->
      <div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="create.php" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" name="f_name" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" name="l_name" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Age</label>
                  <input type="number" name="age" class="form-control" required min="1">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_student" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</html>