<?php
session_start();
require_once '../includes/connect.php';
require_once '../includes/functions.php';

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ============================
   ADD TO CART
============================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $id  = intval($_POST['product_id']);
    $qty = intval($_POST['quantity']);

    // Fetch product details
    $stmt = $mysqli->prepare("SELECT id, name, price, carbon_score FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result  = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if ($product) {
        // Add to session cart
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'id'      => $product['id'],
                'name'    => $product['name'],
                'price'   => $product['price'],
                'carbon'  => $product['carbon_score'],
                'quantity'=> $qty
            ];
        } else {
            $_SESSION['cart'][$id]['quantity'] += $qty;
        }
    }

    header("Location: cart.php");
    exit();
}

/* ============================
   REMOVE FROM CART
============================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $removeId = intval($_POST['remove_id']);

    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
    }

    header("Location: cart.php");
    exit();
}

/* ============================
   ITEM COUNT FOR HEADER
============================ */
$itemCount = 0;
foreach ($_SESSION['cart'] as $item) {
    $itemCount += $item['quantity'];
}

/* ============================
   CURRENCY LOGIC
============================ */
 
	$currencies = [ 
	  'ZAR' => 1, 
	  'USD' => 0.0606, 
	  'EUR' => 0.0550 
	];  
$selectedCurrency = $_POST['currency'] ?? 'ZAR'; 
$conversionRate = $currencies[$selectedCurrency] ?? 1;

/* ============================
   CART TOTALS + CARBON
============================ */
$orderTotalZAR = 0;
$cartCarbon     = 0;

foreach ($_SESSION['cart'] as $item) {
    $lineTotal     = $item['price'] * $item['quantity'];
    $orderTotalZAR += $lineTotal;
    $cartCarbon    += $item['carbon'] * $item['quantity'];
}

/* ============================
   SHIPPING
============================ */
$shippingZAR = ($orderTotalZAR < 600) ? 100 : 0;

/* ============================
   CONVERT TOTALS
============================ */
$orderTotalConverted = $orderTotalZAR * $conversionRate;
$shippingConverted   = $shippingZAR * $conversionRate;
$grandTotalConverted = $orderTotalConverted + $shippingConverted;

/* ============================
   USER CARBON SCORE
============================ */
$userCarbon = null;

if (isset($_SESSION['user_id'])) {
    $stmt = $mysqli->prepare("SELECT carbon_score FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($userCarbon);
    $stmt->fetch();
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart | DragonStone</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="cart-page">
  <div class="cart-header">
    <h2>Your Cart</h2>

    <form method="POST" class="currency-form">
        <select name="currency" onchange="this.form.submit()">
            <option value="ZAR" <?= $selectedCurrency=='ZAR'?'selected':''; ?>>ZAR</option>
            <option value="USD" <?= $selectedCurrency=='USD'?'selected':''; ?>>USD</option>
            <option value="EUR" <?= $selectedCurrency=='EUR'?'selected':''; ?>>EUR</option>
        </select>
    </form>
  </div>


  <?php if (!empty($_SESSION['cart'])): ?>
    <!-- Existing cart table -->
    <table class="cart-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Carbon Score</th>
          <th>Quantity</th>
          <th>Price</th>
         <!-- <th>Total</th> -->
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
          <?php $lineTotal = $item['price'] * $item['quantity']; ?>
          <tr>
            <td><?= htmlspecialchars($item['name']); ?></td>
            <td><?= htmlspecialchars($item['carbon']); ?></td>
            <td><?= $item['quantity']; ?></td>
            <td>R<?= number_format($item['price'], 2); ?></td>
            <!--<td><strong>R<?= number_format($lineTotal, 2); ?></strong></td> -->
            <td>
              <form method="POST">
                <input type="hidden" name="remove_id" value="<?= $item['id']; ?>">
				<button type="submit" class="cart-remove" title="Remove">
					<i class="fa-solid fa-trash"></i>
				</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Totals -->
  <div class="cart-total">
      <p>Total: <?= $selectedCurrency . " " . number_format($orderTotalConverted, 2); ?></p>
      <p>Shipping: <?= $selectedCurrency . " " . number_format($shippingConverted, 2); ?></p>
      <p><strong>Total Charged: <?= $selectedCurrency . " " . number_format($grandTotalConverted, 2); ?></strong></p>
	  <p>🌱Carbon Score: <?= $cartCarbon; ?></p>
	 <!--  <?php if (isset($_SESSION['user_id'])): ?> <p>Your Lifetime Carbon Score: <?= $userCarbon; ?></p><?php endif; ?> -->


    <div class="cart-footer">
      <button class="back-btn" onclick="history.back()">Back</button>
      <?php if (isset($_SESSION['user_id'])): ?>
        <form action="checkout.php" method="POST">
          <button type="submit" class="checkout-btn">Proceed to Order</button>
        </form>
      <?php else: ?>
        <a href="../login.php?redirect=../pages/checkout.php" class="checkout-btn">Log in to Checkout</a>
      <?php endif; ?>
    </div>
	
    <?php else: ?>
      <p>Your cart is empty.</p>
      <button class="back-btn" onclick="history.back()">Back</button>
    <?php endif; ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
