<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'includes/connection.php';

$mail = $_SESSION['user'];
$name = $phone_no = $address = $created_at = '';

$sql = "SELECT * FROM user WHERE mail_id = '$mail'";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $phone_no = $row['phone_no'];
    $address = $row['address'];
    $created_at = $row['created_at'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f1f1;
        }
        .dashboard-box {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .profile-info label {
            font-weight: bold;
            color: #444;
        }
    </style>
</head>
<body>

<div class="dashboard-box">
    <h3 class="text-center mb-4">👤 My Profile</h3>
    
    <div class="profile-info mb-3">
        <label>Name:</label>
        <div><?= htmlspecialchars($name) ?></div>
    </div>

    <div class="profile-info mb-3">
        <label>Email:</label>
        <div><?= htmlspecialchars($mail) ?></div>
    </div>

    <div class="profile-info mb-3">
        <label>Phone No:</label>
        <div><?= htmlspecialchars($phone_no) ?></div>
    </div>

    <div class="profile-info mb-3">
        <label>Address:</label>
        <div><?= nl2br(htmlspecialchars($address)) ?></div>
    </div>

    <div class="profile-info mb-4">
        <label>Account Created:</label>
        <div><?= date('d M Y, h:i A', strtotime($created_at)) ?></div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
        <a href="index.php" class="btn btn-danger">Logout</a>
    </div>
</div>

</body>
</html>