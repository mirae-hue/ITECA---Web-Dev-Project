<?php
session_start();
require_once "../includes/connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['subscription'])) {
    header("Location: subscribe.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$subscription_id = intval($_GET['subscription']);

// Fetch template
$stmt = $mysqli->prepare("
    SELECT id, name, price, renewal_period_days
    FROM subscriptions
    WHERE id = ? AND status = 'active'
");
$stmt->bind_param("i", $subscription_id);
$stmt->execute();
$template = $stmt->get_result()->fetch_assoc();

if (!$template) {
    echo "<script>alert('Invalid subscription.'); window.location='subscribe.php';</script>";
    exit;
}

// Create subscription
$start_date = date("Y-m-d");
$next_renewal = date("Y-m-d", strtotime("+{$template['renewal_period_days']} days"));

$insert = $mysqli->prepare("
    INSERT INTO user_subscriptions
    (user_id, subscription_id, start_date, next_renewal_date, renewal_period_days, status, total_price)
    VALUES (?, ?, ?, ?, ?, 'active', ?)
");
$insert->bind_param("iissid",
    $user_id,
    $subscription_id,
    $start_date,
    $next_renewal,
    $template['renewal_period_days'],
    $template['price']
);
$insert->execute();

$user_subscription_id = $insert->insert_id;

// Copy items
$items = $mysqli->prepare("
    SELECT product_id, quantity, item_price
    FROM subscription_items
    WHERE subscription_id = ?
");
$items->bind_param("i", $subscription_id);
$items->execute();
$itemList = $items->get_result();

while ($i = $itemList->fetch_assoc()) {
    $copy = $mysqli->prepare("
        INSERT INTO user_subscription_items
        (user_subscription_id, product_id, quantity, item_price)
        VALUES (?, ?, ?, ?)
    ");
    $copy->bind_param("iiid",
        $user_subscription_id,
        $i['product_id'],
        $i['quantity'],
        $i['item_price']
    );
    $copy->execute();
}

echo "<script>alert('Subscription Activated Successfully!'); window.location='u_subscribe.php';</script>";
exit;
?>
