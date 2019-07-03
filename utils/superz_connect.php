<?php
    require_once('globals.php');
    $servername = "localhost";
    $username = "intimasi_user123";
    $password = "intimasia###123";
    $dbname = "intimasi_ems";
    $base_url = 'http://intimasia.co.in/ems';
    $doc_url = $_SERVER['DOCUMENT_ROOT'].'/superz';

    // create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    #var_dump($conn);
    if ($conn->errno > 0) {
        if (DEBUG) {
            echo "Mysql connection error: ".$conn->error;
        }
        exit;
    } else {
        if (DEBUG) {
            echo "Connected to database";
        }
    } 
?>