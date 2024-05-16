<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "lecture_reminder_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password