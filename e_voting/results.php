<?php
include 'db_connection.php'; // Database connection

// Fetch Results
$query = "SELECT c.name, c.party, COUNT(v.candidate_id) AS votes 
          FROM candidates c 
          LEFT JOIN votes v ON c.id = v.candidate_id 
          GROUP BY c.id";
$results = $conn->query($query);

// Fetch results into an array for use in the bar chart
$candidates = [];
while ($row = $results->fetch_assoc()) {
    $candidates[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #1f1f1f;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: center;
            transition: background-color 0.3s;
        }
        th {
            background-color: #333;
        }
        tr:hover td {
            background-color: #444;
        }
        h1 {
            color: #e0e0e0;
        }
        .chart-container {
            width: 80%;
            margin: 20px auto;
        }
        .bar-chart {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 300px;
            margin-top: 40px;
        }
        .bar {
            width: 20%;
            background-color: #b71c1c;
            text-align: center;
            color: #e0e0e0;
            transition: height 0.5s;
        }
        .bar:hover {
            background-color: #c62828;
        }
        .bar-label {
            margin-top: 10px;
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
        <h1>Election Results</h1>
        <table>
            <tr>
                <th>Candidate Name</th>
                <th>Party</th>
                <th>Votes</th>
            </tr>
            <?php foreach ($candidates as $row): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['party']; ?></td>
                <td><?php echo $row['votes']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="chart-container">
            <h2>Vote Distribution</h2>
            <div class="bar-chart">
                <?php
                $maxVotes = max(array_column($candidates, 'votes'));
                foreach ($candidates as $row):
                    $barHeight = ($row['votes'] / $maxVotes) * 100;
                ?>
                <div class="bar" style="height: <?php echo $barHeight; ?>%;">
                    <span><?php echo $row['votes']; ?></span>
                    <div class="bar-label"><?php echo $row['name']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
