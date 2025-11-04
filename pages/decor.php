<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Eco-Friendly Home Décor & Living | DragonStone" />
  <meta name="keywords" content="home décor, sustainable living, eco-friendly, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <title>Home Décor & Living | DragonStone</title>

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
  <section class="hero fade-in" style="background-image: url('../img/products/decor/decor-hero.jpeg');">
    <div class="hero-overlay">
      <h1>Home Décor & Living</h1>
      <p>Bring warmth, texture, and sustainability into your space with consciously crafted décor.</p>
    </div>
  </section>

  <!-- ================= PRODUCT GRID ================= -->
  <section class="product-section fade-in">
    <h2 class="section-title text-center">Eco-Friendly Home Accents</h2>
    <div class="product-grid">

      <!-- Recycled Glass Vases and Candle Holders -->
      <div class="product">
        <img src="../img/products/decor/recycled-glass-vases.jpeg" alt="Recycled glass vases and candle holders" />
        <div class="product-info">
          <h3>Recycled Glass Vases & Candle Holders</h3>
          <p>Handblown from post-consumer glass, these elegant pieces add charm and reduce landfill waste.</p>
          <div class="price">R149.00</div>
          <a href="product.php?id=201" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <!-- Upcycled Wood Wall Art and Shelving -->
      <div class="product">
        <img src="../img/products/decor/upcycled-wood-shelving.jpeg" alt="Upcycled wood wall art and shelving" />
        <div class="product-info">
          <h3>Upcycled Wood Wall Art & Shelving</h3>
          <p>Crafted from reclaimed timber, each piece is unique and adds rustic warmth to your home.</p>
          <div class="price">R299.00</div>
          <a href="product.php?id=202" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <!-- Organic Cotton Throws and Cushions -->
      <div class="product">
        <img src="../img/products/decor/organic-cotton-throws.jpeg" alt="Organic cotton throw blankets and cushion covers" />
        <div class="product-info">
          <h3>Organic Cotton Throws & Cushions</h3>
          <p>Soft, breathable, and GOTS-certified. These textiles bring cozy comfort with a clean conscience.</p>
          <div class="price">R189.00</div>
          <a href="product.php?id=203" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <!-- Soy Wax Candles with Essential Oils -->
      <div class="product">
        <img src="../img/products/decor/soy-wax-candles.jpeg" alt="Soy wax candles with natural essential oils" />
        <div class="product-info">
          <h3>Soy Wax Candles with Essential Oils</h3>
          <p>Clean-burning candles infused with lavender, eucalyptus, or citrus oils. No paraffin, no toxins.</p>
          <div class="price">R99.00</div>
          <a href="product.php?id=204" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <!-- Indoor Plants with Biodegradable Pots -->
      <div class="product">
        <img src="../img/products/decor/indoor-plants.jpeg" alt="Indoor plants with biodegradable pots" />
        <div class="product-info">
          <h3>Indoor Plants with Biodegradable Pots</h3>
          <p>Air-purifying greenery in compostable pots made from coconut coir and rice husk blends.</p>
          <div class="price">R129.00</div>
          <a href="product.php?id=205" class="btn btn-outline-success mt-2">View Product</a>
        </div>
      </div>

      <!-- Eco-Friendly Paint and Finishes -->
      <div class="product">
        <img src="../img/products/decor/eco-paint.jpeg" alt="Eco-friendly paint and finishes" />
        <div class="product-info">
          <h3>Eco-Friendly Paint & Finishes</h3>
          <p>Low-VOC, plant-based paints in partnership with sustainable brands. Safe for your home and planet.</p>
          <div class="price">R249.00</div>
          <a href="product.php?id=206" class="btn btn-outline-success mt-2">View Product</a>
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
l