<?php
require('../connection.php');
session_start();


if (!isset($_SESSION['userid']) || !isset($_SESSION['username'])) {
    echo "Error: User session not properly set.";
    exit();
}

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];


if(isset($_POST['message']) && isset($_POST['userid'])) {
    $message = $_POST['message'];
    $receiver_id = $_POST['userid'];
    $stmt = $con->prepare("INSERT INTO messagetb (message, sender_id, receiver_id, username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $message, $userid, $receiver_id, $username);

    if ($stmt->execute()) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error: Message or receiver ID not provided.";
}
$con->close();
?>
