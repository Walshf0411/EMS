<?php
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        // check if the admin is logged in or no.
        $_SESSION['admin_not_logged_in_message'] = TRUE;
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
    <link rel="stylesheet" href="css/view_forms.css">
</head>

<?php require('../utils/header.php'); ?>

<body>
    <!-- The side nav (Pills style)-->
    <div class="container main-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="nav flex-column nav-pills side-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    
                <div class="dropdown-divider"></div>
                    
                    <div class="sidebar-header">Exhibitor Actions</div>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link active" id="v-pills-tab1" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-user-plus"></i>Add Exhibitor</a>
                    <a class="nav-link" id="v-pills-tab2" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fab fa-wpforms"></i>View Submitted Forms</a>
                    
                    <div class="dropdown-divider"></div>
                    <div class="sidebar-header">Admin Account Options</div>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" id="v-pills-tab5" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-plus"></i>Add admin</a>
                    <a class="nav-link" id="v-pills-tab3" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-cog"></i>Change Admin preferences</a>
                    <a class="nav-link" id="v-pills-tab4" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-key"></i>Change Password</a>
                    
                    <div class="dropdown-divider"></div>
                    <div class="sidebar-header">Generate Reports</div>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link" id="v-pills-tab6" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-file-download"></i>Generate reports</a>
                    
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <?php require("add_exhibitor.php");?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <?php require("view_forms.php"); ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php require("change_admin_preferences.php");?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require("change_password.php");?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require("generate_reports.php"); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="loading-overlay" align=center>
        <div class="loading-overlay-content">
            <i class="fas fa-spinner fa-10x fa-spin"></i><br>
            <span>Please wait...</span>
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

<!-- Exhibitor insertion notification box -->
<?php 
    if (isset($_SESSION['insert_status'])) {
        require_once("../utils/globals.php");
        $insertStatus = $_SESSION['insert_status'];
        $insertMessage = $_SESSION['insert_message'];
        unset($_SESSION['insert_status']);
        unset($_SESSION['insert_message']); 
        notify($insertMessage, $insertStatus);
    }
?>

<!-- Admin logged in notification box -->
<?php 
    if (isset($_SESSION['show_admin_logged_in'])){ 
        require_once("../utils/globals.php");
        unset($_SESSION['show_admin_logged_in']); 
        notify("Admin Logged in", "success");
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