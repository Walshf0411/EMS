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
require("../utils/admin_preferences.php");

function sendMail1 ($conn, $toAddress, $toName, $mailBody, $subject, $mainHeader) {
    $preferences = getAdminPreferences($conn);

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    $context = array(
        "content1" => $mailBody,
        "user" => $toName, 
        "mainHeader" => $mainHeader
    );

    $mailContent = renderToString($context, 'base.php');

    $mail->IsSMTP();
    $mail->Host = "mail.superjuniorz.com";
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
function sendMail ($conn, $toAddress, $toName, $username, $password, $mainHeader) {
    $preferences = getAdminPreferences($conn);

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    global $base_url;

    $content1 = "";
    $content1 .= $preferences['mail_body'];
    $content1 .= "<br>Below are your login credentials. Kindly login to the provided link and fill in the exhbitor manual.<br><br>
    <div>
        <strong>username:</strong><br> $username<br>
        <strong>password:</strong><br> $password<br>
        <a href='$base_url/exhibitor/login.php'>Click Here.</a>
    </div>";
    
    $context = array(
        "content1" => $content1,
        "user" => $toName, 
        "mainHeader" => $mainHeader
    );

    $mailContent = renderToString($context, 'base.php');

    if (!$subject) {
        // this is for the default mail that is sent when the user is first registered
        $subject = $preferences['mail_subject'];
    }

    $mail->IsSMTP();
    $mail->Host = "mail.superjuniorz.com";
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
var_dump(sendMailToAdmin ($conn, $mailBody, $subject, $mainHeader));
*/
?>