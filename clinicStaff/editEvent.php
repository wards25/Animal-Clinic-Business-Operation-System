<?php
require '../connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected variables are set
    if (isset($_POST['eventId'], $_POST['title'], $_POST['start_dateTime'], $_POST['end_dateTime'], $_POST['location'], $_POST['description'])) {
        $eventId = $_POST['eventId'];
        $title = $_POST['title'];
        $start = $_POST['start_dateTime'];
        $end = $_POST['end_dateTime'];
        $location = $_POST['location'];
        $description = $_POST['description'];

        // Update data into the database
        $stmt = $con->prepare("UPDATE calendartb SET title=?, start_dateTime=?, end_dateTime=?, location=?, description=? WHERE eventid=?");

        // for audit trail
        $username = $_SESSION['username'];
        $userid = $_SESSION['userid'];
        $usertype = $_SESSION['usertype'];
        $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Edit an Event')");

        if ($stmt) {
            $stmt->bind_param("sssssi", $title, $start, $end, $location, $description, $eventId);

            if ($stmt->execute()) {
                echo 'Event edited successfully!';
            } else {
                echo 'Failed to edit event: ' . mysqli_error($con); // Provide detailed error message
            }

            $stmt->close();
        } else {
            echo 'Failed to prepare statement';
        }
    } else {
        echo 'Not all required variables are set'; // Handle missing variables
    }

    $con->close();
}
