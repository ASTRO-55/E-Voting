<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php"); // Redirect to login if not logged in
    exit();
}

include 'db_connection.php'; // Database connection

// Handle Add, Edit, and Delete Actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_candidate'])) {
        $name = $_POST['name'];
        $party = $_POST['party'];
        $query = "INSERT INTO candidates (name, party) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $name, $party);
        $stmt->execute();
    } elseif (isset($_POST['edit_candidate'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $party = $_POST['party'];
        $query = "UPDATE candidates SET name = ?, party = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $name, $party, $id);
        $stmt->execute();
    } elseif (isset($_POST['delete_candidate'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM candidates WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

// Fetch Candidates and Results
$candidates_query = "SELECT * FROM candidates";
$candidates_result = $conn->query($candidates_query);

$results_query = "SELECT c.name, c.party, COUNT(v.candidate_id) AS votes 
                  FROM candidates c 
                  LEFT JOIN votes v ON c.id = v.candidate_id 
                  GROUP BY c.id";
$results_result = $conn->query($results_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #ffffff;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #1c1c1c;
            border-bottom: 1px solid #333;
        }
        header h1 {
            margin: 0;
        }
        header .buttons {
            display: flex;
            gap: 10px;
        }
        header a, header button {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid #ffffff;
            border-radius: 5px;
            background-color: #333333;
            transition: background-color 0.3s;
        }
        header a:hover, header button:hover {
            background-color: #555555;
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        form {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form input, form button {
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #333333;
            color: #ffffff;
        }
        form button {
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #555555;
        }
        .actions form {
            display: inline-block;
        }
        .actions input {
            width: auto;
            margin: 0;
            padding: 5px;
        }
        .actions button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['admin_username']; ?></h1>
        <div class="buttons">
            <a href="index.php">Home</a>
            <button onclick="location.reload();">Refresh</button>
            <a href="logout.php">Logout</a>
            <a href="add_voters.php">Add Voters</a>
        </div>
    </header>
    <main>
        <h2>Manage Candidates</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Party</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $candidates_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['party']; ?></td>
                <td class="actions">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                        <input type="text" name="party" value="<?php echo $row['party']; ?>" required>
                        <button type="submit" name="edit_candidate">Edit</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_candidate">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Add Candidate</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Candidate Name" required>
            <input type="text" name="party" placeholder="Party Name" required>
            <button type="submit" name="add_candidate">Add Candidate</button>
        </form>

        <h2>View Results</h2>
        <table>
            <tr>
                <th>Candidate Name</th>
                <th>Party</th>
                <th>Votes</th>
            </tr>
            <?php while ($row = $results_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['party']; ?></td>
                <td><?php echo $row['votes']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
