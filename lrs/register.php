<?php
    // Include your database connection file here
    include 'db_connect.php';

    // Get the username and passwords from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        echo 'Passwords do not match.';
        return;
    }

    // Check if the username is already taken
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($result) > 0) {
        echo 'Username is already taken.';
        return;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')");

    echo 'Registration successful.';
?>
