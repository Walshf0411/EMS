<?php 
    session_start();
    
    // check if the user is logged in or no, if logged in send him to dashboard.php
    if (isset($_SESSION['user_logged_in'])) {
        $_SESSION['already_logged_in_message'] = TRUE;
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMS - Exhibitor Login</title>
    <?php include("../utils/stylesheets.php");?>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container" id="main-container">
        <div class="login-container" align ="center">
            <form action="login.php" method ="POST" >
                <img id="logo_image" src="../images/logo.png" alt="Super Juniorz's logo">
                <br><br>
                <h5>Exhibitor Login</h5>
                <div class="input_div">
                    <i class="fa fa-user"></i>
                    <input type="text" name="email" autocomplete="false" class="form-control input_box" placeholder="Enter Username" required>
                </div><br>
                <div class="input_div">
                    <i class="fa fa-key"></i>
                    <input type="password" name="password" autocomplete="false" class="form-control input_box" placeholder="Enter password" required>
                </div><br>
                <button type="submit" name="submit" class="btn btn-outline-info"><i class="fas fa-email"></i> Submit</button>
            </form>
        </div>
    </div>
</body>
<?php
    // if the user is tries to access the dashboard without login in, will be redirected to this page
    // and the below code will execute to show him that he has to first login.
    if (isset($_SESSION['user_not_logged_in_message'])) {
        require_once('../utils/globals.php');
        unset($_SESSION['user_not_logged_in_message']);
        notify("Kindly login to continue", "error");
    }
    function setFormStatus($conn) {
        $query = "SELECT * FROM exhibitor_forms_submitted where exhibitor_id=".$_SESSION['user_id'];
        $queryResult = executeQuery($conn, $query);
        if ($queryResult->num_rows > 0) {
            $status = $queryResult->fetch_assoc();
            if ($status['mandatory_forms'] == 1) {
                $_SESSION['mandatory_forms_submitted'] = TRUE;
            }

            if ($status['optional_form4'] == 1) {
                $_SESSION['optional_form4_submitted'] = TRUE;
            }

            if ($status['optional_form5'] == 1) {
                $_SESSION['optional_form5_submitted'] = TRUE;
            }

            if ($status['optional_form6'] == 1) {
                $_SESSION['optional_form6_submitted'] = TRUE;
            }

            if ($status['optional_form7'] == 1) {
                $_SESSION['optional_form7_submitted'] = TRUE;
            }
        }
    }

    function checkLoginCredentials($conn, $email, $password) {
        $valid = FALSE;
        
        $query = "SELECT * FROM exhibitor WHERE email='$email'";
        require_once('../utils/globals.php');
        $queryResult = executeQuery($conn, $query);
        
        if  ($queryResult && $queryResult->num_rows == 1) {
            // there exists an entry with the userid.
            $user = $queryResult->fetch_assoc();
            $dbHashedPassword = $user['password'];
            if (password_verify($password, $dbHashedPassword)) {
                // correct credentials
                // session Variables for exhibitor
                $_SESSION['username'] = $user['username']; // this is baiscally his email
                $_SESSION['user_full_name'] = $user['participant_name'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['exhibitor_booth_number'] = $user['booth_number'];
                $_SESSION['exhibitor_contact_person'] = $user['contact_person'];
                $_SESSION['exhibitor_contact_number'] = $user['phone_number'];
                $valid = TRUE;
                setFormStatus($conn);
            }
        }
        return $valid;
    }
    // below is the code that will execute on user submitting the login form.
    if (isset($_POST['email']) && isset($_POST['password'])) {
        require_once('../utils/globals.php');
        if (DEBUG) {
            // if development mode is on
            require('../utils/local_connect.php');
        } else {
            require('../utils/superz_connect.php');
        }
        $email = $conn->escape_string($_POST['email']);
        $password = $conn->escape_string($_POST['password']);
        
        if (checkLoginCredentials($conn, $email, $password)) {
            // set session variable to show notification in dashboard.
            $_SESSION['show_user_logged_in'] = TRUE;
            $_SESSION['user_logged_in'] = TRUE;
            header("location: index.php");
        } else {
            // notify the user about incorrect credentials
            notify("Invalid userid or password", "error");
        }
    }
?>
</html>