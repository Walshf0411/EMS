<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }

    function getElectricalRequirements(){
        global $conn;

        $query ="SELECT * FROM electrical_requirements";
        $queryResult = executeQuery($conn,$query);
        $requirements =array();
        while($row = $queryResult-> fetch_assoc()) {    
            $requirements[] = $row;
        }

        return $requirements;
    }
?>

<?php require('../utils/form_logo_details.php'); ?>
    <div class="col-md-12 col-sm-12">
        <p class="table">
            <table style="width:100%;">
                <tr ">
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
    
    <p id="booth">
        Booth number: <span id="booth_number">Number</span>
    </p>

    <p align="center">
        <strong>
            PLEASE FILL THIS FORM AND RETURN IT TO THE ORGANISERS IF THESE SERVICES ARE REQUIRED
        </strong>
    </p>

    <p>
    1. The Shell Scheme Exhibitors’ Package includes 100 watts comptax spot lights – 3 Nos and 1 plug point (for consumption up to 1 KW only) – single phase on pro rata basis. <br>
    2. The supply available is 130 V Single Phase 50 Hz AC only
    </p>
    <div class="col-md-12 col-sm-12">
        <table style="width:100%;" class="table-layout-fixed">
            <tr >
                <th>DESCRIPTION OF SERVICE/ITEMS</th>
                <th>Cost@INR</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>INDIVIDUAL FITINGS</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
                foreach (getElectricalRequirements() as $row) {
                    echo "<tr>
                        <td>".$row["item_description"]."</td>
                        <td><span id='fitings_price_".$row["id"]."'>".$row["cost"]."</span></td>
                        <td><input type='number' min=0 class='data-input' id='fitings_quantity_".$row["id"]."' oninput='onItemChanged(".$row["id"].", this.value)'></td>
                        <td><span id='fitings_total_".$row["id"]."'>0</span></td>
                    </tr>";
                }
            ?>
            <tr>
                <td align="right"><strong>Sub Total(A)</strong></td>
                <td></td>
                <td></td>
                <td><span id="subtotal_total">0</span></td>
            </tr>
            <tr>
                <td align="right"><strong>GST 18.00%(B)</strong></td>
                <td></td>
                <td></td>
                <td><span id="gst_total">0</span></td>
            </tr>
            <tr>
                <td align="right"><strong>Total cost(A + B)</strong></td>
                <td></td>
                <td></td>
                <td><span id="total_total">0</span></td>
            </tr>
        </table>
    </div>

    <p align="center"><strong>PLEASE INDICATE LOCATIONS OF THE ABOVE REQUIREMENTS BELOW - PLAN OF STALL</strong></p>

   <p>LEFT BACK TO STALL RIGHT / LEFT AISLE RIGHT <br>
1. The Organisers will forward your request to the respective shell contractor appointed for the hall <br>
2. Orders received after 10th June 2019 may be accepted subject to the availability. <br>
3. On spot orders will be subject to availability and 100% premium. <br>
</p>

<div style="float:right;">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both;"></div>
<script>
    function updateTotals() {
        var numberOfAvailableItems = 4;
        var totalIdPrefix = "fitings_total_";
        var subTotalId = "subtotal_total";
        var gsTotalId = "gst_total";
        var finalTotalId = "total_total";
        var gst = 0.18;
        var total = 0;

        for (i=1; i <= numberOfAvailableItems; i++) {
            var selector = totalIdPrefix + i;
            console.log(selector);  
            total += Number(document.getElementById(selector).innerHTML);
        }
        var gstTotal = Math.ceil(gst * total);
        var finalTotal = total + gstTotal;

        document.getElementById(subTotalId).innerHTML = total;
        document.getElementById(gsTotalId).innerHTML = gstTotal;
        document.getElementById(finalTotalId).innerHTML = finalTotal;

    }
    function onItemChanged(number, quantity) {
        var priceId = "fitings_price_" + number;
        var totalId = "fitings_total_" + number;
        
        quantity = Number(quantity);
        price = Number(document.getElementById(priceId).innerHTML);
        
        if (quantity > 0) {
            var total = quantity * price;
        
            document.getElementById(totalId).innerHTML = total;
        } else {
            document.getElementById(totalId).innerHTML = "0";
        }

        updateTotals();
    }
</script>