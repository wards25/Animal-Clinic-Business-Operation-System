<?php
include('../connection.php');
session_start();
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product code and quantity are set in the POST data
    if (isset($_POST['productCode']) && isset($_POST['quantity'])) {
        // Sanitize the input data
        $productCode = $_POST['productCode'];
        $quantity = $_POST['quantity'];

        // Prepare SQL statement to update the quantity
        $sql = "UPDATE producttb SET quantity = quantity + $quantity WHERE productcode = '$productCode'";

        // for audit trail
        $username = $_SESSION['username'];
        $userid = $_SESSION['userid'];
        $usertype = $_SESSION['usertype'];
        $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Add Stock to Inventory')");

        if ($con->query($sql) === TRUE) {
            echo "Quantity updated successfully";
        } else {
            echo "Error updating quantity: " . $con->error;
        }

        $con->close();
    } else {
        // Handle missing product code or quantity
        echo "Product code or quantity not provided";
    }
} else {
    // Handle requests other than POST
    echo "Invalid request method";
}
