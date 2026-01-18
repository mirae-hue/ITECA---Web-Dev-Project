<?php
require 'includes/connect.php';

$username = 'admin';
$password = password_hash('password123', PASSWORD_DEFAULT);
$is_admin = 1;

$stmt = $pdo->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)");
$stmt->execute([$username, $password, $is_admin]);

echo "Admin user created successfully!";
?>
