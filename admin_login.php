<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* Header */
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

        /* Horizontal Navigation Bar */
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
            margin-top: 70px; /* Adjusted to avoid overlap with header */
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

        /* Login Form Container */
        .login-container {
            background: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
            margin: 100px auto;
            border: 1px solid #444;
        }

        .login-container h1 {
            margin-bottom: 20px;
            color: #e0e0e0;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #e0e0e0;
        }

        .login-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .login-container button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Additional Animations */
        .login-container {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>E VOTING SYSTEM</h1>
    <img src="C:\wamp64\www\e_voting\images\logo.jpg" alt="Logo">
</header>

<!-- Horizontal Navigation Bar -->
<nav>
    <a href="index.php">HOME</a>
    <a href="candidates.php">CANDIDATES</a>
    <a href="results.php">RESULTS</a>
    <a href="register.php">REGISTER</a>
    <a href="admin_login.php">ADMIN</a>
</nav>

<!-- Login Form -->
<div class="login-container">
    <h1>Admin Login</h1>
    <form method="POST" action="admin_login_handler.php">
        <input type="text" name="admin_username" placeholder="Username" required>
        <input type="password" name="admin_password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
