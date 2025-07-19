<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care</title>
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
        width: 170vh;
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
        width: 120vh;
        height: 700px;
    }

    .img {
        background-color: whitesmoke;
        border-radius: 70%;
        height: 60px;
    }
</style>

<?php
session_start();
include("../connection.php");

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
            <a class="navbar-brand" href="home.php"><img src="../img/logo.png" class="img navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-color" aria-current="page" href="../home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../products.php">Products</a></li>
                            <li><a class="dropdown-item" href="../bookAppointment.php">Book Appointment</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../schedule.php">Schedule</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="../petCare.php">Pet Care</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="../myPet-Primary.php">My Pet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-color" href="../about.php">About</a>
                    </li>
                </ul>

                <!--Drop down profile-->
                <div class="container-profile">
                    <div class="container-profile-inner">
                        <?php
                        if (isset($image)) {
                            echo '<img id="selectedImage" src="data:image/jpg;charset=utf8;base64,' . base64_encode($image) . '" />';
                        } else {
                            echo ' <img id="selectedImage" src="../img/pngwing.com.png"/>';
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

    <!--content -->
    <div class="container">
        <div class="wrapper">
            <h2 style="font-weight: bold;">Nourishing Your Companion: Essential Nutrition</a></h2><br>
            <div class="mb-3">
                <img src="../img/cat-eating.jpg" class="card-img-top" alt="..." style="height: 600px; width:900px;">
                <div class="card-body">
                    <p class="card-text">we'll explore some essential nutrition tips to ensure your companion's health and happiness.</p>
                </div>
            </div>
            <div class="content1">
                <h2>1. Quality Ingredients:</h2>
                <ul>
                    <li>Ensure that your companion's food is made from high-quality ingredients. </li>
                    <li>Look for a well-balanced mix of proteins, fats, and carbohydrates, with a focus on natural and whole-food sources. Avoid artificial additives and fillers.</li>
                </ul>
            </div>

            <div class="content2">
                <h2>2. Tailor to their Species:</h2>
                <ul>
                    <li>Different companions have different dietary needs. Whether you have a dog, cat, bird, rabbit, or reptile, it's crucial to understand and cater to their specific nutritional requirements.</li>
                    <li>Consult with your veterinarian to create a diet plan that suits your companion's species, breed, and individual health needs.</li>
                </ul>
            </div>

            <div class="content3">
                <h2>3. Portion Control:</h2>
                <ul>
                    <li>Just like in humans, portion control is essential for maintaining a healthy weight in companions. Overfeeding can lead to obesity and related health issues. </li>
                    <li>Follow the recommended portion sizes provided on the pet food packaging or consult with your vet to determine the appropriate amount for your companion's size and activity level.</li>
                </ul>
            </div>

            <div class="content4">
                <h2>4. Hydration is Key:</h2>
                <ul>
                    <li>Adequate water intake is vital for your companion's overall health. Ensure that fresh and clean water is always available.</li>
                    <li> Some companions may need more water than others, so pay attention to their individual needs.</li>
                </ul>
            </div>

            <div class="content5">
                <h2>5. Regular Exercise:</h2>
                <ul>
                    <li>Nutrition goes hand in hand with regular exercise. Tailor your companion's activity level based on their species and breed characteristics. </li>
                    <li>Dogs may need daily walks, cats may benefit from interactive play, and birds might enjoy flying around in a safe environment. Exercise helps maintain a healthy weight and promotes mental stimulation.</li>
                </ul>
            </div>

            <div class="content6">
                <h2>6. Avoid Harmful Foods:</h2>
                <p>Some human foods can be toxic to pets. Keep chocolate, caffeine, grapes, onions, and other harmful substances out of reach.</p>
                <p>Consult your vet to create a list of safe and unsafe foods for your specific pet. </p>
            </div>

            <div class="content7">
                <h2>7. Regular Vet Check-ups:</h2>
                <ul>
                    <li>Schedule regular veterinary check-ups to monitor your pet's overall health. Your vet can provide guidance on nutrition, address any concerns, and recommend specific dietary adjustments based on your companion's evolving needs.</li>

                </ul>
            </div>

            <div class="content8">
                <h2>8. Consider Dietary Supplements:</h2>
                <ul>
                    <li>Depending on your pet's health condition and diet, your vet may recommend dietary supplements. </li>
                    <li>Omega-3 fatty acids, joint supplements, and vitamins can support various aspects of your companion's health.</li>
                </ul>
            </div>
        </div>
    </div>

    <ul class="pagination fixed-bottom justify-content-center">
        <li class="page-item">
            <a class="page-link" href="Common-health-issues.php">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="basic-petCare-101.php" aria-selected="false">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="Common-health-issues.php" aria-selected="false">2</a>
        </li>
        <li class="page-item" aria-current="page">
            <a class="page-link active" href="nutrition-tips-for-your-pets.php" aria-selected="true">3</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link">Next</a>
        </li>
    </ul>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>