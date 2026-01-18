<?php if (!isset($embedded)) : ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-Friendly Bathroom & Personal Care | DragonStone" />
  <meta name="keywords" content="bathroom, personal care, sustainable living, eco-friendly, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Bathroom & Personal Care | DragonStone</title>

  <!-- ========== LINKED STYLESHEETS ========== -->
  <link rel="stylesheet" href="/../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>

<body>
  <!-- ================= HEADER ================= -->
  <header>
    <?php include '/../includes/header.php'; ?>
  </header>

  <!-- ================= HERO BANNER ================= -->
  <section class="hero fade-in">
    <div class="hero-overlay">
      <h1>Bathroom & Personal Care</h1>
      <p>Refresh your routine with sustainable essentials that care for you and the planet.</p>
    </div>
  </section>
<?php endif; ?>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <div class="product-grid">

      <div class="product">
        <img src="/img/products/bathroom/Refillable shampoo and conditioner bottles (1).png" alt="Refillable shampoo and conditioner bottles" />
        <div class="product-info">
          <h3>Refillable Shampoo & Conditioner Bottles</h3>
          <p>Elegant glass or aluminum bottles designed for reuse. Pair with our bulk refills for zero waste.</p>
          <div class="price">R89.00</div>
          <a href="product.php?id=301" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="/img/products/bathroom/Bamboo toothbrushes and holders (1).png" alt="Bamboo toothbrushes and holders" />
        <div class="product-info">
          <h3>Bamboo Toothbrushes & Holders</h3>
          <p>Biodegradable handles and sleek holders made from sustainably harvested bamboo.</p>
          <div class="price">R49.00</div>
          <a href="product.php?id=302" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="/img/products/bathroom/Compostable floss and packaging (2).png" alt="Compostable floss and packaging" />
        <div class="product-info">
          <h3>Compostable Floss & Packaging</h3>
          <p>Plant-based floss in refillable glass vials. Packaging breaks down naturally in home compost.</p>
          <div class="price">R39.00</div>
          <a href="product.php?id=303" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="/img/products/bathroom/Organic cotton towels and bathrobes (3).png" alt="Organic cotton towels and bathrobes" />
        <div class="product-info">
          <h3>Organic Cotton Towels & Bathrobes</h3>
          <p>Luxuriously soft and GOTS-certified. Available in calming earth tones and minimalist textures.</p>
          <div class="price">R249.00</div>
          <a href="product.php?id=304" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="/img/products/bathroom/Natural loofahs and exfoliating mitts (1).png" alt="Natural loofahs and exfoliating mitts" />
        <div class="product-info">
          <h3>Natural Loofahs & Exfoliating Mitts</h3>
          <p>Made from dried gourds and organic cotton. Gentle exfoliation for radiant, healthy skin.</p>
          <div class="price">R59.00</div>
          <a href="product.php?id=305" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="/img/products/bathroom/Plastic-free deodorant and skincare products (1).png" alt="Plastic-free deodorant and skincare products" />
        <div class="product-info">
          <h3>Plastic-Free Deodorant & Skincare</h3>
          <p>Aluminum-free deodorants and nourishing skincare in compostable or refillable packaging.</p>
          <div class="price">R129.00</div>
          <a href="product.php?id=306" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

    </div>
  </section>

<?php if (!isset($embedded)) : ?>
  <!-- ================= FOOTER ================= -->
  <?php include '/../includes/footer.php'; ?>

  <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
<?php endif; ?>