<?php
// updateStatusAppoint.php
include('../connection.php');

// Check if appointmentNo and status are set in the URL
if (isset($_GET['appointmentNo']) && isset($_GET['status'])) {
    $appointmentId = $_GET['appointmentNo'];
    $status = $_GET['status'];

    // Update the status in the database
    $sql = "UPDATE appointmenttb SET status = '$status' WHERE appointmentNo = $appointmentId";
    if ($con->query($sql) === TRUE) {
        // Fetch appointment details from the database
        $sql1 = "SELECT * FROM appointmenttb WHERE appointmentNo = '$appointmentId'";
        $result = mysqli_query($con, $sql1);
        if ($result) {
            // Fetch rows one by one
            while ($row = mysqli_fetch_assoc($result)) {
                $petName = $row['petname'];
                $contact = $row['contact'];
                $fullname = $row['fullName'];
                $service = $row['service'];
                $date = date("F d, Y", strtotime($row['date']));
                $time = $row['time_slot'];

                // Convert contact number to correct format
            }
            // Free result set
            mysqli_free_result($result);

            // Prepare data for SMS sending
            $apiEndpoint = 'https://app.philsms.com/api/v3/sms/send';
            $data = [
                'recipient' => $contact,
                'sender_id' => 'PhilSMS',
                'type' => 'plain',
                'message' => 'Good Day Mr./Ms. ' . $fullname . ',
We are delighted to inform you that your appointment at our veterinary clinic has been approved. Below are the details:
Pets Name: ' . $petName . '
Appointment Date: ' . $date . '
Appointment Time: ' . $time . '
Reason for Visit: ' . $service . '
Clinic Location: Pantok, Binangonan Rizal
Please ensure that you arrive promptly at the scheduled time with your pet. If there are any changes required or if you have any questions, feel free to reach out to us.
We look forward to providing excellent care for your beloved pet.',
            ];

            // Initialize cURL session
            $ch = curl_init($apiEndpoint);
            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer 484|NxkXi9MZBkO9zgwPpSOHGAui1RspowRJjOzWq17y',
                'Content-Type: application/json',
                'Accept: application/json',
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CAINFO, "C:\cert\cacert.pem");

            // Execute cURL request
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL Error: ' . curl_error($ch);
            } else {
                // Check the response from the API
                echo 'Response: ' . $response;
            }

            // Close cURL session
            curl_close($ch);
        } else {
            // Handle query execution errors
            echo "Error: " . mysqli_error($con);
        }

        // Redirect to dashboard after successful update and SMS sending
        header('location: dashboard.php');
        exit();
    } else {
        // Error handling if the status update fails
        echo "Error updating status: " . $con->error;
    }
} else {
    // Handle case where appointmentNo or status is not set
    echo "Invalid request";
}
