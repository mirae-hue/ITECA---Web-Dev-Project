<?php if (!isset($embedded)) : ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-Friendly Outdoor & Garden | DragonStone" />
  <meta name="keywords" content="outdoor, garden, sustainable living, eco-friendly, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Outdoor & Garden | DragonStone</title>

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
  <section class="hero fade-in");">
    <div class="hero-overlay">
      <h1>Outdoor & Garden</h1>
      <p>Transform your outdoor space with sustainable tools and nature-friendly solutions.</p>
    </div>
  </section>
<?php endif; ?>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <div class="product-grid">

      <div class="product">
        <img src="../img/products/outdoor/Compost bins and worm farms (2).png" alt="Compost bins and worm farms" />
        <div class="product-info">
          <h3>Compost Bins & Worm Farms</h3>
          <p>Turn kitchen scraps into nutrient-rich soil with odor-free bins and thriving worm habitats.</p>
          <div class="price">R299.00</div>
          <a href="product.php?id=601" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/outdoor/Rain (1).png" alt="Rainwater harvesting kits" />
        <div class="product-info">
          <h3>Rainwater Harvesting Kits</h3>
          <p>Capture and reuse rainwater with easy-install barrels and filtration systems. Reduce your water footprint.</p>
          <div class="price">R349.00</div>
          <a href="product.php?id=602" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/outdoor/Seed starter kits (1).png" alt="Seed starter kits with heirloom seeds" />
        <div class="product-info">
          <h3>Seed Starter Kits</h3>
          <p>Grow your own herbs and veggies with heirloom seeds, biodegradable pots, and organic soil blends.</p>
          <div class="price">R129.00</div>
          <a href="product.php?id=603" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/outdoor/Solar-powered garden lights (1).png" alt="Solar-powered garden lights" />
        <div class="product-info">
          <h3>Solar Garden Lights</h3>
          <p>Illuminate pathways and patios with energy-efficient lights powered entirely by the sun.</p>
          <div class="price">R99.00</div>
          <a href="product.php?id=604" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/outdoor/Recycled plastic planters (1).png" alt="Recycled plastic planters" />
        <div class="product-info">
          <h3>Recycled Plastic Planters</h3>
          <p>Stylish and sturdy containers made from post-consumer plastics. UV-resistant and built to last.</p>
          <div class="price">R89.00</div>
          <a href="product.php?id=605" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/outdoor/Organic fertiliser (1).png" alt="Organic fertilizers and pest repellents" />
        <div class="product-info">
          <h3>Organic Fertilizers & Pest Repellents</h3>
          <p>Boost plant health and deter pests naturally with composted nutrients and botanical sprays.</p>
          <div class="price">R119.00</div>
          <a href="product.php?id=606" class="btn btn-outline-success mt-2">View Product</a>
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