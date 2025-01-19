<?php
$conn = new mysqli("localhost", "root", "", "e_voting");

// Fetch the total votes per candidate
$results = $conn->query("
    SELECT c.name, c.party, COUNT(v.candidate_id) AS votes 
    FROM candidates c 
    LEFT JOIN votes v ON c.id = v.candidate_id 
    GROUP BY c.id
");

$candidates = [];
$votes = [];

while ($row = $results->fetch_assoc()) {
    $candidates[] = $row['name'] . " (" . $row['party'] . ")";
    $votes[] = $row['votes'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Vote Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }
        .statistics {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }
        .statistics canvas {
            width: 80% !important;
            height: 400px !important;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #ffffff;
            text-decoration: none;
            border: 1px solid #ffffff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #555555;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Detailed Vote Statistics</h1>
    <div class="statistics">
        <canvas id="voteChart"></canvas>
    </div>
    
    <a href="index.php" class="back-button">Back to Home</a>
</div>

<script>
    const candidates = <?php echo json_encode($candidates); ?>;
    const votes = <?php echo json_encode($votes); ?>;

    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: candidates,
            datasets: [{
                label: 'Votes per Candidate',
                data: votes,
                backgroundColor: '#3498db',
                borderColor: '#2980b9',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "#ffffff"
                    },
                    grid: {
                        color: "#444444"
                    }
                },
                x: {
                    ticks: {
                        color: "#ffffff"
                    },
                    grid: {
                        color: "#444444"
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: "#ffffff"
                    }
                }
            }
        }
    });
</script>

</body>
</html>
