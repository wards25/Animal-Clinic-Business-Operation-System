<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Animal Reports</title>
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
                            <h3 class="mb-0" style="background-color: #0B1D51; color:whitesmoke; margin-top: 50px; text-align:center;">Pet Reports</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Statistics -->
                    <h3>Summary Statistics:</h3>
                    <?php
                    // Establish connection
                    include("../../connection.php");

                    // Fetch summary statistics for animals
                    $sql_summary = "SELECT COUNT(*) AS total_animals FROM animaltb";
                    $result_summary = $con->query($sql_summary);

                    // Output summary statistics
                    if ($result_summary->num_rows > 0) {
                        $row_summary = $result_summary->fetch_assoc();
                        echo "<div class='mb-3'>Total Animals: {$row_summary['total_animals']}</div>";
                    }

                    // Close connection
                    $con->close();
                    ?>

                    <!-- Table container for DataTables -->
                    <div class="table-responsive">
                        <table id="animalTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Pet Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Birthday</th>
                                    <th>Pet Type</th>
                                    <th>Breed</th>
                                    <th>Color</th>
                                    <th>User ID</th>
                                    <th>Record No</th>
                                    <th>Date</th>
                                    <th>Weight</th>
                                    <th>Vaccine</th>
                                    <th>Veterinarian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Establish connection
                                include("../../connection.php");

                                // Fetch animal and pet record data using JOIN
                                $sql_summary = "SELECT 
                    COUNT(DISTINCT CASE WHEN pr.animalid IS NOT NULL THEN a.animalid ELSE NULL END) AS pets_with_medical_records,
                    COUNT(DISTINCT CASE WHEN pr.animalid IS NULL THEN a.animalid ELSE NULL END) AS pets_without_medical_records
                FROM animaltb a
                LEFT JOIN petrecordstb pr ON a.animalid = pr.animalid";
                                $result_summary = $con->query($sql_summary);

                                // Output summary statistics
                                if ($result_summary->num_rows > 0) {
                                    $row_summary = $result_summary->fetch_assoc();
                                    echo "<div class='mb-3'>Pets Vaccinated: {$row_summary['pets_with_medical_records']} || Pets Not Vaccinated: {$row_summary['pets_without_medical_records']}</div>";
                                }
                                $sql = "SELECT a.*, pr.*
                                        FROM animaltb a
                                        LEFT JOIN petrecordstb pr ON a.animalid = pr.animalid";
                                $result = $con->query($sql);

                                // Output data rows
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td><img src='data:image/jpeg;base64," . base64_encode($row['imageData']) . "' alt='Animal Image' style='max-width:100px;max-height:100px;'></td>
                                            <td>{$row['petname']}</td>
                                            <td>{$row['gender']}</td>
                                            <td>{$row['age']}</td>
                                            <td>{$row['birthday']}</td>
                                            <td>{$row['pettype']}</td>
                                            <td>{$row['breed']}</td>
                                            <td>{$row['color']}</td>
                                            <td>{$row['userid']}</td>
                                            <td>{$row['recordno']}</td>
                                            <td>{$row['date']}</td>
                                            <td>{$row['weight']}</td>
                                            <td>{$row['vaccine']}</td>
                                            <td>{$row['veterinarian']}</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='15'>No animals found</td></tr>";
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
            $('#animalTable').DataTable();

            // Print button functionality
            $("#print").click(function() {
                window.print();
            });
        });
    </script>
</body>

</html>