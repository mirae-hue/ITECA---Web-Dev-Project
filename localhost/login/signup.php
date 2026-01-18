<?php
session_start();
include '../includes/connect.php'; // make sure this defines $mysqli

$skipVerification = true;
$errorMessage = '';

// SIGN UP
if (isset($_POST['signUp'])) {
    $first_name = trim($_POST['fName']);
    $last_name  = trim($_POST['lName']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // check if email exists
    $checkEmail = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        $errorMessage = "Email address already exists.";
    } else {
        $insertQuery = $mysqli->prepare("INSERT INTO users 
            (first_name, last_name, email, password, role, status, is_verified, created_at) 
            VALUES (?, ?, ?, ?, 'user', 'active', 0, NOW())");
        $insertQuery->bind_param("ssss", $first_name, $last_name, $email, $hashedPassword);

        if ($insertQuery->execute()) {
            header("Location: signup.php?mode=signin&registered=true");
            exit();
        } else {
            $errorMessage = "Error: " . $mysqli->error;
        }
    }
}

// SIGN IN
if (isset($_POST['signIn'])) {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = $mysqli->prepare("SELECT id, first_name, password, role, status, is_verified 
                             FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            if ($row['status'] != 'active') {
                $errorMessage = "Your account is not active. Please contact support.";
            } elseif (!$skipVerification && $row['is_verified'] == 0) {
                $errorMessage = "Please verify your email before logging in.";
            } else {
                session_regenerate_id(true);
                $_SESSION['user_id']    = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['email']      = $email;
                $_SESSION['role']       = $row['role'];

                header("Location: ../pages/u_dashboard.php");
                exit();
            }
        } else {
            $errorMessage = "Incorrect password.";
        }
    } else {
        $errorMessage = "Email not found.";
    }
}

// Cart login
if (!empty($_GET['redirect'])) {
    $_SESSION['redirect_after_login'] = $_GET['redirect'];
}

// after successful login
if (!empty($_SESSION['redirect_after_login'])) {
    header("Location: " . $_SESSION['redirect_after_login']);
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="sign.css">
	<link rel="stylesheet" href="../style.css">
</head>
<body>
  <!-- ================= HEADER ================= -->
  <header>
    <?php include '../includes/header.php'; ?>
  </header>
  
    <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Sign Up</h1>
      <form method="post" action="signup.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="fName" id="fName" placeholder="First Name" required>
           <label for="fname">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
<!--      <p class="or">
        --------OR--------
      </p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
      </div> -->
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton">Sign In</button>
      </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="signup.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
          <p class="recover">
            <a href="#">Recover Password</a>
          </p>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
<!--        <p class="or">
          -------- OR --------
        </p>
        <div class="icons">
          <i class="fab fa-google"></i>
          <i class="fab fa-facebook"></i>
        </div> -->
        <div class="links">
          <p>Don't have account yet?</p>
          <button id="signUpButton">Sign Up</button>
        </div>
      </div>
      <script src="sign.js"></script> 
	  
	    <!-- ================= FOOTER ================= -->
  <footer>
    <?php include '../includes/footer.php'; ?>
  </footer>
  
</body>
</html>