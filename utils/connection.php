<?php
    require_once("globals.php");
    if (DEBUG) {
        require_once("local_connect.php");
    } else {
        require_once("superz_connect.php");
    }
?>