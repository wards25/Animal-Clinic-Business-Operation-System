<?php
include('../connection.php');

// Check if appointmentNo and service are set
if(isset($_POST['appointmentNo']) && isset($_POST['service'])) {
    // Get the appointment number and service from the POST data
    $appointmentNo = $_POST['appointmentNo'];
    $service = $_POST['service'];

    // Check if all services have been treated
    $treatedServices = explode(", ", $service);

    // Query to get all services for the appointment
    $sql = "SELECT service FROM appointmenttb WHERE appointmentNo = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $appointmentNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $allServices = explode(", ", $row['service']);

    // Check if all services in the row have been treated
    $allServicesTreated = true;
    foreach ($allServices as $service) {
        if (!in_array($service, $treatedServices)) {
            $allServicesTreated = false;
            break;
        }
    }

    // If all services have been treated, update status to processed
    if ($allServicesTreated) {
        // Prepare update statement
        $sql = "UPDATE appointmenttb SET status = 'processed' WHERE appointmentNo = ?";
        $stmt = $con->prepare($sql);

        // Check if the statement is prepared successfully
        if ($stmt === false) {
            // Error handling for prepared statement
            echo json_encode(['error' => 'Error preparing statement: ' . $con->error]);
            die();
        }

        // Bind parameters
        $stmt->bind_param("i", $appointmentNo);

        // Execute update
        if ($stmt->execute() === TRUE) {
            // If update successful, send success response
            echo json_encode(['success' => true]);
        } else {
            // If update fails, send error response
            echo json_encode(['error' => 'Error updating record: ' . $con->error]);
        }

        // Close statement
        $stmt->close();
    } else {
        // If not all services are treated, update status to confirmed
        // Prepare update statement
        $sql = "UPDATE appointmenttb SET status = 'confirmed' WHERE appointmentNo = ?";
        $stmt = $con->prepare($sql);

        // Check if the statement is prepared successfully
        if ($stmt === false) {
            // Error handling for prepared statement
            echo json_encode(['error' => 'Error preparing statement: ' . $con->error]);
            die();
        }

        // Bind parameters
        $stmt->bind_param("i", $appointmentNo);

        // Execute update
        if ($stmt->execute() === TRUE) {
            // If update successful, send success response
            echo json_encode(['success' => true]);
        } else {
            // If update fails, send error response
            echo json_encode(['error' => 'Error updating record: ' . $con->error]);
        }

        // Close statement
        $stmt->close();
    }
} else {
    // If appointmentNo or service is not set, return an error response
    echo json_encode(['error' => 'Missing appointmentNo or service']);
}

// Close connection
$con->close();
?>
