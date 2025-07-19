<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Animal Clinic</title>
</head>
<style>
    body {
        /*display: flex;
        flex-direction: column;
        margin: 0;
        min-height: 100vh;*/
        background-color: #CDD5FF;
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

    .container {
        display: flex;
        text-align: center;
        justify-content: center;
        align-items: center;
    }

    .wrapper {
        padding: 20px;
        margin-bottom: 50px;
        width: 180vh;
        background: rgba(11, 29, 81, 0.7);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        border-radius: 10px;
        color: whitesmoke;
        font-family: Arial, Helvetica, sans-serif;
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
        border-radius: 70px;
        background-color: whitesmoke;
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
        width: 180vh;
        height: 700px;
    }

    .products-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 100px;
    }

    .products-wrapper {
        padding: 20px;
        width: 180vh;
        background: rgba(11, 29, 81, 0.7);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        border-radius: 10px;
    }

    .products-container .products-wrapper label {
        color: whitesmoke;
    }

    footer {
        margin-top: auto;
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

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './mailer/src/Exception.php';
require './mailer/src/PHPMailer.php';
require './mailer/src/SMTP.php';

if (isset($_POST['send'])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'animalclinic.main@gmail.com';
    $mail->Password = 'zjhj zefl jspu xrav'; // Use environment variable or configuration file
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;


    $mail->setFrom($_POST['email'], 'Client');
    $mail->addAddress('animalclinic717@gmail.com');
    $mail->Subject = 'Query';
    $mail->Body = ($_POST['message']);

    try {
        $mail->send();
        $alertMessage = '<div id="autoDismissAlert" class="alert alert-success" role="alert" style="font-weight: bold; color:whitesmoke; background-color:green; opacity:0.9;">
    Send Successfully
  </div>';
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
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
                            <li><a class="dropdown-item" href="products.php">Products</a></li>
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

                <!--modal profile-->
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
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                        </ul>
                    </li>
                    </ul>'; ?>
                </div>
            </div>
        </div>
    </nav>

    <!--section about us-->
    <div class="" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="./img/38389590365.png" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body card-about-text" style="margin-top: 50px;">
                    <h1 class="card-title">Mission Vission</h1>
                    <p class="card-text"><strong>Mission:</strong>To provide compassionate and comprehensive veterinary care to our animal patients, enhancing their health and well-being while fostering strong relationships with their human companions. We strive to uphold the highest standards of medical excellence, professionalism, and integrity in our practice."<strong>Vision:</strong> "Our vision is to be the trusted partner in pet healthcare within our community, known for our commitment to exceptional service, progressive medicine, and client education. We aim to continuously innovate and adapt to meet the evolving needs of both pets and their owners, ensuring a lifetime of health, happiness, and companionship."</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="wrapper">
            <h1>About Us</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.790940802444!2d121.17927907457116!3d14.496687479613414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c3fd30690bb9%3A0x49c5072bab7eb871!2sFeje%20Veterinary%20Clinic!5e0!3m2!1sen!2sph!4v1704522126523!5m2!1sen!2sph" width="1100" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p>Feje Veterinary Clinic is located in Pantok, Binangonan Rizal.</p>
            <br>
            <h1 class="card-title">Clinic Hours</h1>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-text">Monday - Saturday: 8:00 AM - 5:00 PM.</h3>
                    <h3 class="card-text">Sunday: 8:00 AM - 12:00 PM.</h3>
                    <br>
                    <p>Emervit || Emerplex || Prefolic-Cee || Hepatosure || Emerflox || Lymedox || Riflexine || Tritozine || Tolfenol</p>
                </div>
            </div>
        </div>
    </div>
   <!--footer-->
   <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card" style="background-color: #0B1D51; color: whitesmoke;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title">Quick Links</h5>
                                    <a href="home.php" style="color:whitesmoke;"><small class="card-text">Home</small></a><br>
                                    <a href="products.php" style=" color:whitesmoke;"><small class="card-text">Products</small><br></a>
                                    <a href="bookAppointment.php" style=" color:whitesmoke;"><small class="card-text">Book Appointment</small><br></a>
                                    <a href="schedule.php" style=" color:whitesmoke;"><small class="card-text">Schedule</small><br></a>
                                    <a href="petCare.php" style=" color:whitesmoke;"><small class="card-text">Pet Care</small><br></a>
                                    <a href="myPet-Primary.php" style=" color:whitesmoke;"><small class="card-text">My Pet</small><br></a>
                                    <a href="about.php" style=" color:whitesmoke;"><small class="card-text">About</small><br></a>
                                    <a href="chatRoom.php" style=" color:whitesmoke;"><small class="card-text">Chat</small><br></a>
                                </div>
                                <!-- First column -->
                                <div class="col-md-4">
                                    <h5 class="card-title">Service Offered</h5>
                                    <small class="card-text">Consultation</small><br>
                                    <small class="card-text">Grooming</small><br>
                                    <small class="card-text">Vaccination</small><br>
                                    <small class="card-text">Medicines</small><br>
                                    <small class="card-text">Home Service</small>
                                </div>
                                <!-- Second column -->
                                <div class="col-md-4">
                                    <h5 class="card-title">Contact Info</h5>
                                    <small class="card-text"><i class="fa-solid fa-location-dot" style="color: #ffffff;"></i> Pantok Binangonan Rizal</small><br>
                                    <small class="card-text"><i class="fa-solid fa-phone" style="color: #ffffff;"></i> Phone: 0950-7808-703</small><br>
                                    <small class="card-text"><a href="https://www.facebook.com/profile.php?id=100054754840642" style=" color:whitesmoke;"><i class="fa-brands fa-facebook" style="color: #ffffff;"></i> Facebook</a></small><br>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="background-color: #0B1D51; color: whitesmoke; text-align: center;">
                            © 2023 Animal Clinic. All rights reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#autoDismissAlert").alert('close');
        }, 3000);

        // Show the background alert
        $(".background-alert").show();
    });
</script>

</html>