<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezgAItR1QazFqF98+MmTHezQ2R+U4r1JQb1s1Cq69jkpqzFq+fxykLfrWUGIS2BD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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
    <!--content -->
    <div class="container">
        <div class="wrapper">
            <div class="wrapper-header">
                <div class="container-fluid" style="margin-bottom: 50px;">
                    <div class="row">
                        <?php
                        if (isset($_GET['productcode'])) {
                            $product_id = $_GET['productcode'];
                            $query = "SELECT * FROM producttb WHERE productcode = '$product_id'";
                            $result = mysqli_query($con, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $name = $row['name'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $stock = $row['quantity'];
                                $product_Image = $row['imageData'];
                        ?>
                                <form method="post">
                                    <div class="product-details">
                                        <div class="row ">
                                            <div class="col-md-8">
                                                <div class="card mb-3" style="max-width: 500px;">
                                                    <div class="row g-0">
                                                        <?php echo '<img class="card-img-top" id="selectedImage" style="object-fit: cover; height:300px " src="data:image/jpg;charset=utf8;base64,' . base64_encode($product_Image) . '"></a>' ?>
                                                    </div>
                                                </div>
                                                <h5 class="card-text">Available Stocks: <?php echo $stock; ?></h5>
                                            </div>
                                            <div class="col-1">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title"> <?php echo $name; ?></h5>
                                                        <p class="card-text"><?php echo $description; ?></p>
                                                        <h4 class="card-text">Price: ₱<?php echo $price; ?></h4>
                                                        <p>_____________________________________</p>

                                                        <div class="input-group" style="margin-bottom: 20px;">
                                                            <label style="margin-right: 60px;" for="quantity">Quantity:</label>
                                                            <button class="btn btn-outline-secondary" type="button" id="minusBtn">-</button>
                                                            <input style="text-align: center;" class="form-control" type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $stock; ?>">
                                                            <button class="btn btn-outline-secondary" type="button" id="plusBtn">+</button>
                                                        </div>
                                                        <button style="width: 255px;" type="submit" class="btn btn-primary btn-cart" name="addCart" value="<?php echo $product_id; ?>">Add to cart</button><br>
                                                        <a href="products.php">Shop More>></a>
                                                        <a href="productCheckout.php" style="margin-left:10px;">Payment>></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <?php
                            } else {
                                // Product not found
                                echo "Product not found.";
                            }
                        } else {
                            // No product ID provided
                            echo "Product ID not specified.";
                        }
                        ?>
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
        <div class="offcanvas-body">
            <?php
            $totalQty = 0;
            $totalPrice = 0;
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCart'])) {
                $selectedProductId = $_POST['addCart'];
                $selectedProductQuery = mysqli_query($con, "SELECT * FROM producttb WHERE productcode = '$selectedProductId'");
                $selectedProduct = mysqli_fetch_assoc($selectedProductQuery);

                $usertype = $_SESSION['usertype'];
                $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Product Add to Cart')");

                if (!isset($_SESSION['shopping_cart'])) {
                    $_SESSION['shopping_cart'] = array();
                }

                // Add quantity information to the product array
                echo '<script>alert("Product added to cart"); window.location.href = "product-details.php?productcode=' . $product_id . '";</script>';
                $selectedProduct['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

                $_SESSION['shopping_cart'][] = $selectedProduct;
            }

            if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $key => $product) {
                    echo '
                <form method="post">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-4">
                                <img class="card-img-top" id="selectedImage" style="object-fit: cover; width: 90px; margin-top:20px;" src="data:image/jpg;charset=utf8;base64,' . base64_encode($product['imageData']) . '">
                            </div>
                            <div class="col-sm-8" style="height:165px;">
                                <div class="card-body">
                                    <h5 class="card-title">' . $product['name'] . '</h5>
                                    <p class="card-text">Price: ₱' . $product['price'] . '</p>
                                    <p class="card-text">Quantity: ' . $product['quantity'] . '</p>
                                    <input type="hidden" name="removeProduct" value="' . $key . '">
                                    <button type="submit" class="btn btn-danger" id="removeBtn" name="removeBtn">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';

                    $totalQty += $product['quantity'];
                    $totalPrice += $product['price'] * $product['quantity'];
                }
                echo '<p style="margin-top: 30vh;">_______________________________________________________</p>
            <p>Total Quantity: ' . $totalQty . '</p>
            <p>Total Price: ₱' . $totalPrice . '</p>';
                echo '<a href="productCheckout.php"><button class="btn btn-success">Proceed to payment</button></a>';
            } else {
                echo '<div class="cart">
                    <i class="fas fa-shopping-cart fa-5x"></i>
                    <p style="font-size: 20px;">Your cart is empty</p>
                </div>';
            }


            ?>
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
    document.getElementById('minusBtn').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    document.getElementById('plusBtn').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        if (quantityInput.value < <?php echo $stock; ?>) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
    });
</script>
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
                            window.location.href = 'product-details.php?productcode=<?php echo $product_id; ?>';
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