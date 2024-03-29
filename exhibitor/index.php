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
    <title>EMS - Exhibitor Dashboard</title>
    <?php require('../utils/stylesheets.php'); ?>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/exhibitor_home.css">
    <link rel="stylesheet" href="css/exhibitor_quick_reference.css">
    <link rel="stylesheet" href="css/exhibitor_mandatory_forms.css">
    <link rel="stylesheet" href="css/exhibitor_optional_forms.css">
    <link rel="stylesheet" href="css/exhibitor_edit_information.css">
    <link rel="stylesheet" href="css/exhibitor_general_information.css">
</head>

<?php require('../utils/header.php'); ?>

<body>
    <div class="loading-overlay" align=center>
        <div class="loading-overlay-content">
            <i class="fas fa-spinner fa-10x fa-spin"></i><br>
            <span>Please wait...</span>
        </div>
    </div>
    <!-- The side nav (Pills style)-->
    <div class="container main-content">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav flex-column nav-pills side-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    
                    <li class="nav-item">
                        <a class="nav-link active" id="v-pills-tab1" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-home"></i>Home</a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <div class="sidebar-header">Account Actions</div>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-tab4" data-toggle="pill" href="#v-pills-14" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-pen"></i>Edit Exhibitor info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-tab5" data-toggle="pill" href="#v-pills-15" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-key"></i>Change Exhibitor Password</a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <div class="sidebar-header">Exhibitor Manual</div>
                    <div class="dropdown-divider"></div>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-tab16" data-toggle="pill" href="#v-pills-16" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fab fa-wpforms"></i>Rules and Regulations</a>
                    </li>

                    <li class="nav-item">
                        <a href="#v-pills-2" class="nav-link" data-toggle="pill" id="v-pills-tab2" role="tab"><i class="fas fa-exclamation-triangle"></i>General Information</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-tab3" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-home" ><i class="far fa-id-badge"></i>Quick Reference</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="mandatory-forms-dropdown"><i class="fa fa-asterisk"></i>Mandatory Forms</a>
                        <div class="dropdown-menu">
                            <!-- create additional tabs in the tab content div and then use href and data-toggle=pill to make them visible using the pills-->
                            <a class="dropdown-item" id="v-pills-tab-4" data-toggle="pill" href="#v-pills-4" role="tab">Standard Shell Scheme Package</a>
                            <a class="dropdown-item" id="v-pills-tab-5" data-toggle="pill" href="#v-pills-5" role="tab">Listing in Fair Catalogue</a>
                            <a class="dropdown-item" id="v-pills-tab-6" data-toggle="pill" href="#v-pills-6" role="tab">Registration for Badges</a>
                            <a class="dropdown-item" id="v-pills-tab-7" data-toggle="pill" href="#v-pills-7" role="tab">Undertaking of Rules & Regulations</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fab fa-wpforms"></i>Optional Services</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-toggle="pill" id="v-pills-tab-8" href="#v-pills-8" role="tab">Advertising in Fair Catalogue</a>
                            <a class="dropdown-item" data-toggle="pill" id="v-pills-tab-9" href="#v-pills-9" role="tab">Other Services</a>
                            <a class="dropdown-item" data-toggle="pill" id="v-pills-tab-10" href="#v-pills-10" role="tab">Electrical Fittings Requirements</a>
                            <a class="dropdown-item" data-toggle="pill" id="v-pills-tab-11" href="#v-pills-11" role="tab">Additional Furniture</a>
                            <a class="dropdown-item" data-toggle="pill" id="v-pills-tab-12" href="#v-pills-12" role="tab">Incoming Items Label</a>
                        </div>
                    </li>

                </ul>
            </div>
            
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                       <?php include("exhibitor_home.php");?>  
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                       <?php include("exhibitor_general_information.php");?>                    
                    </div>  
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                       <?php include("exhibitor_quick_reference.php");?>                    
                    </div>  

                    <!--mandatory form starts here-->
                    
                    <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                       <?php include("exhibitor_mandatory_form1.php");?>  
                    </div>
                    <div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                       <?php include("exhibitor_mandatory_form2.php");?>  
                    </div>
                    <div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                       <?php include("exhibitor_mandatory_form3.php");?>  
                    </div>
                    <div class="tab-pane fade" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                       <?php include("exhibitor_mandatory_form9.php");?>  
                    </div>

                    <!--mandatory form ends here-->

                    <!--optional form starts here-->
                    <div class="tab-pane fade" id="v-pills-8" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php include("exhibitor_optional_form4.php"); ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-9" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php include("exhibitor_optional_form5.php"); ?>
                    </div>
                    
                    <div class="tab-pane fade" id="v-pills-10" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php include("exhibitor_optional_form6.php");?>
                    </div>

                    <div class="tab-pane fade" id="v-pills-11" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php include("exhibitor_optional_form7.php"   );?>
                    </div>
                    
                    <div class="tab-pane fade" id="v-pills-12" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php include("exhibitor_optional_form10.php"); ?>
                    </div>
                    
                    <!-- optional form ends here -->
                    <div class="tab-pane fade" id="v-pills-14" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                       <?php include("exhibitor_information_edit.php");?>  
                    </div>

                    <div class="tab-pane fade" id="v-pills-15" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                       <?php include("exhibitor_password_change.php");?>  
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
    function showWaitingOverlay(modalId) {
        $("#" + modalId).modal("hide");
        $(".loading-overlay").animate({
            opacity: 1
        }, 500); 
        $(".loading-overlay").css("z-index", "1000");
    }

    function hideWaitingOverlay() {
        $(".loading-overlay").animate({
            opacity: 0
        }, 500); 
        $(".loading-overlay").css("z-index", "-1");
    }
    <?php 
        require_once("../utils/globals.php");
        require_once("../utils/connection.php");

        $status = getFormStatus($conn);
        if ($status) {
            if ($status['mandatory_forms'] == 1 || $status['mandatory_forms'] == 2) {
                echo "$('#mandatory-forms-dropdown').addClass('text-success');
                    $('#v-pills-tab-4').addClass('text-success');
                    $('#v-pills-tab-5').addClass('text-success');
                    $('#v-pills-tab-6').addClass('text-success');
                    $('#v-pills-tab-7').addClass('text-success');
                ";
            }
            
            if ($status['optional_form4'] == 1 || $status['optional_form4'] == 2) {
                // either form submitted or reviewed.
                echo "$('#v-pills-tab-8').addClass('text-success');";
            }
    
            if ($status['optional_form5'] == 1 || $status['optional_form5'] == 2) {
                echo "$('#v-pills-tab-9').addClass('text-success');";
            }
    
            if ($status['optional_form6'] == 1 || $status['optional_form6'] == 2) {
                echo "$('#v-pills-tab-10').addClass('text-success');";
            }
    
            if ($status['optional_form7'] == 1 || $status['optional_form7'] == 2) {
                echo "$('#v-pills-tab-11').addClass('text-success');";
            }
        }
    ?>

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