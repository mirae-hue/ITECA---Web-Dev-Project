<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../includes/connect.php";

$action = $_GET['action'] ?? 'add';
$categoryId = $_GET['id'] ?? null;
$message = "";
$category = [];

if ($action === 'edit' && $categoryId) {
    $stmt = $mysqli->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $category = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);

    if (empty($name)) {
        $message = "<p class='error-msg'>Category name is required.</p>";
    } else {
        if ($action === 'edit' && $categoryId) {
            $stmt = $mysqli->prepare("UPDATE categories SET name=? WHERE id=?");
            $stmt->bind_param("si", $name, $categoryId);
            $stmt->execute();
            $message = "<p class='success-msg'>Category updated.</p>";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO categories (name, created_at) VALUES (?, NOW())");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $message = "<p class='success-msg'>Category added.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ucfirst($action); ?> Category - DragonStone Admin</title>
  <link rel="stylesheet" href="/dragonstone/admin/admin.css">
</head>
<body>
<div class="admin-layout">
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
      <a href="../dashboard.php">Dashboard</a>
      <a href="management.php" class="active">Products</a>
      <a href="../settings.php">Settings</a>
    </nav>
  </aside>

  <main>
    <div class="dashboard-header">
      <h1><?php echo ucfirst($action); ?> Category</h1>
      <a href="management.php" class="action-btn add-btn">← Back to Categories</a>
    </div>

    <?php if (!empty($message)) echo "<div class='message-box'>$message</div>"; ?>

    <div class="form-container">
      <form method="POST">
        <div class="form-group">
          <label>Category Name</label>
          <input type="text" name="name" value="<?php echo $category['name'] ?? ''; ?>" required>
        </div>
        <button type="submit" class="action-btn add-btn"><?php echo ucfirst($action); ?> Category</button>
      </form>
    </div>
  </main>
</div>
</body>
</html>
