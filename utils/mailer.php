<?php

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require_once("globals.php");
if (DEBUG) {
    require_once("local_connect.php");
} else {
    require_once("superz_connect.php");
}
require("../utils/render_mail_templates.php");
require_once("../utils/admin_preferences.php");

function sendMail1 ($conn, $toAddress, $toName, $mailBody, $subject, $mainHeader) {
    $preferences = getAdminPreferences($conn);

    $context = array(
        "content1" => $mailBody,
        "user" => $toName, 
        "mainHeader" => $mainHeader
    );

    $mailContent = renderToString($context, 'base.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->IsSMTP();
    $mail->Host = "mail.intimasia.co.in";
    $mail->SMTPAuth = true;
    //$mail->SMTPSecure = "ssl";
    $mail->Port = "587";
    $mail->Username = $preferences['from_email'];
    $mail->Password = $preferences['from_email_password'];

    $mail->From = $preferences['from_email'];
    $mail->FromName = $preferences['display_name'];
    $mail->AddAddress($toAddress, $toName);
    
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $mailContent;
    $mail->Send();
}
function sendMail ($conn, $toAddress, $toName, $username, $password, $mainHeader) {
    $preferences = getAdminPreferences($conn);

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    global $base_url;
    $content1 = "";
    $content1 .= nl2br($preferences['mail_body']); #converts new linest to <br>
    $content1 .= "
    <br>Kindly click on the link below to complete your participation process by filling the Exhibitor Manual. Please note your login details are as follows:<br><br>
    <div>
        <strong>username:</strong> $username<br>
        <strong>password:</strong> $password<br>
        <a href='$base_url/exhibitor/login.php'>Click Here.</a><br/>
        <p>Please note down your username and password and do not share you password with anyone.
        The password provided is an auto-generated password. You can change your password in the dashboard.</p>
    </div>
    <strong>INSTRUCTIONS</strong><br>
    <ol>
        <li>Click on the link and use the provided username and password to login into your account.</li>
        <li>On the left of your dashboard you will find Mandatory forms and Optional forms.
        Kindly fill in the details in the mandatory forms and submit it as early as possible.</li>
        <li>Optional forms to be filled in as per requirements, but have to be submitted before the specified deadline.</li>
        <li>Once you have submitted a form(mandatory or optional), wait for the admin to review it. You will be notified about following instructions via email.</li>
        <li>Once a form has been reviewed by the admin you will receive an invoice regarding payment. Pay the amount specifed to the organizer's as sson as possible.</li>
    </ol>";
    
    $context = array(
        "content1" => $content1,
        "mainHeader" => $mainHeader
    );

    $mailContent = renderToString($context, 'base.php');

    $subject = $preferences['mail_subject'];

    $mail->IsSMTP();
    $mail->Host = "mail.intimasia.co.in";
    $mail->SMTPAuth = true;
    //$mail->SMTPSecure = "ssl";
    $mail->Port = "587";
    $mail->Username = $preferences['from_email'];
    $mail->Password = $preferences['from_email_password'];

    $mail->From = $preferences['from_email'];
    $mail->FromName = $preferences['display_name'];
    $mail->AddAddress($toAddress, $toName);
    
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $mailContent;
    return $mail->Send();
}

function sendMailToAdmin ($conn, $mailBody, $subject, $mainHeader) {
    $adminPrefernces = getAdminPreferences($conn);
    $toAddress = $adminPrefernces['admin_email'];
    $toName = "EMS ADMIN";
    sendMail1($conn, $toAddress, $toName, $mailBody, $subject, $mainHeader);
}

/*
//var_dump(sendMail($conn, "2016.walsh.fernandes@ves.ac.in", "Walsh Fernandes", "walsh", "gitbtitw", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum rerum sint expedita. Sed odio atque voluptatum fuga repellat porro provident officiis enim quia eius nostrum facilis sit, praesentium voluptate? Velit ipsa porro impedit dolorem, nisi dolorum iure dignissimos maxime. Velit excepturi perspiciatis ipsum aut error explicabo voluptate nostrum rerum optio?"));
$mainHeader = "A new application has been submitted";
$mailBody = "Hello world";

$subject = "Hello world";
sendMailToAdmin ($conn, $mailBody, $subject, $mainHeader);
echo "Mail sent";

sendMail1($conn, "walshfernades.320@gmail.com", "walsh", "hello", "Test", "test");
*/
// var_dump(getAdminPreferences($conn));

/*
$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->IsSMTP();
$mail->Host = "mail.superjuniorz.com";
$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = "587";
$mail->Username = "info@superjuniorz.com";
$mail->Password = "Pepcom@1,2,3!";

$mail->From = "info@superjuniorz.com";
$mail->FromName = "SS";
$mail->AddAddress("walshfernades.320@gmail.com", "walsh");

$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "asdase";
$mail->Body = "asdasd";
$mail->Send();
echo "mail send";
*/
// sendMail ($conn, "walshfernades.320@gmail.com", "Walsh fernandes", "walshfernades", "gitbtit", "Testing");
?>