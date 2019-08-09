<?php

// turn development mode on off by setting this boolean
define("DEBUG", TRUE);

function logToJS($message) {
    echo "<script>console.log('$message')</script>";
}

function notify($message, $type, $position = 'top center') {
    /*
        @arguments:
        1. message - The message that should appear on the nofiication.
        2. type - the type of notification possible options = ['success', error', 'info']
        3. position - position of where the notification should appear on the screen
        possible options = [
            'top left', 
            'top center', 
            'top right', 
            'right top',
            'right middle',
            'right bottom',
            'bottom right', 
            'bottom center', 
            'bottom left', 
            'left bottom', 
            'left middle',
            'left top'
        ]
    */ 
    echo "<script>
            $.notify.defaults({
                globalPosition: '$position',
            });
            $.notify('$message', '$type');
            </script>";
}

function executeQuery($conn, $query) {
    return $conn->query($query);
}

function generatePassword($length=8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $password = ''; 
  
    for ($i = 0; $i < $length; $i++) { 
        // generate a random index and append the char at it in the list to the password.
        $index = rand(0, strlen($characters) - 1); 
        $password .= $characters[$index]; 
    } 
  
    return $password; 
} 

function JS($code) {
    echo "<script>$code</script>";
}

function getAdminPreferences($conn) {
    $query = "SELECT * FROM admin_preferences";
    $queryResult = executeQuery($conn, $query);
    return $queryResult->fetch_assoc();
}

function getExhibitorDetails($conn, $exhibitorId) {
    $query = "SELECT * from exhibitor WHERE id=".$exhibitorId;
    $queryResult = executeQuery($conn, $query);
    return $queryResult->fetch_assoc();
}

function getFormStatus($conn) {
    $query = "SELECT * FROM exhibitor_forms_submitted where exhibitor_id=".$_SESSION['user_id'];
    $queryResult = executeQuery($conn, $query);
    if ($queryResult->num_rows > 0) {
        $status = $queryResult->fetch_assoc();
        return $status;
    }
}

function getSubmissionDates($conn, $format="d F Y") {
    $query = "SELECT mandatory_forms_deadline, optional_form4_deadline, optional_form5_deadline,
    optional_form6_deadline, optional_form7_deadline FROM admin_preferences";
    $queryResult = executeQuery($conn, $query);
    if ($queryResult->num_rows > 0) {
        $dates = $queryResult->fetch_assoc();
        
        $dates["mandatory_forms_deadline"] = date($format, strtotime($dates['mandatory_forms_deadline']));
        $dates["optional_form4_deadline"] = date($format, strtotime($dates['optional_form4_deadline']));
        $dates["optional_form5_deadline"] = date($format, strtotime($dates['optional_form5_deadline']));
        $dates["optional_form6_deadline"] = date($format, strtotime($dates['optional_form6_deadline']));
        $dates["optional_form7_deadline"] = date($format, strtotime($dates['optional_form7_deadline']));

        return $dates;
    }
}

function logToDb($conn, $exhibitorId, $formName, $status=NULL) {
    
    /**
     * function to log some status about form submision in db.
     * Possible status messages
     * Exhibitor: SUBMITTED EDITED
     * ADMIN: ACCEPTED, REJETED
     *  */ 
    if (!$status) {
        // a status wiil be provided only by the admin code
        // the below if else loop is to determine what the status should be
        $checkQuery = "SELECT * FROM logs WHERE exhibitor_id = $exhibitorId AND form_name = '$formName'";
        $checkQueryResult = executeQuery($conn, $checkQuery);
        if ($checkQueryResult->num_rows > 0) {
            /* 
            the above statement means that the user has already 
            submitted the form before, hence we add a log with the status EDITED
            */
            $status = "EDITED";
            $insertLog = "INSERT INTO logs(exhibitor_id, form_name, status) values($exhibitorId, '$formName', '$status')";
            executeQuery($conn, $insertLog);
        } else {
            /**
             * This block means that the user has not previously submitted this form
             * hence the status will be SUBMITTED.
             */
            $status = "SUBMITTED";
            $insertLog = "INSERT INTO logs(exhibitor_id, form_name, status) values($exhibitorId, '$formName', '$status')";
            executeQuery($conn, $insertLog);
        }
    } else {
        // this code will execute only when exhibitor side calls the method.
        $insertLog = "INSERT INTO logs(exhibitor_id, form_name, status) values($exhibitorId, '$formName', '$status')";
        executeQuery($conn, $insertLog);
    }
}
