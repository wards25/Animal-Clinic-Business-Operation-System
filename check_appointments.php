<?php
include('connection.php');
if (isset($_POST['selectedDate'])) {
    // Sanitize the input date
    $selectedDate = $_POST['selectedDate'];

    // Format the date to 'YYYY-MM-DD'
    $formattedDate = date('Y-m-d', strtotime($selectedDate));

    // Prepare and execute a query to retrieve appointments for the selected date
    $sql = "SELECT time_slot FROM appointmenttb WHERE date = ?  AND status = 'confirmed'";
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $formattedDate);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        // Array to hold the time slots of appointments for the selected date
        $appointments = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each time slot to the array
            $appointments[] = $row['time_slot'];
        }
        
        // Return the appointments array as JSON
        echo json_encode($appointments);
        
        mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation error
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Handle missing or invalid input
    echo "Error: Invalid input data";
}
?>
