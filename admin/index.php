<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMS - Admin Dashboard</title>
    <?php require('../utils/stylesheets.php'); ?>
    <link rel="stylesheet" href="css/index.css">
</head>

<?php require('../utils/header.php'); ?>

<body>
    <!-- The side nav (Pills style)-->
    <div class="container main-content">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills side-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-tab1" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-user-plus"></i>Add Exhibitor</a>
                    <a class="nav-link" id="v-pills-tab2" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fab fa-wpforms"></i>View Submitted Forms</a>
                    <a class="nav-link" id="v-pills-tab3" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-cog"></i>Change Admin preferences</a>
                    <a class="nav-link" id="v-pills-tab4" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-key"></i>Change Password</a>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, suscipit possimus eius aliquam laborum sapiente numquam alias doloribus. Accusantium velit asperiores odit in iure ex, incidunt harum aspernatur debitis possimus a ut, ratione, pariatur quia? Minus explicabo debitis placeat labore ipsam pariatur, soluta atque voluptatibus facilis omnis quibusdam laudantium facere.
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