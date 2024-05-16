<?php
    // Database configuration
    $host = 'localhost';
    $db   = 'lrs'; // your database name
    $user = 'root'; // your username
    $pass = ''; // your password

    // Create a new mysqli instance
    $mysqli = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare an SQL statement to fetch all users
        $result = $mysqli->query('SELECT * FROM users');

        // Loop through each user
        while($user = $result->fetch_assoc()) {
            // Remove the asterisk from the username
            $username = str_replace('*', '', $user['username']);

            // Prepare an SQL statement to update the user
            $stmt = $mysqli->prepare('UPDATE users SET username = ? WHERE username = ?');

            // Bind parameters and execute the SQL statement
            $stmt->bind_param('ss', $username, $user['username']);
            $stmt->execute();
        }

        echo "Users have been activated.";
    }
?>

<!-- HTML form for activating users -->
<form method="post">
    <input type="submit" value="Activate Users">
</form>
