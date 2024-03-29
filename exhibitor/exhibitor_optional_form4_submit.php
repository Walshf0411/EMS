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
        $query = "INSERT INTO optional_form_advertising(position, exhibitor_id) Values";
        foreach ($arr as $position) {
            $query .= "($position, $exhibitorId),";
        }
        // the -1 in the method indicates how many chars to be 
        // eliminated from the end of the string.
        $query = substr($query, 0, -1);// removes the trailing comma from the query
        if (executeQuery($conn, $query)) {
            $_SESSION['optional_form4_submitted'] = TRUE;
            
            //Inserting or rather converting the flag in submitted_forms as 1/ set 

            $checkExistsQuery = "SELECT * FROM exhibitor_forms_submitted where exhibitor_id = ".$_SESSION['user_id'];
            echo $checkExistsQuery;
            $checkExistsQueryResults = executeQuery($conn, $checkExistsQuery);
            if ($checkExistsQueryResults->num_rows > 0) {
                // there is already an entry in the database for the user 
                // i.e the user has already filled in the mandatory forms.
                $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form4 = 1 where exhibitor_id = ".$_SESSION["user_id"];
                executeQuery($conn,$setQuery);
            } else {
                $participantName = $_SESSION['user_full_name'];
                $boothNumber = $_SESSION['exhibitor_booth_number'];
                // user has not submitted any forms yet
                $setQuery = "INSERT INTO exhibitor_forms_submitted (exhibitor_id, optional_form4, booth_number, participant_name) VALUES(".$_SESSION['user_id'].", 1, '$boothNumber', '$participantName')";
                executeQuery($conn, $setQuery);
            }
            include_once("../utils/globals.php");
            logToDb($conn, $_SESSION["user_id"], "ADVERTISING IN FAIR CATALOGUE");

            $participantName = $_SESSION['user_full_name'];
            global $base_url;
            
            $url = $base_url . "/admin/submitted_form.php?id=".$_SESSION["user_id"];
            $mailBody = "
                An application has been received from $participantName 
                kindly <a href='$url'>click here</a> to view the application. User has submitted mandatory forms.
            ";
            $mainHeader = "$participantName has submitted optional form 4.";
            $subject = "$participantName submitted optional form 4.";

            sendMailToAdmin ($conn, $mailBody, $subject, $mainHeader);
        }
        echo DEBUG;
        echo $query;
    }
?>