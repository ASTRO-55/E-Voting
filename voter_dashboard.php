<?php
session_start();
if ($_SESSION['role'] != 'voter') {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "e_voting");

$voter_id = $_SESSION['user_id'];
$voted = $conn->query("SELECT * FROM votes WHERE voter_id = $voter_id")->num_rows > 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$voted) {
    $candidate_id = $_POST['candidate_id'];
    $conn->query("INSERT INTO votes (voter_id, candidate_id) VALUES ($voter_id, $candidate_id)");
    $voted = true;
    $message = "Vote cast successfully!";
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $voted) {
    $message = "You have already voted.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Dashboard</title>
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h1, h2 {
            margin: 10px 0;
        }
        .candidate-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333333;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .candidate-card:hover {
            background-color: #555555;
        }
        .candidate-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .candidate-name {
            font-size: 18px;
            font-weight: bold;
        }
        .candidate-party {
            font-size: 16px;
            color: #bbbbbb;
        }
        .vote-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #1e88e5;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .vote-button:hover {
            background-color: #1565c0;
        }
        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
            background-color: #333333;
            color: #ffffff;
            animation: slideIn 0.5s ease-in-out;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .home-button {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            text-decoration: none;
            border: 1px solid #ffffff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .home-button:hover {
            background-color: #555555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Voter</h1>
        <h2>Vote for a Candidate</h2>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (!$voted): ?>
            <form method="POST">
                <?php
                $result = $conn->query("SELECT * FROM candidates");
                while ($candidate = $result->fetch_assoc()) {
                    echo "
                    <div class='candidate-card'>
                        <div class='candidate-details'>
                            <div class='candidate-name'>{$candidate['name']}</div>
                            <div class='candidate-party'>{$candidate['party']}</div>
                        </div>
                        <button class='vote-button' type='submit' name='candidate_id' value='{$candidate['id']}'>Vote</button>
                    </div>";
                }
                ?>
            </form>
        <?php else: ?>
            <p class="message">You have already voted.</p>
        <?php endif; ?>
        <a href="home.php" class="home-button">Return to Home</a>
    </div>
</body>
</html>
