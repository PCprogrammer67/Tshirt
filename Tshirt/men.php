<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stylish - T-Shirt Online Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <?php include 'includes/header.php'; ?>


  <div class="hero-section d-flex align-items-center justify-content-center text-center">
    <div class="overlay" >
    </div>
    <div class="hero-content text-white position-relative">
      <h1 class="display-4 fw-bold">Stylish T-Shirts for Every Mood</h1>
      <p class="lead">Find your perfect style today</p>
      <a href="home.php" class="btn btn-warning btn-lg mt-3">Shop Now</a>
    </div>
  </div>
  <div class="container1">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <h2 class="fw-bold text-danger">About Stylish</h2>
        <h4 class="text-muted">
          Welcome to <strong>Stylish</strong> – where fashion meets comfort! <br><br>
          We bring you a wide variety of handpicked, premium quality T-shirts designed to match every mood, moment, and personality. From bold prints to minimal styles, Stylish is your fashion buddy in every season.
</h4>
      </div>
      <div class="col-md-6 text-center">
        <img src="assets/image/images.png" alt="About Stylish" class="img-fluid rounded shadow" style="height: 400px ;">
      </div>
    </div>
  </div>

  <div class="container py-5">
    <h2 class="text-center mb-4">Men T-Shirts</h2>
    <div class="row">
      <?php
      include 'includes/connection.php'; 

      $sql = "SELECT * FROM prodect WHERE is_deleted = 0 and category = 'men' ";
      $result = $conn->query($sql);

      if (!$result) {
          die("SQL Error: " . $conn->error);
      }

      if ($result && $result->num_rows > 0){
      while ($row = $result->fetch_assoc()){?>
        <div class="col-sm-6 col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <img src="<?= htmlspecialchars($row['image'] ?? 'assets/default.jpg') ?>" class="card-img-top"
                style="height: 300px; object-fit: cover;" alt="T-shirt">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['prodect_name'] ?? 'No Name') ?></h5>   <span class="fw-bold">₹<?= number_format($row['prodect_price'] ?? 0, 2) ?></span>
              <p class="card-text text-muted mb-1">Size: <?= htmlspecialchars($row['prodect_size'] ?? 'N/A') ?></p>
              <p class="card-text"><?= htmlspecialchars($row['prodect_about'] ?? 'No Description') ?></p>
                      <div class="d-flex justify-content-between align-items-center">
  <a href="" class="btn btn-sm btn-success">
    <i class="bi bi-cart-plus"></i> Buy Now 
  </a> 
  <a href="add_to_cart.php?id=<?= $row['prodect_ID'] ?>" class="btn btn-sm btn-success">
    <i class="bi bi-cart-plus"></i> Add to Cart
  </a>
  <a href="add_remove_wishlist.php?prodect_ID=<?= $row['prodect_ID'] ?>" class="btn btn-sm btn-light ">
    <i class="bi bi-heart-fill" style="color: red"></i>
  </a>
</div>
            </div>
          </div>
        </div>
      <?php }} ?>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
