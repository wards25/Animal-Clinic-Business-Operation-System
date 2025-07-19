<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> <!-- DataTables CSS -->
</head>

<style>
    /* Table style */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        color: whitesmoke;
        background-color: #0B1D51;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .profileImage {
        height: 40px;
        width: 40px;
        object-fit: cover;
        border-radius: 50%;
    }

    .eye-icon {
        font-size: 1.5em;
        color: #3498db;
    }

    .toggle-btn {
        cursor: pointer;
        position: absolute;
        top: 55%;
        right: 2%;
        background: none;
        border: none;
    }

    .mb-3 {
        position: relative;
    }

    .err_msg1 {
        background-color: rgb(210, 210, 210);
        padding: 15px;
        text-align: center;
    }
</style>

<body class="bg-light">

    <?php
    session_start();
    include("../../connection.php");
    // if (!isset($_SESSION['username'])) {
    //   header("location: ../login.php");
    // } else {
    //   $userid = $_SESSION['userid'];
    //   $username = $_SESSION['username'];
    // }
    ?>
    <main id="main-wrapper" class="main-wrapper">
        <div id="app-content">
            <!-- Container fluid -->
            <div class="app-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="mb-5">
                                <h3 class="mb-0" style="margin-top: 50px; background-color:#0B1D51; color:white; text-align:center;">Account Reports</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="userTable" class="table">
                            <thead>
                                <tr>
                                    <th>User Type</th>
                                    <th>Total Users</th>
                                    <th>Online Users</th>
                                    <th>Offline Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT usertype, COUNT(*) AS user_count, 
                                   SUM(CASE WHEN status = 'online' THEN 1 ELSE 0 END) AS online_count,
                                   SUM(CASE WHEN status = 'offline' THEN 1 ELSE 0 END) AS offline_count
                                    FROM userstb
                                    GROUP BY usertype";
                                // Execute the query
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["usertype"] . "</td>
                                                <td>" . $row["user_count"] . "</td>
                                                <td>" . $row["online_count"] . "</td>
                                                <td>" . $row["offline_count"] . "</td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No data available</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <button class="print-btn btn btn-primary" style="margin-top: 10px;" id="print">Print</button>
                    <a href="../dashboard.php" class="btn btn-outline-danger" style="margin-top: 10px;"> Back</a>
                </div>
            </div>
        </div>
    </main>

</body>
<!-- Bootstrap and Popper.js scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#userTable').DataTable();

        $("#print").click(function() {
            window.print();
        });
    });
</script>
</html>
