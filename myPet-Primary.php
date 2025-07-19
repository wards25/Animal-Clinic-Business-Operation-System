<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        width: 100vh;
        height: 70vh;
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
        padding: 10px;
    }

    table {
        width: 95vh;
        margin: 20px;
    }

    td {
        padding-top: 10px;
        color: black;
    }

    table {
        overflow-y: auto;
        overflow-x: hidden;
        max-height: 300px;

    }

    th {
        z-index: 1;
        top: 0;
        position: sticky;
        background-color: #0A1D56;
        color: whitesmoke;
        padding: 10px;
    }

    tr:hover {
        background-color: #9c9c9c9b;
    }

    .heading3 {
        margin-top: 200px;
        text-align: center;
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
if ($con == false) {
    die("Connection error" . mysqli_connect_error());
}

//sql query 
$result = "SELECT * FROM animaltb WHERE userid=$userid";
$query = mysqli_query($con, $result);


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

    <!--content -->
    <div class="container">
        <div class="wrapper">
            <form class="d-flex" role="search" style="margin:20px" id="liveSearchForm">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" oninput="performSearch()">
                <button class="btn btn-outline-success" type="button">Search</button>
            </form>

            <div id="liveSearchResults">
                <?php
                if (mysqli_num_rows($query) > 0) {
                    echo '<div>
                            <table >
                                <thead>
                                    <tr class="searchable-row">
                                        <th scope="col">Pet Name</th>
                                        <th scope="col">Pet Type</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>';

                    while ($row = mysqli_fetch_assoc($query)) {
                        $animalid = $row['animalid'];
                        $name = $row['petname'];
                        $pettype = $row['pettype'];
                        echo '
                            <tr>
                                <td class="pet-name">' . $name . '</td>
                                <td class="pet-type">' . $pettype . '</td>
                                <td> <a href="myPet-Details.php?animalid=' . $animalid . '"><button class="btn btn-primary">View</button></a>
                                <a href="myPet-Edit.php?animalid=' . $animalid . '"><button class="btn btn-success">Edit <img class="btn-icon-edit" src="img/icons8-edit-64.png" alt=""></button></a>
                                </td>
                             </tr>';
                    }
                } else {
                    echo '<h3 class="heading3" style="color:Black;">No Added Pets Yet! </h3>';
                }
                mysqli_close($con);
                ?>
                <div class="wrapper-footer fixed-bottom">
                    <a href="addPet.php"><button class="btn btn-primary float-end">Add Pet</button></a>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#liveSearchForm input').on('input', function() {
            performSearch();
        });
    });

    function performSearch() {
        var query = $('#liveSearchForm input').val();
        $.ajax({
            method: 'GET',
            url: './live_search/myPetliveSearch.php',
            data: {
                query: query
            },
            success: function(data) {
                $('#liveSearchResults').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Ajax request failed: ' + status + ' - ' + error);
            }
        });
    }
</script>

</html>