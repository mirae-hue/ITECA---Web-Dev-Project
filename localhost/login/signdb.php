<?php
session_start();
include 'connect.php';

// SIGN UP
if(isset($_POST['signUp'])){
    $first_name = trim($_POST['fName']);
    $last_name  = trim($_POST['lName']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Checks
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if($result->num_rows > 0){
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, status, is_verified, created_at) VALUES (?, ?, ?, ?, 'user', 'active', 0, NOW())");
        $insertQuery->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);

        if($insertQuery->execute()){
            // Redirect
            header("Location: signup.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// SIGN IN
if(isset($_POST['signIn'])){
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch by email
    $sql = $conn->prepare("SELECT id, first_name, password, role, status, is_verified FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        // Verify password
        if(password_verify($password, $row['password'])){
            if($row['status'] != 'active'){
                echo "Your account is not active. Please contact support.";
                exit();
            }

            //Check email verification
            if(!$skipVerification && $row['is_verified'] == 0){
                echo "Please verify your email before logging in.";
                exit();
            }

            // Start session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];

            header("Location: dashboard.php"); // Redirect to user dashboard
            exit();
        } else {
            echo "Incorrect Password.";
        }
    } else {
        echo "Email not found.";
    }
}
?>
