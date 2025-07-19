<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        padding: 30px;
        margin-top: 60px;
        margin-bottom: 60px;
        width: 100vh;
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
        border-radius: 10px;
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

    .row {
        padding: 50px;
    }

    input[type="datetime-local"] {

        width: 41vh;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .img {
        background-color: whitesmoke;
        border-radius: 70%;
        height: 60px;
    }

    .bg-lightgreen {
        background-color: lightgreen !important;
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
                    <li class="nav-item">
                        <a class="nav-link text-color" name="submit" href="chatRoom.php">Chat</a>
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
    $sql = "SELECT * FROM animaltb WHERE userid = $userid";
    $query =  mysqli_query($con, $sql);
    ?>
    <!--content -->
    <div class="container">
        <div class="wrapper">
            <h5>Appointment Preferences</h5>
            <form method="get" action="appointmentSummary.php">
                <label for="petname" class="form-label">Pet Name <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <select id="petname" class="form-select" aria-label="Default select example" name="petname" required>
                        <option disabled selected hidden>Select your pet</option>
                        <?php while ($row = mysqli_fetch_assoc($query)) {
                            $petname = $row['petname'];
                            echo '<option value=' . $petname . '>' . $petname . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <label class="form-label">Contact <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">contact no.</span>
                    <input type="number" class="form-control" name="contact" placeholder="ex. 639507808703" required>
                </div>
                <label class="form-label">Appointment <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" name="appointmentType" required id="appointmentType" onchange="toggleAddressInput()">
                        <option disabled selected hidden>Type of Appointment</option>
                        <option value="Schedule appointment">Schedule appointment</option>
                        <option value="Schedule home service">Schedule home service</option>
                    </select>
                </div>

                <input type="hidden" id="selectedDate" name="selectedDate">
                <input type="hidden" id="selectedTime" name="selectedTime">

                <label for="datepicker">Date/Time <span style="color: red;">*</span></label>
                <div class="calendar-container" style="background-color: #FFFDD7;">
                    <div class="row">
                        <div class="card" style="width: 17rem;">
                            <div class="card-body">
                                <div class="">
                                    <label for="timePicker">Date</label>
                                    <hr>
                                    <div id="datepicker"></div>
                                    <p class="badge rounded-pill text-bg-success">Available</p>
                                    <p class="badge rounded-pill text-bg-danger">Not Available</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="timePicker">Time</label>
                            <hr>
                            <div id="timePicker" class="form-check"></div>
                        </div>
                    </div>
                </div>

                <label class="form-label">Services <span style="color: red; font-size: 20px;">*</span></label>

                <div class="row">
                    <?php

                    $sql4 = "SELECT * FROM servicetb";
                    $result4 = mysqli_query($con, $sql4);
                    if (mysqli_num_rows($result4) > 0) {
                        while ($row = mysqli_fetch_assoc($result4)) {
                            $service = $row['service'];
                            $price = $row['prices'];
                            echo '<div class="col-md-4">';
                            echo '<input type="checkbox" name="service[]" value="' . $service . '"> ' . $service . '- ₱' . $price . '<br>';
                            echo '</div>';
                        }
                    } else {
                        echo "No services found";
                    }
                    ?>
                </div>
                <label class="form-label">Address (If Home Service)</label>
                <div class="input-group" style="margin-bottom: 10px;">
                    <textarea class="form-control" aria-label="With textarea" placeholder="Full Address" name="address" id="address" disabled></textarea>
                </div>
                <button class="btn btn-primary" type="submit" name="next">Next</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Datepicker JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
    // Initialize the date picker
    $('#datepicker').datepicker({
        startDate: 'today'
    });

    $('#datepicker').on('changeDate', function(e) {
        var selectedDate = new Date(e.date.getTime() - e.date.getTimezoneOffset() * 60000);

        $('#selectedDate').val(selectedDate.toISOString().slice(0, 10));

        $.ajax({
            url: 'check_appointments.php',
            type: 'POST',
            data: {
                selectedDate: $('#selectedDate').val()
            },
            success: function(response) {
                var appointments = JSON.parse(response);

                $('#timePicker').empty();

                // Get current time
                var currentTime = new Date();

                var availableTimes = [];

                if (selectedDate.getDay() === 0) { // Sunday
                    // Add available times for Sunday (8:00 AM to 11:00 AM)
                    availableTimes = ["8:00 AM", "9:00 AM", "10:00 AM", "11:00 AM"];
                } else {
                    // Default available times for other days
                    availableTimes = ["8:00 AM", "9:00 AM", "10:00 AM", "11:00 AM", "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM"];
                }

                availableTimes.forEach(function(time) {
                    var timeParts = time.split(":");
                    var hour = parseInt(timeParts[0]);
                    var minute = parseInt(timeParts[1]);
                    var ampm = timeParts[1].split(" ")[1];

                    // Convert 12-hour time to 24-hour time for comparison
                    var hour24 = hour + (ampm === "PM" && hour !== 12 ? 12 : 0);

                    var timeValue = new Date(selectedDate);
                    timeValue.setHours(hour24, minute, 0, 0);

                    if (timeValue < currentTime) {
                        $('#timePicker').append($('<div class="form-check">').append(
                            $('<input class="form-check-input" type="radio" name="availableTime" value="' + time + '" disabled>'),
                            $('<label class="form-check-label" for="' + time + '">' + time + '</label>'), ' ',
                            $('<span class="badge rounded-circle bg-danger"><span class="visually-hidden">New</span></span>')
                        ));
                    } else {
                        // Check if the time slot is already taken
                        var disabled = appointments.includes(time) ? "disabled" : "";
                        var badgeColor = disabled ? "danger" : "success";
                        $('#timePicker').append($('<div class="form-check">').append(
                            $('<input class="form-check-input" type="radio" name="availableTime" value="' + time + '" ' + disabled + '>'),
                            $('<label class="form-check-label" for="' + time + '">' + time + '</label>'), ' ',
                            $('<span class="badge rounded-circle bg-' + badgeColor + '"><span class="visually-hidden">New</span></span>')
                        ));
                    }
                });
            }
        });
    });

    $('#timePicker').on('change', 'input[type="radio"]', function() {
        $('#selectedTime').val($(this).val());
    });
});

</script>
<script>
    function toggleAddressInput() {
        var appointmentType = document.getElementById("appointmentType");
        var addressInput = document.getElementById("address");

        addressInput.disabled = (appointmentType.value === "Schedule appointment");
    }
</script>
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("datePicker").setAttribute('min', today);
</script>

</html>