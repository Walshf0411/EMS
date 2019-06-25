<?php

    require_once('globals.php');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exhibitor_management_system";
    $base_url = 'http://'.$_SERVER['SERVER_NAME'].'/superz';
    $doc_url = $_SERVER['DOCUMENT_ROOT'].'/superz';

    // create connection

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    #var_dump($conn);
    
    if ($conn->errno > 0) {
        if (DEBUG) {
            logToJS("Mysql connection error: ".$conn->error);
        }
        exit;
    } 

?>