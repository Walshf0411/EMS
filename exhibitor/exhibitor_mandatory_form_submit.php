<?php
    session_start();
    require_once("../utils/globals.php");
    
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    } else {
        require_once("../utils/superz_connect.php");
    }

    function checkFormParamsInPost($iterator) {
        $valid = TRUE;
        foreach($iterator as $entry) {
            if (!isset($_POST[$entry])) {
                // check if the variable is present in the post request
                $valid = FALSE;
                break;
            }
        }
        return $valid;
    }
    function checkForm2Params() {
        $form2 = [
            "fascia_name",
            "company-name",
            "address",
            "telephone_isd_code",
            "telephone_std_code",
            "telephone",
            "fax_isd_code",
            "fax_std_code",
            "fax",
            "mobile_isd_code",
            "mobile",
            "email",
            "website",
            "person",
            "designation",
            "profile",
            "products"
        ];

        return checkFormParamsInPost($form2);
    }
    function checkForm3Params () {
        $form3 = [
            "stall_personnel_1",
            "stall_personnel_1_designation",
            "stall_personnel_2",
            "stall_personnel_2_designation",
            "stall_personnel_3",
            "stall_personnel_3_designation",
            "stall_personnel_4",
            "stall_personnel_4_designation",
            "stall_personnel_5",
            "stall_personnel_5_designation"
        ];
        return checkFormParamsInPost($form3);
    }

    function insertFascia($conn, $id) {
        $fasciaName = $_POST['fascia_name'];
        $query = "INSERT INTO fascia_names(exhibitor_id, fascia_name) values($id, '$fasciaName')";
        return executeQuery($conn, $query);
    }
    function insertForm2($conn, $id) {
        $companyName = $_POST['company-name'];
        $address = $_POST['address'];
        $telephoneISDCode = $_POST["telephone_isd_code"];
        $telephoneSTDCode = $_POST['telephone_std_code'];
        $telephone = $_POST['telephone'];
        $faxISDCode = $_POST['fax_isd_code'];
        $faxSTDCode = $_POST['fax_std_code'];
        $fax = $_POST['fax'];
        $mobileISDCode = $_POST['mobile_isd_code'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $person = $_POST['person'];
        $designation = $_POST['designation'];
        $profile = $_POST['profile'];
        $products = $_POST['products'];
        
        $query = "INSERT INTO `fair_catalogue_listing` (`company_name`, `company_address`,
        `telephone_isd_code`, `telephone_std_code`, `telephone_number`, `fax_isd_code`,
        `fax_std_code`, `fax_number`, `mobile_isd_code`, `mobile_number`, `email`,
        `website`, `contact_person`, `designation`, `company_profile`, `products_supplied`, 
        `exhibitor_id`) 
        VALUES ('$companyName', '$address', '$telephoneISDCode', '$telephoneSTDCode', '$telephone', 
        '$faxISDCode', '$faxSTDCode', '$fax', '$mobileISDCode', '$mobile', '$email', '$website', 
        '$person', '$designation', '$profile', '$products', $id)";

        return executeQuery($conn, $query);
    }
    function insertForm3($conn, $id) {
        $stallPersonnel1 = $_POST['stall_personnel_1'];
        $stallPersonnel1Designation = $_POST['stall_personnel_1_designation'];
        $stallPersonnel2 = $_POST['stall_personnel_2'];
        $stallPersonnel2Designation = $_POST['stall_personnel_2_designation'];
        $stallPersonnel3 = $_POST['stall_personnel_3'];
        $stallPersonnel3Designation = $_POST['stall_personnel_3_designation'];
        $stallPersonnel4 = $_POST['stall_personnel_4'];
        $stallPersonnel4Designation = $_POST['stall_personnel_4_designation'];
        $stallPersonnel5 = $_POST['stall_personnel_5'];
        $stallPersonnel5Designation = $_POST['stall_personnel_5_designation'];

        $query = "INSERT INTO `exhibitor_stall_personnel` (`exhibitor_id`, `stall_personnel_name`, `designation`)
        VALUES ($id, '$stallPersonnel1', '$stallPersonnel1Designation'), 
        ($id, '$stallPersonnel2', '$stallPersonnel2Designation'), 
        ($id, '$stallPersonnel3', '$stallPersonnel3Designation'), 
        ($id, '$stallPersonnel4', '$stallPersonnel4Designation'), 
        ($id, '$stallPersonnel5', '$stallPersonnel5Designation')";
        return executeQuery($conn, $query);
    }

    function processData ($conn) {
        // check all the parameters.
        if (checkForm2Params() && checkForm2Params()) {
            $id = $_SESSION['user_id'];
            insertFascia($conn, $id);
            insertForm2($conn, $id);
            insertForm3($conn, $id);
        } else {
            echo "Some absent";
        }
        
    }
    processData($conn);
    
?>