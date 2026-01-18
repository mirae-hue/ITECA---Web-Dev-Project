<?php
session_start();
require_once "../includes/connect.php";

if (!isset($_SESSION['user_id'])) {
    exit("Not authorized");
}

$user_id = $_SESSION['user_id'];
$sub_id = intval($_GET['id']);

// Fetch subscription
$sub = $mysqli->query("
    SELECT us.*, s.name
    FROM user_subscriptions us
    JOIN subscriptions s ON us.subscription_id = s.id
    WHERE us.id = $sub_id AND us.user_id = $user_id
")->fetch_assoc();

if (!$sub) {
    exit("Invalid subscription");
}

// Fetch items
$items = $mysqli->query("
    SELECT p.name, usi.quantity, usi.item_price
    FROM user_subscription_items usi
    JOIN products p ON usi.product_id = p.id
    WHERE usi.user_subscription_id = $sub_id
");
?>

<h2><?= htmlspecialchars($sub['name']); ?></h2>

<table class="cart-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($i = $items->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($i['name']); ?></td>
            <td><?= $i['quantity']; ?></td>
            <td>R<?= number_format($i['item_price'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<p><strong>Total:</strong> R<?= number_format($sub['total_price'], 2); ?></p>
<p><strong>Renews every:</strong> <?= $sub['renewal_period_days']; ?> days</p>
<p><strong>Next Renewal:</strong> <?= $sub['next_renewal_date']; ?></p>
