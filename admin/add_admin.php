<div>
<h4>List of Exhibitors</h4>
    <div class="admin-list">
        <div id="number-div">
            Showing <span id="number-of-admins"></span> admin.
        </div>
        <div class="table-wrapper">
            
            <table width=100% height=40% class="table table-hover table-border" id="admin-list-table">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody id="admin-list-body">
                    <?php 
                        require_once("add_admin_backend.php");
                        getAllAdmins($conn);
                        require_once("../utils/mailer.php");
                    ?>
                </tbody>
            </table>
        </div> 
    </div>

    <h4>Add Admin</h4>
    <div class="alert alert-danger">
        <strong>NOTE:</strong> The preferences will be common for all the admins.
    </div>    
    <form action="#" method="post" class="form-group">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Username</label>  
            <input type="text" name="username" class="form-control">
        </div>

        <div class="form-group">
            <label for="username">Email</label>  
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_create">Password</label>
            <input type="password" name="password_create" class="form-control">
        </div>
    
        <button class="btn btn-outline-info" type="submit">Submit</button>
        </form>

</div>

<script>
    $(document).ready(function() {
        $("#add-admin-form").validate();
    });

    function showSomething() {
        $("#add-admin-overlay").css("display", 'block');
        return true;
    }

    function reload() {
        $("#admin-list-overlay").css('display', 'block');
        $.ajax({
            url: "add_admin_backend.php?ajax=true",
            success: function(data) {
                $("#admin-list-overlay").css('display', 'none');
                $("#admin-list-body").html(data);
            }
        });
    }

    // below code is to show a text above the table about how many exhibitors are present;
    $tableRows = $("#admin-list-table tbody").children();
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
            $("#number-of-admins").text($tableRows.length);
        }
    } else {
        // the table body has more than one row, which means there are exhibitors available.
        $("#number-div").show();
        $("#number-of-admins").text($tableRows.length);
    }
</script>


<?php
    function checkAdminExists($conn, $fullName, $username, $email) {
        $query = "SELECT * FROM admin WHERE full_name='$fullName' OR username='$username' OR email='$email'";
        $queryResult = executeQuery($conn, $query);

        return $queryResult->num_rows > 0;
    }
    if (isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['password_create']) && isset($_POST['email'])) {
        require_once("../utils/globals.php");
        if (DEBUG) {
            require_once("../utils/local_connect.php");
        } else {
            require_once("../utils/superz_connect.php");
        }
        $fullName = $conn->escape_string($_POST['full_name']);
        $username = $conn->escape_string($_POST['username']);
        $password =$conn->escape_string( $_POST['password_create']);
        $email = $conn->escape_string($_POST['email']);
        
        if (!checkAdminExists($conn, $fullName, $username, $email)) {
            // admin does not exist.
            $password1 = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO admin(full_name, username, email, password) values('$fullName', '$username', '$email', '$password1')";
            $mailHeader = "You have been added as admin at INTIMASIA Kolkata 2019";
            $mailBody = "Username: ".$username."<br> Password : ".$password;
            $subject = $mailHeader;
            sendMail1($conn, $email, $name, $mailBody, $subject, $mailHeader);
            
            if (executeQuery($conn, $query)) {
                notify("Admin account created", "success");
            }else {
                notify("Account creation failed", "error");
            }
        
        } else {
            //admin already exists
            notify("Admin already exists", "error");
        }
    }
?>