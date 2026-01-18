<?php
$host = "sql310.infinityfree.com";
$user = "if0_40911087";
$pass = "rbCnCXA6ifYpC";
$db   = "if0_40911087_dragonstone_db";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>
