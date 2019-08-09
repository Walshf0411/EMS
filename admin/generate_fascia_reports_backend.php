<?php

require_once("../utils/globals.php");
if (DEBUG) {
    require_once("../utils/local_connect.php");
} else {
    require_once("../utils/superz_connect.php");
}

$query = "SELECT participant_name, fascia_name
            FROM exhibitor 
            INNER JOIN fascia_names ON exhibitor_id";
$queryResults = mysqli_query($conn, $query);

$output = "<table class='table' bordered='1'>
				<tr>
					<th>Sr.no</th>
					<th>Exhibitor Name</th>
					<th>Fascia Name</th>
				</tr>
";
$count = 1;
while($row = mysqli_fetch_assoc($queryResults)){
	$output .= "
		<tr>
			<td>".$count."</td>
			<td>".$row['participant_name']."</td>
			<td>".$row['fascia_name']."</td>
		</tr>
    ";
    $count++;
}
$output .= "</table>";

header("Content-Type: application/xls");
header("Content-Disposition:attachment; filename=download.xls");
echo $output;
?>