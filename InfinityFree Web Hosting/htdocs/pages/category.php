<?php
require_once __DIR__ . "/../includes/connect.php";

$categoryId = intval($_GET['id'] ?? 0);

// Fetch category name
$stmt = $mysqli->prepare("SELECT name FROM categories WHERE id = ?");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$catResult = $stmt->get_result();
$category = $catResult->fetch_assoc();
$stmt->close();

// Fetch products in this category
$stmt = $mysqli->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <meta name="description" content="DragonStone - Sustainable Living, Redefined." />
  <meta name="keywords" content="sustainable, eco-friendly, ecommerce, DragonStone" />
  <meta name="author" content="DragonStone Team" />
  
  <link rel="icon" href="/../img/favicon.ico" type="image/x-icon" />


  <title>DragonStone | Sustainable Living, Redefined</title>

  <link rel="stylesheet" href="/../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>

<body>
  <?php include __DIR__ . "/../includes/header.php"; ?>

  <section class="hero fade-in">
    <div class="hero-overlay">
      <h1><?= htmlspecialchars($category['name'] ?? 'Products'); ?></h1>
      <p>Explore sustainable products in this category.</p>
    </div>
  </section>

  <section class="product-section fade-in">
    <div class="product-grid">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($product = $result->fetch_assoc()): ?>
          <div class="product">
            <img src="/../uploads/products/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
            <div class="product-info">
              <h3><?= htmlspecialchars($product['name']); ?></h3>
              <p><?= htmlspecialchars($product['description']); ?></p>
              <div class="price">R<?= number_format($product['price'], 2); ?></div>
              <a href="product.php?id=<?= $product['id']; ?>" class="btn btn-outline-success mt-2">View Product</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No products found in this category.</p>
      <?php endif; ?>
    </div>
  </section>

  <?php include __DIR__ . "/../includes/footer.php"; ?>

  <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
