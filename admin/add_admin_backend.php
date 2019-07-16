<?php
require_once('../utils/globals.php');
if (DEBUG) {
    require_once('../utils/local_connect.php');
} else {
    require_once('../utils/superz_connect.php');
}

function getListOfAdmins($conn) {
    $query = "SELECT * FROM admin";
    return executeQuery($conn, $query);
}

function printAdminList($conn, $queryResult) {
    if ($queryResult->num_rows > 0) {
        $count = 1;
        while ($admin = $queryResult->fetch_assoc()) {
            $name = $admin['full_name'];
            $username = $admin['username'];
            $email = $admin['email'];
            echo "<tr>
                    <td>$count</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$username</td>
                </tr>";
            $count++;
        }
    } else {
        echo "<tr><td colspan=6>No Admin Found.</td></tr>";
    }
    
}

function getAllAdmins($conn) {
    $queryResult = getListOfAdmins($conn);
    printAdminList($conn, $queryResult);
}

if(isset($_GET['ajax'])) {
    getAllAdmins($conn);    
}