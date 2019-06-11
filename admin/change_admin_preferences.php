<?php
    require_once("../utils/globals.php");
    require_once("change_admin_preferences_backend.php");
    $preferences = getAllPreferences($conn);
?>
<div>
    <h4>Change preferences</h4>
    <br>
    <div class="change-preferences">

        <!-- Form to change the display name of the admin.(Name using which the mail will be sent)-->
        <form action="#" method="post" class="change-preference-form">
            
            <div class="form-group row">
                <label for="form-submission-deadline" class="col-sm-3 col-form-label col-form-label-sm text-danger">Deadline:</label>    
                <div class="col-sm-9">
                <!-- datetime is converted to be compatible with html datetime-local -->
                    <input type="datetime-local" name="form-submission-deadline" id="form-submission-deadline" class="form-control form-control-sm" required value="<?php if($preferences) echo date("c", strtotime($preferences['form_submission_deadline']));?>">
                    <input type="hidden" name="change-form-submission-deadline-form">
                </div>
            </div>
            <div class="alert alert-danger help-text">
                <strong>Warning!: </strong>This will change the deadline for exhibitor manual submission
            </div>

            <button class="btn btn-outline-danger" type="submit">Change Deadline</button>
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

    if (isset($_POST['change-form-submission-deadline-form'])) {
        // change password form has been submitted
        $formSubmissionDeadline = $conn->escape_string($_POST['form-submission-deadline']);
        if (updatePreference($conn, $formSubmissionDeadline, 'form_submission_deadline')) {
            $formSubmissionDeadline = date("c", strtotime($formSubmissionDeadline));
            echo "<script>$('#form-submission-deadline').val('$formSubmissionDeadline')</script>";
            notify("Form Submission Deadline Updated", "success");
        } else {
            notify("Mail Body Update failed", "error");
        }
    }
    
