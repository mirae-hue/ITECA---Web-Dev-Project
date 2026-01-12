<?php
session_start();
require_once "../includes/connect.php";
include "../includes/header.php";

/* ============================
   FETCH ACTIVE SUBSCRIPTION TYPES
   ============================ */

$packages = $mysqli->query("
    SELECT id, name, description, image, price, status
    FROM subscriptions
    WHERE status = 'active'
    ORDER BY id ASC
");

if (!$packages) {
    die("Database error: " . $mysqli->error);
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
<!-- ================= HERO SECTION ================= -->
  <section class="hero fade-in" style="background-image:url('../img/Home decor.jpeg');">
    <div class="hero-overlay">
      <h1>Subscribe & Save</h1>
      <p>Explore our full collection of sustainable packages.</p>
    </div>
  </section>

<!-- ================= SUBSCRIPTION SECTION ================= -->
<div class="subscription-page">
  <a href="javascript:history.back()" class="subscribe-btn" style="margin-bottom:1rem;">← Back</a>

  <h2 style="color:var(--ds-forest); border-bottom:2px solid var(--ds-forest); padding-bottom:0.5rem;">
    Choose Your Subscription Package
  </h2>
  
  <p style="margin-top:1rem; font-size:1.1rem; color:var(--ds-forest); max-width:800px;">
  Subscribers enjoy an automatic <strong>10-15% savings</strong> on every product included in their chosen subscription package. 
  By bundling items and delivering them on a predictable schedule, we reduce packaging, transport, and handling costs - and pass those 
  savings directly on to you. A simple way to stock up sustainably while spending less.
  </p>

  <div class="subscription-grid">

    <?php while ($pkg = $packages->fetch_assoc()): ?>
    <div class="subscription-card">

      <!-- Image -->
	<div class="subscription-image-wrapper">
	  <?php if (!empty($pkg['image'])): ?>
		<img src="../img/subscriptions/<?php echo htmlspecialchars($pkg['image']); ?>" alt="Subscription Image">
	  <?php endif; ?>

	  <div class="subscription-hover">
		<p><?php echo nl2br(htmlspecialchars($pkg['description'])); ?></p>
		<h4>Included Products:</h4>
		<ul>
		  <?php
		  $subscription_id = $pkg['id'];
		  $items = $mysqli->prepare("
			  SELECT p.id, p.name, si.quantity
			  FROM subscription_items si
			  JOIN products p ON si.product_id = p.id
			  WHERE si.subscription_id = ?
		  ");
		  $items->bind_param("i", $subscription_id);
		  $items->execute();
		  $itemsResult = $items->get_result();

		  while ($item = $itemsResult->fetch_assoc()):
		  ?>
			<li>
			  <a href="../pages/product.php?id=<?php echo $item['id']; ?>">
				<?php echo htmlspecialchars($item['name']); ?>
			  </a>
			  <?php if ($item['quantity'] > 1): ?>
				(x<?php echo $item['quantity']; ?>)
			  <?php endif; ?>
			</li>
		  <?php endwhile; ?>
		</ul>
	  </div>
	</div>


      <!-- Visible Content -->
      <div class="subscription-front">
        <h3><?php echo htmlspecialchars($pkg['name']); ?></h3>
        <p><strong>R<?php echo number_format($pkg['price'], 2); ?></strong></p>
		<a class="subscribe-btn" href="manage_subscribe.php?subscription=<?php echo $pkg['id']; ?>">
          Subscribe
        </a>
      </div>

      <!-- Hover Reveal -->
      <div class="subscription-hover">
        <p><?php echo nl2br(htmlspecialchars($pkg['description'])); ?></p>
        <h4>Included Products:</h4>
        <ul>
          <?php
          $subscription_id = $pkg['id'];
          $items = $mysqli->prepare("
              SELECT p.id, p.name, si.quantity
              FROM subscription_items si
              JOIN products p ON si.product_id = p.id
              WHERE si.subscription_id = ?
          ");
          $items->bind_param("i", $subscription_id);
          $items->execute();
          $itemsResult = $items->get_result();

          while ($item = $itemsResult->fetch_assoc()):
          ?>
            <li>
              <a href="../pages/product.php?id=<?php echo $item['id']; ?>">
                <?php echo htmlspecialchars($item['name']); ?>
              </a>
              <?php if ($item['quantity'] > 1): ?>
                (x<?php echo $item['quantity']; ?>)
              <?php endif; ?>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

    </div>
    <?php endwhile; ?>

  </div>
</div>

<?php include "../includes/footer.php"; ?>
</body>
</html>