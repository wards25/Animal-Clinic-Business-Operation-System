<?php
include('../connection.php');

// Check if appointmentNo is set and not empty
if(isset($_POST['appointmentNo']) && !empty($_POST['appointmentNo'])) {
    // Sanitize the input
    $appointmentNo = $con->real_escape_string($_POST['appointmentNo']);

    // Prepare SQL statement to fetch appointment details
    $sql = $con->prepare("SELECT * FROM appointmenttb WHERE appointmentNo = ? AND status='processed'");
    $sql->bind_param("i", $appointmentNo);
    $sql->execute();
    $result = $sql->get_result();

    // Check if any row is returned
    if($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Prepare response data
        $responseData = array(
            'appointmentNo' => $row['appointmentNo'],
            'ownersName' => $row['fullName'],
            'petName' => $row['petname'],
            'service' => $row['service'],
            'userid' => $row['userid'],
            // Add more fields if needed
        );

        // Return JSON response
        echo json_encode($responseData);
    } else {
        // No appointment found
        echo json_encode(array('error' => 'No appointment found for the selected number.'));
    }
} else {
    // Invalid request
    echo json_encode(array('error' => 'Invalid request.'));
}

// Close database connection
$con->close();
?>
