<?php
    require_once('../utils/globals.php');
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    } else {
        require_once("../utils/superz_connect.php");
    }
    function getAllPreferences($conn) {
        $query = "SELECT * FROM admin_preferences";
        $queryResults = executeQuery($conn, $query);
        return $queryResults->fetch_assoc();
    }