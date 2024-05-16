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

$title = $_POST['title'];
$sql = "SELECT title, reminder_date, reminder_time FROM reminders WHERE title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "<tr><th>Title</th><th>Reminder Date</th><th>Reminder Time</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["title"]. "</td><td>" . $row["reminder_date"]. "</td><td>" . $row["reminder_time"]. "</td></tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
