<div>
    <h4>List of Exhibitors</h4>
    <div class="exhibitor-list">
        <div id="number-div">
            Showing <span id="number-of-exhibitors"></span> exhibitors.
        </div>
        <div class="table-wrapper">
            
            <table width=100% height=40% class="table table-hover table-border" id="exhibitor-list-table">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>Exhibitor Name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                    </tr>
                </thead>
                <tbody id="exhibitor-list-body">
                    <?php 
                        require_once("add_exhibitor_backend.php");
                        getAllExhibitors($conn);
                    ?>
                </tbody>
            </table>
        </div> 
        <div class="overlay" id="exhibitor-list-overlay" align=center>
            <div id="overlay-child-exhibitor-list">
                <i class="fas fa-spinner fa-spin fa-7x"></i><br>
                <span>Refreshing list of exhibitors</span>
            </div>
        </div>
    </div>

    <div>
        <h4>Add Exhibitor</h4>
        
        <form action="#" id="add-exhibitor-form" method="POST" class="add-exhibitor" onsubmit="showSomething()">     
            <div class="form-group">
                <strong><label for="name">Name:</label></strong><br>
                <input type="text" name="name" class="form-control" required=true/>
            </div>

            <div class="form-group">
                <strong><label for="email">Email:</label></strong><br>
                <input type="email" name="email" class="form-control" required=true/>
            </div>

            <div class="form-group">
                <strong><label for="phone_number">Phone Number:</label></strong><br>
                <input type="phone" class="form-control" name="phone_number" required=true/>
            </div>

            <button type="submit" class="btn btn-outline-info">Add Exhibitor</button>
            <div class="overlay" id="add-exhibitor-overlay" align=center>
                <div id="overlay-child-add-exhibitor">
                <i class="fas fa-spinner fa-spin fa-7x"></i><br>
                    <span>Adding Exhibitor</span>
                </div>
            </div>    
        </form>

    </div>
</div>

<script>


    function showSomething() {
        $("#add-exhibitor-overlay").css("display", 'block');
        return true;
    }

    function reload() {
        $("#exhibitor-list-overlay").css('display', 'block');
        $.ajax({
            url: "add_exhibitor_backend.php?ajax=true",
            success: function(data) {
                $("#exhibitor-list-overlay").css('display', 'none');
                $("#exhibitor-list-body").html(data);
            }
        });
    }

    // below code is to show a text above the table about how many exhibitors are present;
    $tableRows = $("#exhibitor-list-table tbody").children();
    console.log($tableRows.length);
    if ($tableRows.length == 1) {
        // if the table has only one row 
        console.log($tableRows[0].cells.length);
        if ($tableRows[0].cells.length == 1) {
            // if the one row has only one children
            // it means that there are no exhibitors.
            $("#number-div").hide();
        } else {
            // the row has more than one children, then it means there is only one exhibitor
            $("#number-div").show();
            $("#number-of-exhibitors").text($tableRows.length);
        }
    } else {
        // the table body has more than one row, which means there are exhibitors available.
        $("#number-div").show();
        $("#number-of-exhibitors").text($tableRows.length);
    }
</script>

<?php

// below is the code to execute
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone_number'])) {
    // if the data is properly send through the request.
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phoneNumber = $conn->real_escape_string($_POST['phone_number']);

    logToJS($name.$email.$phoneNumber);

    // three tasks are needed to be done here.
    // 1. insert data to the exhibitor database.
    // 2. send notification to the exhibitor
    // 3. notify the current user i.e admin
    
    if (!checkExists($conn, $name, $email, $phoneNumber)) {
        require_once("../utils/mailer.php");
        require_once("../utils/globals.php");
        $password = generatePassword();
        // the below mail is written as such that, only if the mail is sent to the user then only, 
        // will the exhibitor be added in the database.
        if (sendMail($conn, $email, $name, $email, $password) && insertDataToDB($conn, $name, $email, $phoneNumber, $email, $password)) {
            $_SESSION['insert_status'] = "success";
            $_SESSION['insert_message'] = "Exhibitor Added successfully.";
            if (DEBUG) {
                logToJS("Added exhibitor to the database");
            }
            JS("reload();");
        } else {
            // ERROR!!!
            $_SESSION['insert_status'] = "error";
            $_SESSION['insert_message'] = "Exhibitor couldn't be added.";
            if (DEBUG) {
                logToJS("Database Error");
            }
        }
    } else {
        // ERROR: Already Exists
        $_SESSION['insert_status'] = "error";
        $_SESSION['insert_message'] = "Exhibitor already exists.";
        if (DEBUG) {
            logToJS("User Already exists");
        }
    }
}
