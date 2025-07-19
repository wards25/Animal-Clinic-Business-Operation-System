<?php
// updateStatusAppoint.php
include('../connection.php');

// Check if appointmentNo and status are set in the URL
if (isset($_GET['appointmentNo']) && isset($_GET['status'])) {
    $appointmentId = $_GET['appointmentNo'];
    $status = $_GET['status'];

    // Update the status in the database
    $sql = "UPDATE appointmenttb SET status = '$status' WHERE appointmentNo = $appointmentId";
    
    // Execute the SQL query
    if ($con->query($sql) === TRUE) {
        echo "Status updated successfully";
        header('location: approvedAppointments.php');
    } else {
        echo "Error updating status: " . $con->error;
    }
} else {
    // Handle case where appointmentNo or status is not set
    echo "Invalid request";
}

// Close connection
$con->close();
?>
