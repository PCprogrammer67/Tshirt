<?php
session_start();
include 'includes/connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_mail = $_SESSION['user'];
$product_id = intval($_GET['id']); // product ID from URL or form

// Get user ID
$getUser = $conn->query("SELECT user_id FROM user WHERE mail_id = '$user_mail'");
if ($getUser->num_rows === 0) {
    die("User not found");
}
$user_row = $getUser->fetch_assoc();
$user_id = $user_row['user_id'];

// Check if product already in cart
$check = $conn->query("SELECT * FROM cart WHERE user_id = '$user_id' AND prodect_ID = '$product_id'");

if ($check->num_rows > 0) {
    // Product already in cart → update qty
    $conn->query("UPDATE cart SET qty = qty + 1 WHERE user_id = '$user_id' AND prodect_ID = '$product_id'");
} else {
    // Product not in cart → insert new
    $conn->query("INSERT INTO cart (prodect_ID, qty, added_at, user_id) VALUES ('$product_id', 1, NOW(), '$user_id')");
}

header("Location: cart.php");
exit();
?>
