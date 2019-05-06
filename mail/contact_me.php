<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);
// Check for empty fields
try{
    if(empty($_POST['name'])  		||
       empty($_POST['email'])	||
       empty($_POST['message'])	||
       !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
       {
        echo "No arguments Provided!";
        return false;
       }

    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $message = $_POST['message'];

    $mail->isSMTP();
    $mail->Host = 'smtp.yandex.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@commonfactor.tech';
    $mail->Password = '1234512345';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPDebug = 2;

    $mail->setFrom('no-reply@commonfactor.tech', 'Common Factor');
    $to = 'info@commonfactor.tech';
    $mail->addAddress($to, 'Common Factor');
    $email_subject = "Request demo of our solutions";
    $mail->Subject = $email_subject;
    $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\nEmail: $email_address\nMessage: $message";
    $mail->Body = $email_body;
    $mail->send();
    return true;
}catch (Exception $e){
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    return false;
}
?>