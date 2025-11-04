<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="DragonStone — Sustainable Living, Redefined." />
  <meta name="keywords" content="sustainable, eco-friendly, ecommerce, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  <title>DragonStone | Sustainable Living</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>
<body>

  <!-- ================= HEADER ================= -->
 <?php include 'includes/header.php'; ?>

  <!-- ================= HERO ================= -->
  <section class="hero">
    <div class="hero-overlay">
      <h1>Sustainable Living, Redefined.</h1>
      <p>Shop consciously, earn EcoPoints, and join the movement.</p>
      <div class="hero-buttons">
        <a href="#" class="btn btn-primary">Shop Now</a>
        <a href="#" class="btn btn-outline-light">Learn More</a>
      </div>
    </div>
  </section>

  <!-- ================= SHOP BY FEATURE / CATEGORIES ================= -->
  <section class="categories container fade-in">
    <h2 class="section-title">Shop by Category</h2>
    <div class="row">
      <!-- Repeat one card per category -->
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Cleaning & Household (2).jpeg" alt="Cleaning & Household" />
        <h3>Cleaning & Household Supplies</h3>
        <a href="supplies.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Kitchen (2).jpeg" alt="Kitchen & Dining" />
        <h3>Kitchen & Dining</h3>
        <a href="kitchen.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Home decor.jpeg" alt="Home Décor & Living" />
        <h3>Home Décor & Living</h3>
        <a href="decor.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Bathroom (2).jpeg" alt="Bathroom & Personal Care" />
        <h3>Bathroom & Personal Care</h3>
        <a href="bathroom.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Lifestyle.jpeg" alt="Lifestyle & Wellness" />
        <h3>Lifestyle & Wellness</h3>
        <a href="lifestyle.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Toys.jpeg" alt="Kids & Pets" />
        <h3>Kids & Pets</h3>
        <a href="kids.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
      <div class="col-md-4 col-sm-6 category-tile">
        <img src="img/Outdoor.jpeg" alt="Outdoor & Garden" />
        <h3>Outdoor & Garden</h3>
        <a href="outdoor.php" class="btn btn-outline-secondary">Shop Now</a>
      </div>
    </div>
  </section>

  <!-- ================= FEATURES ================= -->
  <section class="features container-fluid fade-in">
    <div class="row text-center">
      <div class="col-md-4 feature-card">
        <div class="icon">♻️</div>
        <h4>Carbon Footprint Calculator</h4>
        <p>Understand your product impact.</p>
      </div>
      <div class="col-md-4 feature-card">
        <div class="icon">🌿</div>
        <h4>Subscribe & Save</h4>
        <p>Never run out of essentials.</p>
      </div>
      <div class="col-md-4 feature-card">
        <div class="icon">🏷️</div>
        <h4>EcoPoints</h4>
        <p>Earn rewards for every mindful purchase.</p>
      </div>
    </div>
  </section>

  <!-- ================= COMMUNITY ================= -->
  <section class="community container fade-in">
    <h2>From the DragonStone Community</h2>
    <div class="community-posts">
      <div class="post">🌱 Tip: Composting 101</div>
      <div class="post">🌍 Forum: Plastic-Free July</div>
    </div>
    <a href="#" class="btn btn-success">Join the DragonStone Community →</a>
  </section>

  <!-- ================= MISSION ================= -->
  <section class="mission container-fluid fade-in">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="https://source.unsplash.com/600x400/?sustainable" alt="DragonStone Mission" />
      </div>
      <div class="col-md-6">
        <h2>More Than a Store - A Movement.</h2>
        <p>DragonStone exists to make sustainable living accessible, educational, and aspirational.</p>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <?php include 'includes/footer.php'; ?>

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
