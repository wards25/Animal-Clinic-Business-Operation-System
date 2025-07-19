<?php
session_start();
require('connection.php');

// Check if the user is logged in and the session userid is set
if (isset($_SESSION['userid'])) {
    $receiver_id = '13'; // Example receiver ID
    $sender_id = $_SESSION['userid'];

    // Prepare SQL query with a WHERE clause to filter messages by receiver_id and sender_id
    $sql = "SELECT * FROM messagetb WHERE (receiver_id = ? AND sender_id = ?) OR (receiver_id = ? AND sender_id = ?) ORDER BY message_id ASC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiii", $receiver_id, $sender_id, $sender_id, $receiver_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display messages
    $html = '';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html .= '<div><strong>' . $row['username'] . ':</strong> ' . $row['message'] . '</div>';
        }
    } else {
        $html = "No messages found";
    }

    // Send HTML response to client-side JavaScript
    echo $html;

    // Close statement
    $stmt->close();
} else {
    echo "User is not logged in."; // Handle the case when the user is not logged in
}

// Close connection
$con->close();
?>
