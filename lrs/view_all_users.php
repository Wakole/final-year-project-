<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>Username</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr><td>' . htmlspecialchars($row['username']) . '</td></tr>';
    }
    echo '</table>';
} else {
    echo 'No users found.';
}

$conn->close();
?>
