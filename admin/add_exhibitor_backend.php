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
            $name = $exhibitor['participant_name'];
            $email = $exhibitor['email'];
            $contactPerson = $exhibitor['contact_person'];
            $phoneNumber = $exhibitor['phone_number'];
            $boothNumber = $exhibitor['booth_number'];
            echo "<tr>
                    <td>$count</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$contactPerson</td>
                    <td>$phoneNumber</td>
                    <td>$boothNumber</td>
                </tr>";
            $count++;
        }
    } else {
        echo "<tr><td colspan=6>No Exhibitors Found.</td></tr>";
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
function checkBoothNumberExists($conn, $boothNumber) {
    $query = "SELECT * FROM Exhibitor where booth_number='$boothNumber'";
    return executeQuery($conn, $query)->num_rows > 0;
}

function insertDataToDB($conn, $name, $email, $contactPerson, $phoneNumber, $brandName, $boothNumber, $username, $password) {
    // data is not in DB.
    $username = $email;
    if (DEBUG){
        logToJS("password: " + $password);
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO exhibitor(participant_name, brands, username, phone_number, email, password, booth_number, contact_person) 
    values('$name', '$brandName', '$username', '$phoneNumber','$email', '$hashedPassword', '$boothNumber', '$contactPerson')";
    $queryResult = executeQuery($conn, $query);
    return $queryResult;
}

if(isset($_GET['ajax'])) {
    getAllExhibitors($conn);    
}