<?php

session_start();
include 'includes/connection.php';


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_mail = $_SESSION['user'];


$sql = "SELECT user_id FROM user WHERE mail_id = '$user_mail'";
$result = $conn->query($sql);
$user_mail = 0;

if ($row = $result->fetch_assoc()) {
    $user_mail = $row['user_id'];
}


$sql = "SELECT c.*, p.prodect_name, p.prodect_price, p.image 
        FROM cart c 
        JOIN prodect p ON c.prodect_id = p.prodect_ID 
      WHERE c.user_id = '$user_mail'";
$result = $conn->query($sql);

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Stylish T-Shirts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
  <h3 class="mb-4">Checkout</h3>

  <?php if ($result && $result->num_rows > 0) { ?>
    <table class="table table-bordered">
      <thead class="table-secondary">
        <tr>
          <th>Image</th><th>Name</th><th>Price</th><th>Qty</th><th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()) {
          $subtotal = $row['prodect_price'] * $row['qty'];
          $total += $subtotal;
      ?>
        <tr>
          <td><img src="<?= $row['image'] ?>" width="80"></td>
          <td><?= $row['prodect_name'] ?></td>
          <td>₹<?= number_format($row['prodect_price'], 2) ?></td>
          <td><?= $row['qty'] ?></td>
          <td>₹<?= number_format($subtotal, 2) ?></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>

    <div class="text-end">
      <h5>Total: ₹<?= number_format($total, 2) ?></h5>
      <form action="place_order.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <input type="hidden" name="total" value="<?= $total ?>">
        <button type="submit" class="btn btn-success mt-3">Place Order</button>
      </form>
    </div>

  <?php } else { ?>
    <p>Your cart is empty. <a href="home.php">Shop now</a></p>
  <?php } ?>
</div>
</body>
</html>
