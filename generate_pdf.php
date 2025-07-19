<?php
require_once('./TCPDF-main/config/tcpdf_config.php');
require_once('./TCPDF-main/tcpdf.php');
include("connection.php");

$animalid = isset($_GET['animalid']) ? $_GET['animalid'] : null;

if ($animalid === null) {
    die('No animalid provided in the URL.');
}
$result = "SELECT * FROM animaltb WHERE animalid='$animalid'";
$query = mysqli_query($con, $result);

if (!$query) {
    die('Error in query: ' . mysqli_error($con));
}

$row = mysqli_fetch_array($query);

if ($row) {
    $petname = $row['petname'];
    $gender = $row['gender'];
    $age = $row['age'];
    $birthday = $row['birthday'];
    $pettype = $row['pettype'];
    $breed = $row['breed'];
    $color = $row['color'];

    // Create instance of TCPDF
    $pdf = new TCPDF();

    // Set PDF title and author
    $pdf->SetTitle('Pet Details');
    $pdf->SetAuthor('Your Name');

    // Add a page
    $pdf->AddPage();

    // Set content dynamically
    $pdf->Cell(40, 10, 'Pet Name: ' . $petname);
    $pdf->Cell(40, 10, 'Gender: ' . $gender);
    $pdf->Cell(40, 10, 'Age: ' . $age);
    $pdf->Cell(40, 10, 'Birthday: ' . $birthday);
    $pdf->Cell(40, 10, 'Pet Type: ' . $pettype);
    $pdf->Cell(40, 10, 'Breed: ' . $breed);
    $pdf->Cell(40, 10, 'color: ' . $color);
    // Add more cells for other data...

    $pdf->SetFont('helvetica', '', 12);

    // Output the PDF as a string
    $pdfData = $pdf->Output('', 'S');

    // Send the PDF data to the client
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="pet_details.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    echo $pdfData;
    exit;
} else {
    die('No data found for the specified animalid.');
}
?>
