<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getServices($id) {
        global $conn;
        $query = "SELECT * from other_services where id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $servicesList = $queryResult->fetch_assoc();
        
        return $servicesList;
    }
    function getUserServices() {
        global $conn;
        $query = "SELECT * from optional_other_services where exhibitor_id = ".$_GET["id"];
        $result = executeQuery($conn, $query);
        $userServices = array();
        $servicesList = array();
        foreach ($result as $row) {
            $servicesList = getServices($row["item_id"]);
            $row["amount"] = $servicesList['amount'];
            $row["item_description"] = $servicesList['item_description'];
            $userServices[] = $row;
        }
        return $userServices;
        
    }
?>

<?php require('../utils/form_logo_details.php'); ?>

<div class="">
    <p class="table">
        <table style="width:100%;">
            <tr style="">
                <th>FORM 5</th>
                <th>OTHER SERVICES</th>
                <th>OPTIONAL</th>
            </tr>
            <tr>
                <?php 
                    require_once("../utils/connection.php");
                    require_once("../utils/globals.php");
                ?>
                <td colspan="3">Submission Date - <?php echo getSubmissionDates($conn)['optional_form5_deadline'];?></td>
            </tr>
        </table>
    </p>
</div>

<div style="margin-left: 1%;">
    <h5>Exhibitor Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>
</div>

<div class="table-wrapper">
    <table class="table " style="width:100%;" id="optional_form5_invoice">
        <tr style="">
            <th>No.</th>
            <th>Item Description</th>
            <th>Amount(INR)</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
            function getTotal() {
                $total = 0;
                $userServices = getUserServices();
                foreach ($userServices as $row) {
                    $total += (int)$row["total"]; 
                }
                return $total;
            }
            
            $userServices = getUserServices();
            $count = 1;
            $subTotal = 0;
            foreach ($userServices as $row) {
                $total = $row["amount"] * $row['quantity'];
                $subTotal += $total;
                echo "<tr>
                <td>".$count."</td>
                <td>".$row["item_description"]."</td>
                <td>".$row["amount"]."</td>
                <td>".$row["quantity"]."</td>
                <td>".$total."</td>
                </tr>
                ";
                $count += 1;
            }
            
        ?>
        <tr>
            <td colspan=5>
                <div style="float:right;">
                    <strong>Total (Rs.) </strong>
                    <span><?php
                        echo $subTotal; 
                    ?></span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=5>
                <div style = "float:right;">
                    <strong>GST Total (Rs.) </strong>
                    <span>
                        <?php 
                        $gstTotal = ceil($subTotal * 0.18);
                        echo $gstTotal; 
                        ?>
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=5>
                <div style = "float:right;">
                    <strong>Grand Total (Rs.) </strong>
                    <span>
                        <?php 
                        echo $subTotal + $gstTotal; 
                        ?>
                    </span>
                </div>
            </td>
        </tr>
    </table>
</div>

<div style="float:right">
    <!-- Insert contact details -->
    <strong><?php echo "CONTACT PERSON: ".getForm1Details()["contact_person"] ?><br></strong>
    <strong><?php echo "CONTACT NUMBER: ".getForm1Details()["phone_number"];?></strong>
</div>
<div style="clear:both"></div>


<div align=center>
    <form action="submitted_form.php?id=<?php echo $_GET["id"]; ?>" method="POST" style="display:inline">
        <button class="btn btn-success" name="verify_form5">
            Verify&nbsp;<i class="fas fa-check"></i>
        </button>
    </form>
    <button class="btn btn-danger" id="optional_form5_reject">
        Reject&nbsp;<i class="fas fa-times"></i>
    </button>
</div>

<!-- modal for reject optional form 6-->
<div class="modal fade" id="optional_form5_reject_modal">
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
                        <label for="rejection_message_form5"><strong>Enter a message to send to the exhibitor:</strong></label>
                        <textarea class="form-control" id="rejection_message" name="rejection_message_form5" rows=10 required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="reject_form5">Confirm</button>
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
    <?php 

    if (isset($_SESSION['send_optional_form5_review_mail'])):
        $exhibitor = getExhibitorDetails($conn, $_GET['id']);
        $subject = "Other services form has been successfully reviewed.";
        $mainHeader = $subject;
        $user = $exhibitor['participant_name'];
        $toAddress = $exhibitor['email'];
        $mailBody = "Your submission for Other Services in Fair catalogue has   been successfully reviewed. Kindly find the invoice and pay the amount.<br>";
    ?>
        // send mail to exhibitor regarding the review
        var invoice = $("#optional_form5_invoice").clone().prop("outerHTML");
        formData = new FormData();
        formData.append("toAddress", "<?php echo $toAddress;?>");
        formData.append("toName", "<?php echo $user;?>");
        formData.append("mailBody", "<?php echo $mailBody;?>" + invoice);
        formData.append("subject", "<?php echo $subject;?>");
        formData.append("mainHeader", "<?php echo $mainHeader;?>");
        $.ajax({
            type: "POST",
            url: "send_confirmation_mail.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {}
        });
        $.notify.defaults({
            globalPosition: "top center",
        });
        $.notify("Other Services form reviewed successfully", "success");

    <?php unset($_SESSION['send_optional_form5_review_mail']); endif?>
    $("#optional_form5_reject").click(function (e) { 
        e.preventDefault();
        $("#optional_form5_reject_modal").modal("show");
    });
</script>
<?php
    if(isset($_POST["verify_form5"])){
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form5'] == 2) {
            notify("You have already reviewed Optional form 5.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form5 = 2 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if($queryResult) {
                require_once("../utils/globals.php");
                logToDb($conn, $_GET['id'], "OTHER SERVICES", "ACCEPTED");
                $_SESSION["send_optional_form5_review_mail"] = TRUE;
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                notify("Form Review failed: Optional form 5.", "error");
            }
        }
        
    }
    if (isset($_POST['reject_form5'])) {
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form5'] == 2 || $checkQueryResults->fetch_assoc()['optional_form5'] == 3) {
            // already verified, cannot reject.
            notify("Other Services form has been already reviewed, cannot reject.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form5 = 3 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if ($queryResult) {
                $exhibitor = getExhibitorDetails($conn, $_GET['id']);
                global $base_url;

                require_once("../utils/mailer.php");
                $exhibitionName = getAdminPreferences($conn)['event_name'];
                $rejectionMessage = $_POST['rejection_message_form5'];
                $subject = "Other Services form reviewed for $exhibitionName.";
                $mainHeader = "Other Services form has been reviewed successfully.";
                $mailBody = "Your Other Services form submission has been rejected by the admin.<br>
                The admin says:";
                
                $mailBody .= "<br><q>$rejectionMessage</q><br>";
                $mailBody .= "You can visit this <a href='$base_url/exhibitor/'>link</a> to resubmit the form."; 
                
                // delete exhibiror entries
                $query = "DELETE FROM optional_other_services WHERE exhibitor_id=".$_GET["id"];
                executeQuery($conn, $query);

                require_once("../utils/globals.php");
                logToDb($conn, $_GET['id'], "OTHER SERVICES", "REJECTED");

                sendMail1($conn, $exhibitor['email'], $exhibitor['participant_name'], $mailBody, $subject, $mainHeader);
                notify("Other services has been rejected successfully. The exhbitor will be notified regarding resubmission", "success");
            } else {
                notify("Form rejection failed: Other Services", "error");
            }
        }
    }
?>