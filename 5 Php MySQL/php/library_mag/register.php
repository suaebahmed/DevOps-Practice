<?php
session_start();
require 'db.php';

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $result = $mysqli->query("INSERT INTO library_users (username, password) VALUES ('$username', '$password')");
    if ($result) {
        $_SESSION['message'] = "Registration successful!";
        header("Location: login.php");
    } else {
        $_SESSION['message'] = "User already exists!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <form action="register.php" method="POST">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <input type="submit" name="register" value="Register" class="btn btn-primary">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
