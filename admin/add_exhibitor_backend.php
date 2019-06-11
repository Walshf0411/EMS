<?php
require_once('../utils/globals.php');
if (DEBUG) {
    require_once('../utils/local_connect.php');
} else {
    require_once('../utils/superz_connect.php');
}

function getListOfExhibitors($conn) {
    $query = "SELECT * FROM exhibitor";
    return executeQuery($conn, $query);
}

function printExhibitorList($conn, $queryResult) {
    if ($queryResult->num_rows > 0) {
        $count = 1;
        while ($exhibitor = $queryResult->fetch_assoc()) {
            $id = $exhibitor['id'];
            $name = $exhibitor['participant_name'];
            $email = $exhibitor['email'];
            $phoneNumber = $exhibitor['phone_number'];
            echo "<tr>
                    <td>$count</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$phoneNumber</td>
                </tr>";
            $count++;
        }
    } else {
        echo "<tr><td colspan=4>No Exhibitors Found.</td></tr>";
    }
    
}

function getAllExhibitors($conn) {
    $queryResult = getListOfExhibitors($conn);
    printExhibitorList($conn, $queryResult);
}

function checkExists($conn, $name, $email, $phoneNumber) {
    $exists = FALSE;
    $query = "SELECT * from exhibitor where participant_name='$name' or email='$email' or phone_number='$phoneNumber'";
    $queryResult = executeQuery($conn, $query);
    if ($queryResult->num_rows > 0) {
        // a user already exits.
        $exists = TRUE;
    } 
    return $exists;
}

function insertDataToDB($conn, $name, $email, $phoneNumber, $username, $password) {
    // data is not in DB.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO exhibitor(participant_name, email, phone_number, username, password) 
    values('$name', '$email', '$phoneNumber', '$username', '$hashedPassword')";
    $queryResult = executeQuery($conn, $query);
    return $queryResult;
}

if(isset($_GET['ajax'])) {
    getAllExhibitors($conn);    
}