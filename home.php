<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Voting System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #e0e0e0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1f1f1f;
            border-bottom: 1px solid #333;
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
        }
        nav a {
            color: #e0e0e0;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #444;
        }
        .content {
            padding: 20px;
        }
        .steps, .awareness {
            margin-bottom: 20px;
        }
        .steps h2, .awareness h2 {
            color: #e0e0e0;
        }
        .steps ol {
            padding-left: 20px;
        }
        .steps ol li, .awareness p {
            color: #b0b0b0;
        }
        .vote-button {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            padding: 15px;
            background-color: #b71c1c;
            color: #e0e0e0;
            text-align: center;
            text-decoration: none;
            font-size: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .vote-button:hover {
            background-color: #c62828;
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
        <div class="steps">
            <h2>Steps to E-Vote</h2>
            <ol>
                <li>First, register and return to home.</li>
                <li>Use your username and password to login.</li>
                <li>Vote for the candidates.</li>
                <li>Wait for the vote confirmation screen.</li>
                <li>Click on the return to home button and you are done with your vote.</li>
            </ol>
        </div>
        <div class="awareness">
            <h2>Voting Awareness</h2>
            <p>Voting is a fundamental right and responsibility of every citizen. Make sure to participate in the voting process to make your voice heard and contribute to the democratic process.</p>
        </div>
        <a href="login.php" class="vote-button">VOTE</a>
    </div>
</body>
</html>
