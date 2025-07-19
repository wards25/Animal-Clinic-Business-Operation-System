<?php
// Include your database connection file
include('../connection.php');

// Check if the transactionNo is set in the URL
if (isset($_GET['transactionNo'])) {
    $transacNo = $_GET['transactionNo'];

    // Retrieve prescription details from the database
    $sqls = $con->prepare("SELECT t.transaction_date, t.transactionNo, t.amount, t.referenceNo, t.orderNo,
                            o.productname, o.description, o.firstname, o.lastname, o.payment, o.totalprice, o.quantity, o.totalprice, o.quantity
                            FROM transactiontb t
                            INNER JOIN ordertb o ON t.orderNo = o.orderNo
                            WHERE t.transactionNo = ?");
    $sqls->bind_param("i", $transacNo);
    $sqls->execute();
    $result = $sqls->get_result();

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the first row
        $date = date("F d, Y", strtotime($row['transaction_date']));
        $transacNo = $row['transactionNo'];
        $orderNo = $row['orderNo'];
        $amount = $row['amount'];
        $refNo = $row['referenceNo'];
        $productPrice = $row['totalprice'];
        $prodName = $row['productname'];
        $fullName = $row['firstname'] . ' ' . $row['lastname'];
        $change = $row['amount'] - $productPrice;

        require_once('../TCPDF-main/config/tcpdf_config.php');
        require_once('../TCPDF-main/tcpdf.php');


         // Write prescription content
         $html = '
         <h2 style="text-align:center">Official Receipt</h2>
         <hr>
         <h3>Prescription Details:</h3>
         <p><strong>Transac#:</strong> ' . $transacNo . '</p>
         <p><strong>OR#:</strong> ' . $orderNo . '</p>
         <p><strong>Product:</strong> ' . $prodName . '</p>
         <p><strong>Description:</strong> ' . $row['description'] . '</p>
         <p><strong>Quantity:</strong> ' .$row['quantity'].'</p>
         <p><strong>Price:</strong> P' .$row['totalprice'].'.00</p>
         <hr>
         <p><strong>Total Price:</strong> P' . $productPrice . '.00</p>
         <p><strong>Cash:</strong> P' . $amount . '.00</p>
         <p><strong>Change:</strong> P' . $change . '.00</p>
         <p><strong>Transaction Date:</strong> ' . $date . '</p>
         <p><strong>Mode of Payment:</strong> ' . $row['payment'] . '</p>
         <hr>
         <p style="text-align:center;">THANK YOU, COME AGAIN.</p>
         <p style="text-align:center;">Animal Clinic Business Operation System </p>
     ';
     
        // Calculate the height required for the content dynamically
        $contentHeight = strlen($html) * 0.4; // Assuming average line height is 0.4 mm (adjust as needed)
        $contentHeight += 20; // Additional height in mm

        // Create a new TCPDF object with dynamically calculated page height
        $pdf = new TCPDF('P', 'mm', array(80, $contentHeight), true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Animal Clinic Prescription');
        $pdf->SetSubject('Prescription');
        $pdf->SetKeywords('TCPDF, PDF, veterinary, prescription');
        $pdf->SetFont('dejavusans', '', 10); // Use DejaVuSans font

        // Set default header data
        $pdf->SetHeaderData('', 0, 'Animal Clinic Prescription', '');

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
        $pdf->AddPage('P', array(80, $contentHeight));

        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('prescription.pdf', 'I');
        exit; // Terminate script execution after sending PDF
    } else {
        // Handle case where no prescription is found
        echo "Prescription not found.";
    }
} else {
    // Handle case where transactionNo is not set in the URL
    echo "Transaction number not provided.";
}
?>
