<?php
session_start();
require_once "../includes/connect.php";
include "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* Pause / Cancel */
if (isset($_POST['action']) && isset($_POST['sub_id'])) {
    $sub_id = intval($_POST['sub_id']);
    $action = $_POST['action'];

    if ($action === "pause") {
        $mysqli->query("UPDATE user_subscriptions SET status='paused' WHERE id=$sub_id AND user_id=$user_id");
        echo "<script>alert('Subscription Paused'); window.location='u_subscribe.php';</script>";
        exit;
    }

    if ($action === "cancel") {
        $mysqli->query("UPDATE user_subscriptions SET status='cancelled' WHERE id=$sub_id AND user_id=$user_id");
        echo "<script>alert('Subscription Cancelled'); window.location='u_subscribe.php';</script>";
        exit;
    }
}

/* Fetch user subscriptions */
$subs = $mysqli->query("
    SELECT us.id AS user_sub_id, s.name, us.status, us.total_price, us.next_renewal_date
    FROM user_subscriptions us
    JOIN subscriptions s ON us.subscription_id = s.id
    WHERE us.user_id = $user_id
    ORDER BY us.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>My Subscriptions | DragonStone</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<a href="u_dashboard.php" class="back-btn" style="margin-left:auto;">← Back</a>

<div class="cart-page">
	<div class="cart-header">
		<h2>My Subscriptions</h2>
	</div>


    <?php if ($subs->num_rows > 0): ?>
        <?php while ($sub = $subs->fetch_assoc()): ?>

        <div class="subscription-card-user">
            <h3><?= htmlspecialchars($sub['name']); ?></h3>
            <p>Status: <strong><?= ucfirst($sub['status']); ?></strong></p>
            <p>Next Renewal: <?= $sub['next_renewal_date']; ?></p>
            <p>Total Price: R<?= number_format($sub['total_price'], 2); ?></p>

            <div class="sub-actions">
                <button class="checkout-btn" onclick="openModal(<?= $sub['user_sub_id']; ?>)">View Details</button>

                <form method="POST" style="display:inline;">
                    <input type="hidden" name="sub_id" value="<?= $sub['user_sub_id']; ?>">
                    <button name="action" value="pause" class="back-btn">Pause</button>
                </form>

                <form method="POST" style="display:inline;">
                    <input type="hidden" name="sub_id" value="<?= $sub['user_sub_id']; ?>">
                    <button name="action" value="cancel" class="cart-remove">Cancel</button>
                </form>
            </div>
        </div>

        <?php endwhile; ?>
    <?php else: ?>
        <p>You have no active subscriptions.</p>
    <?php endif; ?>
</div>

<!-- Modal -->
<div id="modalOverlay" class="modal-overlay" onclick="closeModal()"></div>

<div id="modalBox" class="modal-box">
    <div id="modalContent"></div>
    <button class="back-btn" onclick="closeModal()">Close</button>
</div>

<script>
function openModal(id) {
    fetch("view_subscription_ajax.php?id=" + id)
        .then(res => res.text())
        .then(html => {
            document.getElementById("modalContent").innerHTML = html;
            document.getElementById("modalOverlay").style.display = "block";
            document.getElementById("modalBox").style.display = "block";
        });
}

function closeModal() {
    document.getElementById("modalOverlay").style.display = "none";
    document.getElementById("modalBox").style.display = "none";
}
</script>

<?php include "../includes/footer.php"; ?>
    
      <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
