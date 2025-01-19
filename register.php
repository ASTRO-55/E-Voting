<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e_voting");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $aadhar_no = $_POST['aadhar_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify name, DOB, and Aadhar number with the verification table
    $verification_result = $conn->query("SELECT * FROM verification WHERE name='$name' AND date_of_birth='$dob' AND aadhar_no='$aadhar_no'");

    if ($verification_result->num_rows == 0) {
        echo "Verification failed. You are not eligible to register.";
        exit();
    }

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username is already taken
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows > 0) {
        echo "Username already exists!";
        exit();
    }

    // Register the voter
    $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'voter')");

    echo "Registration successful! Redirecting to login page...";
    header("Refresh: 2; URL=index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #e0e0e0;
            text-align: center;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1f1f1f;
            border-bottom: 1px solid #333;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        header h1 {
            margin: 0;
            color: #e0e0e0;
        }
        header img {
            height: 50px;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
            margin-top: 70px;
        }
        nav a {
            color: #e0e0e0;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            transition: background-color 0.3s, transform 0.3s;
        }
        nav a:hover {
            background-color: #444;
            transform: scale(1.1);
        }
        .content {
            padding: 100px 20px 20px; /* Adjust padding to account for fixed header */
        }
        form {
            display: inline-block;
            text-align: left;
            border: 1px solid #333;
            padding: 20px;
            border-radius: 5px;
            background-color: #1f1f1f;
            color: #e0e0e0;
            margin-top: 20px;
            width: 300px;
        }
        input {
            display: block;
            width: calc(100% - 20px);
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #333;
            color: #e0e0e0;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>E VOTING SYSTEM</h1>
        <img src="C:\wamp64\www\e_voting\images\logo.jpg" alt="Logo">
    </header>
    <nav>
        <a href="index.php">HOME</a>
        <a href="candidates.php">CANDIDATES</a>
        <a href="results.php">RESULTS</a>
        <a href="register.php">REGISTER</a>
        <a href="admin_login.php">ADMIN</a>
    </nav>
    <div class="content">
        <h1>Voter Registration</h1>
        <form method="POST" action="">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" required>
            
            <label for="aadhar_no">Aadhar Number:</label>
            <input type="text" name="aadhar_no" id="aadhar_no" required maxlength="12">

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
