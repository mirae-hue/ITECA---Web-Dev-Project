<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../includes/connect.php";

$message = "";

// Delete user
if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "<p class='success-msg'>User deleted.</p>";
    } else {
        $message = "<p class='error-msg'>Error deleting user: {$stmt->error}</p>";
    }
    $stmt->close();
}

// Fetch all users
$userResult = $mysqli->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management - DragonStone Admin</title>
  <link rel="stylesheet" href="../admin.css">
</head>
<body>
<div class="admin-layout">
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
		<a href="../dashboard.php">Dashboard</a>
		<a href="../products/p_management.php">Products</a>
		<a href="../subscriptions/s_management.php">Subscriptions</a>
		<a href="../orders/o_management.php">Orders</a>
		<a href="../users/u_management.php" class="active">Users</a>
		<a href="../community/c_management.php">Community</a>
		<a href="../dashboard.php">Analytics</a>
    </nav>
  </aside>

  <main>
    <div class="dashboard-header">
      <h1>User Management</h1>
      <a href="manage_user.php" class="action-btn add-btn">+ Add User</a>
    </div>

    <?php if (!empty($message)) echo "<div class='message-box'>$message</div>"; ?>

    <div class="table-container">
      <h2>All Users</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Profile</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Verified</th>
            <th>Eco Points</th>
            <th>Carbon Score</th>
            <th>Last Login</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if ($userResult && $userResult->num_rows > 0): ?>
          <?php while ($row = $userResult->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td>
                <?php if (!empty($row['profile_image'])): ?>
                  <img src="../../uploads/profiles/<?php echo htmlspecialchars($row['profile_image']); ?>" class="profile-thumb" alt="">
                <?php else: ?>
                  <span class="no-image">N/A</span>
                <?php endif; ?>
              </td>
              <td><?php echo htmlspecialchars($row['first_name']); ?></td>
              <td><?php echo htmlspecialchars($row['last_name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['role']); ?></td>
              <td><?php echo htmlspecialchars($row['status']); ?></td>
              <td><?php echo $row['is_verified'] ? "Yes" : "No"; ?></td>
              <td><?php echo htmlspecialchars($row['eco_points']); ?></td>
              <td><?php echo htmlspecialchars($row['carbon_score']); ?></td>
              <td class="timestamp"><?php echo $row['last_login']; ?></td>
              <td class="timestamp"><?php echo $row['created_at']; ?></td>
              <td class="actions">
                <a href="manage_user.php?action=edit&id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="u_management.php?delete_user=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this user?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="14" class="no-data">No users found.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
</body>
</html>
