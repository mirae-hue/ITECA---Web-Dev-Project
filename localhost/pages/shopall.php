<?php
require_once "../includes/connect.php";

// Fetch all categories
$categories = $mysqli->query("SELECT * FROM categories ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shop All | DragonStone</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <section class="hero fade-in" style="background-image:url('../img/Home decor.jpeg');">
    <div class="hero-overlay">
      <h1>Shop All</h1>
      <p>Explore our full collection of sustainable essentials.</p>
    </div>
  </section>

  <?php while ($cat = $categories->fetch_assoc()): ?>
    <section class="product-section fade-in">
     <h2 class="section-title text-center"><?= htmlspecialchars($cat['name']); ?></h2>
     <div class="product-grid">
      <?php
      $stmt = $mysqli->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC");
      $stmt->bind_param("i", $cat['id']);
      $stmt->execute();
      $products = $stmt->get_result();
      while ($product = $products->fetch_assoc()):
      ?>
        <div class="product">
          <img src="../uploads/products/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" />
          <div class="product-info">
            <h3><?= htmlspecialchars($product['name']); ?></h3>
            <p><?= htmlspecialchars($product['description']); ?></p>
            <div class="price">R<?= number_format($product['price'], 2); ?></div>
            <a href="product.php?id=<?= $product['id']; ?>" class="btn btn-outline-success mt-2">View Product</a>
          </div>
        </div>
      <?php endwhile; ?>
     </div>
    </section>
  <?php endwhile; ?>


  <?php include '../includes/footer.php'; ?>
</body>
</html>
