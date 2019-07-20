<?php
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        // check if the admin is logged in or no.
        $_SESSION['admin_not_logged_in_message'] = TRUE;
        header("location: login.php");
    }
    require_once('../utils/globals.php');
    if(DEBUG) {
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }

    function getSubmittedFormDetails(){
        global $conn;
        $id = $_GET["id"];
        $query = "SELECT * from exhibitor_forms_submitted where exhibitor_id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $forms = $queryResult-> fetch_assoc();
        return $forms;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMS - Submitted Forms</title>
    <?php require('../utils/stylesheets.php'); ?>
    <link rel="stylesheet" href="css/index.css">
</head>

<?php require('../utils/header.php'); ?>

<body>
    <!-- The side nav (Pills style)-->
    <div class="container main-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="nav flex-column nav-pills side-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="dropdown-divider"></div>
                    <div class="sidebar-header">Mandatory forms</div>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link active" id="v-pills-tab1" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-home" aria-selected="true">Shell scheme package</a>
                    
                    <a class="nav-link" id="v-pills-tab2" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-profile" aria-selected="false">Listing in Fair Catalogue</a>
                    
                    <a class="nav-link" id="v-pills-tab3" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-messages" aria-selected="false">Registration for badges </a>
                    <?php
                        $flag =0;
                        $optionalForms = ["optional_form4", "optional_form5", "optional_form6", "optional_form7"];
                        $i=4;
                        foreach ($optionalForms as $option) {
                            if (getSubmittedFormDetails()[$option] >= 1){
                                $flag =$flag +1;
                            }
                            $i+=1;
                        }
                        if($flag >=1){
                            echo "<div class='dropdown-divider'></div>
                            <div class='sidebar-header'>Optional forms</div>
                            <div class='dropdown-divider'></div>";
                        }   
                    ?>
                    <?php
                        $optionalForms = ["optional_form4", "optional_form5", "optional_form6", "optional_form7"];
                        $formTags= ["Advertising in Fair Catalogue", "Other services","Electrical fittings", "Additional Furniture"];
                        $i=4;
                        foreach ($optionalForms as $option) {
                            if (getSubmittedFormDetails()[$option] >= 1){
                                echo "<a class='nav-link' id='v-pills-tab".$i."' data-toggle='pill' href='#v-pills-".$i."' role='tab' aria-controls='v-pills-settings' aria-selected='false'>".$formTags[$i-4]." </a>
                                ";
                            }
                            $i+=1;
                        }                        
                    ?>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <?php require_once("show_standard_shell_scheme.php"); ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <?php require_once("show_listing_in_fair_catalogue.php"); ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <?php require_once("show_registration_for_badges.php"); ?>        
                    </div>
                    <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require_once("show_optional_form4.php"); ?>    
                    </div>
                    <div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require_once("show_optional_form5.php"); ?>                       
                    </div>
                    <div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require_once("show_optional_form6.php"); ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <?php require_once("show_optional_form7.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    // the logout.php file clears the session and once we receive response, 
    // we redirect user to the login page
    $("#logout-btn").click(function() {
        $.ajax({
            url: "../logout.php",
            success: function(data) {
                window.location.href="login.php";
            }
        });
    });
</script>