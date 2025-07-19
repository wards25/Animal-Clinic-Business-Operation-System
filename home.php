<?php
session_start();
include('connection.php');
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>AnimalClinic</title>
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
        padding-bottom: 250px;
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

    .owl-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .owl-carousel .card {
        height: 80vh;
    }

    .owl-prev,
    .owl-next {
        background-color: #333;
        color: #fff;
        padding: 10px;
        cursor: pointer;
    }

    .img {
        background-color: whitesmoke;
        border-radius: 70%;
        height: 60px;
    }

    footer {
        margin-top: auto;
    }
</style>
<!------profile query----->
<?php
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

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
                <i class="fa-solid fa-bars fa-sm" style="color: #ffffff;"></i>
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
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        </ul>
                    </li>
                    </ul>'; ?>
                </div>
            </div>
        </div>
    </nav>

    <!--hero section-->
    <div class="card text-bg-dark" style="margin-bottom:50px;">
        <img src="./img/dog-owner-bg.jpg" class="card-img" alt="..." style="max-height: 95vh;">
        <div class="card-img-overlay" style="margin-top: 20vh; margin-left:10vh; font-family: Arsenal;">
            <h1 class="card-title" style="color: white; font-size:70px; font-weight:bold;">Providing <span style="color:black;">Special</span></h1>
            <h1 class="card-title" style="color: white; font-size:55px;">Care for your <span style="color: black;">Pets</span></h1>
            <strong class="card-text" style="color:whitesmoke">we are dedicated to providing exceptional veterinary services for your beloved pets.</strong><br><br>
            <a href="bookAppointment.php"><button class="btn btn-primary">Book Appointment</button></a>
        </div>
    </div>


    <!--features-->
    <div class="column-features-container">
        <div class="column-features-wrapper">
            <h3 class="text-center">Services Offered</h3>
            <!--carousel-->
            <div class="owl-carousel">
                <div class="card" style="width: 18rem;">
                    <img src="./img/consultation of 40742cc5-4a7a-49e7-8ca1-000b33c803b0.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-center">Consultation</h3>
                        <p class="text-center">Vet Consult starts at P400</p>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Client Education</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Diagnosis</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Preventive Care</small><br><br>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="./img/grooming of pet b3c1e0ca-de6d-4278-8737-7c26003b17be.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-center">Grooming</h3>
                        <p class="text-center">Grooming starts at P750</p>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Salon Experience</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Dog Grooming</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-xmark fa-lg" style="color: #cc0000;"></i> Cats Grooming</small><br><br>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="./img/vaccination of  a5d4205f-906d-4102-89ed-35b65f588c18.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-center">Vaccination</h3>
                        <p class="text-center">Vaccination starts at P500</p>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Anti-rabies</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Deworming</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> 5 in one</small><br><br>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="./img/dog supplies an 80b69cd8-e739-49e6-b857-f2403996daf1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title text-center">Vitamins and Medicines</h3>
                        <p class="text-center">Vaccination starts at P200</p>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Quality medicines</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> Trusted Brands</small><br><br>
                        <small class="card-text"><i class="fa-solid fa-circle-check fa-lg" style="color: #039900;"></i> 5 in one</small><br><br>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="./img/cat pet having  62d8ec24-9a54-4e7e-8e68-75bcb27c041f.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">Home Service</h3>
                        <p class="card-text">Whether your pet needs vaccines, veterinary consultations, or simple companionship, our team of trained professionals is equipped to deliver top-notch services in the comfort of your home. </p>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--products-->
    <div class="products-container">
        <div class="products-wrapper">
            <h3 class="text-center">Products</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="./img/lymedox.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Cat Food</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-body-secondary">Price: ₱59.99 KL</small>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="./img/dog food 2afe9a5a-fd6b-4a83-bed5-da06e84fc704.png" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Dog Food</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-body-secondary">Price: ₱79.99 KL</small>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="./img/product shampoo d520e9b7-7dc0-40e0-9a6b-9e74d8adf00a.png" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Shampoo</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-body-secondary">Price: ₱150.00</small>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="products.php"><button class="btn btn-outline-warning">See more</button></a>
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
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: false,
            autoplayTimeout: 2000,
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
        });

        // Go to the next item
        $('.owl-next').click(function() {
            owl.trigger('next.owl.carousel');
        });

        // Go to the previous item
        $('.owl-prev').click(function() {
            owl.trigger('prev.owl.carousel', [300]);
        });
    });
</script>

</html>