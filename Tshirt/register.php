
<?php
include 'includes/connection.php';

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return htmlspecialchars($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = validate($_POST['name']);
  $password = validate($_POST['password']);
  $phone = validate($_POST['phone_no']);
  $mail = validate($_POST['mail_id']);
  $address = validate($_POST['address']);
  $check_sql = "SELECT * FROM user WHERE phone_no = '$phone' or mail_id ='$mail'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "<script>alert('phone number or mail id is  already exists!') </script>";
    echo "<script> window.location.href='register.php' </script>";
}else {
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO user (name, password, phone_no, mail_id, address) 
        VALUES ('$name', '$hashedPassword', '$phone', '$mail', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Account created successfully!'); window.location.href='index.php';</script>";
} 


else {
    if (str_contains($conn->error, "Duplicate entry!!")) {
        echo "<script>alert('Phone number or Email already exists! Please use a different one.');</script>";
    } else {
        echo "<script>alert('Database Error: " . $conn->error . "');</script>";
    }
}

}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Account</title>
    <link rel="stylesheet" href=" assets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f2f4f8;
      font-family: 'Inter', sans-serif;
    }
    .signup-container {
      max-width: 500px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }
    .signup-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: bold;
    }
    .btn {
      width: 100%;
    }
    
  </style>
</head>
<body>

  <div class="signup-container">
    <h2>Create Account</h2>
    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" name="phone_no" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="mail_id" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="3" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Create Account</button>
    </form>
    <div class="text-center mt-3">
      <a href="index.php">Already have an account? Login</a>
    </div>
  </div>
</body>
</html>
