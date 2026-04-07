<?php
session_start();
include 'db_connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // Query to check admin credentials
    $query = "SELECT * FROM admins WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $admin_username, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        $_SESSION['admin_username'] = $admin_username;
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Failed login
        echo "<script>alert('Invalid username or password'); window.location.href = 'admin_login.php';</script>";
    }
}
?>