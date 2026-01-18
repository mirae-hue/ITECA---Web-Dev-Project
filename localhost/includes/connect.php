<?php
$host = "localhost:4306";
$user = "root";
$pass = "";
$db   = "dragonstone_db";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>
