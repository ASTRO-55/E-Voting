<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e_voting");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: " . ($user['role'] == 'admin' ? 'admin_dashboard.php' : 'voter_dashboard.php'));
    } else {
        echo "<p class='error'>Invalid login credentials.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        input, button {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333333;
            color: #ffffff;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button {
            cursor: pointer;
        }
        button:hover {
            background-color: #555555;
        }
        .error {
            color: #ff6b6b;
        }
        .home-button {
            margin-top: 10px;
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            text-decoration: none;
            border: 1px solid #ffffff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .home-button:hover {
            background-color: #555555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="recreate_user.php" class="home-button">Re-create Username and Password</a>
        <a href="home.php" class="home-button">Return to Home</a>
    </div>
</body>
</html>
