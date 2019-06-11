<?php
    require_once('globals.php');
    $servername = "localhost";
    $username = "superjun_new";
    $password = "Slm@15893";
    $dbname = "superjun_new";
    $base_url = 'http://'.$_SERVER['SERVER_NAME'].'/superz';
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