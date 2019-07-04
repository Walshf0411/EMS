<div>
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
            <label for="password_create">Password</label>
            <input type="password" name="password_create" class="form-control">
        </div>
    
        <button class="btn btn-outline-info" type="submit">Submit</button>
        </form>

</div>
<?php
    function checkAdminExists($conn, $fullName, $username) {
        $query = "SELECT * FROM admin WHERE full_name='$fullName' OR username='$username'";
        $queryResult = executeQuery($conn, $query);

        return $queryResult->num_rows > 0;
    }
    if (isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['password_create'])) {
        require_once("../utils/globals.php");
        if (DEBUG) {
            require_once("../utils/local_connect.php");
        } else {
            require_once("../utils/superz_connect.php");
        }
        $fullName = $conn->escape_string($_POST['full_name']);
        $username = $conn->escape_string($_POST['username']);
        $password =$conn->escape_string( $_POST['password_create']);
        
        if (!checkAdminExists($conn, $fullName, $username)) {
            // admin does not exist.
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO admin(full_name, username, password) values('$fullName', '$username', '$password')";
        
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