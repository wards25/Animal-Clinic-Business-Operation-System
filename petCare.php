<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        margin-top: 100px;
        margin-bottom: 60px;
        width: 120vh;

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

    .owl-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .owl-prev,
    .owl-next {
        background-color: #333;
        color: #fff;
        padding: 10px;
        cursor: pointer;
    }

    .petcare-tips a {
        text-decoration: none;
        color: black;
    }

    .petcare-tips a:hover {
        color: #F28500;
        transition: ease-in-out;
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

    <!------------content------------->
    <div class="card text-bg-dark" style="height: 450px; border-radius: 0;">
        <div class="card-img-overlay">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="img-fluid" src="./img/friends-nobg.png" alt="" style="height: 400px;">
                </div>
                <div class="col-md-8">
                    <span style="font-size:80px; font-family:Aresenal;">Paws and Whiskers</span>
                    <h6>Exploring the World of Animal Companionship</h6>
                    <span>______________________________________________________________________________________________</span>
                    <p>"Embark on a journey of love and companionship with our furry, feathered, and scaly friends"</p>
                    <span>Discover heartwarming stories, expert pet care tips, and the joy of nurturing a lifelong bond on our animal-loving blog"</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="wrapper">
            <div class="petcare-tips" style='font-family: "Nunito",Arial,Helvetica,sans-serif'>
                <div class="mb-3">
                    <img src="./img/pet-care-101.jpg" class="card-img-top mx-auto" alt="..." style="height: 300px; width:500px; display:block; margin-bottom:20px; border-radius:20px;">
                    <div class="card-body">
                        <h2><a href="./petCare-tips/basic-petCare-101.php" style="font-weight: bold;">Basic Pet Care 101: A Guide to Happy and Healthy Companions</a></h2>
                        <p>Welcome to our pet care corner, where we embark on a journey to ensure the well-being and happiness of our beloved animal friends. Whether you're a seasoned pet owner or considering bringing a new furry, feathery, or scaly companion into your life, this guide covers the fundamental aspects of responsible and loving pet care.</p>
                        <button class="btn btn-primary"><a href="./petCare-tips/basic-petCare-101.php" style="color: whitesmoke;">Continue Reading</a></button>
                    </div>
                </div>

                <br>

                <div class="mb-3">
                    <img src="./img/icebag-dog.jpg" class="card-img-top mx-auto" alt="..." style="height: 370px; width:500px; display:block; margin-bottom:20px; border-radius:20px;">
                    <div class="card-body">
                        <h2><a href="./petCare-tips/Common-health-issues.php" style="font-weight: bold;">Common Health Issues: A Guide to Prevention and Care</a></h2>
                        <p>As devoted pet parents, our priority is ensuring the well-being of our beloved companions. Understanding the common health issues that our furry, feathered, or scaled friends may face is crucial for proactive care and early intervention. Let's delve into some prevalent health concerns among pets and how to address them</p>
                        <button class="btn btn-primary"><a href="./petCare-tips/Common-health-issues.php" style="color: whitesmoke;">Continue Reading</a></button>
                    </div>
                </div>

                <br>

                <div class="mb-3">
                    <img src="./img/cat-eating.jpg" class="card-img-top mx-auto" alt="..." style="height: 370px; width:500px; display:block; margin-bottom:20px; border-radius:20px;">
                    <div class="card-body">
                        <h2><a href="./petCare-tips/nutrition-tips-for-your-pets.php" style="font-weight: bold;">Nutrition tips for your companion</a></h2>
                        <p>Welcome to our pet care corner, where we embark on a journey to ensure the well-being and happiness of our beloved animal friends. Whether you're a seasoned pet owner or considering bringing a new furry, feathery, or scaly companion into your life, this guide covers the fundamental aspects of responsible and loving pet care.</p>
                        <button class="btn btn-primary"><a href="./petCare-tips/nutrition-tips-for-your-pets.php" style="color: whitesmoke;">Continue Reading</a></button>
                    </div>
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
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: true,
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