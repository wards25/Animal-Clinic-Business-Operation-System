<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezgAItR1QazFqF98+MmTHezQ2R+U4r1JQb1s1Cq69jkpqzFq+fxykLfrWUGIS2BD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <!--navBar start-->
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
                            <li><a class="dropdown-item" href="orderHistoryClient.php">Order History</a></li>
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
                <button class="btn btn-outline-warning position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight staticBackdrop">
                    <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                        <?php
                        // badge number sa button
                        $totalQuantityInCart = isset($_SESSION['shopping_cart']) ? array_sum(array_column($_SESSION['shopping_cart'], 'quantity')) : 0;
                        echo $totalQuantityInCart;
                        ?>
                    </span>
                    <img src="./img/cart-add.png" style="height: 35px; margin-right: 10px">
                    <span style="color: whitesmoke; margin-right: 10px;">My cart</span>
                </button>
            </div>
        </div>
    </nav>

    <?php
    $sql = "SELECT * FROM producttb";
    $query = mysqli_query($con, $sql);
    ?>
    <?php
    // Get selected category value from the dropdown
    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

    // Modify the SQL query to filter products by category
    $sql = "SELECT * FROM producttb";
    if (!empty($categoryFilter)) {
        // If a category is selected, add a WHERE clause to filter by that category
        $sql .= " WHERE category = '$categoryFilter'";
    }
    $query = mysqli_query($con, $sql);
    ?>
    <!--content -->
    <div class="container">
        <div class="wrapper">
            <div class="wrapper-header">
                <div class="container-fluid" style="margin-bottom: 50px;">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select" id="categoryFilter" style="margin-bottom: 50px;">
                                <option disabled selected hidden>All Categories</option>
                                <option value="medicine">Medicine</option>
                                <option value="vitamins">vitamins</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <form class="d-flex" role="search" id="liveSearchForm">
                                <div class="input-group mb-3">
                                    <input aria-describedby="basic-addon1" class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" oninput="performSearch()">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="liveSearchResults">
                        <div class="row">
                            <?php
                            $stock_err = "";
                            while ($row = mysqli_fetch_assoc($query)) {
                                $product_id = $row['productcode'];
                                $product_Image = $row['imageData'];
                                $name = $row['name'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $stock = $row['quantity'];
                            ?>
                                <?php if ($stock < 1) {
                                    $stock_err = '<div class="stock"><strong>Out of stock</strong></div>';
                                } ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card" style="height:80vh;">
                                        <form method="post" action="">
                                            <?php echo '<a href="product-details.php?productcode=' . $product_id . '"><img class="card-img-top" id="selectedImage" style="object-fit: cover; height:250px " src="data:image/jpg;charset=utf8;base64,' . base64_encode($product_Image) . '"></a>' ?>
                                            <div class="card-body" style="text-align: center;">
                                                <h5 class="card-title"><?php echo $name; ?></h5>
                                                <p class="card-text">Indication: <?php echo $description; ?></p>
                                                <p class="card-text">Price: ₱<?php echo $price; ?></p>
                                                <p class="card-text">Available: <?php echo $stock; ?></p>
                                                <?php echo $stock_err; ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- off-canvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" data-bs-backdrop="static">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart (<?php $totalQuantityInCart = isset($_SESSION['shopping_cart']) ? array_sum(array_column($_SESSION['shopping_cart'], 'quantity')) : 0;
                                                                                echo $totalQuantityInCart; ?>)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="catContainer">
            <?php
            $totalQty = 0;
            $totalPrice = 0;

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCart'])) {
                $selectedProductId = $_POST['addCart'];
                $selectedProductQuery = mysqli_query($con, "SELECT * FROM producttb WHERE productcode = '$selectedProductId'");
                $selectedProduct = mysqli_fetch_assoc($selectedProductQuery);

                if (!isset($_SESSION['shopping_cart'])) {
                    $_SESSION['shopping_cart'] = array();
                }

                // Add quantity sa product na array
                $selectedProduct['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

                $_SESSION['shopping_cart'][] = $selectedProduct;
            }

            if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $key => $product) {
                    echo '
            <form method="post">
                <div class="card mb-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <img class="card-img-top" id="selectedImage" style="object-fit: cover; width: 90px; margin-top:20px;" src="data:image/jpg;charset=utf8;base64,' . base64_encode($product['imageData']) . '">
                        </div>
                        <div class="col-sm-8" style="height:165px;">
                            <div class="card-body">
                                <h5 class="card-title">' . $product['name'] . '</h5>
                                <p class="card-text">Price: ₱' . $product['price'] . '</p>
                                <p class="card-text">Quantity: ' . $product['quantity'] . '</p>
                                <button type="submit" id="removeBtn" class="btn btn-danger removeBtn" name="removeBtn">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="removeProduct" value="' . $key . '">';

                    $totalQty += $product['quantity'];
                    $totalPrice += $product['price'] * $product['quantity'];
                }
                echo '<p style="margin-top: 30vh;">_______________________________________________________</p>
        <p>Total Quantity: ' . $totalQty . '</p>
        <p>Total Price: ₱' . $totalPrice . '</p>';
                echo '<a href="productCheckout.php" class="btn btn-success">Proceed to payment</a>';
            } else {
                echo '<div class="cart">
                <i class="fas fa-shopping-cart fa-5x"></i>
                <p style="font-size: 20px;">Your cart is empty</p>
            </div>';
            }
            ?>
        </div>
    </div>
    <!--footer-->
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
                                    <a href="products.php" style=" color:whitesmoke;"><small class="card-text">Products</small><br></a>
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
                                    <small class="card-text"><a href="https://www.facebook.com/profile.php?id=100054754840642" style=" color:whitesmoke;"><i class="fa-brands fa-facebook" style="color: #ffffff;"></i> Facebook</a></small><br>
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
                $.ajax({
                    url: 'productRemove.php',
                    type: 'POST',
                    data: {
                        removeProduct: <?php echo json_encode($_POST['removeProduct']); ?>
                    },
                    success: function(response) {

                        Swal.fire("Product Removed", "", "success").then(() => {

                            window.location.href = 'products.php';
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
<script>
    // JavaScript to reload the page with the selected category
    document.getElementById('categoryFilter').onchange = function() {
        var selectedCategory = this.value;
        // Redirect to the same page with the selected category as a query parameter
        window.location.href = 'products.php?category=' + encodeURIComponent(selectedCategory);
    };
</script>
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
            url: './live_search/productSearch.php',
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