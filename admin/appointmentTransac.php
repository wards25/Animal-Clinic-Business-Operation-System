<?php
include('../connection.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $total = $_POST['total'];
    $payment = $_POST['payment'];
    $change = $_POST['amount_change'];
    $appointmentNo = $_POST['appointmentNo']; // Assuming you have this value sent from the form

    // Update the appointment status and payment details in the database
    $sql = "UPDATE appointmenttb SET total=?, payment=?, amount_change=?, status='fulfilled' WHERE appointmentNo=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iidi", $total, $payment, $change, $appointmentNo);

    if (mysqli_stmt_execute($stmt)) {
        // Appointment updated successfully
        echo json_encode(['success' => true]);
    } else {
        // Error updating appointment
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    // If the request method is not POST, return an error
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
