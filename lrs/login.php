<?php
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $db = new mysqli('localhost', 'root', '', 'lrs');

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    // Query the users table
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // If a user is not found, query the admins table
    if (!$user) {
        $stmt->close();

        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    }

    // Check if the user exists and the password is correct
    if ($user && array_key_exists('password_hash', $user) && password_verify($password, $user['password_hash'])) {
        echo 'success';
    } else {
        echo 'Invalid username or password.';
    }

    $stmt->close();
    $db->close();
?>
