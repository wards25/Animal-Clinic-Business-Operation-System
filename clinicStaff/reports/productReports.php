<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Product Reports</title>
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
                                <h3 class="mb-0" style="background-color: #0B1D51; color:whitesmoke; margin-top: 50px; text-align:center;">Product Reports</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Statistics -->
                    <h5>Summary Statistics</h5>
                    <?php
                    // Establish connection
                    include("../../connection.php");

                    // Fetch summary statistics
                    $sql_summary = "SELECT COUNT(*) AS total_products, SUM(quantity) AS total_quantity, AVG(price) AS average_price FROM producttb";
                    $result_summary = $con->query($sql_summary);

                    // Output summary statistics
                    if ($result_summary->num_rows > 0) {
                        $row_summary = $result_summary->fetch_assoc();
                        echo "<div class='mb-3'>Total Products: {$row_summary['total_products']} | Total Quantity: {$row_summary['total_quantity']} | Average Price: {$row_summary['average_price']}</div>";
                    }

                    // Close connection
                    $con->close();
                    ?>

                    <!-- Table container for DataTables -->
                    <div class="table-responsive">
                        <table id="productTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Expiration</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Establish connection
                                include("../../connection.php");

                                // Fetch product data
                                $sql = "SELECT * FROM producttb";
                                $result = $con->query($sql);

                                // Output data rows
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['productcode']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['description']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>{$row['price']}</td>
                                            <td>{$row['expiration']}</td>
                                            <td><img src='data:image/jpeg;base64," . base64_encode($row['imageData']) . "' alt='Product Image' style='max-width:100px;max-height:100px;'></td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No products found</td></tr>";
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
            $('#productTable').DataTable();

            // Print button functionality
            $("#print").click(function() {
                window.print();
            });
        });
    </script>
</body>

</html>