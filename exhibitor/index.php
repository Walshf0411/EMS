<?php
    session_start();
    if (!isset($_SESSION['user_logged_in'])) {
        // check if the admin is logged in or no.
        $_SESSION['user_not_logged_in_message'] = TRUE;
        header("location: login.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMS - Admin Dashboard</title>
    <?php require('../utils/stylesheets.php'); ?>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/add_exhibitor.css">
</head>

<?php require('../utils/header.php'); ?>

<body>
    <!-- The side nav (Pills style)-->
    <div class="container main-content">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav flex-column nav-pills side-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <li class="nav-item">
                        <a class="nav-link active" id="v-pills-tab1" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-pen"></i>Edit Exhibitor Info</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-asterisk"></i>Mandatory Forms</a>
                        <div class="dropdown-menu">
                            <!-- create additional tabs in the tab content div and then use href and data-toggle=pill to make them visible using the pills-->
                            <a class="dropdown-item" data-toggle="pill" href="#" role="tab">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fab fa-wpforms"></i>Mandatory Forms</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-tab4" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-key"></i>Change Exhibitor Password</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require("password_change.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
if (isset($_SESSION['already_logged_in_message'])) {
    // user tried to access login.php even after being logged in.
    require_once("../utils/globals.php");
    unset($_SESSION['already_logged_in_message']);
    require_once("../utils/globals.php");
    notify("You are already logged in.", "info");
}
?>
<?php 
    if (isset($_SESSION['show_user_logged_in'])){ 
        require_once("../utils/globals.php");
        unset($_SESSION['show_user_logged_in']); 
        notify("Exhibitor Logged in", "success");
    }
?>

<script>
    // the logout.php file clears the session and once we receive response, 
    // we redirect user to the login page
    $("#logout-btn").click(function() {
        $.ajax({
            url: "logout.php",
            success: function(data) {
                window.location.href="login.php";
            }
        });
    });
</script>

</body>
</html>