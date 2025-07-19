<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezgAItR1QazFqF98+MmTHezQ2R+U4r1JQb1s1Cq69jkpqzFq+fxykLfrWUGIS2BD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
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
        padding: 20px;
        width: 150vh;
        margin-top: 60px;
        margin-bottom: 60px;
        background: #f1f5f9;
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
        margin-right: 60px;
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

    .row {
        padding: 50px;
    }

    input[type="datetime-local"] {

        width: 41vh;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .stock {
        background: rgba(49, 54, 63, 0.25);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        color: whitesmoke;
        text-align: center;
    }

    .cart {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        flex-direction: column;
    }

    .img {
        background-color: #CDD5FF;
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
                            <li><a class="dropdown-item" href="productCheckout.php">Check Out</a></li>
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

    <?php
    $sql = "SELECT * FROM producttb";
    $query = mysqli_query($con, $sql);
    ?>
    <?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve user information from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $payment = $_POST['payment'];

    // Assuming you have established a database connection already
    include("connection.php");

    // Check if the database connection is successful
    if ($con) {
        // Construct the SQL INSERT query
        $sql = "INSERT INTO ordertb (userid, productname, description, totalPrice, quantity, firstname, lastname, address, postcode, phone, city, payment) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the SQL statement
        $stmt = mysqli_prepare($con, $sql);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "isssssssssss", $userid, $productName, $productDescription, $totalPrice, $quantity, $firstname, $lastname, $address, $postcode, $phone, $city, $payment);

        foreach ($_SESSION['shopping_cart'] as $product) {
            $productName .= $product['name'] . ', '; 
            $productDescription .= $product['description'] . ', '; 
            $totalPrice += $product['price'] * $product['quantity']; 
            $quantity += $product['quantity']; 
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        unset($_SESSION['shopping_cart']);

        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
        echo '<script>';
        echo 'Swal.fire({
            icon: "success",
            title: "Success",
            text: "Order has been placed successfully!",
            showConfirmButton: true,
            timer: 2000
        }).then(function() {
            window.location.href = "home.php"
        });';
        echo '</script>';
    } else {
        // Handle database connection error
        echo "Database connection failed.";
    }
}
?>


    <!--content -->
    <form method="post">
        <div class="container">
            <div class="wrapper">
                <div class="wrapper-header">
                    <div class="container-fluid" style="margin-bottom: 50px;">
                        <h5>Billing Address</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Firstname <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" required name="firstname">
                                <label for="">Address <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" required name="address">
                                <label for="">Post Code <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" required name="postcode">
                            </div>
                            <div class="col-md-6">
                                <label for="">Lastname <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" required name="lastname">
                                <label for="">Phone <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" required name="phone">
                                <label for="">City <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" required name="city">
                            </div>
                        </div>
                        <hr>
                        <h5>Payment Option</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3" style="width: 40vh;">
                                    <label class="input-group-text" for="inputGroupSelect01" style="background-color: blue; color:whitesmoke;">Payment</label>
                                    <select class="form-select" id="inputGroupSelect01" name="payment" required>
                                        <option disabled selected hidden>Select payment</option>
                                        <option value="cash">Cash</option>
                                        <option value="gcash">Gcash</option>
                                    </select>
                                    <p style="margin-top: 30px;">Note: if you buy the product you will pick-up it on our store</p>
                                    <button class="btn btn-success" name="submit">Place Order</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="padding: 30px;">
                                    <p>If you choose gcash send the payment through this gcash Account provided,</p>
                                    <strong>No. <span style="color: blue;">09507808703</span></strong>
                                    <strong>Username: <span style="color:blue;">E***** D.B</span></strong>
                                    <p>After you send the payment, kindly take a screen shot and send the proof of payment to our gmail account <span style="color: blue;">animalclinicmain@gmail.com</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script>
    <?php
    // Check if the form was submitted and if the necessary POST variables are set
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removeBtn']) && isset($_POST['removeProduct'])) {
    ?>
        Swal.fire({
            title: "Do you want to remove this product?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Remove",
            denyButtonText: `Don't save`
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to remove the product if user chooses to save
                $.ajax({
                    url: 'productRemove.php',
                    type: 'POST',
                    data: {
                        removeProduct: <?php echo json_encode($_POST['removeProduct']); ?>
                    },
                    success: function(response) {
                        Swal.fire("Product Removed", "", "success").then(() => {
                            // Redirect to product-details.php?productid=$productid
                            window.location.href = 'productCheckout.php';
                        });
                    },
                    error: function() {
                        // Display Swal.fire error message if removal fails
                        Swal.fire("Error", "Failed to remove product", "error");
                    }
                });
            } else if (result.isDenied) {
                // Display info message if user chooses not to save
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    <?php } ?>
</script>

</html>