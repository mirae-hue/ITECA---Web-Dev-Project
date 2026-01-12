<?php
require_once "../includes/connect.php";

// Fetch all categories
$result = $mysqli->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Meta tags -->
  <meta name="description" content="DragonStone — Sustainable Living, Redefined." />
  <meta name="keywords" content="sustainable, eco-friendly, ecommerce, DragonStone" />
  <meta name="author" content="DragonStone Team" />

  <!-- Favicon -->
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

  <!-- Title -->
  <title>DragonStone | Shop All Categories</title>

  <!-- ========== LINKED CSS ========== -->
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>

<body>
  <!-- ================= HEADER ================= -->
  <header>
    <?php include '../includes/header.php'; ?>
  </header>

  <!-- ================= CATEGORY GRID ================= -->
  <section class="category-section container fade-in">
    <h1 class="section-title text-center">Shop by Category</h1>
    <div class="row">
      <?php foreach ($categories as $cat): ?>
        <div class="col-md-4 col-sm-6 category-tile">
          <!-- Optional: add category images if stored in DB -->
          <img src="../img/category-placeholder.png" alt="<?= htmlspecialchars($cat['name']); ?>" />
          <h3><?= htmlspecialchars($cat['name']); ?></h3>
          <a href="category.php?id=<?= $cat['id']; ?>" class="btn btn-outline-success">View Products</a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <?php include '../includes/footer.php'; ?>

  <!-- ========== SCRIPTS ========== -->
  <script src="../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
