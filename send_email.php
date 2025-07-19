
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './mailer/src/Exception.php';
require './mailer/src/PHPMailer.php';
require './mailer/src/SMTP.php';

if(isset($_POST['send'])){
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'animalclinic717@gmail.com';
$mail->Password = 'agob xblv xukr qsez'; // Use environment variable or configuration file
$mail->SMTPSecure = 'ssl';  // Use 'ssl' for Gmail
$mail->Port = 465;  // Change the port to 465


$mail->setFrom('animalclinic717@gmail.com', 'Animal Clinic');
$mail->addAddress($_POST['email']);
$mail->Subject = 'Subject of the email';
$mail->Body = ($_POST['message']);

try {
    $mail->send();
    echo"<script>
    alert('Sent Successfully');
    document.location.href = 'about.php';
    
    </script>";
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
}
?>