<?php
include('connection.php'); // Include database connection file
session_start();
// Check if appointment ID and date are set
if (isset($_POST['appointmentNo']) && isset($_POST['date'])) {
    // Sanitize input
    $appointmentId = $_POST['appointmentNo'];
    $date = $_POST['date'];
    $time = $_POST['time_slot'];

    // Update the appointment date in the database
    // Replace this with your actual update query
    $sql = "UPDATE appointmenttb SET date = '$date', time_slot = '$time' WHERE appointmentNo = $appointmentId";

    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $usertype = $_SESSION['usertype'];
    $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Edit Appointment')");

    // Execute the query
    if ($con->query($sql) === TRUE) {
        // Return success response
        echo json_encode(array('success' => true));
    } else {
        // Return error response
        echo json_encode(array('success' => false));
    }
} else {
    // Return error response
    echo json_encode(array('success' => false));
}
