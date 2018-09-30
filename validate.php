<?php

//Backend Validations

require 'common.php';

$name = $_POST['name'];

$email = $_POST['email'];

$regrex_email = "/^[a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

if(!preg_match($regrex_email, $email)){
	header('location: index.php?email_error=enter correct email');
}

$email= mysqli_real_escape_string($con, $email);


$con = mysqli_connect("localhost","root","","Portfolio") or die(mysqli_error($con));

$subject= $_POST['subject'];

$message= $_POST['message'];

$contact_details= "insert into contact(ID, Name, Email_id, Subject, Message) values('', '$name', '$email', '$subject','$message')";

$contact_details_submit= mysqli_query($con, $contact_details) or die(mysqli_error($con));


echo "Thank You for Contacting. Have a Nice day :) ";


///////////////////////////


	
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '24yadav09sumit96@gmail.com';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('24yadav09sumit96@gmail.com', 'Sumit');
    $mail->addAddress($_POST['email'], $_POST['name']);     // Add a recipient

    $body= "<p> <strong> Hi! $name </strong><br>Thank You for contacting. </p>
        From:- <br> Sumit Yadav<br>Developer<br>Resource Person, CSE Technical Team, JUET";

     //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Thanks email from Sumit';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}



/////////////////////








?>