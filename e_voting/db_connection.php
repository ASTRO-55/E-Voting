<?php
// Database credentials
$host = "localhost";        // Database host
$dbname = "e_voting";       // Database name
$username = "root";         // Database username
$password = "";             // Database password (leave blank if no password)

// Establishing the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the charset to UTF-8 for better compatibility
$conn->set_charset("utf8");
?>