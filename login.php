<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <title>AnimalClinic</title>
</head>
<style>
    body {
        height: 100vh;
        display: flex;
        background: rgb(45, 88, 118);
        background: linear-gradient(0deg, rgba(45, 88, 118, 1) 0%, rgba(205, 213, 255, 1) 100%);
    }

    .left-container img {

        border-radius: 400px;
        width: 700px;
        height: 680px;

    }

    .right-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 70px;
    }

    .wrapper-container {
        background-color: whitesmoke;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        width: 100vh;
        padding: 70px;
        text-align: center
    }

    .wrapper-container input {
        margin-left: 60px;
    }

    .wrapper-container input {
        border: 0.5px solid;
    }

    .toggle-btn {
        cursor: pointer;
        position: absolute;
        top: 46%;
        right: -9%;
        transform: translateY(-40%);
        background: none;
        border: none;
    }

    .eye-icon {
        font-size: 1.5em;
        color: #3498db;
    }

    .col-sm-10 {
        position: relative;
    }

    .wrapper-container input {
        height: 70px;
    }

    .logo {
        display: flex;
        justify-content: center;
        height: 110px;
    }
</style>
<?php

include("connection.php");
if (!isset($_SESSION)) {
    session_start();
}

?>

<body>
    <div class="left-container">
        <img src="./img/dog-owner-for-login.png" alt="">
    </div>
    <div class="right-container">
        <div class="wrapper-container">
            <div class="logo">
                <a href="index.php"><img src="./img/logo.png" style="height: 100px;"></a>
            </div>
            <h3 style="color: #333A73; font-weight: 700; font-size: 24px;">Animal Clinic Business Operation System</h3>
            <p>Log in to your Account</p>
            <form method="post" class="needs-validation">
                <div class="row mb-3">
                    <div class="col-sm-10 has-validation">
                        <?php
                        $msg = "";
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $loginUsername = $_POST['username'];
                            $loginPassword = $_POST['password'];

                            $loginQuery = "SELECT * FROM userstb WHERE username=?";
                            $loginStmt = mysqli_prepare($con, $loginQuery);

                            if ($loginStmt) {
                                mysqli_stmt_bind_param($loginStmt, "s", $loginUsername);
                                mysqli_stmt_execute($loginStmt);
                                $loginQuery = mysqli_stmt_get_result($loginStmt);
                                if ($row = mysqli_fetch_assoc($loginQuery)) {
                                    login($row['userid']);
                                    if (password_verify($loginPassword, $row['password'])) {
                                        $_SESSION['username'] = $row['username'];
                                        $_SESSION['usertype'] = $row['usertype'];
                                        $_SESSION['firstname'] = $row['firstname'];
                                        $_SESSION['lastname'] = $row['lastname'];
                                        $_SESSION['contact'] = $row['contact'];
                                        $_SESSION['userid'] = $row['userid'];

                                        // for audit trail
                                        // $username = $_SESSION['username'];
                                        // $userid = $_SESSION['userid'];
                                        // $usertype = $_SESSION['usertype'];
                                        // $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Logged in')");

                                        if ($_SESSION['usertype'] == $row['usertype']) {
                                            if ($row['usertype'] == 'standard_User') {
                                                header('location: home.php');
                                            } elseif ($row['usertype'] == 'admin') {
                                                header('location: ./admin/dashboard.php');
                                            } elseif ($row['usertype'] == 'clinic_Staff') {
                                                header('location: ./clinicStaff/dashboard.php');
                                            } elseif ($row['usertype'] == 'veterinary') {
                                                header('location: ./veterinary/dashboard.php');
                                            }
                                        } else {
                                            $msg = '<div class="invalid-feedback text-left"><strong>Invalid Usertype</strong></div>';
                                        }
                                    } else {
                                        $msg = '<div class="invalid-feedback text-left"><strong>Username and password did not match</strong></div>';
                                    }
                                } else {
                                    $msg = '<div class="invalid-feedback text-left"><strong>User Does not exist</></div>';
                                }
                            }
                        }
                        ?>
                        <input class="form-control <?php if (isset($msg)) {
                                                        echo $msg ? 'is-invalid' : '';
                                                    } ?>" placeholder="Username" name="username" required>
                        <?php echo $msg; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 has-validation">
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                        <button type="button" id="toggleBtn" class="toggle-btn" onclick="togglePassword()">
                            <i id="eyeIcon" class="eye-icon fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Log in</button><br><br>
                <p>Dont have account? <a href="signup.php" style="text-decoration: none;">Sign Up</a></p>
            </form>
        </div>
    </div>
    <?php
    function login($user_id)
    {
        global $con;
        $query = "UPDATE userstb SET status = 'online' WHERE userid = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }

    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Script para sa invalid fields, sa bootsrap ito galing -->
<script>
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<!-- script para sa hide and unhide ng password -->
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

</html>