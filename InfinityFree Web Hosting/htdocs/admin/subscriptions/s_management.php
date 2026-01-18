<?php
session_start();
require_once "../../includes/connect.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$message = "";

/* ============= DELETE SUBSCRIPTION =============== */
if (isset($_GET['delete_subscription'])) {
    $id = intval($_GET['delete_subscription']);

    // Delete subscription items first
    $stmt = $mysqli->prepare("DELETE FROM subscription_items WHERE subscription_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Delete subscription
    $stmt = $mysqli->prepare("DELETE FROM subscriptions WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $message = "<p class='success-msg'>Subscription deleted.</p>";
}

/*=============== FETCH SUBSCRIPTIONS ================ */
$subscriptionResult = $mysqli->query("
    SELECT 
        s.*, 
        CONCAT(u.first_name, ' ', u.last_name) AS user_name
    FROM subscriptions s
    LEFT JOIN users u ON s.user_id = u.id
    ORDER BY s.created_at DESC
");

/*=============== FETCH USER SUBSCRIPTIONS =============== */
$activeSubs = $mysqli->query("
    SELECT 
        us.id AS user_subscription_id,
        CONCAT(u.first_name, ' ', u.last_name) AS user_name,
        s.name AS subscription_name,
        us.start_date,
        us.next_renewal_date,
        us.status,
        us.total_price
    FROM user_subscriptions us
    JOIN users u ON us.user_id = u.id
    JOIN subscriptions s ON us.subscription_id = s.id
    WHERE us.status = 'active'
    ORDER BY us.start_date DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Subscriptions - DragonStone Admin</title>
  <link rel="stylesheet" href="../admin.css">
</head>

<body>
<div class="admin-layout">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
		<a href="../dashboard.php">Dashboard</a>
		<a href="../products/p_management.php">Products</a>
		<a href="../subscriptions/s_management.php" class="active">Subscriptions</a>
		<a href="../orders/o_management.php">Orders</a>
		<a href="../users/u_management.php">Users</a>
		<a href="../community/c_management.php">Community</a>
		<a href="../dashboard.php">Analytics</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main>

    <div class="dashboard-header">
      <h1>Subscription Management</h1>
      <a href="manage_subscription.php" class="action-btn add-btn">+ Add Subscription</a>
    </div>

    <?php if (!empty($message)) echo "<div class='message-box'>$message</div>"; ?>

    <div class="table-container">
      <h2>All Subscriptions</h2>

      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>User</th>
            <th>Name</th>
            <th>Renewal (days)</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        <?php if ($subscriptionResult && $subscriptionResult->num_rows > 0): ?>
          <?php while ($row = $subscriptionResult->fetch_assoc()): ?>

            <?php
              // Handle missing images
              $imageFile = !empty($row['image']) 
                ? "../../img/subscriptions/" . $row['image'] 
                : "../../img/subscriptions/default.jpg";
            ?>

            <tr>
              <td>
                <img 
                  src="<?php echo $imageFile; ?>" 
                  alt="Subscription Image" 
                  style="width:60px; height:60px; object-fit:cover; border-radius:6px;"
                >
              </td>

              <td><?php echo htmlspecialchars($row['user_name']); ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo $row['renewal_period_days']; ?></td>
              <td><?php echo htmlspecialchars($row['status']); ?></td>
              <td class="timestamp"><?php echo $row['created_at']; ?></td>

              <td class="actions">
                <a href="manage_subscription.php?action=edit&id=<?php echo $row['id']; ?>" 
                   class="action-btn edit-btn">Edit</a>

                <a href="s_management.php?delete_subscription=<?php echo $row['id']; ?>" 
                   class="action-btn delete-btn"
                   onclick="return confirm('Delete this subscription?');">
                   Delete
                </a>
              </td>
            </tr>

          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7" class="no-data">No subscriptions found.</td></tr>
        <?php endif; ?>
        </tbody>

      </table>
    </div>

  </main>
</div>

<h2 style="margin-top:3rem;">Active User Subscriptions</h2>

<div class="table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Subscription</th>
                <th>Start Date</th>
                <th>Next Renewal</th>
                <th>Status</th>
                <th>Total Price</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($activeSubs->num_rows > 0): ?>
                <?php while ($row = $activeSubs->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['user_name']); ?></td>
                    <td><?= htmlspecialchars($row['subscription_name']); ?></td>
                    <td><?= $row['start_date']; ?></td>
                    <td><?= $row['next_renewal_date']; ?></td>
                    <td><?= ucfirst($row['status']); ?></td>
                    <td>R<?= number_format($row['total_price'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No active subscriptions found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
