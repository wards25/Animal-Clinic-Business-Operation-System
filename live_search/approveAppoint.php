<?php
include('../connection.php');

$searchQuery = isset($_GET['query']) ? '%' . mysqli_real_escape_string($con, $_GET['query']) . '%' : '';

$sql = "SELECT * FROM appointmenttb
        WHERE 
            (appointmentType LIKE ? OR 
            service LIKE ? OR 
            date LIKE ? OR 
            fullName LIKE ? OR 
            petname LIKE ? OR 
            contact LIKE ? OR 
            status LIKE ?)
        AND status = 'confirmed'";

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
                    <th style="color: whitesmoke;">Querying No.</th>
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
            <tbody>
            <?php
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                $date = date("F d, Y", strtotime($row['date']));
                $appointmentType = $row['appointmentType'];
                $service = $row['service'];
                $ownersName = $row['fullName'];
                $petName = $row['petname'];
                $contact = $row['contact'];
                $time_slot = $row['time_slot'];
                $statuss = $row['status'];
                $appoinmentNo = $row['appointmentNo'];

                echo '
                    <tr>
                        <td>
                            <h5 class=" mb-1">' . $count++ . '</h5>
                        </td>
                        <td>
                            <h5 class=" mb-1">' . $appointmentType . '</h5>
                        </td>
                        <td>
                            <h5 class=" mb-1">' . $service . '</h5>
                        </td>
                        <td>
                            ' . $date . '
                            ' . $time_slot . '
                        </td>
                        <td>
                            ' . $ownersName . '
                        </td>
                        <td>
                            ' . $petName . '
                        </td>
                        <td>
                            ' . $contact . '
                        </td>
                        <td>
                            <span class="badge badge-success-soft">' . $statuss . '</span>
                        </td>
                        <td>
                            <a href="updateStatusAppoint.php?appointmentNo=' . $appoinmentNo . '&status=fulfilled"><button type="submit" class="btn btn-success approv-btn" name="confirmed"><i class="fa-regular fa-thumbs-up"></i> Treated</button></a>
                            <a href="updatedTreatedStatus.php?appointmentNo=' . $appoinmentNo . '&status=cancel"><button type="submit" class="btn btn-danger approv-btn" name="confirmed"><i class="fa-regular fa-circle-xmark" name="rejected"></i>  Cancel</button>
                        </td>
                    </tr>';
            }
            ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h1 class="text-center text-danger" style="padding: 100px;">No Mathching Appointments</h1>
    <?php }
} else {
    // Handle the case when preparing the statement fails
    echo "Error: " . mysqli_error($con);
}
?>
