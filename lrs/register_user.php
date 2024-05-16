<?php
    // Create a database connection
    $servername = "localhost";
    $username = "root"; // Use root as the username
    $password = ""; // Use an empty string as the password
    $dbname = "lrs"; // Use lrs as the database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the username and passwords from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if the username is already taken in users table
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($result) > 0) {
        echo 'Username is already taken in users table.';
        return;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the users table
    mysqli_query($conn, "INSERT INTO users (username, password_hash) VALUES ('$username', '$hashedPassword')");

    // Insert the new admin into the admin table
    mysqli_query($conn, "INSERT INTO admin (username, password_hash) VALUES ('$username', '$hashedPassword')");

    echo 'Registration successful.';
?>
