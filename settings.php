<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        width: 120vh;
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

    .card img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        display: block;
        position: relative;
        z-index: 0;
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
include('connection.php');
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

?>

<!----------------UPDATE Data---------------->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
        echo '<script> alert("Error uploading file Please try again"); window.location.href = "settings.php";</script>';
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            echo '<script>alert("Please upload a JPEG, PNG, or GIF."); window.location.href = "settings.php";</script>';
        } else {
            $maxFileSize = 5 * 1024 * 1024; // 5 MB
            if ($_FILES['image']['size'] > $maxFileSize) {
                echo "File size exceeds 5MB. Please upload a smaller file.";
            } else {
                $imageName = $_FILES['image']['name'];
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
            }
        }
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $userName = $_POST['username'];


    $stmt = mysqli_prepare($con, "UPDATE userstb SET firstname=?, lastname=?, username=?, imageData=? WHERE userid=?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $userName, $imageData, $userid);
        mysqli_stmt_send_long_data($stmt, 3, $imageData);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Your details updated"); window.location.href = "settings.php";</script>';
        } else {
            echo '<script>alert("Failed to update details ' . mysqli_stmt_error($stmt) . '"); window.location.href = "settings.php";</script>';
        }

        // mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Failed to prepare statement"); window.location.href = "settings.php";</script>';
    }
}

?>

<?php

$sql = "SELECT firstname, lastname, username, imageData FROM userstb WHERE userid=?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $userid);


    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $userName = $row['username'];
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
                            <li><a class="dropdown-item" href="schedule.php">Schedule</a></li>
                            <li><a class="dropdown-item" href="#">Book Appointment</a></li>
                            <li><a class="dropdown-item" href="#">Book Home Service</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
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

    <!--content-->
    <form class="needs-validation" method="post" novalidate enctype="multipart/form-data">
        <div class="row row-cols-1 row-cols-sm-3 " style="margin: 25px 0px 0px 20px;">
            <div class="col">
                <div class="card">
                    <?php
                    if(isset($image)){
                        echo '<img id="selectedImages" src="data:image/jpg;charset=utf8;base64,' . base64_encode($image) . '"  style="height: 70vh; padding: 10px;">';
                    }
                    else{
                       echo' <img id="selectedImages" src="./img/pngwing.com.png" style="height: 70vh; padding: 10px;">';
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo $username; ?></h5>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="fileInput" name="image" accept="image/*" onchange="displayImages()">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-10">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="firstname" required value="<?php echo $firstname; ?>">
                            <div class="invalid-feedback">
                                Please input firstname
                            </div>
                        </div>
                        <div class="col-md-10">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" name="lastname" required value="<?php echo $lastname; ?>">
                            <div class="invalid-feedback">
                                Please input lastname
                            </div>
                        </div>
                        <div class="col-md-10">
                            <label for="validationCustom03" class="form-label">Username</label>
                            <input type="text" class="form-control" id="validationCustom03" name="username" required value="<?php echo $username; ?>">
                            <div class="invalid-feedback">
                                Please input Username
                            </div>
                        </div>
                        <div class="col-12" style="margin-top: 20px;">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function displayImages() {
        var fileInput = document.getElementById('fileInput');
        var imageDataInput = document.getElementById('imageDataInputs');
        var selectedImage = document.getElementById('selectedImages');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set the src attribute of the image
                selectedImage.src = e.target.result;

                // Set the value of the hidden input field with the base64-encoded image data
                imageDataInput.value = e.target.result.split(',')[1];
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
</html>