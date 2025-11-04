<?php
session_start();

//variables
$name = $email = $address = $phone = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);

    if (empty($name)) {
        $errors['name'] = "Full name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address.";
    }

    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }

    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errors['phone'] = "Phone must be 10-15 digits.";
    }

    //no errors = save order info and redirect to payment
    if (empty($errors)) {
        $_SESSION['orderDetails'] = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone
        ];
        header("Location: payment.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Page</title>
<style>
.label {
		display:block; margin-top: 10px;
		}
		
.input {
		width: 100%; 
		padding: 5px; 
		margin-top: 2px;
		}
		
.error {
		color: red;
		font-size: 0.9em;
		}
</style>
</head>
<body>

<h2>Order Details</h2>
<form method="POST" action="">
    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>">
    <?php if(isset($errors['name'])) echo "<p class='error'>{$errors['name']}</p>"; ?>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
    <?php if(isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>"; ?>

    <label for="address">Address</label>
    <input type="text" name="address" id="address" value="<?= htmlspecialchars($address) ?>">
    <?php if(isset($errors['address'])) echo "<p class='error'>{$errors['address']}</p>"; ?>

    <label for="phone">Phone</label>
    <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars($phone) ?>">
    <?php if(isset($errors['phone'])) echo "<p class='error'>{$errors['phone']}</p>"; ?>

    <button type="submit">Place Order</button>
</form>

</body>
</html>
