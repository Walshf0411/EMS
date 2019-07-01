<?php 
    require_once("../utils/globals.php");
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    } else {
        require_once("../utils/superz_connect.php");
    }
    function getElectricalRequirements2($id) {
        global $conn;
        $query = "SELECT * from additional_requirements_items where id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $electricalList2 = $queryResult->fetch_assoc();
        
        return $electricalList2;
    }
    function getUserElectricalRequirement2() {
        global $conn;
        $query = "SELECT * from optional_additional_fittings2 where exhibitor_id = ".$_GET["id"];
        $result = executeQuery($conn, $query);
        $userRequirements = array();
        $servicesList = array();
        foreach ($result as $row) {
            $servicesList = getElectricalRequirements2($row["item_id"]);
            $row["price"] = $servicesList["price"];
            $row["product_name"] = $servicesList["product_name"];
            $row['code_number'] = $servicesList["code_number"];
            $userRequirements[] = $row;
        }
        return  $userRequirements;
    }
?>
<?php include("../utils/form_logo_details.php"); ?>
<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr style="background-color:rgb(193, 13, 109);color:white;">
                <th>FORM 7 & 8</th>
                <th>ELECTRICAL FITINGS ADDITIONAL REQUIREMENTS</th>
                <th>OPTIONAL</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 10th June 2019 </td>
            </tr>
        </table>
    </p>

</div>
    

<div style="margin-left: 1%;">
    <h5>Exhibitor Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>
</div>

<div class="table-wrapper">
    <table width=100% class="table" id="optional_form7_invoice">
        <thead>
            <tr style ="background-color:rgb(193, 13, 109);color:white;">
                <th>Sr.no</th>
                <th>Code No</th>
                <th>Name of the product</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic items generation from the tables-->
            <?php
                $userRequirements = getUserElectricalRequirement2();
                $count = 1;
                $subTotal = 0;
                foreach ($userRequirements as $row) {
                    $total = $row["price"] * $row["quantity"];
                    $subTotal += $total;
                    echo "
                    <tr>
                        <td>".$count."</td>
                        <td>".$row["code_number"]."</td>
                        <td>".$row["product_name"]."</td>
                        <td>".$row["price"]."</td>
                        <td>".$row["quantity"]."</td>
                        <td>".$total."</td>
                    </tr>
                    ";
                    $count += 1;
                }
                function getTotalPrice() {
                    $userRequirements = getUserElectricalRequirement2();
                    $total = 0;
                    foreach ($userRequirements as $row) {
                        $total += (int)$row["total"];
                    }
                    return $total;
                }
            ?>
            <!-- rows for total gst-total and final total-->
            <tr>
                <td align=right colspan=6>
                    <strong>Sub Total(Rs): </strong> <span id="electrical-items-total">
                        <?php echo $subTotal; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Gst Total (Rs): </strong><span id="electrical-items-gst-total">
                    <?php 
                    $gstTotal = ceil($subTotal * 0.18);
                    echo $gstTotal;?>
                    </span>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Total(Rs):</strong> <span id="electrical-items-final-total">
                    <?php echo $gstTotal + $subTotal; ?>
                    </span>
                </td>
            </tr>
        </tbody>
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
        <button class="btn btn-success" name="verify_form7">
            Verify&nbsp;<i class="fas fa-check"></i>
        </button>
    </form>
    <button class="btn btn-danger" id="optional_form7_reject">
        Reject&nbsp;<i class="fas fa-times"></i>
    </button>
</div>

<!-- modal for reject optional form 7-->
<div class="modal fade" id="optional_form7_reject_modal">
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
                        <label for="rejection_message"><strong>Enter a message to send to the exhibitor:</strong></label>
                        <textarea class="form-control" id="rejection_message" name="rejection_message_form7" rows=10 required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="reject_form7">Confirm</button>
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
    if (isset($_SESSION['send_optional_form7_review_mail'])):
        $exhibitor = getExhibitorDetails($conn, $_GET['id']);
        $subject = "Electrical Fittings form 2 has been successfully reviewed.";
        $mainHeader = $subject;
        $user = $exhibitor['participant_name'];
        $toAddress = $exhibitor['email'];
        $mailBody = "Your submission for Electrical Fittings 2 in Fair catalogue has been successfully reviewed. Kindly find the invoice and pay the amount.<br>";
    ?>
        // send mail to exhibitor regarding the review
        var invoice = $("#optional_form7_invoice").clone().prop("outerHTML");
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
        $.notify("Electrical fittings 2 form reviewed successfully", "success");

    <?php unset($_SESSION['send_optional_form7_review_mail']); endif?>

$("#optional_form7_reject").click(function (e) { 
    e.preventDefault();
    $("#optional_form7_reject_modal").modal("show");
});
</script>
<?php
    if(isset($_POST["verify_form7"])){
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form7'] == 2) {
            notify("You have already reviewed Optional form 7.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form7 = 2 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if($queryResult) {
                $_SESSION["send_optional_form7_review_mail"] = TRUE;
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                notify("Form Review failed: Optional form 7.", "error");
            }
        }
       
    }
    if (isset($_POST['reject_form7'])) {
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form7'] == 2) {
            // already verified, cannot reject.
            notify("Optional form 7 has been already reviewed and verifed, cannot reject.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form7 = 0 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if ($queryResult) {
                notify("Optional form 7 has been rejected successfully. The exhbitor will be notified regarding resubmission", "success");
            } else {
                notify("Form rejection failed: Optional form 7", "error");
            }
        }
    }
?>