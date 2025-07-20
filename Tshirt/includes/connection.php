<!DOCTYPE html>

<html><body>
<?php
  error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("127.0.0.1", "phpuser", "12345", "tshirt");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
</body>
</html>