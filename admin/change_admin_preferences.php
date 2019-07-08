<?php
    require_once("../utils/globals.php");
    require_once("../utils/admin_preferences.php");
    $preferences = getAllPreferences($conn);
?>
<div>
    <h4>Change preferences</h4>
    <br>
    <div class="change-preferences">
        <hr>
        <!-- Form to change the display name of the admin.(Name using which the mail will be sent)-->
        <h5>Change Form Submission Deadlines</h5>
        <form action="#" method="post" class="change-preference-form">
            
            <input type="hidden" name="change-form-submission-deadline-form">

            <div class="form-group row">
                <label for="mandatory-forms" class="col-sm-3 col-form-label col-form-label-sm">Mandatory Forms:</label>    
                <div class="col-sm-9">
                    <input type="text" name="mandatory-forms" id="mandatory-forms" class="form-control form-control-sm show-calendar" required value="<?php if($preferences) echo date('d-m-Y', strtotime($preferences['mandatory_forms_deadline'])); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="optional-form-4" class="col-sm-3 col-form-label col-form-label-sm">Optional form 4:</label>    
                <div class="col-sm-9">
                    <input type="text" name="optional-form-4" id="optional-form-4" class="form-control form-control-sm show-calendar" required value="<?php if($preferences) echo date('d-m-Y', strtotime($preferences['optional_form4_deadline'])); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="optional-form-5" class="col-sm-3 col-form-label col-form-label-sm">Optional form 5:</label>    
                <div class="col-sm-9">
                    <input type="text" name="optional-form-5" id="optional-form-5" class="form-control form-control-sm show-calendar" required value="<?php if($preferences) echo date('d-m-Y', strtotime($preferences['optional_form5_deadline'])); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="optional-form-6" class="col-sm-3 col-form-label col-form-label-sm">Optional form 6:</label>    
                <div class="col-sm-9">
                    <input type="text" name="optional-form-6" id="optional-form-6" class="form-control form-control-sm show-calendar" required value="<?php if($preferences) echo date('d-m-Y', strtotime($preferences['optional_form6_deadline'])); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="optional-form-7" class="col-sm-3 col-form-label col-form-label-sm">Optional form 7:</label>    
                <div class="col-sm-9">
                    <input type="text" name="optional-form-7" id="optional-form-7" class="form-control form-control-sm show-calendar" required value="<?php if($preferences) echo date('d-m-Y', strtotime($preferences['optional_form7_deadline'])); ?>">
                </div>
            </div>

            <div class="alert alert-info help-text">
                <strong>Info!: </strong>This will change the deadlines for the form submission
            </div>

            <button class="btn btn-outline-info" type="submit">Change Form Submission Deadlines</button>
        </form><hr>

        <!-- form to change the admin emai(Address that will receive emails regarding updates)-->
        <form action="#" method="post" class="change-preference-form">
            
            <div class="form-group row">
                <label for="display-name" class="col-sm-3 col-form-label col-form-label-sm">Admin Email:</label>    
                <div class="col-sm-9">
                    <input type="email" name="admin-email" id="admin-email" class="form-control form-control-sm" required value="<?php if($preferences) echo $preferences['admin_email']; ?>">
                    <input type="hidden" name="change-admin-email-form">
                </div>
            </div>
            <div class="alert alert-info help-text">
                <strong>Info!: </strong>Email to receive emails regarding exhibitor updates.
            </div>

            <button class="btn btn-outline-info" type="submit">Change Admin Email</button>
        </form><hr>


        <!-- Form to change the display name of the admin.(Name using which the mail will be sent)-->
        <form action="#" method="post" class="change-preference-form">
            
            <div class="form-group row">
                <label for="display-name" class="col-sm-3 col-form-label col-form-label-sm">Display Name:</label>    
                <div class="col-sm-9">
                    <input type="text" name="display-name" id="display-name" class="form-control form-control-sm" required value="<?php if($preferences) echo $preferences['display_name']; ?>">
                    <input type="hidden" name="change-display-name-form">
                </div>
            </div>
            <div class="alert alert-info help-text">
                <strong>Info!: </strong>Name using which mails will be sent
            </div>

            <button class="btn btn-outline-info" type="submit">Change Display name</button>
        </form><hr>

        <!-- Change the email account associated to send mail -->
        <form action="#" method="post" class="change-preference-form">
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label col-form-label-sm">From Email:</label>    
                <div class="col-sm-9">
                    <input type="text" name="email" id="email" class="form-control form-control-sm" required value="<?php if($preferences) echo $preferences['from_email'];?>">
                    <input type="hidden" name="change-from-email-form">
                </div>
            </div>
            
            <div class="alert alert-info help-text">
                <strong>Info!: </strong>Email using which mails will be sent
            </div>

            <div class="form-group row">
                <label for="from-email-password" class="col-sm-3 col-form-label col-form-label-sm">From Email's password:</label>    
                <div class="col-sm-9">
                    <input type="password" name="from-email-password" class="form-control form-control-sm" required>
                </div>
            </div>
            
            <div class="alert alert-info help-text">
                <strong>Info!: </strong>Password for the provided email address.
            </div>
            
            <button class="btn btn-outline-info" type="submit">Change Email</button>
        </form><hr>

        <!-- Change the default mail subject -->
        <form action="#" method="post" class="change-preference-form">
            
            <div class="form-group row">
                <label for="mail-subject" class="col-sm-3 col-form-label col-form-label-sm">Mail Subject:</label>    
                <div class="col-sm-9">
                    <input type="text" name="mail-subject" id="mail-subject" class="form-control form-control-sm" required value="<?php if($preferences) echo $preferences['mail_subject'];?>">
                    <input type="hidden" name="change-mail-subject-form">
                </div>
            </div>
            <div class="alert alert-info help-text">
                <strong>Info!: </strong>Default mail subject for the mails
            </div>
            
            <button class="btn btn-outline-info" type="submit">Change Mail subject</button>
        </form><hr>

        <!-- Change the default mail body -->
        <form action="#" method="post" class="change-preference-form">
            <div class="form-group row">
                <label for="mail-body" class="col-sm-3 col-form-label col-form-label-sm">Mail Body:</label>    
                <div class="col-sm-9">
                    <textarea type="text" name="mail-body" id="mail-body" class="form-control form-control-sm" required><?php if($preferences) echo $preferences['mail_body'];?></textarea>
                    <input type="hidden" name="change-mail-body-form">
                </div>
            </div>
            <div class="alert alert-info help-text">
                <strong>Info!: </strong>Default mail body for the mails
            </div>
            <button class="btn btn-outline-info" type="submit">Change Mail body</button>
        </form><hr>

    </div>
</div>

<script>
    $(".show-calendar").flatpickr({
        minDate: "today",
        dateFormat: 'd-m-Y' ,
    });
</script>

<?php
    require_once("../utils/globals.php");
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    } else {
        require_once("../utils/superz_connect.php");
    }

    function getPreferenceID ($conn) {
        $query = "SELECT id FROM admin_preferences";
        $queryResult = executeQuery($conn, $query);
        if ($queryResult) {
            return $queryResult->fetch_assoc()['id'];
        }
    }

    function updatePreference($conn, $preferenceValue, $preferenceName) {
        $id = getPreferenceID($conn);
        if ($id) {  
            $query = "UPDATE admin_preferences SET $preferenceName='$preferenceValue' WHERE id=$id";
            return executeQuery($conn, $query);
        } else {
            return FALSE;
        }
    } 

    if (isset($_POST['change-display-name-form'])) {
        // change display name form has been submitted
        $displayName = $conn->escape_string($_POST['display-name']);
        if (updatePreference($conn, $displayName, 'display_name')) {
            echo "<script>$('#display-name').val('$displayName')</script>";
            notify("Display Name Updated", "success");
        } else {
            notify("Display Name Update failed", "error");
        }
    }
    if (isset($_POST['change-from-email-form'])) {
        // change from email form has been submitted
        if (isset($_POST['email']) && isset($_POST['from-email-password'])) {
            $email = $conn->escape_string($_POST['email']);
            $password = $conn->escape_string($_POST['from-email-password']);

            if (updatePreference($conn, $email, "from_email") && updatePreference($conn, $password, "from_email_password")) {
                echo "<script>$('#email').val('$email')</script>";
                notify("\'From Email\' Updated successfully", 'success');
            } else {
                notify("\'From Email\' Update failed", 'error');
            }
        }
        
    }
    if (isset($_POST['change-mail-subject-form'])) {
        // change password form has been submitted
        $mailSubject = $conn->escape_string($_POST['mail-subject']);
        if (updatePreference($conn, $mailSubject, 'mail_subject')) {
            echo "<script>$('#mail-subject').val('$mailSubject')</script>";
            notify("Mail Subject Updated", "success");
        } else {
            notify("Mail Subject Update failed", "error");
        }
    }
    if (isset($_POST['change-mail-body-form'])) {
        // change password form has been submitted
        $mailBody = $conn->escape_string($_POST['mail-body']);
        if (updatePreference($conn, $mailBody, 'mail_body')) {
            echo "<script>$('#mail-body').val('$mailBody')</script>";
            notify("Mail Body Updated", "success");
        } else {
            notify("Mail Body Update failed", "error");
        }
    }

    if (isset($_POST['change-admin-email-form'])) {
        // change password form has been submitted
        $adminEmail = $conn->escape_string($_POST['admin-email']);
        if (updatePreference($conn, $adminEmail, 'admin_email')) {
            echo "<script>$('#admin-email').val('$adminEmail')</script>";
            notify("Admin Email updated", "success");
        } else {
            notify("Admin email update failed", "error");
        }
    }
    
    if (isset($_POST['change-form-submission-deadline-form'])) {
        $mandatoryFormsDeadline = date('Y-m-d', strtotime($_POST['mandatory-forms']));
        $optionalForm4 = date('Y-m-d', strtotime($_POST['optional-form-4']));
        $optionalForm5 = date('Y-m-d', strtotime($_POST['optional-form-5']));
        $optionalForm6 = date('Y-m-d', strtotime($_POST['optional-form-6']));
        $optionalForm7 = date('Y-m-d', strtotime($_POST['optional-form-7']));
        $preferenceId = getPreferenceID($conn);
        $query = "UPDATE admin_preferences
        SET mandatory_forms_deadline = '$mandatoryFormsDeadline',
        optional_form4_deadline = '$optionalForm4',
        optional_form5_deadline = '$optionalForm5',
        optional_form6_deadline = '$optionalForm6',
        optional_form7_deadline = '$optionalForm7' where id=$preferenceId";

        $mandatoryFormsDeadline = date('d-m-Y', strtotime($_POST['mandatory-forms']));
        $optionalForm4 = date('d-m-Y', strtotime($_POST['optional-form-4']));
        $optionalForm5 = date('d-m-Y', strtotime($_POST['optional-form-5']));
        $optionalForm6 = date('d-m-Y', strtotime($_POST['optional-form-6']));
        $optionalForm7 = date('d-m-Y', strtotime($_POST['optional-form-7']));
        
        $queryResult = executeQuery($conn, $query);
        
        if ($queryResult) {
            echo "<script>";
            echo "$('#mandatory-forms').val('$mandatoryFormsDeadline');";
            echo "$('#optional-form-4').val('$optionalForm4');";
            echo "$('#optional-form-5').val('$optionalForm5');";
            echo "$('#optional-form-6').val('$optionalForm6');";
            echo "$('#optional-form-7').val('$optionalForm7');";
            echo "</script>";
            
            notify("Deadlines updated successfully", "success");
        } else {
            notify("Deadline updated failed", "error");
        }

    }