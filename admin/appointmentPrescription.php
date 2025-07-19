<?php
include('../connection.php');

// Fetch prescription, appointment, and animal data based on appointmentNo using INNER JOIN
$appointmentNo = $_GET['appointmentNo'];
$sql = $con->prepare("SELECT a.veterinarian, a.findings, a.medicine, a.dosage, a.instruction, a.time,
                            b.fullname, b.appointmentType, b.date, b.time_slot, b.service,
                            c.petname, c.gender, c.age, c.birthday, c.pettype, c.breed, c.color
                      FROM prescriptiontb AS a
                      INNER JOIN appointmenttb AS b ON a.appointmentNo = b.appointmentNo
                      INNER JOIN animaltb AS c ON b.petname = c.petname
                      WHERE a.appointmentNo = ?");
$sql->bind_param("i", $appointmentNo); // assuming appointmentNo is an integer
$sql->execute();
$result = $sql->get_result();

// Prepare data to send back as JSON
$combinedData = array();
while ($row = $result->fetch_assoc()) {
    $combinedData[] = $row;
}

// Close database connection
$sql->close();
$con->close();

// Send combined data back as JSON response
header('Content-Type: application/json');
echo json_encode($combinedData);
?>
