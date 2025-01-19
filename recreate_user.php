<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e_voting");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $aadhar_no = $_POST['aadhar_no'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the user exists in the verification table
    $result = $conn->query("SELECT * FROM verification WHERE name='$name' AND date_of_birth='$date_of_birth' AND aadhar_no='$aadhar_no'");
    $user = $result->fetch_assoc();

    if ($user) {
        // Check if the passwords match
        if ($new_password !== $confirm_password) {
            echo "<p class='error'>Passwords do not match.</p>";
        } else {
            // Check if the new username already exists in the users table
            $existing_user_check = $conn->query("SELECT * FROM users WHERE username='$new_username'");
            if ($existing_user_check->num_rows > 0) {
                echo "<p class='error'>Username already exists.</p>";
            } else {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                // Update the username and password in the users table
                $update_query = "UPDATE users SET username='$new_username', password='$hashed_password' WHERE id='" . $user['id'] . "'";
                if ($conn->query($update_query) === TRUE) {
                    echo "<p>Username and password updated successfully.</p>";
                } else {
                    echo "<p class='error'>Error updating record: " . $conn->error . "</p>";
                }
            }
        }
    } else {
        echo "<p class='error'>Invalid verification details.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re-create Username and Password</title>
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
        <h1>Re-create Username and Password</h1>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="date" name="date_of_birth" placeholder="Date of Birth" required>
            <input type="text" name="aadhar_no" placeholder="Aadhaar Number" required>
            <input type="text" name="new_username" placeholder="New Username" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Update</button>
        </form>
        <a href="home.php" class="home-button">Return to Home</a>
    </div>
</body>
</html>
