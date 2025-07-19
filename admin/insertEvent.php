<?php
include('../connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $start = $_POST['start_dateTime'];
    $end = $_POST['end_dateTime'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Insert data into the database (simplified query)
    $sql = "INSERT INTO calendartb (title, start_dateTime, end_dateTime, location, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    // for audit trail
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $usertype = $_SESSION['usertype'];
    $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Add an Event')");

    if ($stmt === false) {
        die('Error preparing statement.');
    }

    $stmt->bind_param('sssss', $title, $start, $end, $location, $description);

    if ($stmt->execute()) {
        echo 'Event added successfully!';
    } else {
        echo 'Error adding event: ' . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
