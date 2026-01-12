<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../includes/connect.php";

$message = "";
$action = $_GET["action"] ?? "add";
$productId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Default empty values
$product = [
    "name" => "",
    "description" => "",
    "price" => "",
    "category_id" => "",
    "stock_quantity" => "",
    "carbon_score" => "",
    "image" => ""
];

// If editing, fetch product
if ($action === "edit" && $productId > 0) {
    $stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $message = "<p class='error-msg'>Product not found.</p>";
        $action = "add";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = floatval($_POST["price"]);
    $category_id = intval($_POST["category_id"]);
    $stock_quantity = intval($_POST["stock_quantity"]);
    $carbon_score = floatval($_POST["carbon_score"]);
    $image = $_FILES["product_image"];

    if (empty($name) || empty($description) || empty($price) || empty($category_id)) {
        $message = "<p class='error-msg'>All fields are required.</p>";
    } elseif ($price <= 0) {
        $message = "<p class='error-msg'>Enter a valid product price.</p>";
    } else {
        $uploadDir = "../../uploads/products/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $newFileName = $product["image"]; // keep old image by default

        // If new image uploaded
        if ($image["error"] === UPLOAD_ERR_OK) {
            $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
            if (!in_array($image["type"], $allowedTypes)) {
                $message = "<p class='error-msg'>Only JPG, PNG, or WEBP images are allowed.</p>";
            } else {
                $ext = pathinfo($image["name"], PATHINFO_EXTENSION);
                $newFileName = uniqid("prod_", true) . "." . $ext;
                $uploadPath = $uploadDir . $newFileName;

                if (move_uploaded_file($image["tmp_name"], $uploadPath)) {
                    // Delete old image if editing
                    if ($action === "edit" && !empty($product["image"])) {
                        $oldPath = $uploadDir . $product["image"];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                } else {
                    $message = "<p class='error-msg'>Failed to upload image.</p>";
                }
            }
        }

        if (empty($message)) {
            if ($action === "edit" && $productId > 0) {
                // UPDATE
                $stmt = $mysqli->prepare("
                    UPDATE products 
                    SET name=?, description=?, price=?, category_id=?, stock_quantity=?, carbon_score=?, image=?, updated_at=NOW()
                    WHERE id=?
                ");
                $stmt->bind_param("ssdiiisi", $name, $description, $price, $category_id, $stock_quantity, $carbon_score, $newFileName, $productId);
                $stmt->execute();
                $stmt->close();
                $message = "<p class='success-msg'>Product updated successfully.</p>";
            } else {
                // INSERT
                $stmt = $mysqli->prepare("
                    INSERT INTO products (name, description, price, category_id, stock_quantity, carbon_score, image, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
                ");
                $stmt->bind_param("ssdiiis", $name, $description, $price, $category_id, $stock_quantity, $carbon_score, $newFileName);
                $stmt->execute();
                $stmt->close();
                $message = "<p class='success-msg'>Product added successfully.</p>";
            }
        }
    }
}

$categoryQuery = $mysqli->query("SELECT id, name FROM categories ORDER BY name ASC");
$categories = $categoryQuery ? $categoryQuery->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $action === "edit" ? "Edit Product" : "Add Product"; ?> - DragonStone Admin</title>
  <link rel="stylesheet" href="/dragonstone/admin/admin.css">
</head>
<body>
<div class="admin-layout">
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
      <a href="../dashboard.php">Dashboard</a>
      <a href="p_management.php" class="active">Products</a>
      <a href="../settings.php">Settings</a>
    </nav>
  </aside>

  <main>
    <div class="dashboard-header">
      <h1><?= $action === "edit" ? "Edit Product" : "Add New Product"; ?></h1>
      <a href="p_management.php" class="action-btn add-btn">← Back to Products</a>
    </div>

    <?php if (!empty($message)) echo "<div class='message-box'>$message</div>"; ?>

    <div class="form-container">
      <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <label>Product Name</label>
          <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="3" required><?= htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Price (R)</label>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']); ?>" required>
          </div>

          <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
              <option value="">Select a category</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id']; ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                  <?= htmlspecialchars($cat['name']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Stock Quantity</label>
            <input type="number" name="stock_quantity" value="<?= htmlspecialchars($product['stock_quantity']); ?>" required>
          </div>

          <div class="form-group">
            <label>Carbon Score</label>
            <input type="number" step="0.01" name="carbon_score" value="<?= htmlspecialchars($product['carbon_score']); ?>" required>
          </div>
        </div>

		<div class="form-group">
		  <label>Product Image</label>

		  <?php if ($action === "edit" && !empty($product["image"])): ?>
			<p>Current:</p>
			<img 
			  src="../../uploads/products/<?= htmlspecialchars($product['image']); ?>" 
			  class="product-thumb" 
			  alt="" 
			  style="max-width: 150px; margin-bottom: 1rem;"
			>
			<p><b>Upload Replacement Image</p>
		  <?php endif; ?>

		  <input 
			type="file" 
			name="product_image" 
			accept=".jpg,.jpeg,.png,.webp" 
			id="imageInput"
			<?= $action === "add" ? "required" : ""; ?>
		  >

		  <!-- Live preview -->
		  <img 
			id="previewImage" 
			style="display:none; max-width:150px; margin-top:1rem; border-radius:6px;"
		  >
		</div>
		
		<button type="submit" class="action-btn add-btn">
		  <?= $action === "edit" ? "Update Product" : "Add Product"; ?>
		</button>
      </form>
    </div>
  </main>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
        preview.src = "";
    }
});
</script>

</body>
</html>
