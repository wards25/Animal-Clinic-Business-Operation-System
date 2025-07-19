<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    .tab1 {
        padding: 30px;
        color: #0B1D51;
        font-family: Arial, Helvetica, sans-serif;
    }

    .tab-header img {
        height: 100px;
    }

    .tab-header {
        display: flex;
        justify-content: center;
        background-color: #CDFADB;
    }

    table.table th,
    table.table td {
        border: 2px solid #A5DD9B;
    }

    .history-table {
        margin: 100px;
    }

    .custom-table {
        width: 120vh;
        /* Set a fixed width for the table */
        margin: auto;
        text-align: center;
    }

    /* Set specific widths for columns */
    .custom-table th,
    .custom-table td {
        width: 150vh;
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
    $ownersname = $_SESSION['firstname'];
    $contact = $_SESSION['contact'];
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

$animalid = $_GET['animalid'];
$result = "SELECT * FROM animaltb WHERE animalid='$animalid'";
$query = mysqli_query($con, $result);

while ($row = mysqli_fetch_array($query)) {
    $petname = $row['petname'];
    $gender = $row['gender'];
    $age = $row['age'];
    $birthday = $row['birthday'];
    $pettype = $row['pettype'];
    $breed = $row['breed'];
    $color = $row['color'];
    $imagePet = $row['imageData'];
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
                    <li class="nav-item">
                        <a class="nav-link text-color" name="submit" href="chatRoom.php">Chat</a>
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
    <!-- Toast element -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true" style=" background-color: #ffc107; color:whitesmoke;">
            <div class="toast-header ">
                <i class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i><strong class="me-auto">Your pet is not vaccinated Yet!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <a href="bookAppointment.php" type="button" class="btn btn-primary"> Book appointment now</a>
            </div>
        </div>
    </div>
    <!--content -->
    <div class="container">
        <div class="wrapper">
            <ul class="nav nav-tabs justify-content-center navigation-tab" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#primary-details-tab-pane" type="button" role="tab" aria-controls="primary-details-tab-pane" aria-selected="true">Primary Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#vaccine-tab-pane" type="button" role="tab" aria-controls="vaccine-tab-pane" aria-selected="false">History</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!---------Primary details------>
                <div class="tab-pane fade show active tab1" id="primary-details-tab-pane" role="tabpanel" aria-labelledby="primary-details-tab" tabindex="0" style="width: 100vh;">
                    <div class="tab-header">
                        <img src="./img/dog-laying.png" alt="">
                        <h1>Animal Clinic</h1>
                        <img src="./img/cat-laydown.png" alt="">
                    </div>
                    <div style="background-color: #FFCF96; width:auto; height:10px;"></div>
                    <div class="tab-content">
                        <div class="row row-cols-2 row-cols-md-3" style=" margin-top:20px;">
                            <div class="col-md-5">
                                <div class="col-md-12">
                                    <h5>Pet Name: <?php echo $petname ?></h5> <br>
                                    <h5>Owners Name: <?php echo $ownersname ?></h5> <br>
                                    <h5>Contact No.: <?php echo $contact ?></h5> <br>
                                    <h5>Pet Age: <?php echo $age ?></h5> <br>
                                    <h5>Birthday: <?php echo $birthday ?></h5><br>
                                    <h5>Pet Type: <?php echo $pettype ?></h5><br>
                                    <h5>Breed: <?php echo $breed ?></h5><br>
                                    <h5>Color: <?php echo $color ?></h5><br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12" style="margin-top: 50px;">
                                    <?php
                                    if (isset($imagePet)) {
                                        echo '<img src="data:image/jpg;charset=utf8;base64,' . base64_encode($imagePet) . '" style="max-width: 100%; height: auto; max-height: 300px; border: 2px solid #000;">';
                                    } else {
                                        echo '<img src="./img/img-symbol.png" style="max-width: 100%; height: auto; max-height: 300px; border: 2px solid #000;">';
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                    <a href="myPet-Primary.php"><button class="btn btn-outline-danger">Back</button></a>
                </div>
            </div>
            <!------------Medical History----------->
            <div class="tab-pane fade" id="vaccine-tab-pane" role="tabpanel" aria-labelledby="vaccine-tab" tabindex="0">
                <div class="history-table">
                    <h3 style="text-align: center;">Medical History</h3>
                    <table class="table table-bordered border-primary custom-table">
                        <thead>
                            <th>Date</th>
                            <th>Body Weight</th>
                            <th>Vaccination</th>
                            <th>Veterinarian</th>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($animalid)) {
                                $sql = "SELECT * FROM petrecordstb WHERE animalid=?";
                                $stmt = mysqli_prepare($con, $sql);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "i", $animalid);
                                    mysqli_stmt_execute($stmt);

                                    $result = mysqli_stmt_get_result($stmt);
                                    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                    // Check if records exist
                                    if (empty($records)) {
                                        echo '<tr><td colspan="4" style="text-align: center; color:red;">No Records Found</td></tr>';
                                    } else {
                                        // Iterate over the records
                                        foreach ($records as $row) {
                                            $date = $row['date'];
                                            $weight = $row['weight'];
                                            $vaccine = $row['vaccine'];
                                            $veterinarian = $row['veterinarian'];
                            ?>
                                            <tr>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $weight; ?></td>
                                                <td><?php echo $vaccine; ?></td>
                                                <td><?php echo $veterinarian; ?></td>
                                            </tr>
                            <?php
                                        }
                                    }

                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Failed to prepare statement: " . mysqli_error($con);
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    // Check if the document is ready
    $(document).ready(function() {
        <?php
        if (empty($records)) {
            echo '$("#liveToast").toast("show");';
        }
        ?>
        setTimeout(function() {
            $("#liveToast").toast("hide");
        }, 8000);
    });
</script>

</html>