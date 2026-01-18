<?php
session_start();
require_once "../../includes/connect.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch all orders
$orders = $mysqli->query("
    SELECT o.id, u.first_name, u.last_name, o.order_date, o.status, o.total
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Management | Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="../admin.css" />
</head>

<body>

<div class="admin-layout">

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">DragonStone Admin</div>
    <nav>
		<a href="../dashboard.php">Dashboard</a>
		<a href="../products/p_management.php">Products</a>
		<a href="../subscriptions/s_management.php">Subscriptions</a>
		<a href="../orders/o_management.php" class="active">Orders</a>
		<a href="../users/u_management.php">Users</a>
        <a href="../community/c_management.php">Community</a>
		<a href="../dashboard.php">Analytics</a>
    </nav>
</aside>

<!-- Main Content -->
<main>
    <div class="dashboard-header">
        <h1>Orders</h1>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($o = $orders->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $o['id']; ?></td>
                    <td><?= htmlspecialchars($o['first_name'] . " " . $o['last_name']); ?></td>
                    <td><?= date("d M Y, H:i", strtotime($o['order_date'])); ?></td>
                    <td><?= ucfirst($o['status']); ?></td>
                    <td>R<?= number_format($o['total'], 2); ?></td>
                    <td>
                        <a href="manage_order.php?id=<?= $o['id']; ?>" class="btn-small">Manage</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>
</main>

</div>

</body>
</html>
