<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Voting System</title>
    <style>
        * {
            box-sizing: border-box;
        }
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
            flex-wrap: wrap;
        }
        header h1 {
            margin: 0;
            color: #e0e0e0;
            font-size: 1.5rem;
        }
        header img {
            height: 50px;
            width: auto;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
            flex-wrap: wrap;
        }
        nav a {
            color: #e0e0e0;
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px 10px;
            transition: background-color 0.3s;
            border-radius: 3px;
        }
        nav a:hover, nav a:focus {
            background-color: #444;
            outline: 2px solid #666;
        }
        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .steps, .awareness {
            margin-bottom: 30px;
            background-color: #1f1f1f;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .steps h2, .awareness h2 {
            color: #e0e0e0;
            margin-top: 0;
            border-bottom: 2px solid #b71c1c;
            padding-bottom: 10px;
        }
        .steps ol {
            padding-left: 20px;
            line-height: 1.8;
        }
        .steps ol li, .awareness p {
            color: #b0b0b0;
            margin-bottom: 10px;
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
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        .vote-button:hover, .vote-button:focus {
            background-color: #c62828;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(183, 28, 28, 0.4);
            outline: 2px solid #d32f2f;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
            }
            header h1 {
                margin-bottom: 10px;
                font-size: 1.3rem;
            }
            nav {
                flex-direction: column;
                align-items: center;
            }
            nav a {
                width: 100%;
                max-width: 300px;
                text-align: center;
                margin: 5px 0;
            }
            .content {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 1.1rem;
            }
            .vote-button {
                font-size: 18px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>E VOTING SYSTEM</h1>
        <!-- Fixed: Changed to relative path -->
        <img src="images/logo.jpg" alt="E Voting System Logo">
    </header>
    <nav role="navigation" aria-label="Main navigation">
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
        <a href="login.php" class="vote-button" role="button">VOTE</a>
    </div>
</body>
</html>
