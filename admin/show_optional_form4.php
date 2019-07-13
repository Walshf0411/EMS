    <?php
        require_once('../utils/globals.php');
        if(DEBUG){
            require_once('../utils/local_connect.php');
        } else {
            require_once('../utils/superz_connect.php');
        }
        function getAdvertisingList() {
            global $conn;
            $query = "SELECT * from advertising_in_fair_catalogue";
            $queryResult = executeQuery($conn, $query);
            $advertisingList = array();
            foreach ($queryResult->fetch_assoc() as $row) {
                $advertisingList[] = $row ;
            }
            return $advertisingList;
        }
        
        function getUserAdvertisements(){
            global $conn;
            $advertisingList = getAdvertisingList();
            $query = "SELECT * FROM optional_form_advertising WHERE exhibitor_id=".$_GET['id'];
            $queryResult = executeQuery($conn, $query);
            $userAdvertisements = array();
            foreach ($queryResult as $row) {
                $query = "SELECT position,rate from advertising_in_fair_catalogue where id = ".$row["position"];
                $result = executeQuery($conn,$query);
                $userAdvertisements[] = $result ->fetch_assoc();
            }
            return $userAdvertisements;
        }
    ?>   
    <?php include("../utils/form_logo_details.php");?>

    <div class="">
        <p class="table">
            <table style="width:100%;">
                <tr style="">
                    <th>FORM 4</th>
                    <th>ADVERTISING IN FAIR CATALOGUE</th>
                    <th>OPTIONAL</th>
                </tr>
                <tr>
                    <?php 
                        require_once("../utils/connection.php");
                        require_once("../utils/globals.php");
                    ?>
                    <td colspan="3">Submission Date - <?php echo getSubmissionDates($conn)['optional_form4_deadline'];?></td>
                </tr>
            </table>
        </p>
    </div>

    <div style="margin-left: 1%;">
        <h5>Exhibitor Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>
    </div>

    <div>
        <strong>SUBMITTED RATES</strong>
        <table class="table" id="optional_form4_invoice">
            <tr style="">
                <th>
                    Sr.no
                </th>
                <th>
                    Position
                </th>
                <th>
                    Rate
                </th>
            </tr>
            <?php
                $userAdvertisements = getUserAdvertisements();
                $count = 1;
                $rate = 0;
                foreach ($userAdvertisements as $row) {
                    echo "<tr>";
                    echo "<td>$count</td>";
                    echo "<td>".$row["position"]."</td>";
                    echo "<td>".$row["rate"]."</td>";
                    echo "</tr>";
                    $rate +=(int)$row["rate"];
                    $count += 1;
                }

                echo "<tr>
                    <td colspan ='3' align='right'><strong>Sub Total : Rs.".$rate."</strong></td>
                </tr>";
                $gstTotal = ceil($rate * 0.18);
                echo "<tr>
                    <td colspan ='3' align='right'><strong>GST Total (18%): Rs.".$gstTotal."</strong></td>;
                </tr>";
                echo "<tr>
                    <td colspan ='3' align='right'><strong>Grand Total : Rs.".($gstTotal + $rate)."</strong></td>;
                </tr>";
            ?>
            
        </table>
    </div>

    <div>
        <strong>Full page size (Techinical Specifications) :</strong>
        <ul>
            <li>Trim Size: 125mm X 215mm</li>
            <li>Bleed: 150mm X 210mm</li>
            <li>Non-bleed: 140mm X 200mm</li>
            <li>Require Bleed margin of 5mm on all side of the page.</li>
        </ul>
    </div>
    
    
    <div style="float:right">
        <strong><?php echo "CONTACT PERSON: ".getForm1Details()["contact_person"] ?><br></strong>
        <strong><?php echo "CONTACT NUMBER: ".getForm1Details()["phone_number"];?></strong>
    </div>
    <div style="clear:both"></div>

    <div align=center>
        <form method="POST" style="display:inline">
            <button class="btn btn-success" name="verify_form4" href="#v-pills-5">
                Verify&nbsp;<i class="fas fa-check"></i>
            </button>
        </form>
        <button class="btn btn-danger" id="optional_form4_reject">
            Reject&nbsp;<i class="fas fa-times"></i>
        </button>
    </div>

<!-- modal for reject optional form 4-->
<div class="modal fade" id="optional_form4_reject_modal">
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
                        <label for="rejection_message_form4"><strong>Enter a message to send to the exhibitor:</strong></label>
                        <textarea class="form-control" id="rejection_message" name="rejection_message_form4" rows=10 required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="reject_form4">Confirm</button>
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
    // code to send form reviewed mail to the exhibitor
    if (isset($_SESSION['send_optional_form4_review_mail'])):
        $exhibitor = getExhibitorDetails($conn, $_GET['id']);
        $subject = "Advertising in fair catalogue form has been successfully reviewed.";
        $mainHeader = $subject;
        $user = $exhibitor['participant_name'];
        $toAddress = $exhibitor['email'];
        $mailBody = "Your submission for Advertising in Fair catalogue has been successfully reviewed. Kindly find the invoice and pay the amount.<br>";
    ?>
        // send mail to exhibitor regarding the review
        var invoice = $("#optional_form4_invoice").clone().prop("outerHTML");
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
        $.notify("Advertising in fair catalogue reviewed successfully", "success");

    <?php unset($_SESSION['send_optional_form4_review_mail']); endif?>

    $("#optional_form4_reject").click(function (e) { 
        e.preventDefault();
        $("#optional_form4_reject_modal").modal("show");
    });
</script>

<?php
    if(isset($_POST["verify_form4"])){
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted where exhibitor_id=".$_GET['id'];
        $checkQueryResult = executeQuery($conn, $checkQuery);
        if ($checkQueryResult->fetch_assoc()['optional_form4'] == 2) {
            // form already reviewed
            notify("You already reviewed this form.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form4 = 2 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if($queryResult) {
                $_SESSION['send_optional_form4_review_mail'] = TRUE;
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                notify("Form review failed", "error");
            }
        }
        
    }
    if (isset($_POST['reject_form4'])) {
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form4'] == 2) {
            // already verified, cannot reject.
            notify("Optional form 4 has been already reviewed and verifed, cannot reject.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form4 = 3 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if ($queryResult) {
                // Rejection successful.
                $exhibitor = getExhibitorDetails($conn, $_GET['id']);
                global $base_url;

                require_once("../utils/mailer.php");
                $exhibitionName = getAdminPreferences($conn)['event_name'];
                $rejectionMessage = $_POST['rejection_message_form4'];
                $subject = "Advertising in Fair Catalogue reviewed for $exhibitionName.";
                $mainHeader = "Advertising in Fair Catalogue has been reviewed successfully.";
                $mailBody = "Your Advertising in Fair Catalogue form submission has been rejected by the admin.<br>
                The admin says:";
                
                $mailBody .= "<br><q>$rejectionMessage</q><br>";
                $mailBody .= "You can visit this <a href='$base_url/exhibitor/'>link</a> to resubmit the form."; 

                sendMail1($conn, $exhibitor['email'], $exhibitor['participant_name'], $mailBody, $subject, $mainHeader);
                notify("Advertising in Fair Catalogue has been rejected successfully. The exhbitor will be notified regarding resubmission", "success");
            } else {
                notify("Form rejection failed: Optional form 4", "error");
            }
        }
    }
?>