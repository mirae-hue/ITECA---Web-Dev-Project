<?php
require_once __DIR__ . "/../includes/connect.php";
session_start();

$productId = intval($_GET['id'] ?? 0);

// Fetch product
$stmt = $mysqli->prepare("SELECT p.*, c.name AS category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    die("<p class='error-msg'>Product not found.</p>");
}

// Handle review CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $action = $_POST['action'] ?? '';
    $userId = $_SESSION['user_id'];

    if ($action === 'create') {
        $stmt = $mysqli->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $userId, $productId, $_POST['rating'], $_POST['comment']);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'delete') {
        $stmt = $mysqli->prepare("DELETE FROM reviews WHERE id=? AND user_id=?");
        $stmt->bind_param("ii", $_POST['review_id'], $userId);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch reviews
$stmt = $mysqli->prepare("SELECT r.*, CONCAT(u.first_name, ' ', u.last_name) AS reviewer_name
                          FROM reviews r
                          LEFT JOIN users u ON r.user_id = u.id
                          WHERE r.product_id = ?
                          ORDER BY r.created_at DESC");
$stmt->bind_param("i", $productId);
$stmt->execute();
$reviews = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($product['name']); ?> | DragonStone</title>
  <link rel="stylesheet" href="/../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <style>

    .product-page {
      max-width: 1200px;
      margin: 3rem auto;
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
    }
    .product-detail-img {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
      object-fit: cover;
    }
    .product-detail-info {
      flex: 1;
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .product-detail-info h1 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--ds-forest);
    }
    .product-detail-info .price {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--ds-teal);
      margin: 1rem 0;
    }
    .add-to-cart {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
    }
    .add-to-cart input {
      width: 80px;
      text-align: center;
    }
    .reviews-section {
      max-width: 900px;
      margin: 3rem auto;
    }
    .review-card {
      background: #fff;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    .review-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
    }
    .review-card button {
      background: none;
      border: none;
      cursor: pointer;
      color: var(--ds-forest);
    }
    .review-card button:hover {
      color: var(--ds-teal);
    }
  </style>
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <!-- ================= PRODUCT DETAILS ================= -->
  <div class="product-page fade-in">
    <img src="../uploads/products/<?= htmlspecialchars($product['image']); ?>" 
         alt="<?= htmlspecialchars($product['name']); ?>" 
         class="product-detail-img">

    <div class="product-detail-info">
      <h1><?= htmlspecialchars($product['name']); ?></h1>
      <p><?= htmlspecialchars($product['description']); ?></p>
      <div class="price">R<?= number_format($product['price'], 2); ?></div>
      <p><strong>Category:</strong> <?= htmlspecialchars($product['category_name']); ?></p>
      <?php if ($product['stock_quantity'] > 0): ?>
	  <p><strong>Availability:</strong> In Stock</p>
	  <?php else: ?>
	  <p><strong>Availability:</strong> Out of Stock</p>
	  <?php endif; ?>
      <p><strong>Carbon Score:</strong> <?= $product['carbon_score']; ?></p>

      <!-- Add to Cart -->
      <form class="add-to-cart" method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?= $productId; ?>">
        <input type="number" name="quantity" value="1" min="1" class="form-control">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-shopping-cart"></i> Add to Cart
        </button>
      </form>
    </div>
  </div>

  <!-- ================= REVIEWS ================= -->
  <section class="reviews-section fade-in">
    <h2 class="section-title">Customer Reviews</h2>
    <?php if ($reviews->num_rows > 0): ?>
      <?php while ($review = $reviews->fetch_assoc()): ?>
        <div class="review-card">
          <div class="review-header">
            <strong><?= htmlspecialchars($review['reviewer_name'] ?? 'Anonymous'); ?></strong>
            <small><?= date("Y-m-d", strtotime($review['created_at'])); ?></small>
          </div>
          <p><?= htmlspecialchars($review['comment']); ?></p>

          <!-- Only show delete if logged in user owns this review -->
          <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['user_id']): ?>
            <form method="POST" class="d-inline">
              <input type="hidden" name="review_id" value="<?= $review['id']; ?>">
              <input type="hidden" name="action" value="delete">
              <button type="submit" title="Delete Review">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No reviews yet. Be the first to review this product!</p>
    <?php endif; ?>
  </section>

  <!-- ================= ADD REVIEW FORM ================= -->
  <?php if (isset($_SESSION['user_id'])): ?>
    <section class="review-form container mt-4">
      <h3>Leave a Review</h3>
      <form method="POST">
        <input type="hidden" name="action" value="create">
        <div class="mb-3">
          <label for="rating" class="form-label">Rating</label>
          <select name="rating" id="rating" class="form-select" required>
            <option value="">Select rating</option>
            <?php for ($i=1; $i<=5; $i++): ?>
              <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="comment" class="form-label">Comment</label>
          <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit Review</button>
      </form>
    </section>
  <?php else: ?>
    <p class="text-center mt-4">Please <a href="../login/signup.php">log in</a> to leave a review.</p>
  <?php endif; ?>

  <?php include '../includes/footer.php'; ?>
      <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
