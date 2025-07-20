<?php
include 'includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
?>
