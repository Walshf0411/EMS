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