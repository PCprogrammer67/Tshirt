<?php
session_start();
include 'includes/connection.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_mail = $_SESSION['user'];

// Get user_id from user table
$getUser = $conn->query("SELECT user_id FROM user WHERE mail_id = '$user_mail'");
if ($getUser->num_rows === 0) {
    die("User not found");
}
$row = $getUser->fetch_assoc();
$user_id = $row['user_id'];

// Remove item if requested
if (isset($_GET['remove'])) {
    $removeId = intval($_GET['remove']);
    $conn->query("DELETE FROM cart WHERE user_id = '$user_id' AND prodect_ID = '$removeId'");
    header("Location: cart.php");
    exit();
}

// Fetch cart data for the user
$sql = "SELECT c.qty, p.prodect_name, p.prodect_price, p.image as prodect_img, p.prodect_id
        FROM cart c
        JOIN prodect p ON c.prodect_ID = p.prodect_id
        WHERE c.user_id = '$user_id'";


$result = $conn->query($sql);

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4">🛒 Your Shopping Cart</h2>

  <?php if ($result->num_rows === 0): ?>
    <div class="alert alert-info">Your cart is empty!</div>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Image</th>
          <th>prodect</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): 
          $subtotal = $row['prodect_price'] * $row['qty'];
          $total += $subtotal;
        ?>
        <tr>
          <td><img src="<?= htmlspecialchars($row['prodect_img']) ?>" width="60" height="60"></td>
          <td><?= htmlspecialchars($row['prodect_name']) ?></td>
          <td>₹<?= number_format($row['prodect_price'], 2) ?></td>
          <td><?= $row['qty'] ?></td>
          <td>₹<?= number_format($subtotal, 2) ?></td>
          <td>
            <a href="cart.php?remove=<?= $row['prodect_id'] ?>" class="btn btn-sm btn-danger">Remove</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <h4>Total: ₹<?= number_format($total, 2) ?></h4>
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    <a href="home.php" class="btn btn-secondary">Continue Shopping</a>
  <?php endif; ?>
</div>

</body>
</html>
