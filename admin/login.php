<?php 
    session_start();
    
    // check if the admin is logged in or no, if logged in send him to dashboard.php
    if (isset($_SESSION['admin_logged_in'])) {
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
    <title>EMS - Admin Login</title>
    <?php include("../utils/stylesheets.php");?>
    <!--Custom styles-->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="" id="main-container">
        <img src="../images/login_background.jpg" alt="Background image" width="100%" height="100%" id="login-background-image">
        
        <div class="login-container" align="center">
            <form action="login.php" method="POST">
                <img id="logo_image" class="img-responsive" src="../images/logo.png" alt="INTIMASIA logo">
                <br><br>
                <h5>Admin Login</h5>
                <div class="input_div">
                    <i class="fa fa-user"></i>
                    <input type="text" name="userid" autocomplete="false" class="form-control input_box" placeholder="Enter Username" required>
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
</html>
<script>
</script>
<?php
    // if the admin is tries to access the dashboard without login in, will be redirected to this page
    // and the below code will execute to show him that he has to first login.
    if (isset($_SESSION['admin_not_logged_in_message'])) {
        require_once('../utils/globals.php');
        unset($_SESSION['admin_not_logged_in_message']);
        notify("Kindly login to continue", "error");
    }

    function checkLoginCredentials($conn, $userId, $password) {
        $valid = FALSE;
        
        $query = "SELECT * FROM admin WHERE username='$userId'";
        require_once('../utils/globals.php');
        $queryResult = executeQuery($conn, $query);
        
        if  ($queryResult && $queryResult->num_rows == 1) {
            // there exists an entry with the userid.
            $user = $queryResult->fetch_assoc();
            $dbHashedPassword = $user['password'];
            if (password_verify($password, $dbHashedPassword)) {
                // correct credentials
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_type'] = 'ADMIN';
                $valid = TRUE;
            }
        }

        return $valid;
    }
    // below is the code that will execute on user submitting the login form.
    if (isset($_POST['userid']) && isset($_POST['password'])) {

        require_once('../utils/globals.php');
        if (DEBUG) {
            // if development mode is on
            require('../utils/local_connect.php');
        } else {
            require('../utils/superz_connect.php');
        }
        $userId = $conn->escape_string($_POST['userid']);
        $password = $conn->escape_string($_POST['password']);
        
        if (checkLoginCredentials($conn, $userId, $password)) {
            // set session variable to show notification in dashboard.
            $_SESSION['show_admin_logged_in'] = TRUE;
            $_SESSION['admin_logged_in'] = TRUE;
            header("location: index.php");
        } else {
            // notify the user about incorrect credentials
            notify("Invalid userid or password", "error");
        }
    }
?>