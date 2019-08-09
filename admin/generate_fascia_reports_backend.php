<?php

require_once("../utils/connection.php");
require_once("../utils/export_to_xls.php");

$query = "SELECT participant_name, booth_number, fascia_name
            FROM exhibitor 
            INNER JOIN fascia_names ON exhibitor_id";

getExcelHeaders("fascia_names.xlsx");
echo queryToTable($conn, $query, ['Participant Name', 'Booth Number', 'Fascia Name']);
?>