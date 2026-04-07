<?php
// Database connection details
$servername = "localhost"; // Change if your DB is hosted elsewhere
$username = "your_db_username";
$password = "your_db_password";
$dbname = "e_voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $aadhar_no = $_POST['aadhar_no'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO verification (name, date_of_birth, aadhar_no) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $date_of_birth, $aadhar_no);

    // Execute the statement
    if ($stmt->execute()) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Internal Server Error
    }

    $stmt->close();
}

$conn->close();
?>
