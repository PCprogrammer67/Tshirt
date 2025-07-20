<?php
include '../assets/connection.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['prodect_name']);
    $price = floatval($_POST['prodect_price']);
    $size = $_POST['prodect_size'];
    $about = trim($_POST['prodect_about']);
    $category =$_POST['category'];

   
    $uploadDir = "uploads/";
    $imageName = time() . "_" . basename($_FILES['image']['name']); 
    $targetPath = $uploadDir . $imageName;


    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
       
        $dbImagePath = "admin/uploads/" . $imageName;

        $query = "INSERT INTO prodect (prodect_name, prodect_price, prodect_size, prodect_about, image, is_deleted)
                  VALUES ('$name', $price, '$size', '$about', '$dbImagePath', 0)";
        if ($conn->query($query)) {
            $msg = "Product added successfully!";
        } else {
            $msg = " DB Error: " . $conn->error;
        }
    } else {
        $msg = "Image upload failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4">Add New Product</h2>

  <?php if ($msg): ?>
    <div class="alert alert-info"><?= $msg ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="prodect_name" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="prodect_name" name="prodect_name" required>
    </div>

    <div class="mb-3">
      <label for="prodect_price" class="form-label">Price (₹)</label>
      <input type="number" step="0.01" class="form-control" id="prodect_price" name="prodect_price" required>
    </div>

    <div class="mb-3">
      <label for="prodect_size" class="form-label">Size</label>
      <select class="form-select" name="prodect_size" id="prodect_size" required>
        <option value="">--Select--</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
      </select>
    </div>

     <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <select class="form-select" name="category" id="category" required>
        <option value="">--Select--</option>
        <option value="men">Men</option>
        <option value="weman">weman</option>
        <option value="kids">kids</option>
        </select>
    </div>


    <div class="mb-3">
      <label for="prodect_about" class="form-label">About Product</label>
      <textarea class="form-control" id="prodect_about" name="prodect_about" rows="3"></textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Product Image</label>
      <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
    <a href="manage_products.php" class="btn btn-secondary">Back</a>
  </form>
</div>

</body>
</html>
