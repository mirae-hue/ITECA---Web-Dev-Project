<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="DragonStone — Sustainable Living, Redefined."/>
  <meta name="keywords" content="sustainable, eco-friendly, ecommerce, DragonStone"/>
  <meta name="author" content="DragonStone Team"/>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>

  <title>DragonStone | Sustainable Living, Redefined</title>

  <!-- ========== LINKED CSS ========== -->
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>

<body>
  <!-- ================= HEADER ================= -->
  <header>
    <?php include 'includes/header.php'; ?>
  </header>

  <!-- ================= HERO SECTION ================= -->
  <section class="hero fade-in">
    <div class="hero-overlay">
      <h1>Sustainable Living, Redefined.</h1>
      <p>Shop consciously, earn EcoPoints, and join the movement.</p>
      <div class="hero-buttons">
        <a href="pages/shopall.php" class="btn btn-secondary">Shop Now</a>
        <a href="pages/about.php" class="btn btn-secondary">Learn More</a>
      </div>
    </div>
  </section>

  <!-- ================= PLATFORM FEATURES ================= -->
  <section class="features-section container-fluid fade-in">
    <div class="row text-center">
      <div class="col-md-4 feature-card">
        <div class="icon"><i class="fa-solid fa-leaf"></i></div>
        <h4><a href="pages/u_dashboard.php">Carbon Footprint Calculator</a></h4>
        <p>Understand your product impact.</p>
      </div>

      <div class="col-md-4 feature-card">
        <div class="icon"><i class="fa-solid fa-recycle"></i></div>
        <h4><a href="pages/subscribe.php">Subscribe & Save</a></h4>
        <p>Never run out of essentials.</p>
      </div>

      <div class="col-md-4 feature-card">
        <div class="icon"><i class="fa-solid fa-award"></i></div>
        <h4><a href="pages/u_dashboard.php">EcoPoints</a></h4>
        <p>Earn rewards for every mindful purchase.</p>
      </div>
    </div>
  </section>

 <!-- ================= SHOP BY CATEGORY ================= -->
<section class="category-section container fade-in">
  <h2 class="section-title text-center">Shop by Category</h2>
  <div class="row">
    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Cleaning & Household (2).jpeg" alt="Eco-friendly cleaning and household supplies" />
      <h3>Cleaning & Household Supplies</h3>
      <a href="pages/category.php?id=1" class="btn btn-outline-secondary">Shop Now</a>
    </div>

    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Kitchen (2).jpeg" alt="Eco-friendly kitchen and dining products" />
      <h3>Kitchen & Dining</h3>
      <a href="pages/category.php?id=2" class="btn btn-outline-secondary">Shop Now</a>
    </div>

    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Home decor.jpeg" alt="Sustainable home décor and living" />
      <h3>Home Décor & Living</h3>
      <a href="pages/category.php?id=3" class="btn btn-outline-secondary">Shop Now</a>
    </div>

    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Bathroom (2).jpeg" alt="Eco-friendly bathroom and personal care" />
      <h3>Bathroom & Personal Care</h3>
      <a href="pages/category.php?id=4" class="btn btn-outline-secondary">Shop Now</a>
    </div>

    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Lifestyle.jpeg" alt="Lifestyle and wellness products" />
      <h3>Lifestyle & Wellness</h3>
      <a href="pages/category.php?id=5" class="btn btn-outline-secondary">Shop Now</a>
    </div>

    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Toys.jpeg" alt="Eco-friendly products for kids and pets" />
      <h3>Kids & Pets</h3>
      <a href="pages/category.php?id=6" class="btn btn-outline-secondary">Shop Now</a>
    </div>

    <div class="col-md-4 col-sm-6 category-tile">
      <img src="img/Outdoor.jpeg" alt="Outdoor and garden essentials" />
      <h3>Outdoor & Garden</h3>
      <a href="pages/category.php?id=7" class="btn btn-outline-secondary">Shop Now</a>
    </div>
  </div>
</section>

  <!-- ================= COMMUNITY SECTION ================= -->
  <section class="community-section container fade-in">
    <h2 class="text-center">From the DragonStone Community</h2>
    <div class="community-posts">
      <div class="post">🌱Composting 101</div>
      <div class="post">🌍 Forum: Plastic-Free July</div>
    </div>
    <div class="text-center">
      <a href="pages/community.php" class="btn btn-success">Join the DragonStone Community →</a>
    </div>
  </section>

  <!-- ================= BRAND MISSION ================= -->
  <section class="mission container-fluid fade-in">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="img/mission.png" alt="DragonStone brand mission" />
      </div>
      <div class="col-md-6 mission-text">
        <h2><a href="pages/about.php">More Than a Store - A Movement.</a></h2>
        <p>DragonStone exists to make sustainable living accessible, educational, and aspirational.</p>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <?php include 'includes/footer.php'; ?>

  <!-- ========== SCRIPTS ========== -->
  <script src="script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
