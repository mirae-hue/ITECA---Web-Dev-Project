<?php
session_start();

// Unset all session variables
$_SESSION = [];

session_destroy();
header("location: ../index.php");
?>