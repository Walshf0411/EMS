<?php

require_once("../utils/globals.php");
if (DEBUG) {
    require("../utils/local_connect.php");
} else {
    require("../utils/superz_connect.php");
}

require("../utils/mailer.php");
if (isset($_POST['toAddress']) && isset($_POST["toName"]) && isset($_POST["mailBody"]) && isset($_POST["subject"]) && isset($_POST["mainHeader"])) {
    
    sendMail1 ($conn, $_POST["toAddress"], $_POST["toName"], $_POST["mailBody"], $_POST["subject"], $_POST["mainHeader"]);
}
