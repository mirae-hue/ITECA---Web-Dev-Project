<?php
session_start();
require_once "../../includes/connect.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}

$posts = $mysqli->query("
    SELECT p.*, u.first_name, u.last_name
    FROM posts p
    JOIN users u ON p.user_id = u.id
    ORDER BY p.id DESC
");

$comments = $mysqli->query(" 
    SELECT c.id, c.post_id, c.content, c.created_at, u.first_name, u.last_name, p.title 
    FROM comments c 
    JOIN users u ON c.user_id = u.id 
    JOIN posts p ON c.post_id = p.id 
    ORDER BY c.id DESC 
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Posts | Admin</title>
<link rel="stylesheet" href="../admin.css">
</head>

<body>

<div class="admin-layout">

<aside class="sidebar">
    <div class="sidebar-header">DragonStone Admin</div>
    <nav>
		<a href="../dashboard.php">Dashboard</a>
		<a href="../products/p_management.php">Products</a>
		<a href="../subscriptions/s_management.php">Subscriptions</a>
		<a href="../orders/o_management.php">Orders</a>
		<a href="../users/u_management.php">Users</a>
        <a href="../community/c_management.php" class="active">Community</a>
		<a href="../dashboard.php">Analytics</a>
    </nav>
</aside>

<main>
    <div class="dashboard-header">
        <h1>Manage Posts</h1>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Likes</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($p = $posts->fetch_assoc()): ?>
            <tr>
                <td><?= $p['id']; ?></td>
                <td><?= htmlspecialchars($p['first_name'] . " " . $p['last_name']); ?></td>
                <td><?= htmlspecialchars($p['title']); ?></td>
                <td><?= $p['likes_count']; ?></td>
                <td><?= date("d M Y", strtotime($p['created_at'])); ?></td>
                <td>
                    <a href="../../community/view_post.php?id=<?= $p['id']; ?>" class="btn-small">View</a>
                    <a href="edit_post.php?id=<?= $p['id']; ?>" class="btn-small">Edit</a>
                    <a href="delete_post.php?id=<?= $p['id']; ?>" class="btn-small danger"
                       onclick="return confirm('Delete this post?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

</div>
<div class="admin-layout">

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
