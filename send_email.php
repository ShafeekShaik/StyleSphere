<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$alert = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNum = $_POST['phoneNum'];
    $orderNum = $_POST['orderNum'];
    $message = $_POST['message'];

    try {

        $mail->IsSMTP();

//        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "shopietest12@gmail.com";
        $mail->Password = "kbbsndzbbzzgenyh";

        $mail->IsHTML(true);
        $mail->AddAddress("shopietest12@gmail.com");
        $mail->SetFrom("shopietest12@gmail.com");
        $mail->Subject = 'Message Received (Contact Page)';
        $mail->Body = "<h3>Name : $name <br>Email: $email <br>Phone Number: $phoneNum <br>Order Number: $orderNum <br>Message : $message</h3>";

        $mail->send();
        $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.</span>
                </div>';
        session_start();
        $_SESSION['feedback'] = 'Feedback has been sent successfully!';
        header("location: contact.php#form-details");
    } catch (Exception $e) {
        $_SESSION['feedback'] = 'Feedback has not been sent successfully. Please contact administrator!';
        header("location: contact.php#form-details");

        $alert = '<div class="alert-error">
                <span>' . $e->getMessage() . '</span>
              </div>';
    }
}
?>
