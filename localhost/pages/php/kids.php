<?php if (!isset($embedded)) : ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-Friendly Kids & Pets | DragonStone" />
  <meta name="keywords" content="kids, pets, sustainable living, eco-friendly, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Kids & Pets | DragonStone</title>

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
      <h1>Kids & Pets</h1>
      <p>Gentle, joyful, and planet-friendly essentials for your little ones.</p>
    </div>
  </section>
<?php endif; ?>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <div class="product-grid">

      <div class="product">
        <img src="../img/products/kids/Wooden toys (1).png" .pngalt="Wooden toys made from FSC-certified wood" />
        <div class="product-info">
          <h3>Wooden Toys</h3>
          <p>Crafted from FSC-certified wood and finished with non-toxic paints. Safe, durable, and timeless.</p>
          <div class="price">R179.00</div>
          <a href="product.php?id=501" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/kids/Baby clothes (3).png" alt="Organic cotton baby clothes and blankets" />
        <div class="product-info">
          <h3>Organic Baby Clothes & Blankets</h3>
          <p>Soft, breathable, and GOTS-certified. Gentle on sensitive skin and kind to the planet.</p>
          <div class="price">R229.00</div>
          <a href="product.php?id=502" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/kids/Reusable cloth diapers (2).png" alt="Reusable cloth diapers" />
        <div class="product-info">
          <h3>Reusable Cloth Diapers</h3>
          <p>Adjustable, leak-proof, and washable. Made with organic cotton and waterproof liners.</p>
          <div class="price">R149.00</div>
          <a href="product.php?id=503" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/kids/Natural Pet Grooming Kit (1).png" alt="Natural pet grooming products" />
        <div class="product-info">
          <h3>Natural Pet Grooming</h3>
          <p>Shampoos and balms made with organic oils and botanicals. Gentle on fur and skin.</p>
          <div class="price">R99.00</div>
          <a href="product.php?id=504" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/kids/pet toys (1).png" alt="Eco-friendly pet toys and biodegradable waste bags" />
        <div class="product-info">
          <h3>Pet Toys</h3>
          <p>Durable toys made from recycled materials and compostable waste bags for clean walks.</p>
          <div class="price">R69.00</div>
          <a href="product.php?id=505" class="btn btn-outline-success mt-2">View Product</a>
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