<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'includes/connection.php';

$user_mail = $_SESSION['user']; // if $_SESSION['user'] contains mail_id

// Get user ID from mail
$user_sql = "SELECT user_id FROM user WHERE mail_id = '$user_mail'";
$user_result = $conn->query($user_sql);
$user_id = 0;

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['user_id'];
}

// Corrected query: join `wishlist` and `prodect`
$sql = "SELECT p.* FROM wishlist w 
        JOIN prodect p ON w.product_id = p.prodect_ID 
        WHERE w.user_id = $user_id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>My Wishlist</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
 <h3 class="mb-4">My Wishlist</h3>
 <?php if ($result && $result->num_rows > 0){ ?>
    <table class="table table-bordered">
      <thead class="table-secondary">
        <tr>
          <th>Image</th><th>Name</th><th>Price</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($item = $result->fetch_assoc()){ ?>
        <tr>
          <td><img src="<?= htmlspecialchars($item['image']) ?>" width="80"></td>
          <td><?= htmlspecialchars($item['prodect_name']) ?></td>
          <td>₹<?= number_format($item['prodect_price'], 2) ?><?= $item['prodect_ID'] ?></td>
          <td>
            <a href="add_to_cart.php?id=<?= $item['prodect_ID'] ?>" class="btn btn-sm btn-success">Add to Cart</a>
            <a href="add_remove_wishlist.php?prodect_ID=<?= $item['prodect_ID'] ?>" class="btn btn-sm btn-danger">Remove</a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  <?php } else {?>
    <p>Your wishlist is empty.</p>
    <a href="home.php" class="btn btn-primary">Continue Shopping</a>
  <?php }?>
</div>
</body>
</html>
