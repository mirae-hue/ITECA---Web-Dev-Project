<?php if (!isset($embedded)) : ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-Friendly Lifestyle & Wellness | DragonStone" />
  <meta name="keywords" content="wellness, lifestyle, sustainable living, eco-friendly, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Lifestyle & Wellness | DragonStone</title>

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
  <section class="hero fade-in" s);">
    <div class="hero-overlay">
      <h1>Lifestyle & Wellness</h1>
      <p>Live mindfully with eco-conscious essentials that nourish your body, mind, and environment.</p>
    </div>
  </section>
<?php endif; ?>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <div class="product-grid">

      <div class="product">
        <img src="../img/products/lifestyle/recycled water bottle (1).png" alt="Reusable water bottles made from recycled materials" />
        <div class="product-info">
          <h3>Reusable Water Bottles</h3>
          <p>Durable bottles crafted from recycled stainless steel and BPA-free plastics. Stay hydrated sustainably.</p>
          <div class="price">R159.00</div>
          <a href="product.php?id=401" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/lifestyle/Eco-friendly yoga mats (1).png" alt="Eco-friendly yoga mats and accessories" />
        <div class="product-info">
          <h3>Eco-Friendly Yoga Mats & Accessories</h3>
          <p>Non-toxic mats made from natural rubber and cork. Includes blocks, straps, and bolsters.</p>
          <div class="price">R299.00</div>
          <a href="product.php?id=402" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/lifestyle/Sustainable journals (1).png" alt="Sustainable journals and stationery" />
        <div class="product-info">
          <h3>Sustainable Journals & Stationery</h3>
          <p>Made from recycled paper and vegetable inks. Perfect for mindful writing and creative reflection.</p>
          <div class="price">R89.00</div>
          <a href="product.php?id=403" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/lifestyle/Solar-powered lanterns (1).png" alt="Solar-powered lanterns and chargers" />
        <div class="product-info">
          <h3>Solar Lanterns & Chargers</h3>
          <p>Harness the sun with portable lighting and device chargers. Ideal for travel, camping, or off-grid living.</p>
          <div class="price">R199.00</div>
          <a href="product.php?id=404" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/lifestyle/compostable teas bags (1).png" alt="Organic herbal teas in compostable packaging" />
        <div class="product-info">
		<h3>Compostable Tea Bags</h3>
		<p>Soothing blends of chamomile, rooibos, and mint. Packed in fully compostable tea bags for a zero-waste brew.</p>
          <div class="price">R69.00</div>
          <a href="product.php?id=405" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <div class="product">
        <img src="../img/products/lifestyle/incense (1).png" alt="Mindfulness kits with sustainably sourced incense and guides" />
        <div class="product-info">
          <h3>Mindfulness Kits</h3>
          <p>Includes incense, breathing guides, and meditation prompts. Ethically sourced and beautifully packaged.</p>
          <div class="price">R139.00</div>
          <a href="product.php?id=406" class="btn btn-outline-success mt-2">View Product</a>
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