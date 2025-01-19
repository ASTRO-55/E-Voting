<?php
session_start();
include 'db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials in the database
    $query = "SELECT * FROM voters WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: voter_dashboard.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password'); window.location.href = 'login.php';</script>";
    }
}
?>