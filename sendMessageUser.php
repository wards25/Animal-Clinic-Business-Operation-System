<?php
require('connection.php');
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

if(isset($_POST['message']) && isset($_POST['receiver_id'])) {
    $message = $_POST['message'];
    $receiver_id = $_POST['receiver_id'];

    // Prepare and bind statement
    $stmt = $con->prepare("INSERT INTO messagetb (message, sender_id, receiver_id, username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $message, $userid, $receiver_id, $username);
    $stmt->execute();
    $stmt->close();

    // Response to the client-side JavaScript
    echo "Message sent successfully";
} else {
    // If message or receiver_id is not provided
    echo "Error: Message or receiver ID not provided.";
}

// Close connection
$con->close();
?>
