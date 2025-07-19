<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <title>AnimalClinic</title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">

</head>
<style>
    .disabled-input {
        background-color: #f0f0f0;
        /* Adjust background color to match disabled state */
        color: #666666;
        /* Adjust text color to match disabled state */
        border: 1px solid #cccccc;
        /* Add border to visually separate the input */
        cursor: not-allowed;
        /* Change cursor to indicate that the input is not interactable */
    }

    .card {
        height: 45vh;
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
    }
    $username = $_SESSION['username'];
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
                                                            <a class="nav-link has-arrow " href="servGrooming.php">
                                                                grooming
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="servConsult.php">
                                                                Consultation
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="servVaccine.php">
                                                                Vaccine
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="servSurgery.php">
                                                                Surgery
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="servCofine.php">
                                                                Confinement
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="servNeutring.php">
                                                                Neutring
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="approvedAppointments.php">
                                                                Appointment List
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
                                                        <li class="nav-item">
                                                            <a class="nav-link has-arrow " href="./reports/salesReports.php">
                                                                Sales Reports
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
                                    <h3 class="mb-0  text-white">Consultation queuing</h3><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <?php
                        $sqls = $con->prepare("SELECT * FROM appointmenttb WHERE status ='consult' AND service LIKE '%consultation%' ORDER BY created_at LIMIT 10");
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
                                                    <th style="color: whitesmoke;">Queuing #</th>
                                                    <th style="color: whitesmoke;">Appointment Type</th>
                                                    <th style="color: whitesmoke;">Type of Service</th>
                                                    <th style="color: whitesmoke;">Appointment Schedule</th>
                                                    <th style="color: whitesmoke;">Owners Name</th>
                                                    <th style="color: whitesmoke;">Pet Name</th>
                                                    <th style="color: whitesmoke;">Contact No.</th>
                                                    <th style="color: whitesmoke;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                while ($row = $results->fetch_assoc()) {
                                                    $date = date("F d, Y", strtotime($row['date']));
                                                    $appointmentType = $row['appointmentType'];
                                                    $services = explode("grooming, ", $row['service']); // Split services by comma
                                                    $ownersName = $row['fullName'];
                                                    $petName = $row['petname'];
                                                    $contact = $row['contact'];
                                                    $time_slot = $row['time_slot'];
                                                    $appointmentNo = $row['appointmentNo'];

                                                    echo '
                                    <tr>
                                        <td>
                                            <h5 class="mb-1">' . $count++ . '</h5>
                                        </td>
                                        <td>
                                            <h5 class="mb-1">' . $appointmentType . '</h5>
                                        </td>
                                        <td>';
                                        // Loop through services and display each one
                                        foreach ($services as $service) {
                                            echo '<h5 class="mb-1">' . $service . '</h5>';
                                        }
                                        echo '
                                                </td>
                                        <td>
                                            ' . $date . ' ' . $time_slot . '
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
                                            <a href="updatedTreatedStatus.php?appointmentNo=' . $appointmentNo . '&status=vax" class="btn btn-success approv-btn">Completed</a>
                                            <a href="updatedTreatedStatus.php?appointmentNo=' . $appointmentNo . '&status=cancel" class="btn btn-danger approv-btn"><i class="fa-regular fa-circle-xmark" name="rejected"></i> Cancel</a>
                                        </td>
                                    </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo '<h1 class="text-center text-danger" style="padding: 100px;">No Scheduled Appointments</h1>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for status-->
                    <div class="modal fade" id="status" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Status</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="status-form">
                                        <input type="hidden" id="appointmentNo" name="appointmentNo">
                                        <input type="hidden" id="userid" name="userid">
                                        <label for="ownersName">Owners Full Name</label>
                                        <input id="ownersName" type="text" class="form-control" name="fullname" readonly>
                                        <label for="service">Service</label>
                                        <select class="form-select" id="service" class="form-control" name="service[]">

                                        </select>
                                        <label for="petName">Pet Name</label>
                                        <input id="petName" type="text" class="form-control" name="petname" readonly>
                                        <hr>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="transac" id="update-status-btn">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for payment-->
                    <div class="modal fade" id="static" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Payment</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="transactionForm" method="post">
                                        <label for="appointmentNotxt">AppointmentNo:</label>
                                        <input type="text" name="appointmentNo" id="appointmentNotxt" class="form-control" readonly>
                                        <p id="appointmentServicetxt"> Service: </p>
                                        <hr>
                                        <label for="amounttoPay">Total Amount Fees <span style="color: red;">*</span></label>
                                        <input type="number" class="form-control" id="amounttoPay" name="total">
                                        <label for="ownerPay">Owners Payment <span style="color: red;">*</span></label>
                                        <input type="number" class="form-control" id="ownerPay" name="payment">
                                        <label for="change">Change</label>
                                        <input type="number" class="form-control" id="change" name="amount_change" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="transac" id="treated-btn" disabled>Treated</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- modal sa create ng prescription -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Prescription</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <button class="btn btn-primary">Medical History</button>
                                    <form method="post">
                                        <input type="hidden" name="appointmentNo" id="appointmentNotxts" class="form-control" readonly>
                                        <input type="hidden" id="userid" name="userid">
                                        <hr>
                                        <h3 class="text-center">Appointment Details</h3>
                                        <label for="ownersName">Owners Full Name</label>
                                        <input id="ownersName" type="text" class="form-control disabled-input" name="fullname" readonly>
                                        <label for="service">Service</label>
                                        <input id="service" type="text" class="form-control disabled-input" name="service" readonly>
                                        <label for="petName">Pet Name</label>
                                        <input id="petName" type="text" class="form-control disabled-input" name="petname" readonly>
                                        <hr>
                                        <h3 class="text-center">Medical Details</h3>
                                        <label for="findings">Findings <span style="color: red;">*</span></label>
                                        <input type="text" id="findings" class="form-control" required name="findings">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="medicine">Medicine <span style="color: red;">*</span></label>
                                                <select id="medicine" class="form-select" required name="medicine">
                                                    <option disabled selected hidden>Select medicine</option>
                                                    <?php
                                                    $sql = "SELECT * FROM producttb WHERE category='medicine' OR category='vitamins'";
                                                    $result = $con->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $productNameParts = explode(' ', $row['name']);
                                                            $productName = $productNameParts[0];
                                                            echo "<option value='" . $productName . "'>" . $productName . " - " . $row['category'] . " </option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="dosage">Dosage <span style="color: red;">*</span></label>
                                                <input type="text" id="dosage" class="form-control" required name="dosage">
                                            </div>
                                        </div>
                                        <br>
                                        <label for="prescriptionTextarea">Instructions <span style="color: red;">*</span></label>
                                        <textarea id="prescriptionTextarea" class="form-control" rows="4" placeholder="Enter prescription here..." required name="instruction"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Prescribed</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['add'])) {
                        // Retrieve form data
                        $fullNames = $_POST['fullName'];
                        $petNames = $_POST['petname'];
                        $contacts = $_POST['contact'];
                        $dates = $_POST['date'];
                        $timeSlots = $_POST['time_slot'];
                        $services = $_POST['service'];
                        $appointmentTypes = $_POST['appointmentType'];

                        // Set status 
                        $status = ($appointmentTypes === 'scheduled appointment') ? 'pending' : 'confirmed';

                        // Prepare and execute SELECT statement to get userid
                        $sql_check = "SELECT userid FROM userstb WHERE CONCAT(firstname, ' ', lastname) = ?";
                        $stmt_check = mysqli_prepare($con, $sql_check);
                        mysqli_stmt_bind_param($stmt_check, "s", $fullNames);
                        mysqli_stmt_execute($stmt_check);
                        mysqli_stmt_bind_result($stmt_check, $userid);
                        mysqli_stmt_fetch($stmt_check);
                        mysqli_stmt_close($stmt_check);

                        // If userid found, insert appointment data into appointmenttb
                        if ($userid) {
                            $sqlss = "INSERT INTO appointmenttb (userid, fullName, petName, contact, date, time_slot, service, appointmentType, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmtss = mysqli_prepare($con, $sqlss);

                            // Bind parameters for INSERT
                            mysqli_stmt_bind_param($stmtss, "issssssss", $userid, $fullNames, $petNames, $contacts, $dates, $timeSlots, $services, $appointmentTypes, $status);

                            // Execute the INSERT statement
                            if (mysqli_stmt_execute($stmtss)) {
                                // Display success message and redirect
                                $message = "Saved!";
                                $statuss = "success";
                            } else {
                                // Display error message if insertion fails
                                $message = "Failed to save changes";
                                $statuss = "error";
                            }

                            // Close the prepared statement
                            mysqli_stmt_close($stmtss);
                        } else {
                            // If userid not found, display error message
                            $message = "User not found";
                            $statuss = "error";
                        }
                    }
                    ?>
                    <!-- Modal sa pag add ng appointment-->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New Appointment</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <label for="fullname">Owners Fullname <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="fullname" required name="fullName">
                                        <label for="petname">Pets name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="petname" required name="petname">
                                        <label for="contact">Contact No.<span style="color: red;">*</span></label>
                                        <input type="number" class="form-control" id="contact" placeholder="ex. 639291882262" required name="contact"><br>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="date">Date <span style="color: red;">*</span></label>
                                                <input type="date" class="form-control" id="date" required name="date">
                                            </div>
                                            <div class="col-6">
                                                <label for="time">Time <span style="color: red;">*</span></label>
                                                <select name="time_slot" id="time" class="form-select" required>
                                                    <option disabled selected hidden>Select time</option>
                                                    <option value="8:00 AM">8:00 AM - 9:00 AM</option>
                                                    <option value="9:00 AM">9:00 AM - 10:00 AM</option>
                                                    <option value="10:00 AM">10:00 AM - 11:00 AM</option>
                                                    <option value="11:00 AM">11:00 AM - 12:00 PM</option>
                                                    <option value="12:00 PM">12:00 PM - 1:00 PM</option>
                                                    <option value="1:00 PM">1:00 PM - 2:00 PM</option>
                                                    <option value="2:00 PM">2:00 PM - 3:00 PM</option>
                                                    <option value="3:00 PM">3:00 PM - 4:00 PM</option>
                                                    <option value="4:00 PM">4:00 PM - 5:00 PM</option>
                                                </select>
                                            </div>
                                        </div><br>
                                        <label for="service">Type of Service <span style="color: red;">*</span></label>
                                        <select name="service" id="service" class="form-select" required>
                                            <option disabled selected hidden>service</option>
                                            <option value="vaccine">vaccine</option>
                                            <option value="consultation">consultation</option>
                                            <option value="consultation">grooming</option>
                                        </select>
                                        <label for="appointmentType">Appointment Type<span style="color: red;">*</span></label>
                                        <select name="appointmentType" id="appointmentType" class="form-select" required>
                                            <option disabled selected hidden>Select time</option>
                                            <option value="walkin">walk-in</option>
                                            <option value="scheduled appointment">Schedule Appointment</option>
                                        </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                                </div>
                                </form>
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
    // Listen for changes in total and payment inputs
    document.getElementById('amounttoPay').addEventListener('input', calculateChange);
    document.getElementById('ownerPay').addEventListener('input', calculateChange);

    // Function to calculate change
    function calculateChange() {
        var total = parseFloat(document.getElementById('amounttoPay').value);
        var payment = parseFloat(document.getElementById('ownerPay').value);
        var changeInput = document.getElementById('change');
        var treatedBtn = document.getElementById('treated-btn');

        // Check if input values are valid numbers
        if (!isNaN(total) && !isNaN(payment)) {
            // Check if payment is less than total
            if (payment < total) {
                // Display an error message or handle the validation as needed
                changeInput.value = 'Payment amount cannot be less than total amount';
                treatedBtn.disabled = true;
            } else {
                // Calculate change
                var change = payment - total;

                // Update the change input value
                changeInput.value = change.toFixed(2);
                treatedBtn.disabled = false; // Display change with two decimal places
            }
        } else {
            // If either total or payment is not a valid number, set change input value to empty
            changeInput.value = '';
            treatedBtn.disabled = true;
        }
    }
</script>
<script>
    $(document).ready(function() {
        // Handle click event on transaction button
        $('.transac-btn').click(function() {
            var appNo = $(this).data('appointment-no');
            var service = $(this).data('service'); // Corrected attribute name
            var modal = $('#static');
            modal.find('#appointmentNotxt').val(appNo);
            modal.find('#appointmentServicetxt').text('Service: ' + service); // Use .text() instead of .val() for non-input elements
            modal.modal('show');
        });

        // Handle form submission using AJAX
        $('#transactionForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'appointmentTransac.php',
                data: formData,
                success: function(response) {
                    alert('Transaction submitted successfully!');
                    $('#static').modal('hide');
                    window.location.href = "approvedAppointments.php";
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('Error submitting transaction: ' + error);
                }
            });
        });
    });
</script>

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
<!-- Add this script after the prescription modal -->
<script>
    // Add an event listener to the prescription button
    document.querySelectorAll('.btn-prescription').forEach(item => {
        item.addEventListener('click', event => {
            var appointmentNo = event.target.getAttribute('data-appointment-no');
            fetchAppointmentDetails(appointmentNo);
        });
    });

    function fetchAppointmentDetails(appointmentNo) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'appointmentDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log('Response:', response);
                // Populate the prescription modal with appointment details
                document.getElementById('appointmentNotxts').value = response.appointmentNo;
                document.getElementById('ownersName').value = response.ownersName;
                document.getElementById('service').value = response.service;
                document.getElementById('petName').value = response.petName;
                document.getElementById('userid').value = response.userid;
            }
        };
        xhr.send('appointmentNo=' + appointmentNo);
    }
</script>

<?php
if (isset($_POST['submit'])) {
    $appointNo = $_POST['appointmentNo'];
    $fullname = $_POST['fullname'];
    $userId = $_POST['userid'];
    $findings = $_POST['findings'];
    $medicine = $_POST['medicine'];
    $dosage = $_POST['dosage'];
    $instruction = $_POST['instruction'];
?>
    <script>
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: "Don't save"
        }).then((result) => {
            if (result.isConfirmed) {
                <?php
                // Insert data into prescriptiontb after confirmation
                $stmt = $con->prepare("INSERT INTO prescriptiontb (appointmentNo,userid,fullname ,veterinarian, findings, medicine, dosage, instruction) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iissssss", $appointNo, $userId, $fullname, $username, $findings, $medicine, $dosage, $instruction);
                if ($stmt->execute()) {
                    // Display success message
                ?>
                    Swal.fire("Saved!", "", "success").then(() => {
                        // Redirect to another page after successful submission
                        window.location.href = "approvedAppointments.php";
                    });
                <?php } else { ?>
                    // Display error message if insertion fails
                    Swal.fire("Error!", "Failed to save changes", "error");
                <?php } ?>
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    </script>
<?php } ?>
<script>
    Swal.fire({
        title: "<?php echo $message; ?>",
        icon: "<?php echo $statuss; ?>",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to another page if necessary
            window.location.href = "approvedAppointments.php";
        }
    });
</script>

</html>