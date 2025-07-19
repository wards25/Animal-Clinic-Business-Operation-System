<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <title>AnimalClinic</title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">
</head>


<style>
    .wrapper {
        padding: 20px;
        margin-top: 60px;
        margin-bottom: 60px;
        height: 100vh;
        width: 200vh;
        background: #f1f5f9;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        border-radius: 10px;
    }

    .fc-event {
        cursor: pointer;
        /* Change cursor to pointer when hovering over events */
    }

    .fc-event-time {
        display: none;
    }

    .container-logo .logo {
        height: 50px;
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


<body class="bg-light">
    <?php
    session_start();
    include("../connection.php");

    if (!isset($_SESSION['username'])) {
        header("location: ../index.php");
    }
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
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
                    <a href="log_out.php" type="button" class="btn btn-outline-danger" style="margin-left: 10px;">Log Out</a>
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
        <!-- page content -->
        <div id="app-content">
            <!-- Container fluid -->
            <div class="app-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="mb-5">
                                <h3 class="mb-0 ">Calendar App</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-lg-2 border-end">
                                        <div class="p-5">
                                            <div class="d-grid mb-4">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-edit-event-modal" id="create-new-event-btn">+ Create New Events</a>
                                            </div>
                                            <h5 class="mb-0">Events</h5>
                                            <p>Drag and drop your event or click in the calendar</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div id='calendar'></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Calendar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Add or Edit Event Modal -->
    <div class="modal fade" id="add-edit-event-modal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-edit-event-modal-title">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="add-event-form" method="post">
                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" placeholder="Event Title" name="title" id="event-title" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Start At</label>
                            <div class="input-group">
                                <input class="form-control " id="eventStart" placeholder="Select Dates" type="datetime-local" name="start_dateTime" required>
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event End At </label>
                            <div class="input-group">
                                <input class="form-control " id="eventEnd" placeholder="Select Dates" type="datetime-local" name="end_dateTime" required>
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Location</label>
                            <input type="text" class="form-control " id="event-location" placeholder="Event Location" name="location" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="event-description" placeholder="Enter event description" rows="3" spellcheck="false" name="description" required>description</textarea>
                        </div>
                        <button type="button" class="btn btn-outline-success" id="addEvent" name="addEvent">Add Event</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- view modal -->
    <div class="modal fade" id="view-edit-event-modal" tabindex="-1" aria-labelledby="eventModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view-event-modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="event-details">
                        <div class="mt-0">
                            <h5 class="mb-0 text-800"><i class="fa-solid fa-circle-info"></i> Description</h5>
                            <p class="mb-1 mt-2" id="view-event-description"></p>
                        </div>

                        <div class="mt-4">
                            <h5 class="mb-0 text-800"><i class="fa-regular fa-calendar"></i> Start Date and End Date</h5>
                            <p class="mb-1 mt-2" id="view-event-dates"></p>
                        </div>
                        <div class="my-4">
                            <h5 class="mb-0 text-800"><i class="fa-solid fa-location-dot"></i> Location</h5>
                            <p class="mb-1 mt-2" id="view-event-location"></p>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-primary" id="btn-edit-event"><i class="fa-regular fa-pen-to-square"></i>
                            Edit Event</button>
                        <input type="hidden" id="selected-event-id" name="selectedeventid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- edit event modal -->
    <div class="modal fade" id="edit-event-form" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Event</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form name="form" id="edit-event-form" method="post">
                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" placeholder="Event Title" name="title" id="edit-event-title" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Start At</label>
                            <div class="input-group">
                                <input class="form-control " id="edit-eventStart" placeholder="Select Dates" type="datetime-local" name="start_dateTime" required>
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event End At </label>
                            <div class="input-group">
                                <input class="form-control " id="edit-eventEnd" placeholder="Select Dates" type="datetime-local" name="end_dateTime" required>
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Location</label>
                            <input type="text" class="form-control " id="edit-event-location" placeholder="Event Location" name="location" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="edit-event-description" placeholder="Enter event description" rows="3" spellcheck="false" name="description" required>description</textarea>
                        </div>
                        <button type="button" class="btn btn-outline-success" id="editEvent" name="editEventBtn"><i class="fa-regular fa-pen-to-square"></i> Edit Event</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap and Popper.js scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- FullCalendar scripts -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" />

<!-- SimpleBar script -->
<script src="https://unpkg.com/simplebar/dist/simplebar.min.js"></script>

<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
    });
</script>

<script>
    $('#addEvent').click(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // AJAX request to the server
        $.ajax({
            type: 'post',
            url: 'insertEvent.php',
            data: $("#add-event-form").serialize(),
            success: function(response) {
                // Handle the response from the server
                console.log(response);
                if (response === 'Event added successfully!') {
                    Swal.fire({
                        title: "Add Successfully",
                        text: "Successfully add a event",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'calendar.php';
                        }
                    });
                }
            }
        });
        return true;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {
                url: 'displayEvent.php',
                method: 'POST',
                extraParams: {},
                failure: function() {
                    alert('Error fetching events from the server');
                },
            },
            eventClick: function(info) {
                // Prevent default behavior, such as navigating to a new URL
                info.jsEvent.preventDefault();

                // Log to console to verify that this function is being called and event ID
                console.log('Event clicked:', info.event.id);

                // Fetch event details from the server using AJAX
                $.ajax({
                    url: 'displayEvent.php',
                    method: 'POST',
                    data: {
                        eventId: info.event.id
                    },
                    success: function(response) {
                        console.log('AJAX response:', response);
                        // Parse the JSON response
                        var eventDetails = JSON.parse(response);

                        var startTime = new Date(eventDetails.start);
                        var endTime = new Date(eventDetails.end);

                        var options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        };

                        var startTimeString = startTime.toLocaleString('en-US', options);
                        var endTimeString = endTime.toLocaleString('en-US', options);

                        // Populate modal with event details
                        $('#selected-event-id').val(eventDetails.id);
                        $('#view-event-modal-title').text(eventDetails.title);
                        $('#view-event-description').text(eventDetails.description);
                        $('#view-event-dates').text(startTimeString + ' - ' + endTimeString);
                        $('#view-event-location').text(eventDetails.location);

                        // Show the modal
                        console.log('Showing modal...');
                        $('#view-edit-event-modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                        alert('Error fetching event details');
                    }
                });
            }

        });
        calendar.render();
    });
</script>

<script>
    $(document).ready(function() {
        // When "Edit" button is clicked in the view modal
        $('#btn-edit-event').click(function() {
            // Get the selected event ID
            var eventId = $('#selected-event-id').val();

            // AJAX request to fetch event details
            $.ajax({
                type: 'post',
                url: 'displayEvent.php',
                data: {
                    eventId: eventId
                },
                success: function(response) {
                    // Parse the JSON response
                    var eventDetails = JSON.parse(response);

                    // Populate the fields in the edit modal with the retrieved data
                    $('#selected-event-id').val(eventDetails.id);
                    $('#edit-event-title').val(eventDetails.title);
                    $('#edit-eventStart').val(eventDetails.start);
                    $('#edit-eventEnd').val(eventDetails.end);
                    $('#edit-event-location').val(eventDetails.location);
                    $('#edit-event-description').val(eventDetails.description);

                    // Show the edit modal
                    $('#edit-event-form').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                    alert('Error fetching event details');
                }
            });
        });

        // When "Save" button is clicked in the edit modal
        $('#editEvent').click(function() {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire("Saved!", "", "success").then(() => {
                        // Get the form data
                        var formData = {
                            eventId: $('#selected-event-id').val(),
                            title: $('#edit-event-title').val(),
                            start_dateTime: $('#edit-eventStart').val(),
                            end_dateTime: $('#edit-eventEnd').val(),
                            location: $('#edit-event-location').val(),
                            description: $('#edit-event-description').val()
                        };

                        // AJAX request to update event details
                        $.ajax({
                            type: 'post',
                            url: 'editEvent.php',
                            data: formData,
                            success: function(response) {
                                console.log(response);
                                if (response === 'Event edited successfully!') {
                                    window.location.href = 'calendar.php';
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                console.error(xhr.responseText);
                                alert('Error updating event');
                            }
                        });
                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                    $('#edit-event-form').modal('hide');
                }
            });
        });
    });
</script>