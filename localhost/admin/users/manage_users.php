<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../../includes/connect.php";

$message = "";
$action = $_GET['action'] ?? 'add';
$userId = intval($_GET['id'] ?? 0);
$user = [];

// If editing, fetch user data
if ($action === 'edit' && $userId) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $role = trim($_POST["role"]);
    $status = trim($_POST["status"]);
    $eco_points = intval($_POST["eco_points"]);
    $subscription_level = trim($_POST["subscription_level"]);
    $carbon_score = floatval($_POST["carbon_score"]);
    $profile_image = $_FILES["profile_image"];

    if (empty($first_name) || empty($last_name) || empty($email)) {
        $message = "<p class='error-msg'>First name, last name, and email are required.</p>";
    } else {
        // Handle profile image upload
        $newFileName = $user['profile_image'] ?? '';
        if ($profile_image && $profile_image["error"] === UPLOAD_ERR_OK) {
            $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
            if (in_array($profile_image["type"], $allowedTypes)) {
                $uploadDir = "../../uploads/profiles/";
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $ext = pathinfo($profile_image["name"], PATHINFO_EXTENSION);
                $newFileName = uniqid("user_", true) . "." . $ext;
                $uploadPath = $uploadDir . $newFileName;
                move_uploaded_file($profile_image["tmp_name"], $uploadPath);
            }
        }

        if ($action === 'add') {
            $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, email, role, status, eco_points, subscription_level, carbon_score, profile_image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("sssssiids", $first_name, $last_name, $email, $role, $status, $eco_points, $subscription_level, $carbon_score, $newFileName);
            if ($stmt->execute()) {
                $message = "<p class='success-msg'>User added successfully.</p>";
            } else {
                $message = "<p class='error-msg'>Database error: {$stmt->error}</p>";
            }
            $stmt->close();
        } elseif ($action === 'edit' && $userId) {
            $stmt = $mysqli->prepare("UPDATE users SET first_name=?, last_name=?, email=?, role=?, status=?, eco_points=?, subscription_level=?, carbon_score=?, profile_image=?, updated_at=NOW() WHERE id=?");
            $stmt->bind_param("sssssiidsi", $first_name, $last_name, $email, $role, $status, $eco_points, $subscription_level, $carbon_score, $newFileName, $userId);
            if ($stmt->execute()) {
                $message = "<p class='success-msg'>User updated successfully.</p>";
            } else {
                $message = "<p class='error-msg'>Database error: {$stmt->error}</p>";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $action === 'edit' ? 'Edit User' : 'Add User'; ?> - DragonStone Admin</title>
  <link rel="stylesheet" href="/dragonstone/admin/admin.css">
</head>
<body>
<div class="admin-layout">
  <aside class="sidebar">
    <div class="sidebar-header">DragonStone</div>
    <nav>
      <a href="../dashboard.php">Dashboard</a>
      <a href="../products/management.php">Products</a>
      <a href="management.php" class="active">Users</a>
      <a href="../settings.php">Settings</a>
    </nav>
  </aside>

  <main>
    <div class="dashboard-header">
      <h1><?= $action === 'edit' ? 'Edit User' : 'Add New User'; ?></h1>
      <a href="management.php" class="action-btn add-btn">← Back to Users</a>
    </div>

    <?php if (!empty($message)) echo "<div class='message-box'>$message</div>"; ?>

    <div class="form-container">
      <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Role</label>
            <input type="text" name="role" value="<?= htmlspecialchars($user['role'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Status</label>
            <input type="text" name="status" value="<?= htmlspecialchars($user['status'] ?? '') ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Eco Points</label>
            <input type="number" name="eco_points" value="<?= htmlspecialchars($user['eco_points'] ?? 0) ?>">
          </div>
          <div class="form-group">
            <label>Subscription Level</label>
            <input type="text" name="subscription_level" value="<?= htmlspecialchars($user['subscription_level'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Carbon Score</label>
            <input type="number" step="0.01" name="carbon_score" value="<?= htmlspecialchars($user['carbon_score'] ?? 0) ?>">
          </div>
        </div>

        <div class="form-group">
          <label>Profile Image</label>
          <input type="file" name="profile_image" accept=".jpg,.jpeg,.png,.webp">
          <?php if (!empty($user['profile_image'])): ?>
            <img src="../../uploads/profiles/<?= htmlspecialchars($user['profile_image']); ?>" class="profile-thumb" alt="Current Image">
          <?php endif; ?>
        </div>

        <button type="submit" class="action-btn add-btn"><?= $action === 'edit' ? 'Update User' : 'Add User'; ?></button>
      </form>
    </div>
  </main>
</div>
</body>
</html>
