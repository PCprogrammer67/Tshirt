<?php
session_start();
include 'includes/connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user_mail = $_SESSION['user'];

// Get user_id
$user_sql = "SELECT user_id FROM user WHERE mail_id = '$user_mail'";
$user_result = $conn->query($user_sql);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['user_id'];
} else {
    echo "User not found.";
    exit();
}

// Fetch orders with product details
$order_sql = "SELECT o.*, p.prodect_name, p.image 
              FROM orders o
              JOIN prodect p ON o.product_id = p.prodect_ID
              WHERE o.user_id = $user_id
              ORDER BY o.order_date DESC";
$order_result = $conn->query($order_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order History</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
  <h3 class="mb-4">My Order History</h3>

  <?php if ($order_result && $order_result->num_rows > 0) { ?>
    <table class="table table-bordered">
      <thead class="table-secondary">
        <tr>
          <th>Image</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Total Price</th>
          <th>Order Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $order_result->fetch_assoc()) { ?>
          <tr>
            <td><img src="<?= htmlspecialchars($row['image']) ?>" width="80"></td>
            <td><?= htmlspecialchars($row['prodect_name']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>₹<?= number_format($row['total_price'], 2) ?></td>
            <td><?= $row['order_date'] ?></td>
            <td><?= $row['status'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p>You haven't placed any orders yet.</p>
    <a href="home.php" class="btn btn-primary">Start Shopping</a>
  <?php } ?>
</div>
</body>
</html>
