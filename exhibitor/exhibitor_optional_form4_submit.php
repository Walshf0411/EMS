<?php
    session_start();
    require_once("../utils/globals.php");
    
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    }else {
        require_once("../utils/superz_connect.php");
    }

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
        executeQuery($conn, $query);
        $_SESSION['optional_form4_submitted'] = TRUE;
        echo DEBUG;
        echo $query;
    }
?>