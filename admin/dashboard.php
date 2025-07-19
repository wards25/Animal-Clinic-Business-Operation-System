<?php
session_start();
include('../connection.php');
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Redirect to login page if not logged in
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <title>AnimalClinic</title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">
</head>
<style>
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
                                                            <a class="nav-link has-arrow " href="servConfine.php">
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
                                                                sales Reports
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
                                    <h3 class="mb-0  text-white">Dashboard</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lift">
                                <!-- card body -->
                                <a href="accounts.php">
                                    <div class="card-body">
                                        <!-- heading -->
                                        <?php
                                        //Counting of users in appointment tbl
                                        $sqlUsers = $con->prepare("SELECT COUNT(username) AS userCount FROM userstb");
                                        $sqlUsers->execute();
                                        $resultUsers = $sqlUsers->get_result();
                                        $rowUsers = $resultUsers->fetch_assoc();
                                        $userCount = $rowUsers['userCount'];

                                        $sqlUserStatus = $con->prepare("SELECT COUNT(username) AS userStatus FROM userstb WHERE status='online'");
                                        $sqlUserStatus->execute();
                                        $resultUserStatus = $sqlUserStatus->get_result();
                                        $rowUserStatus = $resultUserStatus->fetch_assoc();
                                        $userStatusCount = $rowUserStatus['userStatus'];
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h4 class="mb-0">Users</h4>
                                            </div>
                                            <div class="icon-shape icon-md bg-primary-soft text-primary rounded-2">
                                                <i class="fa-solid fa-user fa-xl"></i>
                                            </div>
                                        </div>
                                        <!-- project number -->
                                        <div class="lh-1">
                                            <h1 class=" mb-1 fw-bold"><?php echo $userCount; ?></h1>
                                            <p class="mb-0"><span class="text-dark me-2"><?php if (isset($userStatusCount)) {
                                                                                                echo $userStatusCount;
                                                                                            } else {
                                                                                                echo "0";
                                                                                            } ?></span>Online</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lift">
                                <!-- card body -->
                                <a href="approvedAppointments.php">
                                    <div class="card-body">
                                        <!-- heading -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <?php
                                            // Counting of confirmed appointments
                                            $sqlConfirmed = $con->prepare("SELECT COUNT(appointmentNo) AS confirmedCount FROM appointmenttb WHERE status='confirmed'");
                                            $sqlConfirmed->execute();
                                            $resultConfirmed = $sqlConfirmed->get_result();
                                            $rowConfirmed = $resultConfirmed->fetch_assoc();
                                            $confirmedCount = $rowConfirmed['confirmedCount'];

                                            // Counting of pending appointments
                                            $sqlPending = $con->prepare("SELECT COUNT(appointmentNo) AS pendingCount FROM appointmenttb WHERE status='pending'");
                                            $sqlPending->execute();
                                            $resultPending = $sqlPending->get_result();
                                            $rowPending = $resultPending->fetch_assoc();
                                            $pendingCount = $rowPending['pendingCount'];
                                            ?>
                                            <div>
                                                <h4 class="mb-0">Approved Appointments</h4>
                                            </div>
                                            <div class="icon-shape icon-md bg-primary-soft text-primary
              rounded-2">
                                                <i class="fa-solid fa-calendar-days fa-xl"></i>

                                            </div>
                                        </div>
                                        <!-- project number -->
                                        <div class="lh-1">
                                            <h1 class="  mb-1 fw-bold"><?php if (isset($confirmedCount)) {
                                                                            echo $confirmedCount;
                                                                        } else {
                                                                            echo "0";
                                                                        } ?></h1>
                                            <p class="mb-0"><span class="text-dark me-2"><?php if (isset($pendingCount)) {
                                                                                                echo $pendingCount;
                                                                                            } else {
                                                                                                echo "0";
                                                                                            } ?></span>Pending Appointments</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lift">
                                <!-- card body -->
                                <a href="inventory.php">
                                    <div class="card-body">
                                        <!-- heading -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <?php
                                            //Counting of total stocks in inventory tbl
                                            $sqlStocks = $con->prepare("SELECT COUNT(productcode) AS productCount FROM producttb");
                                            $sqlStocks->execute();
                                            $resultStocks = $sqlStocks->get_result();
                                            $rowStocks = $resultStocks->fetch_assoc();
                                            $productCount = $rowStocks['productCount'];

                                            $sqlQuantity = $con->prepare("SELECT SUM(quantity) AS quantityCount FROM producttb");
                                            $sqlQuantity->execute();
                                            $resultQuantity = $sqlQuantity->get_result();
                                            $rowQuantity = $resultQuantity->fetch_assoc();
                                            $quantityCount = $rowQuantity['quantityCount'];
                                            ?>
                                            <div>
                                                <h4 class="mb-0">No. of Products</h4>
                                            </div>
                                            <div class="icon-shape icon-md bg-primary-soft text-primary
                                                    rounded-2">
                                                <i class="fa-solid fa-warehouse fa-xl"></i>

                                            </div>
                                        </div>
                                        <!-- project number -->
                                        <div class="lh-1">
                                            <h1 class="  mb-1 fw-bold"><?php if (isset($productCount)) {
                                                                            echo $productCount;
                                                                        } else {
                                                                            echo "0";
                                                                        } ?></h1>
                                            <p class="mb-0"><span class="text-dark me-2"><?php if (isset($quantityCount)) {
                                                                                                echo $quantityCount;
                                                                                            } else {
                                                                                                echo "0";
                                                                                            } ?></span>Total Stocks Quantity</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lift">
                                <!-- card body -->
                                <a href="pets.php">
                                    <div class="card-body">
                                        <!-- heading -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <?php
                                            //Counting of total stocks in inventory tbl
                                            $sqlPet = $con->prepare("SELECT COUNT(animalid) AS petCount FROM animaltb");
                                            $sqlPet->execute();
                                            $resultPet = $sqlPet->get_result();
                                            $rowPet = $resultPet->fetch_assoc();
                                            $petCount = $rowPet['petCount'];
                                            ?>
                                            <div>
                                                <h4 class="mb-0">No. of Pets</h4>
                                            </div>
                                            <div class="icon-shape icon-md bg-primary-soft text-primary
                                                          rounded-2">
                                                <i class="fa-solid fa-paw fa-2xl"></i>

                                            </div>
                                        </div>
                                        <!-- project number -->
                                        <div class="lh-1">
                                            <h1 class="  mb-1 fw-bold"><?php if (isset($petCount)) {
                                                                            echo $petCount;
                                                                        } else {
                                                                            echo "0";
                                                                        } ?></h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- card  -->
                    <div class="card">
                        <!-- card header  -->
                        <div class="card-header ">
                            <h4 class="mb-0">Pending Appointments</h4>
                        </div>

                        <?php
                        //Counting of pending Status in appointment tbl
                        $sqls = $con->prepare("SELECT * FROM appointmenttb WHERE status='pending' ORDER BY appointmentNo ");
                        $sqls->execute();
                        $results = $sqls->get_result();
                        // Get current date and time
                        $currentDateTime = date("Y-m-d H:i:s");

                        // Update appointments if their scheduled time has passed
                        while ($row = $results->fetch_assoc()) {
                            $scheduledDateTime = $row['date'] . ' ' . $row['time_slot'];
                            if ($currentDateTime > $scheduledDateTime) {
                                // Update status to "cancelled"
                                $appointmentNo = $row['appointmentNo'];
                                $updateSql = $con->prepare("UPDATE appointmenttb SET status='cancel' WHERE appointmentNo=?");
                                $updateSql->bind_param("s", $appointmentNo);
                                $updateSql->execute();
                                $updateSql->close();
                            }
                        }
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
                                            while ($row = $results->fetch_assoc()) {
                                                $appoinmetnNo = $row['appointmentNo'];
                                                $date = date("F d, Y", strtotime($row['date']));
                                                $appointmentType = $row['appointmentType'];
                                                $service = $row['service'];
                                                $ownersName = $row['fullName'];
                                                $petName = $row['petname'];
                                                $contact = $row['contact'];
                                                $time_slot = $row['time_slot'];
                                                $status = $row['status'];

                                                echo '
                                                    <tr>
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
                                                        <span class="badge badge-warning-soft">' . $status . '</span>
                                                        </td>
                                                        <td>
                                                        <a href="updateStatusAppoint.php?appointmentNo=' . $appoinmetnNo . '&status=confirmed"><button type="submit" class="btn btn-success approv-btn" name="confirmed"><i class="fa-regular fa-thumbs-up"></i> Approved</button>
                                                        </td>
                                                    </tr>';
                                            }
                                        } else {
                                            echo '<p style="color:red; text-align:center;">No Pending Appointments</p>';
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
    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>

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
            url: '../live_search/dashAdminSearch.php',
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


</html>