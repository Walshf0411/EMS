<?php

require_once("../utils/connection.php");
require_once("../utils/export_to_xls.php");

$query = "SELECT participant_name, booth_number, code_number, product_name, quantity
FROM exhibitor
INNER JOIN optional_additional_fittings2 as base_table ON exhibitor_id
INNER JOIN additional_requirements_items ON base_table.item_id = additional_requirements_items.id
ORDER BY booth_number";

getExcelHeaders("additional_furniture_requirements.xlsx");
echo queryToTable($conn, $query, ['Participant Name', 'Booth Number', 'Advertising Position']);
