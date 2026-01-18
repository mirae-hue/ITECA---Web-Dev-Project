<?php
session_start();
require_once "../../includes/connect.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: o_management.php");
    exit;
}

$order_id = intval($_GET['id']);

/* Fetch order */
$order = $mysqli->query("
    SELECT o.*, u.first_name, u.last_name, u.email
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.id = $order_id
")->fetch_assoc();

if (!$order) {
    echo "<script>alert('Order not found.'); window.location='o_management.php';</script>";
    exit;
}

/* Fetch items */
$items = $mysqli->query("
    SELECT oi.*, p.name
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = $order_id
");

/* Handle status update */
if (isset($_POST['status'])) {
    $new_status = $_POST['status'];

    $update = $mysqli->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $update->bind_param("si", $new_status, $order_id);
    $update->execute();

    echo "<script>alert('Order status updated.'); window.location='manage_order.php?id=$order_id';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Order #<?= $order_id; ?> | Admin</title>
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
        <a href="o_management.php" class="active">Orders</a>
        <a href="../users/u_management.php">Users</a>
    </nav>
</aside>

<!-- Main Content -->
<main>
    <div class="dashboard-header">
        <h1>Manage Order #<?= $order_id; ?></h1>
        <a href="o_management.php" class="btn-small">← Back</a>
    </div>

    <div class="order-box">

        <h3>Customer</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($order['first_name'] . " " . $order['last_name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($order['email']); ?></p>

        <h3>Order Details</h3>
        <p><strong>Date:</strong> <?= date("d M Y, H:i", strtotime($order['order_date'])); ?></p>
        <p><strong>Status:</strong> <?= ucfirst($order['status']); ?></p>
        <p><strong>Subtotal:</strong> R<?= number_format($order['subtotal'], 2); ?></p>
        <p><strong>Delivery Fee:</strong> R<?= number_format($order['delivery_fee'], 2); ?></p>
        <p><strong>Total:</strong> R<?= number_format($order['total'], 2); ?></p>
        <p><strong>Carbon Score:</strong> <?= $order['carbon_score']; ?></p>
        <p><strong>EcoPoints Earned:</strong> <?= $order['ecopoints_earned']; ?></p>

        <h3>Delivery Address</h3>
        <p><?= nl2br(htmlspecialchars($order['address'])); ?></p>

        <h3>Items</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price Each</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($i = $items->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($i['name']); ?></td>
                    <td><?= $i['quantity']; ?></td>
                    <td>R<?= number_format($i['price_each'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Update Status</h3>
        <form method="POST">
            <select name="status" class="form-select" required>
                <option value="pending" <?= $order['status']=='pending'?'selected':''; ?>>Pending</option>
                <option value="confirmed" <?= $order['status']=='confirmed'?'selected':''; ?>>Confirmed</option>
                <option value="delivered" <?= $order['status']=='delivered'?'selected':''; ?>>Delivered</option>
                <option value="closed" <?= $order['status']=='closed'?'selected':''; ?>>Closed</option>
            </select>

            <button class="btn-primary" style="margin-top:1rem;">Update Status</button>
        </form>

    </div>
</main>

</div>

</body>
</html>
