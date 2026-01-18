<?php
session_start();
require_once "../includes/connect.php";
include "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty.'); window.location='cart.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Checkout | DragonStone</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>

<div class="cart-page">
    <div class="cart-header">
        <h2>Checkout</h2>
        <a href="cart.php" class="back-btn" style="margin-left:auto;">← Back to Cart</a>
    </div>

    <form action="process_order.php" method="POST" class="checkout-form">

        <!-- Address -->
        <div class="form-group" style="margin-bottom:1.5rem;">
            <label for="address" class="form-label" style="font-weight:bold;">Delivery Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required
                placeholder="Enter your delivery address..."></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="checkout-btn" style="width:100%; font-size:1.2rem;">
            Place Order
        </button>

    </form>
</div>

<?php include "../includes/footer.php"; ?>
      <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
