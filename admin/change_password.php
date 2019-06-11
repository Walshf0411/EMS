<div>
    <h4>Change Password</h4>
    <!-- Change the admin's password -->
    <form action="#" method="post" class="change-preference-form">
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label col-form-label-sm">Password:</label>    
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control form-control-sm" required>
            </div>
        </div>

        <div class="alert alert-info help-text">
            <strong>Info!: </strong>Change Password for the logged in user.
        </div>

        <button class="btn btn-outline-danger" type="submit">Change Password</button>
    </form><hr>
</div>
<?php 
    function changePassword($conn, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $id = $_SESSION['admin_id'];
        $query = "UPDATE admin SET password='$hashedPassword' WHERE id=$id";
        echo $query;
        require_once("../utils/globals.php");
        return executeQuery($conn, $query); 
    }

    if (isset($_POST['password'])) {
        require_once("../utils/globals.php");
        if (DEBUG) {
            require_once("../utils/local_connect.php");
        } else {
            require_once("../utils/superz_connect.php");
        }
        $password = $conn->escape_string($_POST['password']);
        if (changePassword($conn, $password)) {
            notify("Password Changed Successfully", "success");
        } else {
            notify("Password Change Failed", "error");
        }
    }
?>