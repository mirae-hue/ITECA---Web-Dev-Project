<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../includes/connect.php";

$message = "";

// Delete product
if (isset($_GET['delete_product'])) {
    $id = intval($_GET['delete_product']);
    $stmt = $mysqli->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        $imagePath = "../../uploads/products/" . $row["image"];
        if (file_exists($imagePath)) unlink($imagePath);
    }
    $stmt->close();

    $stmt = $mysqli->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $message = "<p class='success-msg'>Product deleted.</p>";
}

$action = $_GET['action'] ?? '';
$productId = $_GET['id'] ?? 0;
// Update product
if ($action === 'edit' && $productId) {
    $stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=?, category_id=?, stock_quantity=?, carbon_score=?, image=?, updated_at=NOW() WHERE id=?");
    $stmt->bind_param("ssdiiisi", $name, $description, $price, $category_id, $stock_quantity, $carbon_score, $newFileName, $productId);
    $stmt->execute();
    $message = "<p class='success-msg'>Product updated.</p>";
}

// Delete category
if (isset($_GET['delete_category'])) {
    $id = intval($_GET['delete_category']);
    $stmt = $mysqli->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $message = "<p class='success-msg'>Category deleted.</p>";
}

// Fetch data
$productResult = $mysqli->query("SELECT p.*, c.name AS category_name FROM products p
  LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC
");
$categoryResult = $mysqli->query("SELECT * FROM categories ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products & Categories - DragonStone Admin</title>
  <link rel="stylesheet" href="../admin.css">
</head>
<body>
<div class="admin-layout">
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
		<a href="../dashboard.php">Dashboard</a>
		<a href="../products/p_management.php" class="active">Products</a>
		<a href="../subscriptions/s_management.php">Subscriptions</a>
		<a href="../orders/o_management.php">Orders</a>
		<a href="../users/u_management.php">Users</a>
		<a href="../community/c_management.php">Community</a>
		<a href="../dashboard.php">Analytics</a>
    </nav>
  </aside>

  <main>
    <div class="dashboard-header">
      <h1>Product Management</h1>
      <a href="manage_product.php" class="action-btn add-btn">+ Add Product</a>
    </div>

    <?php if (!empty($message)) echo "<div class='message-box'>$message</div>"; ?>

    <div class="table-container">
      <h2>All Products</h2>
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price (R)</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if ($productResult && $productResult->num_rows > 0): ?>
          <?php while ($row = $productResult->fetch_assoc()): ?>
            <tr>
              <td><img src="../../uploads/products/<?php echo htmlspecialchars($row['image']); ?>" class="product-thumb" alt=""></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['category_name']); ?></td>
              <td>R<?php echo number_format($row['price'], 2); ?></td>
              <td class="timestamp"><?php echo $row['created_at']; ?></td>
              <td class="actions">
                <a href="manage_product.php?action=edit&id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="p_management.php?delete_product=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" class="no-data">No products found.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="dashboard-header" style="margin-top: 3rem;">
      <h1>Category Management</h1>
      <a href="manage_category.php" class="action-btn add-btn">+ Add Category</a>
    </div>

    <div class="table-container">
      <h2>All Categories</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if ($categoryResult && $categoryResult->num_rows > 0): ?>
          <?php while ($cat = $categoryResult->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($cat['name']); ?></td>
              <td class="timestamp"><?php echo $cat['created_at']; ?></td>
              <td class="actions">
                <a href="manage_category.php?action=edit&id=<?php echo $cat['id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="p_management.php?delete_category=<?php echo $cat['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this category?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="3" class="no-data">No categories found.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
</body>
</html>
