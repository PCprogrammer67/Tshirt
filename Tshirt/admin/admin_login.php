
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  
  <?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/connection.php';    
?>

  
  <?php


$error = '';


function validation($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validation($_POST["name"]);
    $password = validation($_POST["password"]);

    $sql = "SELECT * FROM admin WHERE name = '$name' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $_SESSION['admin'] = $name;
        header("Location: admin.php");  
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h4 class="mb-3 text-center">Admin Login</h4>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label for="name">Admin Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>

      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-dark w-100">Login</button>
    </form>
  </div>
</div>

</body>
</html>
