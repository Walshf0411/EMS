<?php

require_once("../utils/connection.php");
require_once("../utils/export_to_xls.php");

$query = "SELECT participant_name, booth_number, item_description, quantity
FROM exhibitor
INNER JOIN optional_additional_fittings1 as base_table ON exhibitor_id
INNER JOIN electrical_requirements ON base_table.item_id = electrical_requirements.id
ORDER BY booth_number";

getExcelHeaders("electrical_requirements.xlsx");
echo queryToTable($conn, $query, ['Participant Name', 'Booth Number', 'item Description', 'Quantity']);
