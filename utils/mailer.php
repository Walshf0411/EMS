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

function sendMail ($conn, $toAddress, $toName, $username=NULL, $password=NULL, $mailBody=NULL, $subject=NULL) {
    $preferences = getAdminPreferences($conn);

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    if (!$mailBody) {
    $mailBody = "<html>
            <br>Dear $toName,<br>".
            $preferences['mail_body']."<br>Below are your login credentials. Kindly login to the provided link and fill in the exhbitor manual.<br><br>
            <div align=center>
                <strong>username:</strong><br> $username<br>
                <strong>password:</strong><br> $password<br>
                <a href='http://ems.superjuniorz.com/exhibitor/login.php'>Click Here.
            </div>
            <br>
            Warm Regards,<br> 
            Exbhitor Management System<br><br>
            <i>This is a system generated mail.</i>
            <br><span style='color:rgb(153, 0, 0)'>Brand Strategy | Events & Promotions | Exhibitions | Shoot Management | Publishing</span><br>
            <b>Peppermint Communications Pvt. Ltd.</b><br>
            Unit No. B-135, Antophill Warehousing Complex, V.I.T. College Road, Wadala (E), Mumbai - 400037<br>
            Tel: 91-22-40956666 (Board) Web: <a href='www.peppermint.co.in'>www.peppermint.co.in</a> | <a href='www.innersecrets.co.in'>www.innersecrets.co.in</a> | <a href='www.iaai.co.in'>www.iaai.co.in</a><br>
            <img width=100% src='http://superjuniorz.com/images/super-email-header.jpg' alt='Super Juniorz Logo'/>
            </html>";
    }
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
    $mail->Body = $mailBody;
    return $mail->Send();
}

// var_dump(sendMail($conn, "2016.walsh.fernandes@ves.ac.in", "Walsh Fernandes", "walsh", "gitbtitw"));
?>