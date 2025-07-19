<?php
require '../connection.php';

// Check if the request contains an event ID
if(isset($_POST['eventId'])) {
    // If an event ID is provided, fetch details for that specific event
    $eventId = $_POST['eventId'];

    // Prepare SQL statement to fetch event details based on event ID
    $sql = "SELECT eventid, title, start_dateTime, end_dateTime, location, description FROM calendartb WHERE eventid = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch event details
        $row = $result->fetch_assoc();
        $eventDetails = array(
            'id' => $row['eventid'],
            'title' => $row['title'],
            'start' => $row['start_dateTime'],
            'end' => $row['end_dateTime'],
            'location' => $row['location'],
            'description' => $row['description']
        );

        // Return event details as JSON response
        echo json_encode($eventDetails);
    } else {
        // No event found with provided ID
        echo json_encode(array('error' => 'Event not found'));
    }

    // Close statement and database connection
    $stmt->close();
    $con->close();
} else {
    // If no event ID is provided, fetch all events
    $sql = "SELECT eventid, title, start_dateTime, end_dateTime, location, description FROM calendartb";
    $result = $con->query($sql);

    $events = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = array(
                'id' => $row['eventid'],
                'title' => $row['title'],
                'start' => $row['start_dateTime'],
                'end' => $row['end_dateTime'],
                'location' => $row['location'],
                'description' => $row['description'],
                'color' => 'red', // Set the color directly to red
            );
        }
    }

    echo json_encode($events);
    $con->close();
}
?>
