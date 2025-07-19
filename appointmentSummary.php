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
            padding: 100px;
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
        exit();
    } else {
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $owners_name = $_SESSION['firstname'];
        $owners_lastname = $_SESSION['lastname'];
        $fullName = $owners_name . ' ' . $owners_lastname;
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
        
        if (isset($_GET['next'])) {
            $petname = $_GET['petname'];
            $contact = $_GET['contact'];
            $appointmentType = $_GET['appointmentType'];
            $date = $_GET['selectedDate'];
            $time_slot = $_GET['selectedTime'];
            $services = isset($_GET['service']) ? implode(', ', $_GET['service']) : '';
            $address = isset($_GET['address']) ? $_GET['address'] : null;

            if (isset($_POST['book'])) {
                $stmt = $con->prepare("INSERT INTO appointmenttb (userid, fullName, petname, contact, appointmentType, date, time_slot, service, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssssss", $userid, $fullName, $petname, $contact, $appointmentType, $date, $time_slot, $services, $address);

                $usertype = $_SESSION['usertype'];
                $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Booked Appointment')");

                if ($stmt->execute()) {
                    echo '<script>alert("Succesfully Book Appointment, Please Wait for COnfirmation."); window.location.href = "home.php";</script>';
                    exit();
                } else {
                    echo '<script>alert("Failed to add pet: ' . $stmt->error . '"); window.location.href = "bookAppointment.php";</script>';
                }

                $stmt->close();
            } else {
        ?>

                <!--content -->
                <div class="container">
                    <div class="wrapper">
                        <form method="post">
                            <h3 style="text-align: center;">Review before submission</h3>
                            <p style="text-align: center;">Update any relevant information as needed</p><br>
                            <h5>Owners Name: <span style="color:red; margin-left:50vh;"><?php echo $fullName; ?></span></h5>
                            <h5>Contact No: <span style="color:red; margin-left:50vh;"><?php echo $contact; ?></span></h5>
                            <p>_______________________________________________________________________________________________</p>
                            <h5>Pet Name: <span style="color:red; margin-left:52vh;"><?php echo $petname; ?></span></h5>
                            <h5>Type of Appointment: <span style="color:red; margin-left:30vh;"><?php echo $appointmentType; ?></span></h5>
                            <h5>Time: <span style="color:red; margin-left:58vh;"><?php echo $time_slot; ?></span></h5>
                            <h5>Date: <span style="color:red; margin-left:58vh;"><?php echo $date; ?></span></h5>
                            <h5>Type of Service: <span style="color:red; margin-left:45vh;"><?php echo $services; ?></span></h5>
                            <h5>Full Address: <span style="color:red; margin-left:50vh;"><?php echo isset($address) ? $address : "N/A"; ?></span></h5>
                            <!-- <a href="bookAppointmentEdit.php?fullName=<?php echo urlencode($fullName); ?>&contact=<?php echo urlencode($contact); ?>&petname=<?php echo urlencode($petname); ?>&appointmentType=<?php echo urlencode($appointmentType); ?>&time_slot=<?php echo urlencode($time_slot); ?>&date=<?php echo urlencode($date); ?>&service=<?php echo urlencode($services); ?>&address=<?php echo urlencode($address); ?>">Edit</a> -->
                            <p>_______________________________________________________________________________________________</p>
                            <a href="bookAppointment.php" class="btn btn-outline-danger" type="button">Back</a>
                            <button class="btn btn-primary" type="submit" name="book">Book Appointment</button>
                        </form>
                <?php
            }
        } else {
            echo '<script>alert("Invalid Data."); window.location.href = "bookAppointment.php";</script>';
        }
                ?>
                    </div>
                </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </html>