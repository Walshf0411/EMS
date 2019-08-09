<?php

require_once("../utils/connection.php");
require_once("../utils/export_to_xls.php");


$query = "SELECT participant_name, booth_number, item_description, quantity
FROM exhibitor
INNER JOIN optional_other_services ON exhibitor_id
INNER JOIN other_services os ON item_id = os.id ";

getExcelHeaders("other_services.xlsx");
echo queryToTable($conn, $query, ['Participant Name', 'Booth Number', 'Item Description', 'Quantity']);
