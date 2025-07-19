<?php
session_start();
require('../connection.php');

// Check if receiver_id is provided in the URL via GET method
if(isset($_GET['userid'])) {
    $receiver_id = $_GET['userid'];
    $current_user_id = $_SESSION['userid'];

    // Prepare SQL query with an inner join to retrieve messages and user images
    $sql = "SELECT messagetb.*, userstb.imageData 
            FROM messagetb 
            INNER JOIN userstb ON (messagetb.sender_id = userstb.userid) 
            WHERE (messagetb.sender_id = ? AND messagetb.receiver_id = ?) 
            OR (messagetb.sender_id = ? AND messagetb.receiver_id = ?) 
            ORDER BY messagetb.message_id";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiii", $current_user_id, $receiver_id, $receiver_id, $current_user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display messages and user images
    $html = '';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html .= '<div>';
            if (isset($row['imageData'])) {
                $html .= '<img style="margin-top:10px; margin-bottonm:10px; margin-left:10px; height:40px; width:40px; border-radius:50%; object-fit:cover;" id="selectedImage" src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['imageData']) . '" />';
            } else {
                $html .= '<img id="selectedImage" src="../img/pngwing.com.png" style="margin-top:10px; margin-bottonm:10px; margin-left:10px; height:40px; width:40px; border-radius:50%; object-fit:cover;"/>';
            }
            $html .= '<strong>' . $row['username'] . ':</strong> ' . $row['message'];
            $html .= '</div>';
        }
    } else {
        $html = '<h4 style="color: red; text-align:center; margin-top: 170px;">No messages Yet</h4>';
    }

    // Send HTML response to client-side JavaScript
    echo $html;

    // Close statement
    $stmt->close();
} else {
    echo "Error: Receiver ID not provided.";
}

// Close connection
$con->close();
?>
