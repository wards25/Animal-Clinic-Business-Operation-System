<?php
include('../connection.php');

if (isset($_GET['query'])) {
    $searchQuery = '%' . mysqli_real_escape_string($con, $_GET['query']) . '%';

    // Retrieve userid from session
    session_start();
    $userid = $_SESSION['userid'];

    $sql = "SELECT * FROM producttb 
        WHERE (name LIKE ? OR description LIKE ? OR category LIKE ? OR expiration LIKE ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="row">';
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['productcode'];
                    $product_Image = $row['imageData'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $stock = $row['quantity'];

                    $stock_err = "";
                    if ($stock < 1) {
                        $stock_err = '<div class="stock"><strong>Out of stock</strong></div>';
                    }

                    echo '
                        <div class="col-md-4 mb-3">
                            <div class="card" style="height:80vh;">
                                <form method="post" action="">
                                    <a href="product-details.php?productcode=' . $product_id . '"><img class="card-img-top" id="selectedImage" style="object-fit: cover; height:250px " src="data:image/jpg;charset=utf8;base64,' . base64_encode($product_Image) . '"></a>
                                    <div class="card-body" style="text-align: center;">
                                        <h5 class="card-title">' . $name . '</h5>
                                        <p class="card-text">Indication: ' . $description . '</p>
                                        <p class="card-text">Price: ₱' . $price . '</p>
                                        <p class="card-text">Available: ' . $stock . '</p>
                                        ' . $stock_err . '
                                    </div>
                                </form>
                            </div>
                        </div>';
                }
                echo '</div>';
            } else {
                echo '<div style="color:red; text-align: center; padding: 300px;">No matching products found!</div>';
            }
        } else {
            echo '<div>Error in fetching result: ' . mysqli_error($con) . '</div>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo '<div>Error in preparing statement: ' . mysqli_error($con) . '</div>';
    }

    mysqli_close($con);
}
?>

