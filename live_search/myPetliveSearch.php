<?php
include('../connection.php');

if (isset($_GET['query'])) {
    $searchQuery = '%' . mysqli_real_escape_string($con, $_GET['query']) . '%';

    // Retrieve userid from session
    session_start();
    $userid = $_SESSION['userid'];

    $sql = "SELECT * FROM animaltb 
            WHERE (petname LIKE ? OR pettype LIKE ?) AND userid = ?";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $searchQuery, $searchQuery, $userid); // 'i' is for integer
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div>
                <table>
                    <thead>
                        <tr class="searchable-row">
                            <th scope="col">Pet Name</th>
                            <th scope="col">Pet Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>';
            while ($row = mysqli_fetch_array($result)) {
                $animalid = $row['animalid'];
                $name = $row['petname'];
                $pettype = $row['pettype'];
                echo '
                        <tr>
                            <td>' . $name . '</td>
                            <td>' . $pettype . '</td>
                            <td> <a href="myPet-Details.php?animalid=' . $animalid . '"><button class="btn btn-primary">View</button></a>
                            <a href="myPet-Edit.php?animalid=' . $animalid . '"><button class="btn btn-success">Edit <img class="btn-icon-edit" src="img/icons8-edit-64.png" alt=""></button></a>
                            </td>
                        </tr>';
            }
        } else {
            echo '<div style="color:red; text-align: center">No matching pets found!</div>';
        }
    } else {
        echo '<div>Error in query: ' . mysqli_error($con) . '</div>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
<div class="wrapper-footer fixed-bottom">
    <a href="addPet.php"><button class="btn btn-primary float-end">Add Pet</button></a>
</div>
