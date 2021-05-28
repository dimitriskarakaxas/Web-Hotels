<?php
// Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendActivationCode($email, $username, $activationCode) {
    // Include required PHPMailer files
    require "../includes/PHPMailer/src/PHPMailer.php";
    require "../includes/PHPMailer/src/SMTP.php";
    require "../includes/PHPMailer/src/Exception.php";

    try {
        $mail = new PHPMailer();
        // Server setting
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "webhotels2021@gmail.com";
        $mail->Password = "uthproject2021!";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
    
        // Recipients
        $mail->setFrom("webhotels2021@gmail.com", "webHotels");
        $mail->addAddress($email, $username);
    
        // Content
        $mail->isHTML(true);
        $mail->Subject = "WebHotels Activation Code";
        $mail->Body = "<p style='font-size: 40px; text-align: center; margin: 0 0 20px;'>Web Hotels</p><p style='color: purple; font-size: 20px;'>Congratulations for creating an account to our website!</p><p style='margin: 0; font-size: 20px;'>In order to continue and take your hotel online please confirm your registration by activating your account with the code below:</p><p style='font-size: 35px; margin: 10px 0 0 0; letter-spacing: 10px; text-align: center; border: 2px solid purple; display: inline-block;'>${activationCode}</p>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}
?>