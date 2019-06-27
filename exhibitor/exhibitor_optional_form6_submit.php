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
        $query = "INSERT INTO optional_additional_fittings1(exhibitor_id, item_id, quantity) Values";
        foreach ($arr as $item=> $quantity) {
            $query .= "($exhibitorId, $item, $quantity),";
        }
        // the -1 in the method indicates how many chars to be 
        // eliminated from the end of the string.
        $query = substr($query, 0, -1);// removes the trailing comma from the query
        if(executeQuery($conn, $query)){
            $_SESSION['optional_form6_submitted'] = TRUE;
        }
        if (DEBUG) {
            echo $query;
        }
    }
?>