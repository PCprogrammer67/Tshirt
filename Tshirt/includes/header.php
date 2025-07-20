<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include 'includes/connection.php';
$mail = $_SESSION['user'];
$name = '';
$phone_no = '';
$address = '';

$stmt = $conn->prepare("SELECT name, phone_no, address FROM user WHERE mail_id = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $phone_no = $row['phone_no'];
    $address = $row['address'];
} else {
    die("User data not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stylish - T-Shirt Online Store</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <link href="../assets/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  <meta name="author" content="TemplatesJungle">
  <meta name="keywords" content="Online Store, T-Shirt, Ecommerce">
  <meta name="description" content="Stylish - T-Shirt Online Store HTML Template">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,900;1,900&family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<header class="navbar navbar-expand-lg text-dark px-4 py-2">
  <a class="navbar-brand" href="index.php">
    <img src="images/main-logo.png" class="logo" alt="logo" style="height: 40px;">
  </a>

  <form class="d-flex mx-auto" role="search" style="width: 40%;">
    <input class="form-control me-2" type="search" placeholder="Search for T-Shirts..." aria-label="Search">
    <button class="btn btn-warning" type="submit">Search</button>
  </form>

  <ul class="navbar-nav ms-auto fw-bold align-items-center">
    <li><a class="nav-link text-dark" href="home.php">Home</a></li>
    <li><a class="nav-link text-dark" href="about.php">About Us</a></li>

    <li class="nav-item dropdown mx-2">
      <a class="nav-link dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown">Shop</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="men.php">Men</a></li>
        <li><a class="dropdown-item" href="women.php">Women</a></li>
        <li><a class="dropdown-item" href="kids.php">kids</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modallong">Cart</a></li>
        <li><a class="dropdown-item" href="index.php" data-bs-toggle="modal" data-bs-target="#modallogin">Login</a></li>
      </ul>
    </li>

    <li><a class="nav-link text-dark" href="contact.php">Contact</a></li>
 <li class="nav-item mx-2">
      <a class="nav-link text-dark" href="cart.php">
        <i class="fas fa-cart-shopping"></i>
      </a>
    </li>
 <li class="nav-item mx-2">
     <a href="wishlist.php" class="nav-link text-dark">
  <i class="bi bi-heart-fill" style="color: black;"></i>
</a>
    </li>
    <li class="nav-item mx-2">
     <li class="nav-item dropdown mx-2">
  <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
    <i class="bi bi-person-circle" style="font-size: 1.3rem;"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
    
  
  <li><a class="dropdown-item" href="user_dashboard.php">User Dashboard</a></li>
    <li><a class="dropdown-item" href="order_history.php">Order History</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item text-danger" href="index.php">Logout</a></li>
  </ul>
</li>

    </li>

   
  </ul>
</header>
</body>
</html>
