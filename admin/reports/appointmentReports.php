<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Appointment Reports</title>
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

        .summary-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
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
                                <h3 class="mb-0" style="background-color: #0B1D51; color:whitesmoke; margin-top: 50px; text-align:center;">Appointment Reports</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Statistics Section -->
                    <div class="summary-section">
                        <h5>Summary Statistics</h5>
                        <?php
                        // Establish connection
                        include("../../connection.php");

                        // Appointment Statistics
                        $sql = "SELECT COUNT(*) AS total_appointments FROM appointmenttb";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                        $total_appointments = $row['total_appointments'];
                        echo "<p>Total Appointments: $total_appointments</p>";

                        // Close connection
                        $con->close();
                        ?>
                    </div>

                    <!-- Table container for DataTables -->
                    <div class="table-responsive">
                        <table id="appointmentTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Appointment No</th>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Appointment Type</th>
                                    <th>Pet Name</th>
                                    <th>Date</th>
                                    <th>Time Slot</th>
                                    <th>Created At</th>
                                    <th>Service</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../../connection.php");
                                $sql = "SELECT * FROM appointmenttb";
                                $result = $con->query($sql);

                                // Output data rows
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['appointmentNo']}</td>
                                            <td>{$row['userid']}</td>
                                            <td>{$row['fullName']}</td>
                                            <td>{$row['appointmentType']}</td>
                                            <td>{$row['petname']}</td>
                                            <td>{$row['date']}</td>
                                            <td>{$row['time_slot']}</td>
                                            <td>{$row['created_at']}</td>
                                            <td>{$row['service']}</td>
                                            <td>{$row['contact']}</td>
                                            <td>{$row['address']}</td>
                                            <td>{$row['status']}</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='12'>No appointments found</td></tr>";
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
            $('#appointmentTable').DataTable();

            // Print button functionality
            $("#print").click(function() {
                window.print();
            });
        });
    </script>
</body>

</html>
