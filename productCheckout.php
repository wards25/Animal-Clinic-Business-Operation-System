<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- cdn for sweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimcalClinic</title>
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

    <?php
    $sql = "SELECT * FROM producttb";
    $query = mysqli_query($con, $sql);
    ?>


    <!--content -->
    <?php
    $sql = "SELECT * FROM producttb";
    $query = mysqli_query($con, $sql);
    ?>

    <!--content -->
    <div class="container">
        <div class="wrapper">
            <div class="wrapper-header">
                <div class="container-fluid" style="margin-bottom: 50px;">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            // Display card elements
                            $totalQty = 0;
                            $totalPrice = 0;
                            $productNameParam = '';
                            $productDescriptionParam = '';
                            if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
                                $productData = $_SESSION['shopping_cart'];
                                // Encode the data to send it via URL parameters
                                $productDataEncoded = urlencode(json_encode($productData));

                                foreach ($_SESSION['shopping_cart'] as $key => $product) {
                                    echo '<form method="post">';
                                    echo '<div class="card" style="width:45vh; margin-bottom:10px;">
                                <img class="card-img-top" id="selectedImage" style="object-fit: cover; width: 100px; margin-left:10px; margin-top:20px;" src="data:image/jpg;charset=utf8;base64,' . base64_encode($product['imageData']) . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $product['name'] . '</h5>
                                    <p class="card-text">Price: ₱' . $product['price'] . '</p>
                                    <input type="hidden" name="removeProduct" value="' . $key . '">
                                    <button type="submit" id="removeBtn" class="btn btn-danger removeBtn" name="removeBtn">Remove</button>
                                </div>
                            </div>
                        </form>';

                                    // Update total quantity and total price
                                    $totalQty += $product['quantity'];
                                    $totalPrice += $product['price'] * $product['quantity'];

                                    // Add product name and description to URL parameters
                                    $productNameParam .= '&productName[' . $key . ']=' . urlencode($product['name']);
                                    $productDescriptionParam .= '&productDescription[' . $key . ']=' . urlencode($product['description']);
                                }
                            ?>
                        </div>
                        <div class="col-md-6">
                        <?php
                                echo '<div class="card" style="padding: 20px;">
                                <h4>Order Summary</h4>
                                <hr>
                                <p>Total Quantity: ' . $totalQty . '</p>
                                <hr>
                                <p>Total Price: ₱' . $totalPrice . '</p>';
                                $productDetails = [];
                                foreach ($_SESSION['shopping_cart'] as $product) {
                                    // Concatenate product details
                                    $productDetails[] = $product['name'] . ': ₱' . ($product['price'] * $product['quantity']) . ' (' . $product['quantity'] . ')';
                                }

                                // Encode product details for URL
                                $productDetailsEncoded = urlencode(json_encode($productDetails));

                                // Construct the link with all product data
                                echo '<hr>';
                                echo '<a href="payment.php?productData=' . $productDataEncoded . '&productDetails=' . $productDetailsEncoded . '" class="btn btn-primary">Check Out</a>';

                                echo '</div>';
                            } else {
                                echo '<div class="cart">
                                <i class="fas fa-shopping-cart fa-5x"></i>
                                <p style="font-size: 20px;">Your cart is empty</p>
                              </div>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
        $usertype = $_SESSION['usertype'];
        $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Remove Product to Cart')");
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
                    url: 'productRemove.php', // Adjust the URL as per your setup
                    type: 'POST',
                    data: {
                        removeProduct: <?php echo json_encode($_POST['removeProduct']); ?>
                    },
                    success: function(response) {
                        // Display Swal.fire success message after successful removal
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