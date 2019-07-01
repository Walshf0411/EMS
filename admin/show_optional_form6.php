<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getElectricalRequirements($id) {
        global $conn;
        $query = "SELECT * from electrical_requirements where id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $servicesList = $queryResult->fetch_assoc();
        
        return $servicesList;
    }
    function getUserElectricalRequirement() {
        global $conn;
        $query = "SELECT * from optional_additional_fittings1 where exhibitor_id = ".$_GET["id"];
        $result = executeQuery($conn, $query);
        $userRequirements = array();
        $servicesList = array();
        foreach ($result as $row) {
            $servicesList = getElectricalRequirements($row["item_id"]);
            $row["cost"] = $servicesList["cost"];
            $row["item_description"] = $servicesList["item_description"];
            $userRequirements[] = $row;
        }
        return $userRequirements;
    }
?>

<?php require('../utils/form_logo_details.php'); ?>
    <div class="col-md-12 col-sm-12">
        <p class="table">
            <table style="width:100%;">
                <tr style = "background-color:rgb(193, 13, 109);color:white;">
                    <th>FORM 6</th>
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

    <div class="col-md-12 col-sm-12">
        <table style="width:100%;" class="table-layout-fixed">
            <tr style ="background-color:rgb(193, 13, 109);color:white;">
                <th>Sr.no</th>
                <th>DESCRIPTION OF SERVICE/ITEMS</th>
                <th>Cost@INR</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <tr>
                <td colspan=5><strong>INDIVIDUAL FITINGS</strong></td>
            </tr>
            
            <?php
                $userRequirements = getUserElectricalRequirement();
                // var_dump($userRequirements);
                function getElectricalTotal(){
                    $userRequirements = getUserElectricalRequirement();
                    $total = 0;
                    foreach ($userRequirements as $row) {
                        $total += (int)$row["total"];
                    }
                    return $total;
                }
                $count = 1;
                $subTotal = 0;
                foreach ($userRequirements as $row) {
                    $total = $row["cost"] * $row['quantity'];
                    $subTotal += $total;
                    echo "<tr>
                        <td>".$count."</td>
                        <td>".$row["item_description"]."</td>
                        <td>".$row["cost"]."</td>
                        <td>".$row["quantity"]."</td>
                        <td>".$total."</td>
                    </tr>";
                    $count += 1;
                }
            ?>
            
            <tr>
                <td align="right" colspan=5><strong>Sub Total(A):</strong><span id="form6_subtotal_total">
                <?php 
                    echo $subTotal;
                ?></span></td>
            </tr>
            <tr>
                <td align="right" colspan=5><strong>GST 18.00%(B):</strong><span id="form6_gst_total">
                <?php 
                    $gstTotal = ceil($subTotal * 0.18); 
                    echo $gstTotal; 
                ?></span></td>
            </tr>
            <tr>
                <td align="right" colspan=5><strong>Total cost(A + B):</strong><span id="form6_final_total"> <?php
                    echo $subTotal + $gstTotal;
                ?></span></td>
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
        <button class="btn btn-success" name="verify_form6">
            Verify&nbsp;<i class="fas fa-check"></i>
        </button>
    </form>
    <button class="btn btn-danger" id="optional_form6_reject">
        Reject&nbsp;<i class="fas fa-times"></i>
    </button>
</div>

<!-- modal for reject optional form 4-->
<div class="modal fade" id="optional_form6_reject_modal">
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
                        <textarea class="form-control" id="rejection_message" name="rejection_message_form4" rows=10 required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="reject_form6">Confirm</button>
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
    $("#optional_form6_reject").click(function (e) { 
        e.preventDefault();
        $("#optional_form6_reject_modal").modal("show");
    });
</script>
<?php
    if(isset($_POST["verify_form6"])){
        global $conn;
        $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form6 = 2 where exhibitor_id = ".$_GET["id"];
        $queryResult = executeQuery($conn,$setQuery);
        if($queryResult) {
            notify("You have successfully reviewed Optional form 6.", "success");
        } else {
            notify("Form Review failed: Optional form 6.", "error");
        }
    }

    if (isset($_POST['reject_form6'])) {
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form6'] == 2) {
            // already verified, cannot reject.
            notify("Optional form 6 has been already reviewed and verifed, cannot reject.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form6 = 0 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if ($queryResult) {
                notify("Optional form 6 has been rejected successfully. The exhbitor will be notified regarding resubmission", "success");
            } else {
                notify("Form rejection failed: Optional form 6", "error");
            }
        }
    }
?>