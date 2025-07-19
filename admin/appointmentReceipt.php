<?php
// Include your database connection file
include('../connection.php');

// Check if the appointmentNo is set in the URL
if (isset($_GET['appointmentNo'])) {
    $appointmentNo = $_GET['appointmentNo'];

    // Retrieve appointment details from the database
    $sqls = $con->prepare("SELECT * FROM appointmenttb WHERE appointmentNo=?");
    $sqls->bind_param("i", $appointmentNo);
    $sqls->execute();
    $result = $sqls->get_result();

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the appointment details

        // Format date
        $date = date("F d, Y", strtotime($row['date']));

        // Include the TCPDF library
        require_once('../TCPDF-main/config/tcpdf_config.php');
        require_once('../TCPDF-main/tcpdf.php');

        // Create a new TCPDF object
        $pdf = new TCPDF('P', 'mm', array(80, 200), true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Appointment Receipt');
        $pdf->SetSubject('Receipt');
        $pdf->SetKeywords('TCPDF, PDF, appointment, receipt');
        $pdf->SetFont('dejavusans', '', 10); // Use DejaVuSans font

        // Set default header data
        $pdf->SetHeaderData('', 0, 'Animal Clinic Business Operation', '');

        // Set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set margins
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 0);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Set font
        $pdf->SetFont('helvetica', '', 10);

        // Add a page
        $pdf->AddPage();

        // Write appointment content
        $html = '
            <h2 style="text-align:center">Appointment Receipt</h2>
            <hr>
            <h3>Appointment Details:</h3>   
            <p><strong>Full Name:</strong> ' . $row['fullName'] . '</p>
            <p><strong>Pet Name:</strong> ' . $row['petname'] . '</p>
            <p><strong>Appointment Type:</strong> ' . $row['appointmentType'] . '</p>
            <p><strong>Service:</strong> ' . $row['service'] . '</p>
            <hr>
            <p><strong>Total:</strong> P' . $row['total'] . '.00</p>
            <p><strong>Owners Payment:</strong> P' . $row['payment'] . '.00</p>
            <p><strong>Amount Change:</strong> P' . $row['amount_change'] . '.00</p>
            <hr>
            <p style="text-align:center;">"THANK YOU, COME AGAIN"</p>
            <p style="text-align:center;">Animal Clinic Business Operation</p>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('appointment_receipt.pdf', 'I');
        exit; // Terminate script execution after sending PDF
    } else {
        // Handle case where no appointment is found
        echo "Appointment not found.";
    }
} else {
    // Handle case where appointmentNo is not set in the URL
    echo "Appointment number not provided.";
}
?>
