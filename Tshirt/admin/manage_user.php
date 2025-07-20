<?php
include 'includes/connection.php';
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM user WHERE user_id = $id");
    header("Location: manage_users.php");
    exit();
}

$result = $conn->query("SELECT * FROM user ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid">
  <div class="row">
    <?php include "includes/side_bar.php" ?>
     <main class="col-md-10 ms-sm-auto px-4 pt-4">
<div class="container mt-5">
  <h2 class="mb-4">Manage Users</h2>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone No</th>
        <th>Email</th>
        <th>Address</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['user_id'] ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['phone_no']) ?></td>
          <td><?= htmlspecialchars($row['mail_id']) ?></td>
          <td><?= htmlspecialchars($row['address']) ?></td>
          <td><?= $row['created_at'] ?></td>
          <td>
            <a href="manage_users.php?delete_id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="admin.php" class="btn btn-secondary">Back to Dashboard</a>
</div>
      </main>
      </div>
      </div>
</body>
</html>
