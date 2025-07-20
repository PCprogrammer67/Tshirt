<?php
session_start();
include 'includes/connection.php'; 
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
} 
$pResult = $conn->query("SELECT COUNT(*) AS total FROM prodect ");
$pRow = $pResult->fetch_assoc();
$total_products = $pRow['total'];

$apResult = $conn->query("SELECT COUNT(*) AS total FROM prodect WHERE is_deleted = 0");
$apRow = $apResult->fetch_assoc();
$avalable_products = $apRow['total'];

$upResult = $conn->query("SELECT COUNT(*) AS total FROM prodect WHERE is_deleted = 1");
$upRow = $upResult->fetch_assoc();
$unavalable_products = $upRow['total'];

$uResult = $conn->query("SELECT COUNT(*) AS total FROM user");
$uRow = $uResult->fetch_assoc();
$total_users = $uRow['total'];

$oResult = $conn->query("SELECT COUNT(*) AS total FROM orders"); 
$oRow = $oResult->fetch_assoc();
$total_orders = $oRow['total'];

$opResult = $conn->query("SELECT COUNT(*) AS total FROM orders where status ='Pending'"); 
$opRow = $opResult->fetch_assoc();
$orders_Pending = $opRow['total'];

$odResult = $conn->query("SELECT COUNT(*) AS total FROM orders where status ='Delivered'"); 
$odRow = $odResult->fetch_assoc();
$order_Delivered = $odRow['total'];

$osResult = $conn->query("SELECT COUNT(*) AS total FROM orders where status ='Shipped'"); 
$osRow = $osResult->fetch_assoc();
$orders_Shipped = $osRow['total'];

$ocResult = $conn->query("SELECT COUNT(*) AS total FROM orders where status ='Cancelled'"); 
$ocRow = $ocResult->fetch_assoc();
$orders_Cancelled = $ocRow['total'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Stylish T-Shirts</title>
  <style>
    .div_padd {
      padding-top: 10px;
      padding-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php include "includes/side_bar.php" ?>
      <main class="col-md-10 ms-sm-auto px-4 pt-4">
        <h2>Welcome,
          <?= $_SESSION['admin'] ?> 🧑‍💼
        </h2>
        <p class="lead">Use the sidebar to manage your store content.</p>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="card border-primary">
              <div class="card-body">
                <h5 class="card-title"><i class="bi bi-cart-check"></i> Total Orders</h5>
                <p class="card-text fs-4">
                  <?= htmlspecialchars($total_orders) ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-primary">
              <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box"></i> Pending</h5>
                <p class="card-text fs-4">
                  <?= htmlspecialchars($orders_Pending ) ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-primary">
              <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box"></i> Cancelled</h5>
                <p class="card-text fs-4">
                  <?= htmlspecialchars($orders_Cancelled) ?>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class='div_padd'>
          <div class="row g-3">
            <div class="col-md-4">
              <div class="card border-primary">
                <div class="card-body">
                  <h5 class="card-title"><i class="bi bi-box"></i> Delivered</h5>
                  <p class="card-text fs-4">
                    <?= htmlspecialchars($order_Delivered) ?>
                  </p>
                </div>
              </div>
            </div>
        
                <div class="col-md-4">
                  <div class="card border-warning">
                    <div class="card-body">
                      <h5 class="card-title"> <i class="bi bi-box"></i> Total Products</h5>
                      <p class="card-text fs-4">
                        <?= htmlspecialchars($total_products) ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card  border-warning">
                    <div class="card-body">
                      <h5 class="card-title"><i class="bi bi-box"></i> Available Product</h5>
                      <p class="card-text fs-4">
                        <?= htmlspecialchars($avalable_products) ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card  border-warning">
                    <div class="card-body">
                      <h5 class="card-title"><i class="bi bi-box"></i> Unavailable Product</h5>
                      <p class="card-text fs-4">
                        <?= htmlspecialchars($unavalable_products) ?>
                      </p>
                    </div>
                  </div>
                </div>

               <div class="col-md-4">
                    <div class="card border-success">
                      <div class="card-body">
                        <h5 class="card-title"> <i class="bi bi-people"></i> Total User</h5>
                        <p class="card-text fs-4">
                          <?= htmlspecialchars($total_users) ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

      </main>
    </div>
  </div>
</body>

</html>