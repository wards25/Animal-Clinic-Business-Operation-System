<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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

    .wrapper-container {
        margin-top: 60px;
        margin-bottom: 60px;
        width: 100vh;
        background: rgba(92, 131, 242, 0.45);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(3.5px);
        -webkit-backdrop-filter: blur(3.5px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 10px;
    }

    .wrapper-container label {
        color: black;
    }

    .toggle-btn {
        cursor: pointer;
        position: absolute;
        top: 55%;
        right: 2%;
        background: none;
        border: none;
    }

    .wrapper-container .mb-3 {
        position: relative;
    }

    .eye-icon {
        font-size: 1.5em;
        color: #3498db;
    }

    .err_msg1 {
        background-color: #FF004D;
        color: whitesmoke;
        width: 55vh;
        padding: 15px;
        text-align: center;
    }
</style>


<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $contactno = $_POST['contact'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $usertype = 'standard_User';

    $checkStmt = $con->prepare("SELECT * FROM userstb WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $result = $checkStmt->get_result();


    if ($password != $confirmpassword) {
        $err_msg = '<div class="err_msg1">Password did not match</div>';
    } else {
        if ($result->num_rows > 0) {
            $err_msg = '<div class="err_msg1">Username is already exist, Enter a new one</div>';
        } else {
            // Check if passwords match
            if (strlen($password) < 8) {
                $err_msg = '<div class="err_msg1">Password must be atleast 8 characters</div>';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = "INSERT INTO userstb (firstname, lastname, username, contact, password, usertype) VALUES ('$firstname', '$lastname', '$username', '$contactno', '$hashed', '$usertype')";
                if ($query = mysqli_query($con, $stmt)) {
                    echo '<script> alert("Successfully created account"); window.location.href = "login.php"; </script>';
                } else {
                    echo '<script> alert("Error creating account: ' . mysqli_error($con) . '"); window.location.href = "signup.php"; </script>';
                }
            }
        }
    }
}
?>



<body>
    <div class="container">
        <div class="wrapper-container">
            <img src="./img/wave-haikei.png" style="position: absolute; width: 100%;">
            <img src="./img/wave-haikei (5).png" style="position: absolute; width: 100%; bottom:0px;">
            <form method="post" class="needs-validation" style="padding: 160px; position:relative;">
                <h1 class="" style="color: whitesmoke; text-align:center;">Create Account</h1>
                <div class="mb-3">
                    <?php
                    if (isset($err_msg)) {
                        echo $err_msg;
                    }
                    ?>
                    <label class="form-label">First Name <span style="color: red; font-size: 20px;">*</span></label>
                    <input class="form-control" name='firstname' required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name <span style="color: red; font-size: 20px;">*</span></label>
                    <input class="form-control" name='lastname' required>

                </div>
                <div class="mb-3">
                    <label class="form-label">UserName <span style="color: red; font-size: 20px;">*</span></label>
                    <input class="form-control" name='username' required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Contact No. <span style="color: red; font-size: 20px;">*</span></label>
                    <input class="form-control" name='contact' required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Password <span style="color: red; font-size: 20px;">*</span></label>
                    <input type="password" class="form-control" id="password" name='password' placeholder="password must be atleast 8 characters" required>
                    <button type="button" id="toggleBtn" class="toggle-btn" onclick="togglePassword()">
                        <i id="eyeIcon" class="eye-icon fas fa-eye"></i>
                    </button>

                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password <span style="color: red; font-size: 20px;">*</span></label>
                    <input type="password" class="form-control" id="password" name="confirmpassword" required>
                </div>
                <!-- Checkbox -->
                <div class="container mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="myModalCheckbox" required>
                        <label class="form-check-label" for="myModalCheckbox" style="color: whitesmoke;">Privacy Policy</label>
                    </div>
                </div>
                <div class="button" style=" display: flex; justify-content:center; margin: 15px;">
                    <button class="btn btn-success" style="color: whitesmoke; font-weight:bold;" type="submit" name="signin">Sign in</button><br><br>
                </div>
                <p style="color: whitesmoke; text-align: center;">Already have account?<a href="login.php">Login</a></p>
            </form>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Privacy Policy</h5>
                    <button type="button" class="btn-close btn btn-danger" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Welcome to AnimalClinic, owned and operated by Group Pasikat. We respect your privacy and are committed to protecting it through our compliance with this policy. This Privacy Policy describes:</p>

                    <ol>
                        <li>The types of information we may collect from you or that you may provide when you visit our website.</li>
                        <li>Our practices for collecting, using, maintaining, protecting, and disclosing that information.</li>
                    </ol>

                    <p>Please read this Privacy Policy carefully to understand our policies and practices regarding your information. If you do not agree with our policies and practices, your choice is not to use our Website. By accessing or using this Website, you agree to this Privacy Policy.</p>

                    <h4>a. Personal Information</h4>

                    <p>We may collect personal information, such as:</p>
                    <ul>
                        <li>Names</li>
                        <li>Email addresses</li>
                        <li>Phone numbers</li>
                        <li>Other information you provide voluntarily</li>
                    </ul>

                    <h4>b. Non-Personal Information</h4>

                    <p>We may collect non-personal information about you, such as:</p>
                    <ul>
                        <li>Browser type</li>
                        <li>Operating system</li>
                        <li>IP address</li>
                        <li>Pages visited on our Website</li>
                        <li>Date and time of visits</li>
                    </ul>

                    <h4>3. How We Collect Information</h4>

                    <p>We collect information:</p>
                    <ul>
                        <li>Directly from you when you provide it to us.</li>
                        <li>Automatically as you navigate through the site (using cookies, web beacons, or other tracking technologies).</li>
                    </ul>

                    <h4>4. How We Use Your Information</h4>

                    <p>We may use your information to:</p>
                    <ul>
                        <li>Provide you with the services and products you request.</li>
                        <li>Improve our Website and present its contents to you.</li>
                        <li>Communicate with you about our products, services, and promotions.</li>
                        <li>Fulfill any other purpose for which you provide it.</li>
                    </ul>

                    <h4>5. Disclosure of Your Information</h4>

                    <p>We may disclose aggregated, anonymized information about our users without restriction.</p>
                    <p>We may disclose personal information:</p>
                    <ul>
                        <li>To contractors, service providers, and other third parties we use to support our business.</li>
                        <li>To comply with any court order, law, or legal process.</li>
                    </ul>

                    <h4>6. Your Choices</h4>

                    <p>Opt-Out: You may choose to stop receiving our marketing emails by following the unsubscribe instructions included in these emails.</p>

                    <h4>7. Security</h4>

                    <p>We use reasonable measures to help protect your personal information. However, no method of transmission over the internet or electronic storage is completely secure.</p>

                    <button type="button" class="btn btn-success" data-dismiss="modal">Agree</button>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./js/script.js"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
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

<script>
    // Function to toggle the password visibility
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        // Toggle the type attribute between "password" and "text"
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