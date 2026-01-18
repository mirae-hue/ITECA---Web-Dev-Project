<?php if (!isset($embedded)) : ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-friendly Cleaning & Household Supplies | DragonStone" />
  <meta name="keywords" content="eco-friendly, cleaning, household, sustainable, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Cleaning & Household Supplies | DragonStone</title>

  <!-- ========== LINKED STYLESHEETS ========== -->
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>

<body>
  <!-- ================= HEADER ================= -->
  <header>
    <?php include '../includes/header.php'; ?>
  </header>

  <!-- ================= HERO BANNER ================= -->
  <section class="hero fade-in">
    <div class="hero-overlay">
      <h1>Cleaning & Household Supplies</h1>
      <p>Create a greener kitchen with sustainable essentials that support conscious cooking and everyday convenience.</p>
    </div>
  </section>

<?php endif; ?>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <div class="product-grid">

      <div class="product">
        <img src="../img/products/supplies/Plant-based laundry detergent sheets (1).jpeg" alt="Plant-Based Laundry Detergent" />
        <div class="product-info">
          <h3>Plant-Based Laundry Detergent</h3>
          <p>Gentle on fabrics, tough on stains. Biodegradable and refillable.</p>
          <div class="price">R129.99</div>
          <a href="product.php?id=101" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/supplies/Refillable glass spray bottles (1).jpeg" alt="Reusable Paper Towels" />
        <div class="product-info">
          <h3>Refillable Glass Spray Bottles</h3>
          <p>Durable, reusable, and perfect for eco-friendly cleaning.</p>
          <div class="price">R99.98</div>
          <a href="product.php?id=102" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/supplies/Compostable cleaning pods multi-surface.png" alt="All-Purpose Cleaner" />
        <div class="product-info">
          <h3>All-Purpose Cleaner</h3>
          <p>Non-toxic formula with citrus oils. Safe for kids and pets.</p>
          <div class="price">R74.50</div>
          <a href="product.php?id=103" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

	<div class="product">
	  <img src="../img/products/supplies/Wool dryer balls (1).png" alt="Wool Dryer Balls" />
	  <div class="product-info">
		<h3>Wool Dryer Balls</h3>
		<p>Reusable alternative to dryer sheets. Softens clothes naturally and reduces drying time.</p>
		<div class="price">R89.99</div>
		<a href="product.php?id=105" class="btn btn-outline-success mt-2">View Product</a>
	  </div>
	</div>

	  <div class="product">
	    <img src="../img/products/supplies/Biodegradable trash bags (1).jpeg" alt="Biodegradable Trash Bags" />
		<div class="product-info">
		  <h3>Biodegradable Trash Bags</h3>
		  <p>Durable, leak-resistant bags made from plant-based materials. Break down naturally in compost.</p>
		 <div class="price">R59.50</div>
		<a href="product.php?id=106" class="btn btn-outline-success mt-2">View Product</a>
		</div>
	  </div>

	  <div class="product">
	    <img src="../img/products/supplies/Natural air purifying charcoal bags (1).jpeg" alt="Natural Air Purifying Charcoal Bags" />
	    <div class="product-info">
		  <h3>Charcoal Air Purifying Bags</h3>
		  <p>Eliminate odors and moisture with activated bamboo charcoal. Ideal for closets, cars, and shoes.</p>
		<div class="price">R69.00</div>
		<a href="product.php?id=107" class="btn btn-outline-success mt-2">View Product</a>
		</div>
	  </div>

    </div>
  </section>

<?php if (!isset($embedded)) : ?>
  <!-- ================= FOOTER ================= -->
  <?php include '../includes/footer.php'; ?>

  <!-- ========== SCRIPTS ========== -->
  <script src="../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
<?php endif; ?>