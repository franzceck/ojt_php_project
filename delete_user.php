<?php

require 'connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete user from the database
    $deleteQuery = "DELETE FROM mss_users WHERE id = $id";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();

?>
