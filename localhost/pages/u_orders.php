<?php
session_start();
require_once "../includes/connect.php";
include "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* Fetch user orders */
$orders = $mysqli->query("
    SELECT id, order_date, status, total, carbon_score, ecopoints_earned
    FROM orders
    WHERE user_id = $user_id
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Orders | DragonStone</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>

<div class="cart-page">
    <div class="cart-header">
        <h2>My Orders</h2>
        <a href="u_dashboard.php" class="back-btn" style="margin-left:auto;">← Back</a>
    </div>

    <?php if ($orders->num_rows > 0): ?>
        <?php while ($o = $orders->fetch_assoc()): ?>

        <div class="subscription-card-user">
            <h3>Order #<?= $o['id']; ?></h3>
            <p><strong>Date:</strong> <?= date("d M Y, H:i", strtotime($o['order_date'])); ?></p>
            <p><strong>Status:</strong> <?= ucfirst($o['status']); ?></p>
            <p><strong>Total:</strong> R<?= number_format($o['total'], 2); ?></p>
            <p><strong>Carbon Score:</strong> <?= $o['carbon_score']; ?></p>
            <p><strong>EcoPoints Earned:</strong> <?= $o['ecopoints_earned']; ?></p>
        </div>

        <?php endwhile; ?>
    <?php else: ?>
        <p>You have no orders yet.</p>
    <?php endif; ?>
</div>

<?php include "../includes/footer.php"; ?>
</body>
</html>
