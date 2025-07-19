<?php
include('../connection.php');

if (isset($_GET['query'])) {
    $searchQuery = '%' . mysqli_real_escape_string($con, $_GET['query']) . '%';

    $sql = "SELECT * FROM userstb
    WHERE 
        firstname LIKE ? OR
        lastname LIKE ? OR
        username LIKE ? OR
        contact LIKE ? OR
        usertype LIKE ? OR
        status LIKE ?";

    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery);
        // Execute statement
        mysqli_stmt_execute($stmt);
        // Get result
        $resultUsers = mysqli_stmt_get_result($stmt);
?>
        <?php if (mysqli_num_rows($resultUsers) > 0) { ?>
            <table class="table text-nowrap mb-0 table-centered table-hover">
                <thead style="background-color: #1B3C73;">
                    <tr>
                        <th scope="col" style="color: whitesmoke;">Profile</th>
                        <th scope="col" style="color: whitesmoke;">Firstname</th>
                        <th scope="col" style="color: whitesmoke;">Lastname</th>
                        <th scope="col" style="color: whitesmoke;">Username</th>
                        <th scope="col" style="color: whitesmoke;">Contact</th>
                        <th scope="col" style="color: whitesmoke;">UserType</th>
                        <th scope="col" style="color: whitesmoke;">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($resultUsers)) {
                    $imageData = $row['imageData'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $userName = $row['username'];
                    $contact = $row['contact'];
                    $usertype = $row['usertype'];
                    $status = $row['status'];

                    // Determine badge color based on status
                    $badgeColor = ($status == 'online') ? 'bg-success' : 'bg-custom';

                    echo '<tr>
                        <td>' . (isset($imageData) ? '<img class="profileImage" id="selectedImageProfile" src="data:image/jpg;charset=utf8;base64,' . base64_encode($imageData) . '" />' : '<i class="fa-solid fa-user-large fa-2xl"></i>') . '</td>
                        <td>' . $firstname . '</td>
                        <td>' . $lastname . '</td>
                        <td>' . $userName . '</td>
                        <td>' . $contact . '</td>
                        <td>' . $usertype . '</td>
                        <td><span class="badge rounded-pill  ' . $badgeColor . '" style=" background-color: rgba(90, 90, 90, 0.5);">' . $status . '</span></td>
                    </tr>';
                }
            } else {
                echo '<h1 class="text-center text-danger"style="padding: 100px;">No Matching Users</h1>';
            } ?>
        <?php } else {
        // Handle the case when preparing the statement fails
        echo "Error: " . mysqli_error($con);
    }
}
        ?>