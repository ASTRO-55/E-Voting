<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

$conn = new mysqli("localhost", "root", "", "e_voting");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $party = $_POST['party'];

    $conn->query("INSERT INTO candidates (name, party) VALUES ('$name', '$party')");
    echo "Candidate added successfully!";
    header("Location: admin_dashboard.php");
}
?>