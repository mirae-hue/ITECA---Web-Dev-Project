<?php
session_start();
require_once '../includes/connect.php';
require_once '../includes/functions.php';
include "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

/* ------------------- DELETE POST ------------------- */
if ($action === 'delete' && $id) {
    $post = $mysqli->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();

    if ($post['user_id'] != $user_id) {
        die("Unauthorized");
    }

    $mysqli->query("DELETE FROM posts WHERE id=$id");
    header("Location: community.php");
    exit;
}

/* ---------------- ADD COMMENT --------------------- */
if ($action === 'comment' && $id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = trim($_POST['comment']);
    $id = (int)$id;
    $user_id = (int)$user_id;

    $stmt = $mysqli->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $id, $user_id, $comment);

    if (!$stmt->execute()) {
        die("Error inserting comment: " . $stmt->error);
    }

    header("Location: community_post.php?action=view&id=$id");
    exit;
}

/* ------------------- DELETE COMMENT ------------------- */
if ($action === 'delete_comment' && $id) {
    $comment_id = (int)$id;

    // Fetch comment
    $comment = $mysqli->query("SELECT * FROM comments WHERE id=$comment_id")->fetch_assoc();

    // Only allow the comment owner to delete
    if ($comment['user_id'] != $user_id) {
        die("Unauthorized");
    }

    $mysqli->query("DELETE FROM comments WHERE id=$comment_id");

    // Redirect back to the post view
    header("Location: community_post.php?action=view&id=" . $comment['post_id']);
    exit;
}


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

<div class="subscription-page">

<?php
/* --------------------- VIEW SINGLE POST --------------------- */
if ($action === 'view' && $id) {

    $post = $mysqli->query("
        SELECT p.*, u.first_name, u.last_name
        FROM posts p
        JOIN users u ON p.user_id = u.id
        WHERE p.id = $id
    ")->fetch_assoc();

    // Back button
    echo '<div style="margin-top:2rem;">';
    echo '<a href="community.php" class="subscribe-btn">← Back to All Posts</a>';
    echo '</div>';

    // Single post card
    echo '<div class="subscription-card">';
    
    echo '<div class="subscription-front">';
    echo '<h3>' . htmlspecialchars($post['title']) . '</h3>';
    echo '<p><strong>By ' . htmlspecialchars($post['first_name'] . " " . $post['last_name']) . '</strong></p>';

    // Edit/Delete buttons
    if ($post['user_id'] == $user_id) {
        echo '<div class="post-actions">';
        echo '<a href="community_post.php?action=edit&id=' . $post['id'] . '" class="post-action-btn">edit</a>';
        echo '<form action="community_post.php?action=delete&id=' . $post['id'] . '" method="post" style="display:inline;">';
        echo '<button type="submit" class="post-action-btn" onclick="return confirm(\'Delete this post?\');">delete</button>';
        echo '</form>';
        echo '</div>';
    }

    echo '<p>' . date("d M Y", strtotime($post['created_at'])) . ' | ❤️ ' . $post['likes_count'] . '</p>';
    echo '</div>'; // end front

    // Full content
    echo '<div class="subscription-hover">';
    echo '<p>' . nl2br(htmlspecialchars($post['content'])) . '</p>';
    echo '</div>'; // end hover

    echo '</div>'; // end card

    // Comments
    echo '<h3>Comments</h3>';
    $comments = $mysqli->query("
        SELECT c.*, u.first_name, u.last_name
        FROM comments c
        JOIN users u ON c.user_id = u.id
        WHERE c.post_id = $id
        ORDER BY c.id ASC
    ");
while ($c = $comments->fetch_assoc()) {
    echo '<div class="comment-box">';
    echo '<p>' . htmlspecialchars($c['content']) . '</p>';
    echo '<small>' . htmlspecialchars($c['first_name'] . " " . $c['last_name']) . 
         ' • ' . date("d M Y", strtotime($c['created_at'])) . '</small>';

    // Show delete button if current user owns the comment
    if ($c['user_id'] == $user_id) {
        echo '<form action="community_post.php?action=delete_comment&id=' . $c['id'] . '" method="post" style="display:inline;">';
        echo '<button type="submit" class="post-action-btn" onclick="return confirm(\'Delete this comment?\');">delete</button>';
        echo '</form>';
    }

    echo '</div>';
}


    echo '
    <form action="community_post.php?action=comment&id=' . $id . '" method="POST">
        <textarea name="comment" required placeholder="Write a comment..."></textarea>
        <button class="subscribe-btn">Add Comment</button>
    </form>
    ';
}

/* -------------------- CREATE POST -------------------- */
if ($action === 'new') {
    echo "<h1>Create New Post</h1>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $mysqli->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);
        $stmt->execute();

        header("Location: community.php");
        exit;
    }

    echo "
    <form method='POST'>
        <input type='text' name='title' placeholder='Post title' required>
        <textarea name='content' placeholder='Write your post...' required></textarea>
        <button class='btn'>Publish</button>
    </form>";
}

/* ----- EDIT POST ------------ */
if ($action === 'edit' && $id) {
    $post = $mysqli->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();

    if ($post['user_id'] != $user_id) {
        die("Unauthorized");
    }

    echo "<h1>Edit Post</h1>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $mysqli->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $content, $id);
        $stmt->execute();

        header("Location: community_post.php?action=view&id=$id");
        exit;
    }

    echo "
    <form method='POST'>
        <input type='text' name='title' value='" . htmlspecialchars($post['title']) . "' required>
        <textarea name='content' required>" . htmlspecialchars($post['content']) . "</textarea>
        <button class='btn'>Save Changes</button>
    </form>";
}
?>

</div>

<?php include "../includes/footer.php"; ?>
      <!-- ========== SCRIPTS ========== -->
  <script src="/../script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
