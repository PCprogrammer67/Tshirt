<?php
session_start();
include 'includes/connection.php';  

$sql = "SELECT * FROM prodect WHERE is_deleted = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid">
  <div class="row">
    <?php include "includes/side_bar.php" ?>
     <main class="col-md-10 ms-sm-auto px-4 pt-4">
<div class="container mt-5">
  <h2 class="mb-4">Manage Products</h2>
<div style="display: flex; justify-content: flex-end;">
  <a href="add_product.php" class="btn btn-success mb-3">+ Add Product</a>
</div>


  <?php if ($result && $result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price (₹)</th>
            <th>Size</th>
            <th>About</th>
            <th>category</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['prodect_ID'] ?></td>
              <td>
                <img src="../<?= $row['image'] ?>" width="70" height="70" style="object-fit: cover;">
              </td>
              <td><?= htmlspecialchars($row['prodect_name']) ?></td>
              <td><?= number_format($row['prodect_price'], 2) ?></td>
              <td><?= $row['prodect_size'] ?></td>
              <td><?= $row['category'] ?></td>
              <td><?= htmlspecialchars($row['prodect_about']) ?></td>
              <td >
                <a href="edit_product.php?id=<?= $row['prodect_ID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_product.php?id=<?= $row['prodect_ID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No products found.</div>
  <?php endif; ?>
  </div>  
</body>
</html>
