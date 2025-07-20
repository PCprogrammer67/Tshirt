<?php
session_start();
include 'includes/connection.php';

// Check if user logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user_mail = $_SESSION['user'];

// Step 1: Get user_id from user table
$user_sql = "SELECT user_id FROM user WHERE mail_id = '$user_mail'";
$user_result = $conn->query($user_sql);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['user_id'];

    // Step 2: Get product_id from URL
    if (isset($_GET['prodect_ID'])) {
        $product_id = intval($_GET['prodect_ID']);

        // Step 3: Check if already in wishlist
        $check_sql = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows === 0) {
            // Step 4: Insert into wishlist
            $insert_sql = "INSERT INTO wishlist (user_id, product_id) VALUES ($user_id, $product_id)";
            if ($conn->query($insert_sql) === TRUE) {
                header("Location: wishlist.php?added=1");
                exit();
            } else {
                echo "❌ Insert error: " . $conn->error;
            }
        } else {

            $delete_sql = "DELETE FROM wishlist WHERE user_id = $user_id AND product_id = $product_id";
            if ($conn->query($delete_sql) === TRUE) {
                header("Location: wishlist.php?removed=1");
                exit();
            } else {
                echo "❌ Delete error: " . $conn->error;
            }
        }
    } else {
        echo "❌ Product ID missing in URL!";
    }
} else {
    echo "❌ User not found!";
}
