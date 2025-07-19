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
    .pet-care-tip {
      margin-bottom: 20px;
    }
    .pet-care-tip h3 {
      color: #2a2a2a;
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
                            <li><a class="dropdown-item" href="../logout.php"><button class="btn btn-danger">Logout</button></a></li>
                            <li><a class="dropdown-item" href="../settings.php">Settings</a></li>
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
            <h2 style="font-weight: bold;">Basic Pet Care 101: A Guide to Happy and Healthy Companions</h2><br>
            <div class="mb-3 mx-auto">
                <img src="../img/pet-care-101.jpg" class="card-img-top" alt="..." style="height: 600px; width:900px; display:block">
                <div class="card-body">
                    <p class="card-text">Incorporating these basic pet care principles into your routine, you're setting the foundation for a happy, healthy, and fulfilling life for your beloved companion. Stay tuned for more in-depth articles on specific aspects of pet care, and let the journey of pet parenthood be a joyful one!</p>
                </div>
            </div>

            <!-- 1. Nutrition Matters -->
            <div class="pet-care-tip">
                <h3>1. Nutrition Matters:</h3>
                <ul>
                    <li>Provide a balanced and species-appropriate diet.</li>
                    <li>Consult with your veterinarian for personalized nutrition advice.</li>
                    <li>Ensure access to fresh and clean water at all times.</li>
                </ul>
            </div>

            <!-- 2. Regular Exercise -->
            <div class="pet-care-tip">
                <h3>2. Regular Exercise:</h3>
                <ul>
                    <li>Engage your pet in daily physical activities suitable for their breed and size.</li>
                    <li>Regular walks, playtime, and interactive toys are excellent for mental and physical stimulation.</li>
                </ul>
            </div>

            <!-- 3. Health Check-ups -->
            <div class="pet-care-tip">
                <h3>3. Health Check-ups:</h3>
                <ul>
                    <li>Schedule regular veterinary visits for check-ups and vaccinations.</li>
                    <li>Keep an eye out for any changes in behavior, appetite, or physical appearance.</li>
                </ul>
            </div>

            <!-- 4. Clean Living Spaces -->
            <div class="pet-care-tip">
                <h3>4. Clean Living Spaces:</h3>
                <ul>
                    <li>Maintain a clean and safe environment for your pet.</li>
                    <li>Regularly clean bedding, toys, and litter boxes to prevent the spread of germs.</li>
                </ul>
            </div>

            <!-- 5. Grooming Routine -->
            <div class="pet-care-tip">
                <h3>5. Grooming Routine:</h3>
                <ul>
                    <li>Establish a grooming routine based on your pet's needs.</li>
                    <li>Brush fur, trim nails, clean ears, and attend to dental care regularly.</li>
                </ul>
            </div>

            <!-- 6. Identification and Safety -->
            <div class="pet-care-tip">
                <h3>6. Identification and Safety:</h3>
                <ul>
                    <li>Ensure your pet has proper identification, including a collar with tags and a microchip.</li>
                    <li>Pet-proof your home to prevent accidents and injuries.</li>
                </ul>
            </div>

            <!-- 7. Socialization -->
            <div class="pet-care-tip">
                <h3>7. Socialization:</h3>
                <ul>
                    <li>Socialize your pet with positive experiences from a young age.</li>
                    <li>Encourage positive interactions with other animals and people.</li>
                </ul>
            </div>

            <!-- 8. Parasite Prevention -->
            <div class="pet-care-tip">
                <h3>8. Parasite Prevention:</h3>
                <ul>
                    <li>Implement a regular parasite prevention plan, including flea, tick, and worm control.</li>
                    <li>Consult your veterinarian for the most effective and safe preventive measures.</li>
                </ul>
            </div>

            <!-- 9. Love and Attention -->
            <div class="pet-care-tip">
                <h3>9. Love and Attention:</h3>
                <ul>
                    <li>Spend quality time with your pet to strengthen your bond.</li>
                    <li>Offer love, attention, and positive reinforcement to encourage good behavior.</li>
                </ul>
            </div>

            <!-- 10. Emergency Preparedness -->
            <div class="pet-care-tip">
                <h3>10. Emergency Preparedness:</h3>
                <ul>
                    <li>Have a basic first aid kit for your pet.</li>
                    <li>Know the location of the nearest veterinary emergency clinic.</li>
                </ul>
            </div>
        </div>
    </div>







    <!-----------------pagination----------->
    <div class="pagination fixed-bottom justify-content-center fixed">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="../petCare.php">Previous</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="basic-petCare-101.php" aria-selected="true">1</a></li>
            <li class="page-item">
                <a class="page-link" href="Common-health-issues.php" aria-selected="false">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="nutrition-tips-for-your-pets.php" aria-selected="false">3</a></li>
            <li class="page-item">
                <a class="page-link" href="Common-health-issues.php">Next</a>
            </li>
        </ul>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>