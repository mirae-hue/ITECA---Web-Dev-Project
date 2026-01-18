<?php
session_start();
require_once "../../includes/connect.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$comments = $mysqli->query("
    SELECT c.*, p.title, u.first_name, u.last_name
    FROM comments c
    JOIN posts p ON c.post_id = p.id
    JOIN users u ON c.user_id = u.id
    ORDER BY c.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Comments | Admin</title>
<link rel="stylesheet" href="../admin.css">
</head>

<body>

<div class="admin-layout">

<aside class="sidebar">
    <div class="sidebar-header">DragonStone Admin</div>
    <nav>
        <a href="../dashboard.php">Dashboard</a>
        <a href="manage_posts.php">Posts</a>
        <a href="manage_comments.php" class="active">Comments</a>
    </nav>
</aside>

<main>
    <div class="dashboard-header">
        <h1>Manage Comments</h1>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Post</th>
                <th>Comment</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($c = $comments->fetch_assoc()): ?>
            <tr>
                <td><?= $c['id']; ?></td>
                <td><?= htmlspecialchars($c['first_name'] . " " . $c['last_name']); ?></td>
                <td><?= htmlspecialchars($c['title']); ?></td>
                <td><?= htmlspecialchars($c['content']); ?></td>
                <td><?= date("d M Y", strtotime($c['created_at'])); ?></td>
                <td>
                    <a href="../../community/view_post.php?id=<?= $c['post_id']; ?>" class="btn-small">View Post</a>
                    <a href="edit_comment.php?id=<?= $c['id']; ?>" class="btn-small">Edit</a>
                    <a href="delete_comment.php?id=<?= $c['id']; ?>" class="btn-small danger"
                       onclick="return confirm('Delete this comment?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

</div>

</body>
</html>
