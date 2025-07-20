


<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $mail = trim($_POST["mail"]);
  $password = $_POST["password"];

  $sql = "SELECT * FROM user WHERE mail_id = '$mail'";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
      $_SESSION['user'] = $mail;
      header("Location: home.php");
      exit();
    } else {
      echo "<script>alert('Incorrect password!');</script>";
    }
  } else {
    echo "<script>alert('Email not found!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href=" assets/style.css">
</head>
<body>
  <div class="login-container">
    <form method="POST" action="">
      <h1>User Login</h1>
      <label for="mail" class="form-label">Email</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fa fa-user"></i></span>
        <input type="email" class="form-control" name="mail" id="mail" autocomplete="username" placeholder="Enter Email ID" required />
      </div>
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fa fa-lock"></i></span>
        <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Enter password" required />
      </div>
      <button class="btn btn-primary" type="submit">Login</button>
      <a href="register.php" class="create-link">Create an Account</a>
    </form>
  </div>
</body>
</html>