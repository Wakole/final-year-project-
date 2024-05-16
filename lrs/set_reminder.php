<?php
    // Database connection
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

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reminders (title, reminder_date, reminder_time, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $reminder_date, $reminder_time, $created_at);

    // Set parameters and execute
    $title = $_POST['title'];
    $reminder_date = $_POST['date'];
    $reminder_time = $_POST['time'];
    $created_at = date('Y-m-d H:i:s');  // Current date and time
    $stmt->execute();

    echo "New reminder set successfully";

    $stmt->close();
    $conn->close();
?>
