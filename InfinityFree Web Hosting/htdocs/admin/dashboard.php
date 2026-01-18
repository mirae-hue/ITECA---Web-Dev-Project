<?php
session_start();
require_once '../includes/connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Total products
$res = $mysqli->query("SELECT COUNT(*) AS count FROM products");
$totalProducts = $res ? $res->fetch_assoc()['count'] : 0;

// Total orders
$res = $mysqli->query("SELECT COUNT(*) AS count FROM orders");
$totalOrders = $res ? $res->fetch_assoc()['count'] : 0;

// Pending orders
$res = $mysqli->query("SELECT COUNT(*) AS count FROM orders WHERE status='Pending'");
$pendingOrders = $res ? $res->fetch_assoc()['count'] : 0;

// Recent orders
$recentOrders = $mysqli->query("
    SELECT o.id, u.first_name, u.last_name, o.total, o.status
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.order_date DESC
    LIMIT 5
");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DragonStone Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-layout">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="products/p_management.php">Products</a>
      <a href="subscriptions/s_management.php">Subscriptions</a>
      <a href="orders/o_management.php">Orders</a>
      <a href="users/u_management.php">Users</a>
      <a href="community/c_management.php">Community</a>
      <a href="../dashboard.php">Analytics</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main>
    <div class="dashboard-header">
      <h1>Dashboard</h1>
      <form action="logout.php" method="POST">
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </div>

    <!-- Metrics -->
    <section class="metrics">
      <div class="card">
        <h2>Total Products</h2>
        <p><?= $totalProducts ?></p>
        <img src="/../img/admin/package.svg" alt="Products">
      </div>
      <div class="card">
        <h2>Total Orders</h2>
        <p><?= $totalOrders ?></p>
        <img src="/../img/admin/shopping-cart.svg" alt="Orders">
      </div>
      <div class="card">
        <h2>Pending Orders</h2>
        <p><?= $pendingOrders ?></p>
        <img src="/../img/admin/clipboard-clock.svg" alt="Pending Orders">
      </div>
    </section>

    <!-- Recent Orders Table -->
    <section class="table-container">
      <h2>Recent Orders</h2>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($order = $recentOrders->fetch_assoc()): ?>
          <tr>
            <td>#<?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['first_name'] . " " . $order['last_name']) ?></td>
            <td>R<?= number_format($order['total'], 2) ?></td>
            <td><?= htmlspecialchars($order['status']) ?></td>
            <td><a href="orders/view.php?id=<?= $order['id'] ?>" class="view-btn">View</a></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </section>

  </main>

</div>

</body>
</html>