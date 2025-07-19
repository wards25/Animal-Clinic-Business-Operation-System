<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Order Reports</title>
    <style>
        /* Other styles as before */

        /* Adjusting DataTables appearance */
        .dataTables_wrapper {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-light">
    <main id="main-wrapper" class="main-wrapper">
        <div id="app-content">
            <div class="app-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="mb-5">
                            <h3 class="mb-0" style="background-color: #0B1D51; color:whitesmoke; margin-top: 50px; text-align:center;">Order Reports</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Statistics -->
                    <h5>Summary Statistics</h5>
                    <?php
                    // Establish connection
                    include("../../connection.php");

                    // Fetch summary statistics for daily orders
                    $sql_summary = "SELECT COUNT(*) AS total_orders, SUM(totalprice) AS total_revenue FROM ordertb";
                    $result_summary = $con->query($sql_summary);

                    // Output summary statistics
                    if ($result_summary->num_rows > 0) {
                        $row_summary = $result_summary->fetch_assoc();
                        echo "<div class='mb-3'>Total Orders: {$row_summary['total_orders']} | Total Revenue: ₱{$row_summary['total_revenue']}</div>";
                    }

                    $sql_summary = "SELECT DATE(orderDate) AS order_date, COUNT(*) AS daily_orders, SUM(totalprice) AS daily_income FROM ordertb GROUP BY DATE(orderDate)";
                    $result_summary = $con->query($sql_summary);

                    // Output summary statistics
                    if ($result_summary->num_rows > 0) {
                        echo "<div class='mb-3'>";
                        while ($row_summary = $result_summary->fetch_assoc()) {
                            echo "Date: {$row_summary['order_date']} | Daily Orders: {$row_summary['daily_orders']} | Daily Sales: ₱{$row_summary['daily_income']}<br>";
                        }
                        echo "</div>";
                    }   

                    // Close connection
                    $con->close();
                    ?>

                    <!-- Table container for DataTables -->
                    <div class="table-responsive">
                        <table id="orderTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>User ID</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Postcode</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Payment</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Establish connection
                                include("../../connection.php");

                                // Fetch order data
                                $sql = "SELECT * FROM ordertb";
                                $result = $con->query($sql);

                                // Output data rows
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['orderNo']}</td>
                                            <td>{$row['userid']}</td>
                                            <td>{$row['productname']}</td>
                                            <td>{$row['description']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>{$row['firstname']}</td>
                                            <td>{$row['lastname']}</td>
                                            <td>{$row['address']}</td>
                                            <td>{$row['postcode']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['city']}</td>
                                            <td>{$row['payment']}</td>
                                            <td>{$row['totalprice']}</td>
                                            <td>{$row['orderDate']}</td>
                                            <td>{$row['status']}</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='15'>No orders found</td></tr>";
                                }

                                // Close connection
                                $con->close();
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Buttons for actions -->
                    <div class="mt-3">
                        <button class="print-btn btn btn-primary" id="print">Print</button>
                        <a href="../dashboard.php" class="btn btn-outline-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#orderTable').DataTable();

            // Print button functionality
            $("#print").click(function() {
                window.print();
            });
        });
    </script>
</body>

</html>
