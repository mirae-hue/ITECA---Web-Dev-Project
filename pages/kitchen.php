<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-friendly Kitchen & Dining | DragonStone" />
  <meta name="keywords" content="eco-friendly, kitchen, dining, sustainable, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Kitchen & Dining | DragonStone</title>

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
  <section class="hero fade-in" style="background-image: url('../img/products/kitchen/kitchen.jpeg');">
    <div class="hero-overlay">
      <h1>Kitchen & Dining</h1>
      <p>Conscious cleaning starts here. Discover sustainable swaps for everyday essentials.</p>
    </div>
  </section>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <h2 class="section-title text-center">Eco-Friendly Cleaning Products</h2>
    <div class="product-grid">
      
      <!-- Product Card -->
      <div class="product">
        <img src="../img/products/kitchen/Bamboo kitchen utensils and cutting boards.jpeg" alt="Bamboo kitchen utensils and cutting boards" />
        <div class="product-info">
          <h3>Bamboo kitchen utensils and cutting boards</h3>
          <p>Crafted from sustainably harvested bamboo, these durable kitchen tools are naturally antibacterial and gentle on cookware.</p>
          <div class="price">R129.99</div>
          <a href="product.php?id=101" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/kitchen/Reusable silicone food storage bags.jpeg" alt="Reusable silicone food storage bags" />
        <div class="product-info">
          <h3>Reusable silicone food storage bags</h3>
          <p>Flexible, leak-proof, and endlessly reusable - these BPA-free silicone bags replace single-use plastics for snacks, produce, and leftovers.</p>
          <div class="price">R89.00</div>
          <a href="product.php?id=102" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/kitchen/Beeswax food wraps (1).jpeg" alt="Beeswax food wraps" />
        <div class="product-info">
          <h3>Beeswax food wraps</h3>
          <p>Wrap sandwiches, fruits, and bowls with breathable beeswax-coated cotton. A reusable, compostable alternative to cling film.</p>
          <div class="price">R74.50</div>
          <a href="product.php?id=103" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

	<div class="product">
	  <img src="../img/products/kitchen/Compostable dish sponges (1).png" alt="Compostable dish sponges" />
	  <div class="product-info">
		<h3>Compostable dish sponges</h3>
		<p>Made from plant-based cellulose and loofah, these sponges scrub effectively and break down naturally after use.</p>
		<div class="price">R89.99</div>
		<a href="product.php?id=105" class="btn btn-outline-success mt-2">View Product</a>
	  </div>
	</div>

	  <div class="product">
	    <img src="../img/products/kitchen/Stainless steel straws and straw cleaners (1).png" alt="Stainless steel straws and straw cleaners" />
		<div class="product-info">
		  <h3>Stainless steel straws and straw cleaners</h3>
		  <p>Say goodbye to plastic straws. This set includes rust-resistant steel straws and a reusable brush for easy cleaning.</p>
		 <div class="price">R59.50</div>
		<a href="product.php?id=106" class="btn btn-outline-success mt-2">View Product</a>
		</div>
	  </div>

	  <div class="product">
	    <img src="../img/products/kitchen/Recycled glass storage jars (1).png" alt="Recycled glass storage jars" />
	    <div class="product-info">
		  <h3>Recycled glass storage jars</h3>
		  <p>Store dry goods, herbs, or pantry staples in these elegant jars made from post-consumer recycled glass.</p>
		<div class="price">R69.00</div>
		<a href="product.php?id=107" class="btn btn-outline-success mt-2">View Product</a>
		</div>
	  </div>

	  <div class="product">
	    <img src="../img/products/kitchen/Organic cotton dish towels (2).png" alt="Organic cotton dish towels" />
	    <div class="product-info">
		  <h3>Organic cotton dish towels</h3>
		  <p>Soft, absorbent, and machine washable - these GOTS-certified cotton towels are perfect for drying dishes and wiping surfaces.</p>
		<div class="price">R69.00</div>
		<a href="product.php?id=107" class="btn btn-outline-success mt-2">View Product</a>
		</div>
	  </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <?php include '../includes/footer.php'; ?>

  <!-- ========== SCRIPTS ========== -->
  <script src="../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
