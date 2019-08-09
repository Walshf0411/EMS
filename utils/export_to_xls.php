<?php

    function queryToTable($conn, $query, array $attributeNames) {
        
        $queryResults = mysqli_query($conn, $query);
        if ($queryResults && mysqli_num_rows($queryResults) > 0) {
            // query executed and produced some number of rows
            $output = "<table>";
            $count = 1;
            $output .= "<tr><th>Sr.no</th>";

            foreach ($attributeNames as $name) {
                // Create the head of the table by using all the header names passed in the query
                $output .= "<th>$name</th>";
            }
            $output .= "</tr>";

            while($row = mysqli_fetch_array($queryResults, MYSQLI_NUM)) {
                $output .= "<tr>";
                $output .= "<td>$count</td>";
                foreach ($row as $attr) {
                    $output .= "<td>$attr</td>";
                }
                $output .= "</tr>";
                $count++;
            }

            $output .= "</table>";
            return $output;
        }
    }
    function getExcelHeaders($filename) {
        header("Content-Type: application/xlsx");
        header("Content-Disposition:attachment; filename=$filename");
    }

    // require_once("local_connect.php");
    // $query = "SELECT participant_name, booth_number, fascia_name 
    // FROM exhibitor 
    // INNER JOIN fascia_names ON exhibitor_id 
    // ";
    // echo queryToExcel($conn, $query, ['Participant Name', 'Booth Number', 'Fascia name']);
?>