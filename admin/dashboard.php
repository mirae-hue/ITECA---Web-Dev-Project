<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DragonStone Admin Dashboard</title>
  <link rel="stylesheet" href="/dragonstone/admin/admin.css">
</head>
<body>

<div class="admin-layout">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
      <a href="/dragonstone/admin/dashboard.php" class="active">Dashboard</a>
      <a href="/dragonstone/admin/products/p_management.php">Products</a>
      <a href="/dragonstone/admin/subscriptions/s_management.php">Subscriptions</a>
      <a href="/dragonstone/admin/orders/o_management.php">Orders</a>
      <a href="/dragonstone/admin/users/u_management.php">Users</a>
      <a href="/dragonstone/admin/dashboard.php">Settings</a>
		<a href="/dragonstone/admin/community/c_management.php">Community</a>
		<a href="/dragonstone/admin/analysis/a_management.php">Analytics</a>    </nav>
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
        <p>123</p>
        <img src="/dragonstone/img/admin/package.svg" alt="Products">
      </div>
      <div class="card">
        <h2>Total Orders</h2>
        <p>87</p>
        <img src="/dragonstone/img/admin/shopping-cart.svg" alt="Orders">
      </div>
      <div class="card">
        <h2>EcoPoints Issued</h2>
        <p>452</p>
        <img src="/dragonstone/img/admin/leaf.svg" alt="EcoPoints">
      </div>
      <div class="card">
        <h2>Pending Orders</h2>
        <p>14</p>
        <img src="/dragonstone/img/admin/clipboard-clock.svg" alt="Pending Orders">
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
          <tr>
            <td>#101</td>
            <td>Sipho M.</td>
            <td>R450.00</td>
            <td>Pending</td>
            <td><button class="view-btn">View</button></td>
          </tr>
          <tr>
            <td>#102</td>
            <td>Thandi N.</td>
            <td>R230.00</td>
            <td>Processing</td>
            <td><button class="view-btn">View</button></td>
          </tr>
        </tbody>
      </table>
    </section>

  </main>

</div>

</body>

</html>
