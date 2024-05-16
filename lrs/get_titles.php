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

    // SQL query to get distinct titles
    $sql = "SELECT DISTINCT title FROM reminders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["title"] . "'>" . $row["title"] . "</option>";
        }
    } else {
        echo "<option>No results</option>";
    }

    $conn->close();
?>
