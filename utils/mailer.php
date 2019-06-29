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

function sendMail ($conn, $toAddress, $toName, $username=NULL, $password=NULL, $mailBody=NULL, $subject=NULL) {
    $preferences = getAdminPreferences($conn);

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mainHeader = "You have been invited to INTIMASIA Kolkata 2019";

    if (!$mailBody) {
        $content1 = "";
        $content1 .= $preferences['mail_body'];
        $content1 .= "<br>Below are your login credentials. Kindly login to the provided link and fill in the exhbitor manual.<br><br>
        <div>
            <strong>username:</strong><br> $username<br>
            <strong>password:</strong><br> $password<br>
            <a href='http://localhost/exhibitor/login.php'>Click Here.</a>
        </div>";
    } else {
        $content1 = $mailBody;
    }
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

//var_dump(sendMail($conn, "2016.walsh.fernandes@ves.ac.in", "Walsh Fernandes", "walsh", "gitbtitw", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum rerum sint expedita. Sed odio atque voluptatum fuga repellat porro provident officiis enim quia eius nostrum facilis sit, praesentium voluptate? Velit ipsa porro impedit dolorem, nisi dolorum iure dignissimos maxime. Velit excepturi perspiciatis ipsum aut error explicabo voluptate nostrum rerum optio?"));
?>