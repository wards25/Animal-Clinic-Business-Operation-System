<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimlClinic</title>
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
        width: 100vh;
        background: whitesmoke;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        border-radius: 10px;
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

    .wrapper-footer {
        padding: 0px 30px 10px;
    }

    .file-upload {
        height: 150px;
    }

    .file-upload .file-upload-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        height: 150px;
        width: 150px;
        border-radius: 50%;
        background-color: rgb(212, 211, 211);
        background-image: url(./img/camera.png);
        background-size: 100px;
        background-position: center;
        background-repeat: no-repeat;
        margin-top: 30px;
    }

    .file-upload .file-upload-wrapper #fileInput {
        height: 150px;
        width: 200px;
        border-radius: 50%;
        object-fit: cover;
        z-index: 4;
        margin: auto;
        opacity: 0;
        overflow: hidden;
        cursor: pointer;
    }

    .file-upload .file-upload-wrapper img {
        position: absolute;
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

$animalid = $_GET['animalid'];
$result = "SELECT * FROM animaltb WHERE animalid='$animalid'";
$query = mysqli_query($con, $result);
$row = mysqli_fetch_array($query);
$petname = $row['petname'];
$gender = $row['gender'];
$age = $row['age'];
$birthday = $row['birthday'];
$pettype = $row['pettype'];
$breed = $row['breed'];
$color = $row['color'];
$imagePet = $row['imageData'];

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            echo '<script>alert("Please upload a JPEG, PNG, or GIF."); window.location.href = "myPet-Primary.php";</script>';
        }

        $maxFileSize = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            echo "File size exceeds 5MB. Please upload a smaller file.";
        }
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    }

    $petname = $_POST['petname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $pettype = $_POST['pettype'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];

    $stmt = mysqli_prepare($con, "UPDATE animaltb SET imageData=?, petname=?, pettype=?, gender=?, birthday=?, age=?, breed=?, color=? WHERE animalid=?");

    $usertype = $_SESSION['usertype'];
    $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Update a Pet Details')");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssi", $imageData, $petname, $pettype, $gender, $birthday, $age, $breed, $color, $animalid);
        mysqli_stmt_send_long_data($stmt, 0, $imageData);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Pet details updated"); window.location.href = "myPet-Primary.php";</script>';
        } else {
            echo '<script>alert("Failed to update pet ' . mysqli_stmt_error($stmt) . '"); window.location.href = "myPet-Edit.php?animalid=' . $animalid . '";</script>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Failed to prepare statement"); window.location.href = "myPet-Edit.php?animalid=' . $animalid . '";</script>';
    }

    mysqli_close($con);
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
                            echo '<img id="selectedImageProfile" src="data:image/jpg;charset=utf8;base64,' . base64_encode($image) . '" />';
                        } else {
                            echo ' <img id="selectedImageProfile" src="./img/pngwing.com.png"/>';
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

    <!--content -->
    <div class="container">
        <div class="wrapper">
            <form class="needs-validation" method="post" novalidate enctype="multipart/form-data">
                <div class="file-upload">
                    <div class="file-upload-wrapper">
                        <input id="fileInput" type="file" onchange="displayImage()" name="image" accept="image/*"  value=<?php echo base64_encode($imagePet); ?>>
                        <input type="hidden" id="imageDataInput" name="imageData" value=<?php echo base64_encode($imagePet); ?>>
                        <img id="selectedImage" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($imagePet); ?>" style="height: 150px; width: 150px; border-radius:50%; object-fit: cover;">
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-3" style="padding:30px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Pet Name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="petname" required value=<?php echo $petname ?>>
                            <div class="invalid-feedback">
                                Please provide your Pet name
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="validationCustom02" name="gender" required value=<?php echo $gender ?>>
                            <div class="invalid-feedback">
                                Please input Gender
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom03" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="validationCustom03" name="birthday" required value=<?php echo $birthday ?>>

                            <div class="invalid-feedback">
                                Please input birthday
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom03" class="form-label">Age</label>
                            <input type="text" class="form-control" id="validationCustom03" name="age" required value=<?php echo $age ?>>

                            <div class="invalid-feedback">
                                Please input Age
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Pet type</label>
                            <select class="form-select" id="validationCustom01" name="pettype">
                                <option disabled <?php echo empty($pettype) ? 'selected' : ''; ?> hidden>Select Pet Type</option>
                                <option value="dog" <?php echo ($pettype === 'dog') ? 'selected' : ''; ?>>Dog</option>
                                <option value="cat" <?php echo ($pettype === 'cat') ? 'selected' : ''; ?>>Cat</option>
                                <option value="bird" <?php echo ($pettype === 'bird') ? 'selected' : ''; ?>>Bird</option>
                                <option value="rabbit" <?php echo ($pettype === 'rabbit') ? 'selected' : ''; ?>>Rabbit</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select pet type
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Breed</label>
                            <input type="text" class="form-control" id="validationCustom02" name="breed" required value=<?php echo $breed ?>>
                            <div class="invalid-feedback">
                                Please input Breed
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom03" class="form-label">Color</label>
                            <input type="text" class="form-control" id="validationCustom03" name="color" required value=<?php echo $color ?>>
                            <div class="invalid-feedback">
                                Please input Pet Color
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="wrapper-footer fixed-bottom">
                    <a href="addPet.php"><button class="btn btn-success float-end" style="margin-left: 10px;" type="submit" name="update">Update</button></a>
                    <a href="myPet-Primary.php" class="float-end btn btn-outline-danger" type="button">Back</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./js/script.js"></script>
<script>
    function displayImage() {
        var fileInput = document.getElementById('fileInput');
        var imageDataInput = document.getElementById('imageDataInput');
        var selectedImage = document.getElementById('selectedImage');

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