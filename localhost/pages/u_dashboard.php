<?php
session_start();
include '../includes/connect.php';

// Protect dashboard: only logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/signup.php?mode=signin");
    exit();
}

$user_id    = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];
$role       = $_SESSION['role'];

// Fetch eco_points 
$stmt = $mysqli->prepare("SELECT eco_points FROM users WHERE id = ?"); 
$stmt->bind_param("i", $user_id); 
$stmt->execute(); 
$stmt->bind_result($eco_points); 
$stmt->fetch(); 
$stmt->close();

// Fetch total carbon score from all user orders
$carbon_stmt = $mysqli->prepare("
    SELECT COALESCE(SUM(carbon_score), 0)
    FROM orders
    WHERE user_id = ?
");
$carbon_stmt->bind_param("i", $user_id);
$carbon_stmt->execute();
$carbon_stmt->bind_result($total_carbon_score);
$carbon_stmt->fetch();
$carbon_stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
.logout-container {
  text-align: right;
  margin-bottom: 20px;
}

.logout-btn {
  background-color: #2b6e4a;
  color: #fff;
  padding: 8px 14px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.3s ease;
  display: inline-flex;
  align-items: center;
}

.logout-btn i {
  margin-right: 6px;
}

.logout-btn:hover {
  background-color: #78a980;
}

</style>
</head>
<body>
  <!-- ================= HEADER ================= -->
  <header>
    <?php include '../includes/header.php'; ?>
  </header>

  <main class="dashboard-container">
    <div class="logout-container">
      <a href="../login/signout.php" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>

    <h1>Welcome, <?php echo htmlspecialchars($first_name); ?> 👋</h1>

    <section class="dashboard-grid">
      <div class="card">
        <i class="fas fa-leaf"></i>
        <h2>EcoPoints</h2>
        <p>Your sustainability points balance:</p>
        <span class="points"><?= number_format($eco_points); ?></span>
      </div>


      <div class="card">
        <i class="fas fa-calculator"></i>
        <h2>Carbon Score</h2>
        <p>Your sustainability score:</p>
        <span class="points"><?= number_format($total_carbon_score); ?></span>
      </div>
	  
	  <div class="card">
        <i class="fas fa-box"></i>
        <h2>Subscriptions</h2>
        <p>Manage your active subscriptions.</p>
        <a href="u_subscribe.php" class="btn">View</a>
      </div>

	  <div class="card">
	    <i class="fas fa-box"></i>
	    <h2>Order History</h2>
	    <p>Track your past and current orders.</p>
	    <a href="u_orders.php" class="btn">View Orders</a>
	  </div>


      <div class="card">
        <i class="fas fa-users"></i>
        <h2>Community Hub</h2>
        <p>Join discussions, add posts, update or delete your content.</p>
        <a href="community.php" class="btn">Enter Hub</a>
      </div>
    </section>
  </main>
  
  <!-- ================= FOOTER ================= -->
  <footer>
    <?php include '../includes/footer.php'; ?>
  </footer>
</body>
</html>
