<?php
include('../connection.php');

if (isset($_GET['query'])) {
    $searchQuery = '%' . mysqli_real_escape_string($con, $_GET['query']) . '%';

   $sql = "SELECT * FROM appointmenttb
    WHERE 
        (appointmentType LIKE ? OR 
        service LIKE ? OR 
        date LIKE ? OR 
        fullName LIKE ? OR 
        petname LIKE ? OR 
        contact LIKE ? OR 
        status LIKE ?)
    AND status = 'pending'";

    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
?>
        <?php if ($result->num_rows > 0) { ?>
            <table class="table text-nowrap mb-0 table-centered table-hover">
                <thead style="background-color: #0B1D51;">
                    <tr>
                        <th style="color: whitesmoke;">Appointment Type</th>
                        <th style="color: whitesmoke;">Type of Service</th>
                        <th style="color: whitesmoke;">Appointment Schedule</th>
                        <th style="color: whitesmoke;">Full Name</th>
                        <th style="color: whitesmoke;">Pet Name</th>
                        <th style="color: whitesmoke;">Contact No.</th>
                        <th style="color: whitesmoke;">Status</th>
                        <th style="color: whitesmoke;">Action</th>
                    </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tbody>
                        <tr>
                            <td>
                                <h5 class=" mb-1"><?php echo $row['appointmentType']; ?></h5>
                            </td>
                            <td>
                                <h5 class=" mb-1"><?php echo $row['service']; ?></h5>
                            </td>
                            <td>
                                <?php echo date("F d, Y", strtotime($row['date'])) . ' ' . $row['time_slot']; ?>
                            </td>
                            <td>
                                <?php echo $row['fullName']; ?>
                            </td>
                            <td>
                                <?php echo $row['petname']; ?>
                            </td>
                            <td>
                                <?php echo $row['contact']; ?>
                            </td>
                            <td>
                                <span class="badge badge-warning-soft"><?php echo $row['status']; ?></span>
                            </td>
                            <td>
                                <button class="btn btn-success"><i class="fa-regular fa-thumbs-up"></i> Approved</button>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        <?php } else { ?>
            <h4 style="color:red; text-align:center;">No matching appointments found</h4>
        <?php } ?>
    <?php } else {
        // Handle the case when preparing the statement fails
        echo "Error: " . mysqli_error($con);
    }
}
?>
