
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
                    
                    <a class="nav-link" id="v-pills-tab4" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-settings" aria-selected="false">Undertaking </a>
                    
                    <?php
                        require_once('../utils/globals.php');
                        if(DEBUG) {
                            require_once('../utils/local_connect.php');
                        } else {
                            require_once('../utils/superz_connect.php');
                        }

                        function getSubmittedFormDetails(){
                            global $conn;

                        
                    ?>
                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>