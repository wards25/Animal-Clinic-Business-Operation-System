<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>AnimalClinic</title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">

</head>
<style>
    /* Basic CSS styles */
    .card {
        height: 70vh;
        overflow-y: scroll;
        border: 1px solid #ccc;
        padding: 10px;
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
    }else {
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
                                                <a class="nav-link has-arrow  collapsed " href="inventory.php" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart nav-icon me-2 icon-xxs">
                                                        <circle cx="9" cy="21" r="1"></circle>
                                                        <circle cx="20" cy="21" r="1"></circle>
                                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                                    </svg> Products
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
                                    <h3 class="mb-0  text-white">Pets Medical History</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card  -->
                    <div class="card">
                        <?php

                        $sqls = $con->prepare("SELECT a.animalid, u.firstname, u.lastname, a.imageData, a.petname, a.gender, a.age, a.pettype, a.breed, a.color
                        FROM userstb u
                        INNER JOIN animaltb a ON u.userid = a.userid;
                        ");
                        $sqls->execute();
                        $results = $sqls->get_result();
                        ?>

                        <!-- table  -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <?php if ($results->num_rows > 0) { ?>
                                    <table class="table text-nowrap mb-0 table-centered table-hover">
                                        <thead style="background-color: #0B1D51;">
                                            <tr>
                                                <th style="color: whitesmoke;">Pet Profile</th>
                                                <th style="color: whitesmoke;">Owners Name</th>
                                                <th style="color: whitesmoke;">Pet Name</th>
                                                <th style="color: whitesmoke;">Gender</th>
                                                <th style="color: whitesmoke;">Age</th>
                                                <th style="color: whitesmoke;">Pet type</th>
                                                <th style="color: whitesmoke;">Breed</th>
                                                <th style="color: whitesmoke;">Color</th>
                                                <th style="color: whitesmoke;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while ($row = $results->fetch_assoc()) {

                                            $ownersFullname = $row['firstname'] . ' ' . $row['lastname'];
                                            $petname = $row['petname'];
                                            $gender = $row['gender'];
                                            $age = $row['age'];
                                            $pettype = $row['pettype'];
                                            $breed = $row['breed'];
                                            $color = $row['color'];
                                            $imageData = $row['imageData'];

                                            echo ' <tr>';
                                            echo ' <td>';
                                            if (isset($imageData)) {
                                                echo '<img src="data:image/jpg;charset=utf8;base64, ' . base64_encode($imageData) . '" style="height: 50px;">';
                                            } else {
                                                echo '<img src="../img/img-symbol.png" style="height: 50px;">';
                                            }
                                            echo ' </td>';
                                            echo ' <td>
                                                            <h5 class=" mb-1">' . $ownersFullname . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $petname . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $gender . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $age . '</h5>
                                                        </td>
                                                        <td>
                                                        ' . $pettype . '
                                                        </td>
                                                        <td>
                                                        ' . $breed . '
                                                        </td>
                                                        <td>
                                                        ' . $color . '
                                                        </td>
                                                        <td>
                                                        <button class="btn btn-success btn-medical-history" data-pet-id="' . $row['animalid'] . '" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal"> + Medical History</button>
                                                        </td>
                                                    </tr>';
                                        }
                                    } else {
                                        echo '<h1 class="text-center text-danger"style="padding: 100px;">No Scheduled Appointments</h1>';
                                    } ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="medicalHistoryModal" tabindex="-1" aria-labelledby="medicalHistoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="medicalHistoryModalLabel">Add Medical History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Medical history form -->
                        <form id="medicalHistoryForm" method="post">
                            <input type="hidden" id="petId" name="animalid" value="">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">weight</label>
                                <input type="text" class="form-control" name="weight" required></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Vaccine</label>
                                <input type="text" class="form-control" name="vaccine" required></input>
                            </div>
                            <!-- Add more fields as needed -->
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $petId = $_POST['animalid'];
            $date = $_POST['date'];
            $weight = $_POST['weight'];
            $vaccine = $_POST['vaccine'];

            $sql = "INSERT INTO petrecordstb (date, weight, vaccine, animalid, veterinarian) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssis", $date, $weight, $vaccine, $petId, $username);

                // Execute statement
                if (mysqli_stmt_execute($stmt)) { ?>
                    <script>
                        Swal.fire({
                            title: "Successfully Add!",
                            text: "You clicked the button!",
                            icon: "success"
                        }).then((result) => {
                            // Check if the user clicked the "OK" button
                            if (result.isConfirmed) {
                                // Redirect to a new URL
                                window.location.href = "pets.php";
                            }
                        });
                    </script>
        <?php
                } else {
                    // Error occurred while executing statement
                    echo "Error: " . mysqli_error($con);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                // Error occurred while preparing statement
                echo "Error: " . mysqli_error($con);
            }
        }
        ?>
    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-medical-history').click(function() {
            var petId = $(this).data('pet-id');
            $('#petId').val(petId);
        });
    });
</script>

</html>