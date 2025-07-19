<?php
// Include your database connection file
include('../connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $orderNo = $_POST['orderNo'];
    $amount = $_POST['amount'];
    $referenceNo = $_POST['referenceNo'];

    // Construct the SQL query to insert data into transactiontb
    $sqlInsert = "INSERT INTO transactiontb (orderNo, amount, referenceNo, status) VALUES (?, ?, ?, 'paid')";
    
    // Construct the SQL query to update order status
    $sqlUpdateOrder = "UPDATE ordertb SET status = 'pickUp' WHERE orderNo = ?";
    
    // Construct the SQL query to update product stock
    $sqlUpdateStock = "UPDATE producttb p
                       INNER JOIN ordertb o ON p.name = o.productname
                       SET p.quantity = p.quantity - o.quantity
                       WHERE o.orderNo = ?";

    // Prepare the SQL statement for inserting into transactiontb
    $stmtInsert = $con->prepare($sqlInsert);

    // Bind parameters and execute the statement for inserting into transactiontb
    $stmtInsert->bind_param("iss", $orderNo, $amount, $referenceNo);
    if ($stmtInsert->execute()) {
        // Transaction insertion successful, update order status
        $stmtUpdateOrder = $con->prepare($sqlUpdateOrder);
        $stmtUpdateOrder->bind_param("i", $orderNo);
        if ($stmtUpdateOrder->execute()) {
            // Order status update successful, update product stock
            $stmtUpdateStock = $con->prepare($sqlUpdateStock);
            $stmtUpdateStock->bind_param("i", $orderNo);
            if ($stmtUpdateStock->execute()) {
                // Product stock update successful
                echo "success";
            } else {
                // Product stock update failed
                echo "Error updating product stock: " . $stmtUpdateStock->error;
            }
            $stmtUpdateStock->close();
        } else {
            // Order status update failed
            echo "Error updating order status: " . $stmtUpdateOrder->error;
        }
        $stmtUpdateOrder->close();
    } else {
        // Transaction insertion failed
        echo "Error inserting transaction: " . $stmtInsert->error;
    }

    // Close the statement for inserting into transactiontb
    $stmtInsert->close();
} else {
    // If the form is not submitted via POST method, return an error
    echo "Error: Form submission method not allowed.";
}

// Close the database connection
$con->close();
?>
