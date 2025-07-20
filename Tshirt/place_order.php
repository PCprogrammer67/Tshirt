<?php
session_start();
include 'includes/connection.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_mail = $_SESSION['user'];

// Get user_id
$userQuery = $conn->query("SELECT user_id FROM user WHERE mail_id = '$user_mail'");
if ($userQuery->num_rows === 0) {
    die("User not found");
}
$userData = $userQuery->fetch_assoc();
$user_id = $userData['user_id'];

// Get all cart items for the user
$cartItems = $conn->query("SELECT * FROM cart WHERE user_id = '$user_id'");
if ($cartItems->num_rows === 0) {
    echo "<script>alert('Your cart is empty!'); window.location.href='cart.php';</script>";
    exit();
}

// Insert each cart item into orders table
while ($item = $cartItems->fetch_assoc()) {
    $product_id = $item['prodect_ID']; // use your cart column name
    $qty = $item['qty'];

    $product = $conn->query("SELECT prodect_price FROM prodect WHERE prodect_id = '$product_id'");
    if ($product && $product->num_rows > 0) {
        $productData = $product->fetch_assoc();
        $price = $productData['prodect_price'];
        $total_price = $price * $qty;

        // Insert into orders table using correct column names
        $conn->query("INSERT INTO orders (user_id, product_id, quantity, total_price)
                      VALUES ('$user_id', '$product_id', '$qty', '$total_price')");
    }
}

// Clear the cart after placing the order
$conn->query("DELETE FROM cart WHERE user_id = '$user_id'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Placed</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5 text-center">
    <div class="alert alert-success">
      ✅ Your order has been placed successfully!
    </div>
    <a href="home.php" class="btn btn-primary">Back to Home</a>
  </div>
</body>
</html>
