<?php
session_start();
require '../includes/connect.php';

$error = '';

if(isset($_POST['login'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND is_admin = 1 LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        // Successful login
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DragonStone Admin Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen font-sans">

<div class="bg-white p-8 rounded shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-6">DragonStone Admin Login</h1>

    <?php if($error): ?>
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username</label>
            <input type="text" name="username" id="username" required
                   class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <button type="submit" name="login"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
            Login
        </button>
    </form>

    <p class="text-center text-gray-500 text-sm mt-4">© 2025 DragonStone</p>
</div>

</body>
</html>

