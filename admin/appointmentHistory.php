<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Homepage</title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">

</head>
<style>
    .card {
        height: 70vh;
        overflow-y: scroll;
    }

    .container-logo .logo {
        height: 50px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
    }
</style>

<body>
    <?php
    session_start();
    include("../connection.php");

    if (!isset($_SESSION['username'])) {
        header("location: ../index.php");
    } else {
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];
    }
    ?>
    <main id="main-wrapper" class="main-wrapper">

        <div class="header">
            <!-- navbar -->
            <div class="navbar-custom navbar navbar-expand-lg">
                <div class="container-fluid px-0">
                    <div class="container-logo">
                        <?php
                        if (isset($image)) {
                            echo '<img id="selectedImage" src="data:image/jpg;charset=utf8;base64,' . base64_encode($image) . '" />';
                        } else {
                            echo '<img id="selectedImage" src="../img/pngwing.com.png" style="height:40px;" />';
                        }
                        ?>
                        <!-- Echo the username beside the profile image -->
                        <strong class="username"><?php echo $username; ?></strong>
                    </div>
                    <!-- Form -->
                    <form id="liveSearchForm" role="search">
                        <div class="input-group">
                            <input class="form-control rounded-3" type="search" name="search" placeholder="Search" aria-label="Search" oninput="performSearch()">
                            <span class="input-group-append">
                                <button class="btn ms-n10 rounded-0 rounded-end" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                            <a href="log_out.php" type="button" class="btn btn-outline-danger" style="margin-left: 10px;">Log Out</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- navbar vertical -->
        <div class="app-menu">
            <!-- Sidebar -->

            <div class="navbar-vertical navbar nav-dashboard">
                <div class="h-100" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                    <div class="simplebar-content" style="padding: 0px;">
                                        <div class="container">
                                            <img class="logo" src="../img/logo.png" alt="" style="background-color: #CDD5FF; height:100px; border-radius:50%;"><br>
                                        </div>
                                        <h4 style="text-align: center;">Business Operation System</h4>
                                        <hr style="margin-left: 20px; margin-right:20px;">
                                        <ul class="navbar-nav flex-column" id="sideNavbar">
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow " href="dashboard.php">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home nav-icon me-2 icon-xxs">
                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                    Dashboard
                                                </a>
                                            </li>


                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow " href="calendar.php">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar nav-icon me-2 icon-xxs">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                    </svg> Calendar
                                                </a>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navinvoice" aria-expanded="false" aria-controls="navinvoice">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard nav-icon me-2 icon-xxs">
                                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                                    </svg> Appointments
                                                </a>

                                                <div id="navinvoice" class="collapse " data-bs-parent="#sideNavbar">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="approvedAppointments.php">
                                                                Scheduled Appointments
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="appointmentHistory.php">
                                                                Appointment History
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navrecords" aria-expanded="false" aria-controls="navinvoice">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart nav-icon me-2 icon-xxs">
                                                        <circle cx="9" cy="21" r="1"></circle>
                                                        <circle cx="20" cy="21" r="1"></circle>
                                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                                    </svg> Products
                                                </a>

                                                <div id="navrecords" class="collapse " data-bs-parent="#sideNavbar">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="inventory.php">
                                                                Inventory
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="order.php">
                                                                Orders
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="transaction.php">
                                                                Transaction
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="orderHistory.php">
                                                                Order History
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link   collapsed  " href="accounts.php" aria-controls="navprofilePages">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user nav-icon me-2 icon-xxs">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg> Users
                                                </a>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow  collapsed " href="pets.php">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paw nav-icon me-2 icon-xxs">
                                                        <path d="M2 9C2 4 4 2 8 2s8 2 8 7c0 4.1-2.2 7-3 7s-3-1.5-4-1.5S8 16 8 16s-1.7 0-2.5.5S3 15 2 13V9z"></path>
                                                        <circle cx="8.5" cy="10.5" r="1.5"></circle>
                                                        <circle cx="15.5" cy="10.5" r="1.5"></circle>
                                                        <path d="M4 14.5s1.5 1 4 1 4-1 4-1"></path>
                                                        <path d="M1 20a15.9 15.9 0 0 0 11 0"></path>
                                                    </svg> Pets
                                                </a>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item ">
                                                <a class="nav-link  " href="audittrail.php">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file nav-icon me-2 icon-xxs">
                                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                                        <polyline points="13 2 13 9 20 9"></polyline>
                                                    </svg> Audit Trail
                                                </a>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navCRM" aria-expanded="false" aria-controls="navCRM">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart nav-icon me-2 icon-xxs">
                                                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                                                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                                                    </svg>
                                                    Reports
                                                </a>

                                                <div id="navCRM" class="collapse " data-bs-parent="#sideNavbar">
                                                    <ul class="nav flex-column">


                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="./reports/userReports.php">
                                                                User Reports
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="./reports/petReports.php">
                                                                pet Reports
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="./reports/appointmentReports.php">
                                                                appointment Reports
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="./reports/productReports.php">
                                                                product Reports
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="./reports/orderReports.php">
                                                                order Reports
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <!-- Nav item -->
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow " href="chatroom.php">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square nav-icon me-2 icon-xxs">
                                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                    </svg> Chat
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow " href="log_out.php">
                                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> logout
                                                </a>
                                            </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: auto; height: 1531px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 315px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Page content -->
        <div id="app-content">

            <!-- Container fluid -->

            <div class="app-content-area">
                <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
                <div class="container-fluid mt-n22 ">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <div class="mb-2 mb-lg-0">
                                    <h3 class="mb-0  text-white">Appointment History</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card  -->
                    <div class="card">
                        <?php

                        $sqls = $con->prepare("SELECT * FROM appointmenttb WHERE status IN ('fulfilled', 'cancel') ORDER BY created_at ASC");
                        $sqls->execute();
                        $results = $sqls->get_result();
                        ?>

                        <!-- table  -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <div id="liveSearchResults">
                                    <?php if ($results->num_rows > 0) { ?>
                                        <table class="table text-nowrap mb-0 table-centered table-hover">
                                            <thead style="background-color: #0B1D51;">
                                                <tr>
                                                    <th style="color: whitesmoke;">No</th>
                                                    <th style="color: whitesmoke;">Appointment Type</th>
                                                    <th style="color: whitesmoke;">Type of Service</th>
                                                    <th style="color: whitesmoke;">Appointment Schedule</th>
                                                    <th style="color: whitesmoke;">Full Name</th>
                                                    <th style="color: whitesmoke;">Pet Name</th>
                                                    <th style="color: whitesmoke;">Contact No.</th>
                                                    <th style="color: whitesmoke;">Status</th>
                                                    <th style="color: whitesmoke;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            while ($row = $results->fetch_assoc()) {
                                                $date = date("F d, Y", strtotime($row['date']));
                                                $appointmentType = $row['appointmentType'];
                                                $service = $row['service'];
                                                $ownersName = $row['fullName'];
                                                $petName = $row['petname'];
                                                $contact = $row['contact'];
                                                $time_slot = $row['time_slot'];
                                                $status = $row['status'];
                                                $appointmentNo = $row['appointmentNo'];

                                                if ($status == 'cancel') {
                                                    $statusColor = '<span class="badge badge-danger-soft">' . $status . '</span>';
                                                } elseif ($status == 'fulfilled') {
                                                    $statusColor = '<span class="badge badge-success-soft">' . $status . '</span>';
                                                }

                                                echo '
                                                    <tr>
                                                        <td>
                                                            <h5 class=" mb-1">' . $count++ . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $appointmentType . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $service . '</h5>
                                                        </td>
                                                        <td>
                                                        ' . $date . '
                                                            ' . $time_slot . '
                                                        </td>
                                                        <td>
                                                        ' . $ownersName . '
                                                        </td>
                                                        <td>
                                                        ' . $petName . '
                                                        </td>
                                                        <td>
                                                        ' . $contact . '
                                                        </td>
                                                        <td>
                                                       ' . $statusColor . '
                                                        </td>
                                                        <td>
                                                        <button type="button" class="btn btn-primary view-prescription-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-appointment-no="' . $appointmentNo . '">View</button>
                                                        <a href="appointmentReceipt.php?appointmentNo=' . $appointmentNo . '" type="button" class="btn btn-success">Print</a>
                                                        </td>
                                                    </tr>';
                                            }
                                        } else {
                                            echo '<h1 class="text-center text-danger"style="padding: 100px;">No History Yet</h1>';
                                        } ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="exampleModalLabel">Prescription</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/simplebar/dist/simplebar.min.js"></script>
<script>
    $(document).ready(function() {
        $('#liveSearchForm input').on('input', function() {
            performSearch();
        });
    });

    function performSearch() {
        var query = $('#liveSearchForm input').val();
        $.ajax({
            method: 'GET',
            url: '../live_search/approveAppoint.php',
            data: {
                query: query
            },
            success: function(data) {
                $('#liveSearchResults').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Ajax request failed: ' + status + ' - ' + error);
            }
        });
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add event listener to each "View" button
        var viewButtons = document.querySelectorAll('.view-prescription-btn');
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var appointmentNo = this.getAttribute('data-appointment-no');
                fetchAndDisplayDataInModal(appointmentNo); // Corrected function name
            });
        });

        // Function to fetch prescription, appointment, and animal data and display them in the modal
        function fetchAndDisplayDataInModal(appointmentNo) {
            fetch('appointmentPrescription.php?appointmentNo=' + appointmentNo)
                .then(response => response.json())
                .then(data => {
                    displayDataInModal(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Function to display prescription, appointment, and animal data in the modal
        function displayDataInModal(data) {
            var modalBody = document.querySelector('.modal-body');
            var modalfooter = document.querySelector('.modal-footer');

            // Clear existing content in the modal body
            modalBody.innerHTML = '';
            modalfooter.innerHTML = '';

            // Create divs for each section of data
            var prescriptionDiv = document.createElement('div');
            prescriptionDiv.innerHTML = '<h3>Prescription Details</h3>';
            modalBody.appendChild(prescriptionDiv);

            var appointmentDiv = document.createElement('div');
            appointmentDiv.innerHTML = '<hr><h3>Appointment Details</h3>';
            modalBody.appendChild(appointmentDiv);

            var animalDiv = document.createElement('div');
            animalDiv.innerHTML = '<hr><h3>Pet Details</h3>';
            modalBody.appendChild(animalDiv);

            var timeDiv = document.createElement('div');
            timeDiv.innerHTML = '';
            modalfooter.appendChild(timeDiv);

            // Display prescription data
            data.forEach(function(row) {
                var prescriptionItem = document.createElement('div');
                prescriptionItem.innerHTML =
                    '<p><strong>Presribed By:</strong> ' + row.veterinarian + '</p>' +
                    '<p><strong>Findings:</strong> ' + row.findings + '</p>' +
                    '<p><strong>Medicine:</strong> ' + row.medicine + '</p>' +
                    '<p><strong>Dosage:</strong> ' + row.dosage + '</p>' +
                    '<p><strong>Instruction:</strong> ' + row.instruction + '</p>';
                prescriptionDiv.appendChild(prescriptionItem);
            });

            // Display appointment data
            data.forEach(function(row) {
                var appointmentItem = document.createElement('div');
                appointmentItem.innerHTML =
                    '<p><strong>Owners Name:</strong> ' + row.fullname + '</p>' +
                    '<p><strong>Appointment Type:</strong> ' + row.appointmentType + '</p>' +
                    '<p><strong>Service:</strong> ' + row.service + '</p>' +
                    '<p><strong>Date:</strong> ' + row.date + '</p>' +
                    '<p><strong>Time Slot:</strong> ' + row.time_slot + '</p>';
                appointmentDiv.appendChild(appointmentItem);
            });

            // Display animal data
            data.forEach(function(row) {
                var animalItem = document.createElement('div');
                animalItem.innerHTML =
                    '<p><strong>Pet Name:</strong> ' + row.petname + '</p>' +
                    '<p><strong>Gender:</strong> ' + row.gender + '</p>' +
                    '<p><strong>Age:</strong> ' + row.age + '</p>' +
                    '<p><strong>Birthday:</strong> ' + row.birthday + '</p>' +
                    '<p><strong>Pet Type:</strong> ' + row.pettype + '</p>' +
                    '<p><strong>Breed:</strong> ' + row.breed + '</p>' +
                    '<p><strong>Color:</strong> ' + row.color + '</p>';
                animalDiv.appendChild(animalItem);
            });

            data.forEach(function(row) {
                var timeItem = document.createElement('div');

                // Parse the time string into a Date object and format both date and time
                var formattedDateTime = new Date(row.time).toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric'
                });

                timeItem.innerHTML = '<strong>Date Prescribed:</strong> ' + formattedDateTime;
                timeDiv.appendChild(timeItem);
            });
        }
    });
</script>

</html>