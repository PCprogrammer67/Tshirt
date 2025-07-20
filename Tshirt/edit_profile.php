<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include 'includes/connection.php';

$mail = $_SESSION['user'];
$name = $phone_no = $address = '';
$success = '';
$error = '';

// Fetch existing user data
$sql = "SELECT * FROM user WHERE mail_id = '$mail'";
$result = $conn->query($sql);
if ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $phone_no = $row['phone_no'];
    $address = $row['address'];
}

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone_no = trim($_POST['phone_no']);
    $address = trim($_POST['address']);

    if ($name && $phone_no && $address) {
        $update = "UPDATE user SET name=?, phone_no=?, address=? WHERE mail_id=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ssss", $name, $phone_no, $address, $mail);

        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
        } else {
            $error = "Failed to update profile: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .edit-box {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="edit-box">
    <h3 class="mb-4 text-center">Edit Profile</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
<form method="POST">
  

    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
  <div class="mb-3">
        <label>Email:</label>
        <input type="email" class="form-control" value="<?= htmlspecialchars($mail) ?>" readonly>
    </div>
    <div class="mb-3">
        <label>Phone Number:</label>
        <input type="text" name="phone_no" class="form-control" value="<?= htmlspecialchars($phone_no) ?>" required>
    </div>

    <div class="mb-3">
        <label>Address:</label>
        <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($address) ?></textarea>
    </div>

    <div class="d-flex justify-content-between">
        <a href="user_dashboard.php" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>

</div>

</body>
</html>
