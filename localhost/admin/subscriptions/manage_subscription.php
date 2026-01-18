<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../includes/connect.php";

$action = $_GET['action'] ?? 'create';
$subscriptionId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Default values for create mode
$subscription = [
    "name" => "",
    "description" => "",
    "start_date" => "",
    "renewal_period_days" => "",
    "max_instances" => "",
    "status" => "active",
    "image" => "",
    "price" => ""
];

$items = [];

// Fetch products for dropdown
$productResult = $mysqli->query("SELECT id, name, price FROM products ORDER BY name ASC");

// Editing existing subscription
if ($action === 'edit' && $subscriptionId > 0) {
    $stmt = $mysqli->prepare("SELECT * FROM subscriptions WHERE id = ?");
    $stmt->bind_param("i", $subscriptionId);
    $stmt->execute();
    $subscription = $stmt->get_result()->fetch_assoc();

    // Fetch subscription items
    $stmt = $mysqli->prepare("
        SELECT si.*, p.name AS product_name 
        FROM subscription_items si
        LEFT JOIN products p ON si.product_id = p.id
        WHERE si.subscription_id = ?
    ");
    $stmt->bind_param("i", $subscriptionId);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $renewal_period_days = intval($_POST['renewal_period_days']);
    $max_instances = intval($_POST['max_instances']);
    $status = $_POST['status'];
    $price = floatval($_POST['price']);

    /* ============================
       IMAGE UPLOAD HANDLING
       ============================ */
    $image = $subscription['image']; // keep old image by default

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = "../../img/subscriptions/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid("sub_", true) . "." . $ext;
            $uploadPath = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {

                // Delete old image if editing
                if ($action === "edit" && !empty($subscription['image'])) {
                    $oldPath = $uploadDir . $subscription['image'];
                    if (file_exists($oldPath)) unlink($oldPath);
                }

                $image = $newFileName;
            }
        }
    }

    /* ============================
       UPDATE SUBSCRIPTION
       ============================ */
    if ($action === 'edit') {

        $stmt = $mysqli->prepare("
            UPDATE subscriptions 
            SET name=?, description=?, start_date=?, renewal_period_days=?, max_instances=?, status=?, price=?, image=?, updated_at=NOW()
            WHERE id=?
        ");
        $stmt->bind_param("sssissdsi", $name, $description, $start_date, $renewal_period_days, $max_instances, $status, $price, $image, $subscriptionId);
        $stmt->execute();

        // Delete old items
        $mysqli->query("DELETE FROM subscription_items WHERE subscription_id = $subscriptionId");

        // Insert new items
        foreach ($_POST['product_id'] as $i => $product_id) {
            if ($product_id) {
                $qty = intval($_POST['quantity'][$i]);
                $item_price = floatval($_POST['item_price'][$i]);

                $stmt = $mysqli->prepare("
                    INSERT INTO subscription_items (subscription_id, product_id, quantity, item_price)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->bind_param("iiid", $subscriptionId, $product_id, $qty, $item_price);
                $stmt->execute();
            }
        }

        header("Location: s_management.php?updated=1");
        exit;
    }

    /* ============================
       CREATE NEW SUBSCRIPTION
       ============================ */
    $stmt = $mysqli->prepare("
        INSERT INTO subscriptions (user_id, name, description, start_date, renewal_period_days, max_instances, status, price, image, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $user_id = 1; // TEMP — replace with actual user selection
    $stmt->bind_param("isssiisdss", $user_id, $name, $description, $start_date, $renewal_period_days, $max_instances, $status, $price, $image);
    $stmt->execute();
    $newId = $stmt->insert_id;

    // Insert items
    foreach ($_POST['product_id'] as $i => $product_id) {
        if ($product_id) {
            $qty = intval($_POST['quantity'][$i]);
            $item_price = floatval($_POST['item_price'][$i]);

            $stmt = $mysqli->prepare("
                INSERT INTO subscription_items (subscription_id, product_id, quantity, item_price)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param("iiid", $newId, $product_id, $qty, $item_price);
            $stmt->execute();
        }
    }

    header("Location: s_management.php?created=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $action === "edit" ? "Edit Subscription" : "Add Subscription"; ?> - DragonStone Admin</title>
  <link rel="stylesheet" href="/dragonstone/admin/admin.css">
</head>
<body>

<div class="admin-layout">

  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
      <a href="../dashboard.php">Dashboard</a>
      <a href="../products/p_management.php">Products</a>
      <a href="s_management.php" class="active">Subscriptions</a>
      <a href="../settings.php">Settings</a>
    </nav>
  </aside>

  <main>

    <div class="dashboard-header">
      <h1><?= $action === "edit" ? "Edit Subscription" : "Add Subscription"; ?></h1>
      <a href="s_management.php" class="action-btn add-btn">← Back to Subscriptions</a>
    </div>

    <div class="form-container">
      <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <label>Subscription Name</label>
          <input type="text" name="name" value="<?= htmlspecialchars($subscription['name']); ?>" required>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="3"><?= htmlspecialchars($subscription['description']); ?></textarea>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" value="<?= $subscription['start_date']; ?>">
          </div>

          <div class="form-group">
            <label>Renewal Period (days)</label>
            <input type="number" name="renewal_period_days" value="<?= $subscription['renewal_period_days']; ?>">
          </div>

          <div class="form-group">
            <label>Max Instances</label>
            <input type="number" name="max_instances" value="<?= $subscription['max_instances']; ?>">
          </div>

          <div class="form-group">
            <label>Status</label>
            <select name="status">
              <option value="active" <?= $subscription['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
              <option value="paused" <?= $subscription['status'] === 'paused' ? 'selected' : ''; ?>>Paused</option>
              <option value="cancelled" <?= $subscription['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Total Price (R)</label>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($subscription['price']); ?>" required>
          </div>

          <div class="form-group">
            <label>Subscription Image</label>

            <?php if ($action === "edit" && !empty($subscription["image"])): ?>
              <p>Current Image:</p>
              <img src="../../img/subscriptions/<?= htmlspecialchars($subscription['image']); ?>" 
                   style="max-width:150px; border-radius:6px; margin-bottom:1rem;">
            <?php endif; ?>

            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
          </div>
        </div>

        <h2>Subscription Items</h2>

        <div id="items-container">
          <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
              <div class="item-row">
                <select name="product_id[]">
                  <option value="">Select Product</option>
                  <?php
                  $productResult->data_seek(0);
                  while ($p = $productResult->fetch_assoc()):
                  ?>
                    <option value="<?= $p['id']; ?>" <?= $p['id'] == $item['product_id'] ? 'selected' : ''; ?>>
                      <?= htmlspecialchars($p['name']); ?>
                    </option>
                  <?php endwhile; ?>
                </select>

                <input type="number" name="quantity[]" value="<?= $item['quantity']; ?>" placeholder="Qty">
                <input type="number" step="0.01" name="item_price[]" value="<?= $item['item_price']; ?>" placeholder="Price">
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <button type="button" class="action-btn add-btn" onclick="addItemRow()">+ Add Item</button>

        <button type="submit" class="action-btn add-btn">
          <?= $action === "edit" ? "Update Subscription" : "Add Subscription"; ?>
        </button>

      </form>
    </div>

  </main>

</div>

<script>
function addItemRow() {
  const container = document.getElementById('items-container');
  const row = document.createElement('div');
  row.classList.add('item-row');
  row.innerHTML = `
    <select name="product_id[]">
      <option value="">Select Product</option>
      <?php
      $productResult->data_seek(0);
      while ($p = $productResult->fetch_assoc()):
      ?>
        <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></option>
      <?php endwhile; ?>
    </select>
    <input type="number" name="quantity[]" placeholder="Qty">
    <input type="number" step="0.01" name="item_price[]" placeholder="Price">
  `;
  container.appendChild(row);
}
</script>

</body>
</html>
