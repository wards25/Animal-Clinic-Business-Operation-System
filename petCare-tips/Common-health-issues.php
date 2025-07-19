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
                        <a class="nav-link text-color" name="submit" href="../about.php">About</a>
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
            <h2 style="font-weight: bold;">Common Health Issues: A Guide to Prevention and Care</a></h2><br>
            <div class="mb-3">
                <img src="../img/icebag-dog.jpg" class="card-img-top" alt="..." style="height: 600px; width:900px;">
                <div class="card-body">
                    <p class="card-text">staying informed and proactive, we can ensure our pets lead happy, healthy lives free from common health issues. Stay tuned for more in-depth articles on specific health concerns and preventive measures for our cherished companions!</p>
                </div>
            </div>
            <div class="health-issue">
                <h2>1. Obesity:</h2>
                <ul>
                    <li>Overfeeding and lack of exercise contribute to obesity in pets.</li>
                    <li>Combat obesity through a balanced diet and regular exercise tailored to your pet's needs.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>2. Dental Problems:</h2>
                <ul>
                    <li>Dental issues, such as tartar buildup and gum disease, are common.</li>
                    <li>Implement regular dental care routines, including brushing and providing dental treats or toys.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>3. Parasitic Infestations:</h2>
                <ul>
                    <li>Fleas, ticks, and worms can cause discomfort and health issues.</li>
                    <li>Use vet-recommended preventive treatments to keep parasites at bay.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>4. Allergies:</h2>
                <ul>
                    <li>Pets can develop allergies to food, pollen, or environmental factors.</li>
                    <li>Identify and eliminate allergens, and consult your vet for suitable treatments.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>5. Arthritis:</h2>
                <ul>
                    <li>Joint problems and arthritis are common in older pets.</li>
                    <li>Provide joint supplements, a comfortable bed, and moderate exercise to support joint health.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>6. Ear Infections:</h2>
                <p>Ear infections may result from moisture, allergies, or wax buildup.</p>
                <p>Regularly clean your pet's ears and seek veterinary attention for persistent issues.</p>
            </div>

            <div class="health-issue">
                <h2>7. Urinary Tract Infections (UTIs):</h2>
                <ul>
                    <li>UTIs can affect both dogs and cats.</li>
                    <li>Encourage hydration, maintain clean litter boxes, and seek prompt veterinary care for symptoms.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>8. Respiratory Issues:</h2>
                <ul>
                    <li>Respiratory problems can arise from infections or environmental factors.</li>
                    <li>Keep a smoke-free environment and address respiratory symptoms promptly.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>9. Skin Conditions:</h2>
                <ul>
                    <li>Allergies, parasites, or fungal infections may cause skin problems.</li>
                    <li>Regular grooming, a balanced diet, and parasite prevention help maintain healthy skin.</li>
                </ul>
            </div>

            <div class="health-issue">
                <h2>10. Diabetes:</h2>
                <ul>
                    <li>Diabetes is increasingly common in pets, often linked to obesity.</li>
                    <li>Monitor your pet's weight, provide a balanced diet, and seek veterinary guidance.</li>
                </ul>
            </div>

        </div>
    </div>







    <ul class="pagination fixed-bottom justify-content-center">
        <li class="page-item">
            <a class="page-link" href="basic-petCare-101.php">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="basic-petCare-101.php" aria-selected="false">1</a>
        </li>
        <li class="page-item" aria-current="page">
            <a class="page-link active" href="Common-health-issues.php" aria-selected="true">2</a>
        </li>
        <li class="page-item"><a class="page-link" href="nutrition-tips-for-your-pets.php" aria-selected="false">3</a></li>
        <li class="page-item">
            <a class="page-link" href="nutrition-tips-for-your-pets.php">Next</a>
        </li>
    </ul>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>