<?php
session_start();
include 'includes/connection.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Orders - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <?php include "includes/side_bar.php" ?>
     <main class="col-md-10 ms-sm-auto px-4 pt-4">
<div class="container mt-5">
  
  <h2 class="mb-4">Manage Orders</h2>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM orders ORDER BY order_date DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['order_id']}</td>
              <td>{$row['user_id']}</td>
              <td>{$row['product_id']}</td>
              <td>{$row['quantity']}</td>
              <td>₹{$row['total_price']}</td>
              <td>{$row['order_date']}</td>
              <td>{$row['status']}</td>
              <td>
                <form method='POST' action='update_order_status.php' class='d-flex'>
                  <input type='hidden' name='order_id' value='{$row['order_id']}'>
                  <select name='status' class='form-select me-2'>
                    <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                    <option value='Shipped' " . ($row['status'] == 'Shipped' ? 'selected' : '') . ">Shipped</option>
                    <option value='Delivered' " . ($row['status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                    <option value='Cancelled' " . ($row['status'] == 'Cancelled' ? 'selected' : '') . ">Cancelled</option>
                  </select>
                  <button type='submit' class='btn btn-sm btn-primary'>Update</button>
                </form>
              </td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='8' class='text-center'>No orders found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>
      </main>
      </div>
      </div>

</body>
</html>
