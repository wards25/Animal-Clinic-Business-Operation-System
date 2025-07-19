<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/theme.css">
    <title>AnimalClinic</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #CDD5FF;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .wrapper {
        margin-top: 60px;
        margin-bottom: 60px;
        background: whitesmoke;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        border-radius: 10px;
    }

    .wrapper ul li button {

        color: whitesmoke;
    }

    .wrapper ul li button:hover {
        color: #F28500;
    }

    nav {
        background-color: #0B1D51;
    }

    .text-color {
        color: whitesmoke;
    }

    .text-color:hover {
        color: #F28500;
    }

    .navigation-tab {
        background-color: #0B1D51;
        margin-bottom: 60px;
    }

    .container-profile {
        margin-right: 100px;
        display: flex;
        align-items: center;
    }

    .container-profile-inner {
        height: 40px;
        width: 40px;
        margin-top: 3px;
        border-radius: 50%;
        background-color: whitesmoke;
        overflow: hidden;
    }

    .container-profile-inner img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        display: block;
        position: relative;
        z-index: 0;
        border-radius: 50%;
    }

    .card-about-text {
        font-family: Arial, Helvetica, sans-serif;
    }

    .column-features-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .column-features-wrapper {
        width: 120vh;
        height: 700px;
    }

    .fc-event {
        cursor: pointer;
    }

    .fc-event-time {
        display: none;
    }

    .img {
        background-color: whitesmoke;
        border-radius: 70%;
        height: 60px;
    }
</style>

<?php
session_start();
include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location: index.php");
} else {
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
}
?>

<!------profile query----->
<?php
$sql = "SELECT imageData FROM userstb WHERE userid=?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $userid);


    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $image = $row['imageData'];
        } else {
            echo "No user found with the specified userid.";
        }

        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
    } else {
        die("Statement execution failed: " . mysqli_stmt_error($stmt));
    }
} else {
    die("Statement preparation failed: " . mysqli_error($con));
}

?>

<body>
    <!--navBar-->
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php"><img src="./img/logo.png" class="img navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-color" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products.php">Products</a></li>
                            <li><a class="dropdown-item" href="bookAppointment.php">Book Appointment</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="schedule.php">Schedule</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="petCare.php">Pet Care</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="myPet-Primary.php">My Pet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" name="submit" href="about.php">About</a>
                    </li>
                </ul>

                <!--Drop down profile-->
                <div class="container-profile">
                    <div class="container-profile-inner">
                        <?php
                        if (isset($image)) {
                            echo '<img id="selectedImage" src="data:image/jpg;charset=utf8;base64,' . base64_encode($image) . '" />';
                        } else {
                            echo ' <img id="selectedImage" src="./img/pngwing.com.png"/>';
                        }
                        ?>
                    </div>
                    <?php echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ' . $username . '
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php"><button class="btn btn-danger">Logout</button></a></li>
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        </ul>
                    </li>
                    </ul>'; ?>
                </div>
            </div>
        </div>
    </nav>
    <?php
    $sql = "SELECT * FROM appointmenttb WHERE userid = ?";
    $stmts = $con->prepare($sql);
    $stmts->bind_param("i", $userid);
    $stmts->execute();
    $result = $stmts->get_result();
    ?>

    <!--content-->
    <div class="container">
        <div class="wrapper">
            <ul class="nav nav-tabs navigation-tab justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Calendar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Appointment</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="height: 145vh; width: 170vh;">
                    <div id='calendar'></div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <?php if ($result->num_rows > 0) { ?>
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
                                while ($row = $result->fetch_assoc()) {
                                    $appointmentNo = $row['appointmentNo'];
                                    $date = date("F d, Y", strtotime($row['date']));
                                    $appointmentType = $row['appointmentType'];
                                    $service = $row['service'];
                                    $ownersName = $row['fullName'];
                                    $petName = $row['petname'];
                                    $contact = $row['contact'];
                                    $time_slot = $row['time_slot'];
                                    $status = $row['status'];

                                    // Define badge color based on status
                                    $badge_color = '';
                                    if ($status == 'pending') {
                                        $badge_color = 'badge-warning-soft';
                                    } elseif ($status == 'confirmed') {
                                        $badge_color = 'badge-success-soft';
                                    } elseif ($status == 'fulfilled') {
                                        $badge_color = 'badge-success-soft';
                                    } elseif ($status == 'cancel') {
                                        $badge_color = 'badge-danger-soft';
                                    }

                                    echo '
                                <tr>
                                    <td>
                                        <h5 class="mb-1">' . $appointmentType . '</h5>
                                    </td>
                                    <td>
                                        <h5 class="mb-1">' . $service . '</h5>
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
                                        <span class="badge ' . $badge_color . '">' . $status . '</span>
                                    </td>';
                                    if ($status == 'pending') {
                                        echo '<td><button class="btn btn-primary edit-appointment-btn" data-appointment-no="' . $appointmentNo . '">Edit</button></td>';
                                    } else {
                                        echo '<td></td>'; 
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo '<p style="color:red; text-align:center;">No Scheduled Appointments</p>';
                    } ?>
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
                        <input type="hidden" id="selected-event-id" name="selectedeventid" value="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for editing appointment -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Re-schedule Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input fields for editing appointment details -->
                    <form id="editAppointmentForm" method="post">
                        <!-- Hidden input field to store the appointment ID -->
                        <input type="hidden" id="appointmentNo" name="appointmentNo">
                        <div class="form-group">
                            <label for="date">Appointment Date <span style="color: red; font-size: 20px;">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <label class="form-label">Time <span style="color: red; font-size: 20px;">*</span></label>
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="Default select example" name="time_slot" required>
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
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>

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
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        })
        calendar.render()
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {
                url: './admin/displayEvent.php',
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
                    url: './admin/displayEvent.php',
                    method: 'POST',
                    data: {
                        eventId: info.event.id
                    },
                    success: function(response) {
                        console.log('AJAX response:', response); // Log the response
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
        // Add event listener for the "Edit" button click
        $('.edit-appointment-btn').click(function() {
            // Find the corresponding appointment number
            var appointmentNo = $(this).data('appointment-no');
            // Update the appointment number in the modal form
            $('#appointmentNo').val(appointmentNo);
            // Show the modal
            $('#appointmentModal').modal('show');
        });
    });

    $(document).ready(function() {
        // Handle form submission
        $('#editAppointmentForm').submit(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Get form data
            var formData = $(this).serialize();
            console.log("Form data:", formData); // Log form data for debugging

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: 'editAppointment.php', // PHP script to handle the update operation
                data: formData,
                dataType: 'json', // Specify the expected data type of the response
                success: function(response) {
                    Swal.fire({
                        title: "Do you want to save the changes?",
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Save",
                        denyButtonText: `Don't save`
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            if (response.success) {
                                Swal.fire("Saved!", "", "success").then(() => {
                                    // Redirect to schedule.php after the user clicks OK
                                    window.location.href = "schedule.php";
                                });
                            } else {
                                Swal.fire("Error!", "Error updating appointment", "error");
                            }
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error); // Log AJAX error for debugging
                    // Display error message
                    alert('Error updating appointment. Please try again.');
                }
            });
        });
    });
</script>

</html>