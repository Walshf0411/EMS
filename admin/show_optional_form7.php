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
            $userRequirements[] = $row;
        }
        return  $userRequirements;
    }
?>
<?php include("../utils/form_logo_details.php"); ?>
<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr style="">
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
    <h5>Your Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>
</div>

<div class="table-wrapper">
    <table width=100% class="table">
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
                foreach ($userRequirements as $row) {
                    echo "
                    <tr>
                        <td>".$row["item_id"]."</td>
                        <td>".$row["code_number"]."</td>
                        <td>".$row["product_name"]."</td>
                        <td>".$row["price"]."</td>
                        <td>".$row["quantity"]."</td>
                        <td>".$row["total"]."</td>
                    </tr>
                    ";
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
                        <?php echo getTotalPrice(); ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Gst Total (Rs): </strong><span id="electrical-items-gst-total">
                    <?php echo getTotalPrice()*0.18; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Total(Rs):</strong> <span id="electrical-items-final-total">
                    <?php echo getTotalPrice()+getTotalPrice()*0.18; ?>
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
    <button class="btn btn-success" id="exhibitor_optional_form7_submit_btn">
        Verify<i class="fas fa-paper-plane"></i>
    </button>
</div>
