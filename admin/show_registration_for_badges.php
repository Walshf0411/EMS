<?php require('../utils/form_logo_details.php'); ?>
<?php 
    require_once('../utils/globals.php');
    if(DEBUG) {
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getForm3Details(){
        $details = array();
        global $conn;
        $query = "SELECT * from exhibitor_stall_personnel where exhibitor_id = ".$_GET["id"];
        $queryResult = executeQuery($conn,$query);
        $count = $queryResult-> num_rows;
        while($count >0){
            $details[] = $queryResult->fetch_assoc();
            $count -= 1;
        }
        return $details;
    }
?>

<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
                <tr style="background-color:rgb(193, 13, 109);color:white;">
                <th>FORM 3</th>
                <th>REGISTRATION OF EXHIBITION PERSONNEL FOR BADGES</th>
                <th>MANDATORY</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 5th June 2019 </td>
            </tr>
        </table>
    </p>    
</div>

<h5>Exhibitor Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>

<span id="staff-personnel-form-error" class="text-danger" style="display:none">Kindly fill in all the details. If you think this is a mistake, press Next</span><br>
<p>
    <ol>
        <strong>THIS FORM MUST BE COMPLETED AND RETURNED BY EVERY EXHIBITOR</strong>
        <li><strong>1. APPLICATION :</strong>
        Please use this Form to apply for your stall personnel badges before 15th May 2019</li>
        <li><strong>2. PREPARATION OF EXHIBITORS’ BADGES :</strong>
        To avoid errors in the preparation of badges, Exhibitors are requested to TYPE all names in BLOCK LETTERS</li>
        <li><strong>3. COLLECTION OF BADGES :</strong>
        Badges can be collected from the Organiser’s Site Office in the Hall while taking possession of their stalls.</li>
        <li><strong>4. 2 Badges per 6 sq. m. of booth and in multiple there off.</strong></li>
        <li><strong>5. BADGES :</strong>
        Kindly issue the Exhibitors’ badges for following stall personnel</li>
    </ol>
</p>
<div class="table table-bordered">
    <div class="row" id="header">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">Sr.No.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1">Name of the stall Personnel</div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1">Designation</div>
    </div>

    <?php 
        $i=1;
        foreach (getForm3Details() as $row) {    
            echo "<div class=row>
            <div class='col-md-2 col-sm-11 col-sm-offset-1'>".$i."</div>
            <div class='col-md-6 col-sm-11 col-sm-offset-1' >".$row["stall_personnel_name"]."</div>
            <div class='col-md-4 col-sm-11 col-sm-offset-1'>".$row["designation"]."</div>
            </div>
            ";
            $i += 1;
        }
    ?>
</div>
</form>
<div style="float:right; margin-bottom:1%;">
    <strong><?php echo "CONTACT PERSON: ".getForm1Details()["contact_person"] ?><br></strong>
    <strong><?php echo "CONTACT NUMBER: ".getForm1Details()["phone_number"];?></strong>
</div>
<div style="clear:both;"></div>

<div class="alert alert-info">
    <strong>Info!:</strong>Kindly go through the exhibitors's submiitted details and review the form.
</div>


<div align=center>

    <form action="submitted_form.php?id=<?php echo $_GET["id"]; ?>" method="POST" style="display:inline">
        <button class="btn btn-success" name="verify">
            Verify&nbsp;<i class="fas fa-check"></i>
        </button>
    </form>
    
    <button class="btn btn-danger" id="mandatory_forms_reject">
        Reject&nbsp;<i class="fas fa-times"></i>
    </button>
    
</div>


<!-- modal for reject mandatory forms-->
<div class="modal fade" id="mandatory_forms_reject_modal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Confirm Form Rejection!</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="rejection_message_mandatory"><strong>Enter a message to send to the exhibitor:</strong></label>
                        <textarea class="form-control" id="rejection_message" name="rejection_message_mandatory" rows=10 required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="reject">Confirm</button>
                </form>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script>
    $("#mandatory_forms_reject").click(function (e) { 
        e.preventDefault();
        $("#mandatory_forms_reject_modal").modal("show");
    });
</script>
<?php
    if(isset($_POST["verify"])){
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['mandatory_forms'] == 2) {
            notify("You have already reviewed this form.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET mandatory_forms = 2 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if($queryResult) {
                // form review mail the user
                $exhibitor = getExhibitorDetails($conn, $_GET['id']);
                
                require_once("../utils/mailer.php");
                $exhibitionName = getAdminPreferences($conn)['event_name'];
                
                $subject = "Mandatory forms Reviewd for $exhibitionName.";
                $mainHeader = "Mandatory forms have been reviewed successfully.";
                $mailBody = "Your forms have been successfully reviewed by the admin.
                Thank you for participating in $exhibitionName";
                
                sendMail1($conn, $exhibitor['email'], $exhibitor['participant_name'], $mailBody, $subject, $mainHeader);
                notify("Form Reviewed successfully.", "success");
            } else {
                notify("Form Reviewed failed. Try Again later.", "error");
            }
        }
    }
    if (isset($_POST['reject'])) {
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['mandatory_forms'] == 2) {
            // already verified, cannot reject.
            notify("Mandatory forms have been already reviewed and verifed cannot reject.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET mandatory_forms = 0 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if ($queryResult) {
                $exhibitor = getExhibitorDetails($conn, $_GET['id']);
                global $base_url;

                require_once("../utils/mailer.php");
                $exhibitionName = getAdminPreferences($conn)['event_name'];
                $rejectionMessage = $_POST['rejection_message_mandatory'];
                $subject = "Mandatory forms reviewed for $exhibitionName.";
                $mainHeader = "Mandatory forms have been reviewed successfully.";
                $mailBody = "Your mandatory form submission has been rejected by the admin.<br>
                The admin says:";
                
                $mailBody .= "<br><q>$rejectionMessage</q><br>";
                $mailBody .= "You can visit this <a href='$base_url/exhibitor/'>link</a> to resubmit the form."; 

                sendMail1($conn, $exhibitor['email'], $exhibitor['participant_name'], $mailBody, $subject, $mainHeader);
                notify("Mandatory forms have been rejected successfully. The exhbitor will be notified regarding resubmission", "success");
            } else {
                notify("Form rejection failed: Mandatory forms", "error");
            }
        }
    }
?>
