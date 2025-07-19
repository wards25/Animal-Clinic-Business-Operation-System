<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <title>Homepage</title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">

</head>

<style>
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
        header("location: ../login.php");
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
                                                <a class="nav-link  " href="./pages/apps-file-manager.html">
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


        <div id="app-content">
            <!-- Container fluid -->
            <div class="app-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="mb-5">
                                <h3 class="mb-0">Accoounts</h3>
                            </div>
                        </div>
                    </div>

                    <?php
                    //Counting of users in appointment tbl
                    $sqlUsers = $con->prepare("SELECT * FROM userstb");
                    $sqlUsers->execute();
                    $resultUsers = $sqlUsers->get_result();
                    ?>
                    <div>
                        <!-- row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-md-flex border-bottom-0">
                                        <div class="flex-grow-1">
                                            <a href="#!" class="btn btn-primary" style="margin-top: 25px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ Add User</a>
                                        </div>
                                        <form id="liveSearchForm" role="search">
                                            <div class="input-group " style="margin-top: 20px;">
                                                <input class="form-control rounded-3" type="search" name="search" placeholder="Search" aria-label="Search" oninput="performSearch()">
                                                <span class="input-group-append">
                                                    <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="row">

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div id="liveSearchResults">
                                                            <?php if ($resultUsers->num_rows > 0) { ?>
                                                                <table class="table text-nowrap mb-0 table-centered table-hover">
                                                                    <thead style="background-color: #1B3C73;">
                                                                        <tr>
                                                                            <th scope="col" style="color: whitesmoke;">Profile</th>
                                                                            <th scope="col" style="color: whitesmoke;">Firstname</th>
                                                                            <th scope="col" style="color: whitesmoke;">Lastname</th>
                                                                            <th scope="col" style="color: whitesmoke;">Username</th>
                                                                            <th scope="col" style="color: whitesmoke;">Contact</th>
                                                                            <th scope="col" style="color: whitesmoke;">UserType</th>
                                                                            <th scope="col" style="color: whitesmoke;">Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    while ($row = $resultUsers->fetch_assoc()) {
                                                                        $imageData = $row['imageData'];
                                                                        $firstname = $row['firstname'];
                                                                        $lastname = $row['lastname'];
                                                                        $userName = $row['username'];
                                                                        $contact = $row['contact'];
                                                                        $usertype = $row['usertype'];
                                                                        $status = $row['status'];

                                                                        // Determine badge color based on status
                                                                        $badgeColor = ($status == 'online') ? 'bg-success' : 'bg-custom';

                                                                        echo '<tr>
                                                                    <td>' . (isset($imageData) ? '<img class="profileImage" id="selectedImageProfile" src="data:image/jpg;charset=utf8;base64,' . base64_encode($imageData) . '" />' : '<i class="fa-solid fa-user-large fa-2xl"></i>') . '</td>
                                                                    <td>' . $firstname . '</td>
                                                                    <td>' . $lastname . '</td>
                                                                    <td>' . $userName . '</td>
                                                                    <td>' . $contact . '</td>
                                                                    <td>' . $usertype . '</td>
                                                                    <td><span class="badge rounded-pill  ' . $badgeColor . '" style=" background-color: rgba(90, 90, 90, 0.5);">' . $status . '</span></td>
                                                                </tr>';
                                                                    }
                                                                } else {
                                                                    echo '<h1 class="text-center text-danger"style="padding: 100px;">No Users Saved</h1>';
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
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                                echo '<script>alert("Please upload a JPEG, PNG, or GIF."); window.location.href = "accounts.php";</script>';
                                exit;
                            }

                            $maxFileSize = 5 * 1024 * 1024; // 5 MB
                            if ($_FILES['image']['size'] > $maxFileSize) {
                                echo '<script>alert("File size exceeds 5MB. Please upload a smaller file."); window.location.href = "accounts.php";</script>';
                                exit;
                            }
                            $imageData = file_get_contents($_FILES['image']['tmp_name']);
                        } else {
                            $imageData = null;
                        }
                        $firstnames = $_POST['firstname'];
                        $lastnames = $_POST['lastname'];
                        $usernames = $_POST['username'];
                        $contactnos = $_POST['contact'];
                        $passwords = $_POST['password'];
                        $confirmpasswords = $_POST['confirmpassword'];
                        $usertypes =  $_POST['usertype'];

                        $checkStmt = $con->prepare("SELECT * FROM userstb WHERE username = ?");
                        $checkStmt->bind_param("s", $usernames);
                        $checkStmt->execute();
                        $result = $checkStmt->get_result();


                        if ($passwords != $confirmpasswords) {
                        } else {
                            if ($result->num_rows > 0) {
                            } else {
                                // Check if passwords match
                                if (strlen($passwords) < 8) {
                                    $err_msg = '<div class="err_msg1"><i class="fa-solid fa-circle-info fa-sm" style="color: #e20303;"></i> Password must be atleast 8 characters</div>';
                                } else {
                                    $hashed = password_hash($passwords, PASSWORD_DEFAULT);
                                    $stmt = $con->prepare("INSERT INTO userstb( imageData, firstname, lastname, username, contact, password, usertype) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                    $stmt->bind_param("sssssss", $imageData, $firstnames, $lastnames, $usernames, $contactnos, $hashed, $usertypes);

                                    // for audit trail
                                    $usertype = $_SESSION['usertype'];
                                    $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Add User')");

                                    // Execute the statement
                                    if ($stmt->execute()) {
                                        echo '<script>
                                        alert("Successfully created account");
                                        window.location.href = "accounts.php";
                                    </script>';
                                    } else {
                                        echo '<script>
                                        alert("Error creating account: ' . mysqli_error($con) . '");
                                        window.location.href = "accounts.php";
                                    </script>';
                                    }

                                    // Close the statement
                                    $stmt->close();
                                }
                            }
                        }
                    }
                    ?>
                    <!-- Modal -->
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="image-container" style=" display:flex; justify-content:center; ">
                                            <div class="image-container-inner" style="background-color:white; height:150px; border-radius: 20px; width:200px; margin-bottom:10px; ">
                                                <img id="selectedImages" style="height: 150px; width: 200px; border-radius:20px; object-fit: cover; border-style:solid;">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input class="form-control" id="fileInputs" type="file" onchange="displayImages()" name="image" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">First Name <span style="color: red; font-size: 20px;">*</span></label>
                                            <input class="form-control" name='firstname' required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Last Name <span style="color: red; font-size: 20px;">*</span></label>
                                            <input class="form-control" name='lastname' required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">UserName <span style="color: red; font-size: 20px;">*</span></label>
                                            <input class="form-control" name='username' required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contact No. <span style="color: red; font-size: 20px;">*</span></label>
                                            <input class="form-control" name='contact' required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password <span style="color: red; font-size: 20px;">*</span></label>
                                            <input type="password" class="form-control" id="password" name='password' required>
                                            <button type="button" id="toggleBtn" class="toggle-btn" onclick="togglePassword()">
                                                <i id="eyeIcon" class="eye-icon fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password <span style="color: red; font-size: 20px;">*</span></label>
                                            <input type="password" class="form-control" id="password" name="confirmpassword" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">User Type<span style="color: red; font-size: 20px;">*</span></label>
                                            <select class="form-select" name="usertype">
                                                <option disabled selected hidden>Select Your User Type</option>
                                                <option value="standard_User">client</option>
                                                <option value="admin">admin</option>
                                                <option value="clinic_Staff">clinic Staff</option>
                                                <option value="veterinary">Veterinary</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="addUser">Add User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
<!-- Bootstrap and Popper.js scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- SimpleBar script -->
<script src="https://unpkg.com/simplebar/dist/simplebar.min.js"></script>

<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>

<script>
    function displayImages() {
        var fileInput = document.getElementById('fileInputs');
        var selectedImage = document.getElementById('selectedImages');

        // Check if a file is selected
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set the source of the image to the data URL
                selectedImage.src = e.target.result;
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
<script>
    // Function to toggle the password visibility
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        // Toggle the type attribute between "password" and "text"
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
<script>
    // Check the condition in JavaScript and trigger SweetAlert accordingly
    <?php if ($passwords != $confirmpasswords) : ?>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Passwords ddi not match!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'accounts.php';
            }
        });
    <?php elseif ($result->num_rows > 0) : ?>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Username Already Exist",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'accounts.php';
            }
        });
    <?php endif ?>
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
            url: '../live_search/dashUsers.php',
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