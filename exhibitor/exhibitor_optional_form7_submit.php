<?php
    session_start();
    require_once("../utils/globals.php");
    
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    }else {
        require_once("../utils/superz_connect.php");
    }
    require_once("../utils/mailer.php");
    if (isset($_POST['selected_items'])) {
        $arr = json_decode($_POST['selected_items']);
        // insert all the positions in the database
        // attributes position exhibitor_id
        $exhibitorId = $_SESSION['user_id'];
        $query = "INSERT INTO optional_additional_fittings2(exhibitor_id, item_id, quantity) Values";
        foreach ($arr as $item=> $quantity) {
            $query .= "($exhibitorId, $item, $quantity),";
        }
        // the -1 in the method indicates how many chars to be 
        // eliminated from the end of the string.
        $query = substr($query, 0, -1);// removes the trailing comma from the query
        if(executeQuery($conn, $query)){
            $_SESSION['optional_form7_submitted'] = TRUE;
            
            $checkExistsQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_SESSION['user_id'];
            $checkExistsQueryResult = executeQuery($conn, $checkExistsQuery);
            
            if ($checkExistsQueryResult->num_rows) {
                // exhibitor has already filled in a form 
                $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form7 = 1 where exhibitor_id = ".$_SESSION["user_id"];
                executeQuery($conn,$setQuery);
            } else {
                // exhibitor has not filled any of the forms
                $participantName = $_SESSION['user_full_name'];
                $boothNumber = $_SESSION['exhibitor_booth_number'];
                $setQuery = "INSERT INTO exhibitor_forms_submitted(exhibitor_id, optional_form7, booth_number, participant_name) VALUES(".$_SESSION['user_id'].", 1, '$boothNumber', '$participantName')";
                executeQuery($conn, $setQuery);
            }
            
            include_once("../utils/globals.php");
            logToDb($conn, $_SESSION["user_id"], "ADDITIONAL FURNITURE");

            $participantName = $_SESSION['user_full_name'];
            global $base_url;
            
            $url = $base_url . "/admin/submitted_form.php?id=".$_SESSION["user_id"];
            $mailBody = "
                An application has been received from $participantName 
                kindly <a href='$url'>click here</a> to view the application. User has submitted mandatory forms.
            ";
            $mainHeader = "$participantName has submitted optional form 7.";
            $subject = "$participantName submitted optional form 7.";
            sendMailToAdmin ($conn, $mailBody, $subject, $mainHeader);
        }
        if (DEBUG) {
            echo $query;
        }
    }
?>