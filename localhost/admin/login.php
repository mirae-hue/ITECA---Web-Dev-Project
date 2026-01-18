<?php
session_start();
require '../includes/connect.php';

$error = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare the SQL statement - check by email and admin role
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin' AND status = 'active' LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if ($password === $user['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['admin_email'] = $user['email'];
            header("Location: dashboard.php");
            exit;
        } 
 
        else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Invalid email or not an admin account.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DragonStone Admin Login</title>

  <style>
    /* General reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    /* Center content vertically and horizontally */
    body {
      background-color: #f3f4f6;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    /* Login container */
    .login-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    /* Heading */
    .login-container h1 {
      font-size: 1.75rem;
      font-weight: bold;
      color: #111827;
      margin-bottom: 1.5rem;
    }

    /* Error message box */
    .error-box {
      background-color: #fee2e2;
      color: #b91c1c;
      padding: 0.5rem;
      border-radius: 5px;
      margin-bottom: 1rem;
      text-align: left;
    }

    /* Form labels and inputs */
    .form-group {
      margin-bottom: 1rem;
      text-align: left;
    }

    label {
      display: block;
      color: #374151;
      font-size: 0.9rem;
      margin-bottom: 0.3rem;
    }

    input {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #d1d5db;
      border-radius: 5px;
      font-size: 1rem;
      transition: border-color 0.2s ease;
    }

    input:focus {
      outline: none;
      border-color: #3b82f6;
    }

    /* Button */
    button {
      width: 100%;
      background-color: #2b6e4a;
      color: white;
      padding: 0.5rem 0;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.22s ease;
    }

    button:hover {
      background-color: #78a980;
    }

    /* Footer */
    .footer {
      color: #6b7280;
      font-size: 0.85rem;
      margin-top: 1.5rem;
    }

    /* Responsive design */
    @media (max-width: 480px) {
      .login-container {
        padding: 1.5rem;
      }

      .login-container h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h1>Admin Login</h1>

    <?php if ($error): ?>
      <div class="error-box">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
      </div>

      <button type="submit" name="login">Login</button>
    </form>

    <p class="footer">© 2025 DragonStone</p>
  </div>

</body>
</html>
