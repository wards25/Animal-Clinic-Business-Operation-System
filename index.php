<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Animal Clinic</title>
</head>
<style>
    body {
       margin: 0;
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

    .img {
        background-color: #CDD5FF;
        border-radius: 70%;
        height: 60px;
    }

  

    footer {
        margin-top: auto;
    }
</style>


<body>
    <!--navBar-->
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="./img/logo.png" class="img navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-color" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">Products</a></li>
                            <li><a class="dropdown-item" href="login.php">Book Appointment</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="login.php">Schedule</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="login.php">Pet Care</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="login.php">My Pet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="login.php">About</a>
                    </li>
                </ul>
                <a href="login.php"><button class="btn btn-warning" type="submit" style="margin-right:13px;">Log In</button></a>
                <a href="signup.php"><button class="btn btn-outline-warning" type="submit">Sign Up</button></a>
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
            <a href="login.php"><button class="btn btn-primary">Book Appointment</button></a>
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
                        <p class="text-center">Products starts at P200</p>
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
                                    <h5 class="card-title">lymedox 60ML</h5>
                                    <p class="card-text">Effective against respiratory infections, toxoplasmosis, kennel cough, urinary tract infections, wounds, and blood-bone infections.</p>
                                    <p class="card-text"><small class="text-body-secondary">Price: ₱200</small>
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
                                <img src="./img/hepatosure.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">hepatosure 60ML</h5>
                                    <p class="card-text">May cause mild stomach upset in hypersensitive animals. Take caution when giving to pregnant and lactating animals. Avoid giving to animals with Irritable Bowel Syndrome (IBS)</p>
                                    <p class="card-text"><small class="text-body-secondary">Price: ₱300</small>
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
                                <img src="./img/emerplex.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Emerplex 120ML</h5>
                                    <p class="card-text">Addresses various conditions such as excessive shedding, flea allergies, dirty and decaying teeth, motion sickness, weight gain and/or constipation</p>
                                    <p class="card-text"><small class="text-body-secondary">Price: ₱270</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <a href="products.php"  style=" color:whitesmoke;"><small class="card-text">Products</small><br></a>
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
                                <small class="card-text" ><a href="https://www.facebook.com/profile.php?id=100054754840642" style=" color:whitesmoke;"><i class="fa-brands fa-facebook" style="color: #ffffff;"></i> Facebook</a></small><br>
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