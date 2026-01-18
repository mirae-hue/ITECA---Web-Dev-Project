<?php
session_start();
require_once "../includes/connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_POST['address']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Missing checkout information.'); window.location='checkout.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$address = trim($_POST['address']);

/* ============================================================
   1. CALCULATE ORDER TOTALS
   ============================================================ */

$subtotal = 0;
$total_items = 0;

foreach ($_SESSION['cart'] as $product_id => $item) {
    $subtotal += $item['price'] * $item['quantity'];
    $total_items += $item['quantity'];
}

// Delivery fee rules
$delivery_fee = 60;               // base fee
$free_delivery_threshold = 600;   // free above this

if ($subtotal >= $free_delivery_threshold) {
    $delivery_fee = 0;
}

$total = $subtotal + $delivery_fee;

/* ============================================================
   2. AUTO CARBON SCORE (LOW = "HEAVIER" ORDER)
   ============================================================ */

if ($total_items <= 3) {
    $carbon_score = 10;   // light order
} elseif ($total_items <= 6) {
    $carbon_score = 7;
} elseif ($total_items <= 10) {
    $carbon_score = 5;
} else {
    $carbon_score = 3;    // heavy order
}

/* ============================================================
   3. ECOPOINTS CALCULATION
   ============================================================ */

$points_from_total  = floor($total / 20);      // 1 point per R20
$points_from_items  = $total_items * 2;        // 2 points per item
$points_from_carbon = (11 - $carbon_score);    // lower carbon_score → more points

$ecopoints = $points_from_total + $points_from_items + $points_from_carbon;

/* ============================================================
   4. INSERT INTO ORDERS TABLE
   ============================================================ */

$stmt = $mysqli->prepare("
    INSERT INTO orders 
    (user_id, order_date, status, subtotal, delivery_fee, total, carbon_score, ecopoints_earned, address)
    VALUES (?, NOW(), 'pending', ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "iddddis",
    $user_id,
    $subtotal,
    $delivery_fee,
    $total,
    $carbon_score,
    $ecopoints,
    $address
);

$stmt->execute();
$order_id = $stmt->insert_id;

/* ============================================================
   5. INSERT ORDER ITEMS
   ============================================================ */

foreach ($_SESSION['cart'] as $product_id => $item) {
    $insertItem = $mysqli->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price_each)
        VALUES (?, ?, ?, ?)
    ");
    $insertItem->bind_param(
        "iiid",
        $order_id,
        $product_id,
        $item['quantity'],
        $item['price']
    );
    $insertItem->execute();
}

/* ============================================================
   6. UPDATE USER ECOPOINTS
   ============================================================ */

$updatePoints = $mysqli->prepare("
    UPDATE users SET eco_points = eco_points + ? WHERE id = ?
");
$updatePoints->bind_param("ii", $ecopoints, $user_id);
$updatePoints->execute();

/* ============================================================
   7. CLEAR CART + REDIRECT
   ============================================================ */

unset($_SESSION['cart']);

echo "<script>
    alert('Order placed successfully! You earned $ecopoints EcoPoints.');
    window.location='u_orders.php';
</script>";
exit;
?>
