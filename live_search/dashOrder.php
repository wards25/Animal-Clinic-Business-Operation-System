<?php
include('../connection.php');

if (isset($_GET['query'])) {
    $searchQuery = '%' . mysqli_real_escape_string($con, $_GET['query']) . '%';

    $sql = "SELECT * FROM ordertb
    WHERE status = 'pending' AND
        (orderNo LIKE ? OR
        firstname LIKE ? OR
        lastname LIKE ? OR
        productname LIKE ? OR
        address LIKE ? OR
        quantity LIKE ? OR
        totalprice LIKE ? OR
        payment LIKE ?)";


    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
?>
        <?php if ($result->num_rows > 0) { ?>
            <table class="table text-nowrap mb-0 table-centered table-hover">
                <thead style="background-color: #0B1D51;">
                    <tr>
                        <th style="color: whitesmoke;">Order No.</th>
                        <th style="color: whitesmoke;">Full Name</th>
                        <th style="color: whitesmoke;">Product Name</th>
                        <th style="color: whitesmoke;">Address</th>
                        <th style="color: whitesmoke;">Quantity</th>
                        <th style="color: whitesmoke;">Price</th>
                        <th style="color: whitesmoke;">Order Date</th>
                        <th style="color: whitesmoke;">Mode Of Payment</th>
                        <th style="color: whitesmoke;">Status</th>
                        <th style="color: whitesmoke;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $date = date("F d, Y", strtotime($row['orderDate']));
                    $fullname = $row['firstname'] . ' ' . $row['lastname'];
                    $productName = $row['productname'];
                    $qty = $row['quantity'];
                    $address = $row['address'];
                    $price = $row['totalprice'];
                    $statuss = $row['status'];
                    $orderNo = $row['orderNo'];
                    $payment = $row['payment'];

                    echo '
                                                    <tr>
                                                        <td>
                                                            <h5 class=" mb-1">' . $orderNo . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $fullname . '</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class=" mb-1">' . $productName . '</h5>
                                                        </td>
                                                        <td>
                                                        ' . $address . '
                                                        </td>
                                                        <td>
                                                        ' . $qty . '
                                                        </td>
                                                        <td>
                                                        ₱ ' . $price . '
                                                        </td>
                                                        <td>
                                                        ' . $date . '
                                                        </td>
                                                        <td>
                                                        ' . $payment . '
                                                        </td>
                                                        <td>
                                                        <span class="badge badge-warning-soft">' . $statuss . '</span>
                                                        </td>
                                                        <td>
                                                        <button class="transac-btn btn btn-primary" data-order-no=' . $orderNo . ' data-payment-type=' . $payment . '>Transac</button>
                                                        </td>
                                                    </tr>';
                }
            } else {
                echo '<h1 class="text-center text-danger"style="padding: 100px;">No Matching Orders</h1>';
            } ?>
        <?php } else {
        // Handle the case when preparing the statement fails
        echo "Error: " . mysqli_error($con);
    }
}
        ?>