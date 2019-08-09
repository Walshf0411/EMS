<?php

require_once("../utils/connection.php");
require_once("../utils/export_to_xls.php");

$query = "SELECT participant_name, booth_number, advertising.position FROM exhibitor INNER JOIN optional_form_advertising as optional_advert ON exhibitor_id INNER JOIN advertising_in_fair_catalogue as advertising on optional_advert.position=advertising.id";

getExcelHeaders("advertising_in_fair_catalogue.xlsx");
echo queryToTable($conn, $query, ['Participant Name', 'Booth Number', 'Advertising Position']);
