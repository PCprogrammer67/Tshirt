<?php
include 'includes/connection.php';
$msg='';
if (!isset($_GET['id'])) {
    die("Product ID not provided.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM prodect WHERE prodect_ID = $id and is_deleted   = '1' ");
if ($result->num_rows === 0) {
  
    echo "PC+programmer1";
    $query =  $conn->query("UPDATE prodect SET is_deleted   = '1' WHERE prodect_ID = $id");
    $msg = "Error: " . $conn->error;
    header("Location: manage_products.php");  
    exit();
}      
else {
        echo "PC+programmer";
        $query =  $conn->query("UPDATE prodect SET is_deleted   = '0' WHERE prodect_ID = $id");
        header("Location: manage_products.php");  
    exit();
}
?>
