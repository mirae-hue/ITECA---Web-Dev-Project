<?php
session_start();
require_once "../includes/connect.php";
include "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

/* ----------------------- FETCH ALL POSTS ------------------ */
$posts = $mysqli->query("
    SELECT p.*, u.first_name, u.last_name
    FROM posts p
    JOIN users u ON p.user_id = u.id
    ORDER BY p.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Community Hub | DragonStone</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="../style.css" />
<style>
.post-actions {
  margin: 5px 0;
}
.post-action-btn {
  background: #000;
  color: #fff;
  text-transform: lowercase;
  padding: 4px 10px;
  border-radius: 4px;
  font-size: 0.85rem;
  text-decoration: none;
  margin-right: 5px;
  border: none;
  cursor: pointer;
}
.post-action-btn:hover {
  background: #333;
}
.comment-box {
  background:#eee;
  padding:10px;
  border-radius:6px;
  margin-bottom:10px;
}
</style>
</head>
<body>

<!-- ================= HERO SECTION ================= -->
<section class="hero fade-in" style="background-image:url('../img/mission.png');">
  <div class="hero-overlay">
    <h1>Community Hub</h1>
    <p>Connect, share, and grow with fellow DragonStone members.</p>
  </div>
</section>

<!-- ================= COMMUNITY POSTS SECTION ================= -->
<div class="subscription-page">

  <h2 style="color:var(--ds-forest); border-bottom:2px solid var(--ds-forest); padding-bottom:0.5rem;">
    Latest Community Posts
  </h2>

  <p style="margin-top:1rem; font-size:1.1rem; color:var(--ds-forest); max-width:800px;">
    Welcome to the DragonStone community! Here you’ll find posts from members sharing ideas, 
    tips, and inspiration. Join the conversation and make your voice heard.
  </p>

  <!-- Action Bar -->
  <div style="display:flex; justify-content:space-between; align-items:center; margin:1rem 0;">
    <!-- Left: Create Post -->
    <a href="community_post.php?action=new" class="subscribe-btn">+ Create Post</a>
  </div>

  <!-- Posts Grid -->
  <div class="subscription-grid">
    <?php while ($p = $posts->fetch_assoc()): ?>
    <div class="subscription-card">
      <div class="subscription-front">
        <h3><?= htmlspecialchars($p['title']); ?></h3>
        <p><strong>By <?= htmlspecialchars($p['first_name'] . " " . $p['last_name']); ?></strong></p>

        <!-- Edit/Delete buttons for owner -->
        <?php if ($p['user_id'] == $_SESSION['user_id']): ?>
          <div class="post-actions">
            <a href="community_post.php?action=edit&id=<?= $p['id']; ?>" class="post-action-btn">edit</a>
            <form action="community_post.php?action=delete&id=<?= $p['id']; ?>" method="post" style="display:inline;">
              <button type="submit" class="post-action-btn" onclick="return confirm('Delete this post?');">delete</button>
            </form>
          </div>
        <?php endif; ?>


        <p><?= date("d M Y", strtotime($p['created_at'])); ?> | ❤️ <?= $p['likes_count']; ?></p>
      </div>

      <div class="subscription-hover">
        <p><?= nl2br(htmlspecialchars(substr($p['content'], 0, 200))); ?>...</p>
        <a href="community_post.php?action=view&id=<?= $p['id']; ?>" class="subscribe-btn">Read More</a>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <!-- Back Button at Bottom -->
  <div style="margin-top:2rem;">
    <a href="u_dashboard.php" class="subscribe-btn">← Back to Account</a>
  </div>

</div>

<?php include "../includes/footer.php"; ?>
    
      <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
