<?php
session_start();

// Include your connection script
include("../connection.php");
// $username = $_SESSION['username'];
// $userid = $_SESSION['userid'];
// $usertype = $_SESSION['usertype'];
// $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Logged out')");
// Function to update user status to "offline"
function logout($user_id, $con)
{
    // Update user status to "offline"
    $query = "UPDATE userstb SET status = 'offline' WHERE userid = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

// Call logout function passing the user_id and database connection
if (isset($_SESSION['userid'])) {
    logout($_SESSION['userid'], $con);
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("location: ../index.php");
exit();
