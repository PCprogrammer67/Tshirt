<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      padding-top: 1rem;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
  </style>
    
</head>
<body>
  
    
    
    <nav class="col-md-2 d-none d-md-block sidebar" style='position: fixed'>
      <h5 class="text-white text-center">Admin Panel</h5>
      <a href="admin.php">Dashboard</a>
      <a href="manage_products.php">Manage Products</a>
      <a href="manage_user.php">Manage Users</a>
      <a href="manage_orders.php">Orders</a>
      <a href="admin_login.php" class="text-danger">Logout</a>
    </nav>


        
</body>
</html> 