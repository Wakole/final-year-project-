<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = $_POST['title'];

    $query = "SELECT * FROM report WHERE title = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $title);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // Return the reminder details
        echo "Title: " . $row['title'] . "<br>";
        echo "Time: " . $row['reminder_time'] . "<br>";
        echo "Date: " . $row['reminder_date'] . "<br>";
    }
}

$conn->close();
?>
