<?php
include('../connection.php');
if(isset($_POST['appointmentNo'])){
$appointmentNo = $_POST['appointmentNo'];
$totalAmount = $_POST['totalAmount'];
$ownerPayment = $_POST['ownerPayment'];
$change = $_POST['change'];
$status = "fulfilled";

// Example SQL query to update appointment table
$sql = "UPDATE appointmenttb SET total = '$totalAmount', amount = '$ownerPayment', amount_change = '$change', status='$status' WHERE appointment_no = '$appointmentNo'";

// Execute the SQL query
if ($con->query($sql) === TRUE) {
    // Return the updated HTML content
    echo $updatedData;
} else {
    echo "Error updating record: " . $con->error;
}

// Close the database connection
$con->close();
}
?>
