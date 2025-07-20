<?php
include 'includes/connection.php';
$msg = "";

if (!isset($_GET['id'])) {
    die("Product ID not provided.");
}

$id = intval($_GET['id']);

$result = $conn->query("SELECT * FROM prodect WHERE prodect_ID = $id");
if ($result->num_rows === 0) {
    die("Product not found.");
}
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['prodect_name']);
    $price = floatval($_POST['prodect_price']);
    $size = isset($_POST['prodect_size']) ? trim($_POST['prodect_size']) : '';
    $about = trim($_POST['prodect_about']);
    $category = isset($_POST['category']) ? trim($_POST['category']) : '';

    $imagePath = $product['image'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $uploadDir = "uploads/";
        $newPath = $uploadDir . basename($imageName);

        if (move_uploaded_file($tmpName, $newPath)) {
            $imagePath = "uploads/" . basename($imageName);
        } else {
            $msg = "Image upload failed!";
        }
    }

    $query = "UPDATE prodect SET 
                prodect_name = '$name',
                prodect_price = $price,
                prodect_size = '$size',
                prodect_about = '$about',
                image = '$imagePath',
                category = '$category'
              WHERE prodect_ID = $id";

    if ($conn->query($query)) {
        $msg = "Product updated successfully!";
        header("Location: manage_products.php");
        exit();
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4">Edit Product</h2>

  <?php if ($msg): ?>
    <div class="alert alert-info"><?= $msg ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="prodect_name" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="prodect_name" name="prodect_name" value="<?= htmlspecialchars($product['prodect_name']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="prodect_price" class="form-label">Price (₹)</label>
      <input type="number" step="0.01" class="form-control" id="prodect_price" name="prodect_price" value="<?= $product['prodect_price'] ?>" required>
    </div>

    <div class="mb-3">
      <label for="prodect_size" class="form-label">Size</label>
      <select class="form-select" name="prodect_size" id="prodect_size" required>
        <option value="">--Select--</option>
        <?php
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        foreach ($sizes as $s) {
            $selected = ($product['prodect_size'] == $s) ? 'selected' : '';
            echo "<option value='$s' $selected>$s</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <select class="form-select" name="category" id="category" required>
        <option value="">--Select--</option>
        <?php
        $categories = ['men', 'women', 'kids'];
        foreach ($categories as $cat) {
            $selected = ($product['category'] == $cat) ? 'selected' : '';
            echo "<option value='$cat' $selected>$cat</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="prodect_about" class="form-label">About Product</label>
      <textarea class="form-control" id="prodect_about" name="prodect_about" rows="3"><?= htmlspecialchars($product['prodect_about']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Product Image (Optional)</label>
      <input type="file" class="form-control" id="image" name="image">
      <p class="mt-2">Current Image: <img src="../<?= $product['image'] ?>" width="80" height="80"></p>
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
    <a href="manage_products.php" class="btn btn-secondary">Back</a>
  </form>
</div>

</body>
</html>
