<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e_voting");

// Fetch Candidates
$query = "SELECT * FROM candidates";
$candidates = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates</title>
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
        .candidate {
            background-color: #1f1f1f;
            border: 1px solid #333;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            text-align: left;
        }
        .candidate h2 {
            color: #e0e0e0;
        }
        .candidate p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>E VOTING SYSTEM</h1>
        <!-- Removed image from header -->
    </header>
    <nav>
        <a href="index.php">HOME</a>
        <a href="candidates.php">CANDIDATES</a>
        <a href="results.php">RESULTS</a>
        <a href="register.php">REGISTER</a>
        <a href="admin_login.php">ADMIN</a>
    </nav>
    <div class="content">
        <h1>Candidates</h1>
        <?php while ($row = $candidates->fetch_assoc()): ?>
            <div class="candidate">
                <h2><?php echo $row['name']; ?></h2>
                <p><strong>Party:</strong> <?php echo $row['party']; ?></p>
                <p><strong>Experience:</strong> <?php echo $row['experience']; ?> years</p>
                <p><strong>Manifesto:</strong> <?php echo $row['manifesto']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
