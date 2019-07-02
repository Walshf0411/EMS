<?php

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mainHeader = "A new application has been submitted";
$mailBody = "Hello world";
/*
$subject = "Hello world";
sendMailToAdmin ($conn, $mailBody, $subject, $mainHeader);
echo "Mail sent";

sendMail1($conn, "walshfernades.320@gmail.com", "walsh", "hello", "Test", "test");
*/
// var_dump(getAdminPreferences($conn));

$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->IsSMTP();
$mail->Host = "mail.intimasia.co.in";
$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = "587";
$mail->Username = "ems@intimasia.co.in";
$mail->Password = "Pepcom@123";

$mail->From = "ems@intimasia.co.in";
$mail->FromName = "SS";
$mail->AddAddress("rahulnandrajog99@gmail.com", "Rahul Nandrajog");  

$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "asdase";
$mail->Body = "asdasd";
$mail->Send();
echo "mail send";