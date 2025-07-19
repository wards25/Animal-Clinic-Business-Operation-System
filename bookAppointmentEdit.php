<!-----Need i debug----->

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        background-color: #CDD5FF;
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
    $sql = "SELECT * FROM animaltb WHERE userid = $userid";
    $query =  mysqli_query($con, $sql);
    ?>

    <?php
    $petName = isset($_GET['petname']) ? $_GET['petname'] : "";
    $contact = isset($_GET['contact']) ? $_GET['contact'] : "";
    $appointmentType = isset($_GET['appointmentType']) ? $_GET['appointmentType'] : "";
    $date = isset($_GET['date']) ? $_GET['date'] : "";
    $time_slot = isset($_GET['time_slot']) ? $_GET['time_slot'] : "";
    $service = isset($_GET['service']) ? $_GET['service'] : "";
    $address = isset($_GET['address']) ? $_GET['address'] : null;
    ?>
    <!--content -->
    <div class="container">
        <div class="wrapper">
            <h5>Appointment Preferences</h5>
            <form action="appointmentSummary.php" method="GET">
                <label class="form-label">Pet Name <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" name="petname" required>
                        <option disabled <?php echo empty($petName) ? 'selected' : ''; ?> hidden>Select Pet Name</option>
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
                    <input type="text" class="form-control" aria-describedby="basic-addon1" name="contact" required value=<?php echo $contact; ?>>
                </div>

                <label class="form-label">Appointment <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" id="appointmentType" name="appointmentType" required onchange="toggleAddressInput()">
                        <option disabled <?php echo empty($appointmentType) ? 'selected' : ''; ?> hidden>Type of appointment</option>
                        <option value="Schedule Appointment" <?php echo ($appointmentType === 'Schedule Appointment') ? 'selected' : ''; ?>>Schedule appointment</option>
                        <option value=" Schedule home service" <?php echo ($appointmentType === 'Schedule home service') ? 'selected' : ''; ?>>Schedule Home Service</option>
                    </select>
                </div>

                <label class="form-label">Date <span style="color: red; font-size: 20px;">*</span></label>
                <div class="mb-3">
                    <input class="form-control" type="date" name="date" required value=<?php echo $date; ?>>
                </div>

                <label class="form-label">Time <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Time Available</button>
                    </span>
                    <select class="form-select" aria-label="Default select example" name="time_slot" required>
                        <option disabled <?php echo empty($time_slot) ? 'selected' : ''; ?> hidden>Select Time</option>
                        <option value="8:00 AM" <?php echo ($time_slot === '8:00 AM') ? 'selected' : ''; ?>>8:00 AM - 9:00 AM</option>
                        <option value="9:00 AM" <?php echo ($time_slot === '9:00 AM') ? 'selected' : ''; ?>>9:00 AM - 10:00 AM</option>
                        <option value="10:00 AM" <?php echo ($time_slot === '10:00 AM') ? 'selected' : ''; ?>>10:00 AM - 11:00 AM</option>
                        <option value="11:00 AM" <?php echo ($time_slot === '11:00 AM') ? 'selected' : ''; ?>>11:00 AM - 12:00 PM</option>
                        <option value="12:00 PM" <?php echo ($time_slot === '12:00 PM') ? 'selected' : ''; ?>>12:00 PM - 1:00 PM</option>
                        <option value="1:00 PM" <?php echo ($time_slot === '1:00 PM') ? 'selected' : ''; ?>>1:00 PM - 2:00 PM</option>
                        <option value="2:00 PM" <?php echo ($time_slot === '2:00 PM') ? 'selected' : ''; ?>>2:00 PM - 3:00 PM</option>
                        <option value="3:00 PM" <?php echo ($time_slot === '3:00 PM') ? 'selected' : ''; ?>>3:00 PM - 4:00 PM</option>
                        <option value="4:00 PM" <?php echo ($time_slot === '4:00 PM') ? 'selected' : ''; ?>>4:00 PM - 5:00 PM</option>
                    </select>
                </div>

                <label class="form-label">Service <span style="color: red; font-size: 20px;">*</span></label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" name="service" required>
                        <option disabled <?php echo empty($service) ? 'selected' : ''; ?> hidden>Type of Service</option>
                        <option value="vaccine" <?php echo ($service === 'vaccine') ? 'selected' : ''; ?>>Vaccination</option>
                        <option value=" grooming" <?php echo ($service === 'grooming') ? 'selected' : ''; ?>>Grooming</option>
                        <option value="consultation" <?php echo ($service === 'consultation') ? 'selected' : ''; ?>>Consultation</option>
                    </select>
                </div>
                <label class="form-label">Address (If Home Service)</label>
                <div class="input-group" style="margin-bottom: 10px;">
                    <textarea class="form-control" aria-label="With textarea" placeholder="Full Address" name="address" id="address" disabled><?php echo $address; ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit" name="next">Next</button>
            </form>
        </div>
    </div>
    <?php
    $sql1 = "SELECT * FROM appointmenttb WHERE status='confirmed'";
    $query1 =  mysqli_query($con, $sql1);
    ?>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Time Querying</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Scheduled Appointment</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query1)) {
                                $occupied_date =  date("F d, Y", strtotime($row['date']));
                                $occupied_time_slot = $row['time_slot']; ?>
                                <tr>
                                    <td><?php echo $occupied_date; ?></td>
                                    <td><?php echo $occupied_time_slot; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./js/bookAppointment.js"></script>
<script>
    function toggleAddressInput() {
        var appointmentType = document.getElementById("appointmentType");
        var addressInput = document.getElementById("address");

        if (appointmentType.value === "Schedule Appointment") {
            addressInput.disabled = true;
            addressInput.value = "";
        } else {
            addressInput.disabled = false;
        }
    }
    toggleAddressInput();
</script>

</html>