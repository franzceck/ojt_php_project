<?php

require 'connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editUserId'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $username = $_POST['editUsername'];
    $password = $_POST['editPassword'];
    $email = $_POST['editEmail'];
    $contactNumber = $_POST['editContactNumber'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    if (strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[!@#$%^&*()\-_=+{};:,<.>ยง~]/', $password)) {
        $errors[] = "Invalid password format";
    }

    // Check if username already exists
    $checkUsernameQuery = "SELECT * FROM mss_users WHERE username='$username' AND id<>'$id'";
    $result = $conn->query($checkUsernameQuery);
    if ($result->num_rows > 0) {
        $errors[] = "Username already exists";
    }

    if (empty($errors)) {
        // Hash the password
        $hashed_password = hash('sha256', $password);

        // Update user in the database
        $sql = "UPDATE mss_users SET first_name='$firstName', last_name='$lastName', username='$username', password='$hashed_password', email='$email', contact_number='$contactNumber' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "User updated successfully";
        } else {
            $errors[] = "Error updating user: " . $conn->error;
        }
    }

    // Output errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
