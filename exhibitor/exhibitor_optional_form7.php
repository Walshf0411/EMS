<?php 
    require_once("../utils/globals.php");
    if (DEBUG) {
        require_once("../utils/local_connect.php");
    } else {
        require_once("../utils/superz_connect.php");
    }
    $getAdditionalItemsQuery = "SELECT * FROM additional_requirements_items";
    $queryResult = executeQuery($conn, $getAdditionalItemsQuery);
    $additionalItems = array();
    if ($queryResult && $queryResult->num_rows > 0) {
        while($row = $queryResult->fetch_assoc()) {
            $additionalItems[] = $row;
        }
    } else {
        $additionalItems = NULL;
    }
?>
<?php include("../utils/form_logo_details.php"); ?>
<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr>
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
    
<p id="booth">
    <label for="Booth number">Booth number:</label>
    <input name="booth_number">
</p>
<p>
<strong>PLEASE FILL THIS FORM AND RETURN IT TO THE ORGANISERS IF THESE SERVICES ARE REQUIRED</strong>
Please use this Form to order furnishing needs. The standard SHELL SCHEME Package Stall includes furniture on
pro rata basis of the area booked as given in the Application Form. For furniture requirements not listed below, please
contact the Organiser for a separate quote. ORDER ONLY ADDITIONAL REQUIREMENTS.
EXTRA FURNITURE RATE LIST FOR SUPER JUNIORZ, CHENNAI
DATED 24-25 JUNE 2019 | Venue Trade Center, Chennai, Tamil Nadu.</p>
<?php if ($additionalItems):?>
<div class="table-wrapper">
    <table width=100% class="table">
        <thead>
            <tr>
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
            <?php $count = 1; foreach($additionalItems as $item): 
                $codeNumber = $item['code_number'];
                $productName = $item['product_name'];
                $price = $item['price'];
                $days = $item['days'];
                $priceId = "electrical-item-" . $count . "-price";
                $quantityId = "electrical-item-" . $count;
                $totalId = "electrical-item-" . $count . "-total";
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $codeNumber;?></td>
                <td><?php echo $productName?></td>
                <td><span id="<?php echo $priceId;?>"><?php echo $price;?></span><?php if($days > 1) echo $days." Days"?></td>
                <td><input type="number" id="<?php echo $quantityId;?>" min=0></td>
                <td><span id="<?php echo $totalId;?>">0</span></td>
            </tr>
            <?php $count++; endforeach ?>
            <!-- rows for total gst-total and final total-->
            <tr>
                <td align=right colspan=6>
                    <strong>Sub Total(Rs): <span id="electrical-items-total">0</span></strong>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Gst Total (Rs): <span id="electrical-items-gst-total">0</span></strong>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Total(Rs): <span id="electrical-items-final-total">0</span></strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="jumbotron" align=center>
    <i class="fa fa-frown fa-10x"></i><br>
    No items available
</div>
<?php endif ?>
<div style="float:right">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both"></div>

<div align=center>
    <button class="btn btn-success" id="exhibitor_optional_form4_submit_btn">
        Submit<i class="fas fa-paper-plane"></i>
    </button>
</div>

<script>
    var numberOfAvailableItems = 67;
    var inputIdPrefix = "electrical-item-";
    for (i=1; i <= numberOfAvailableItems; i++) {
        var selector = inputIdPrefix + i;
        document.getElementById(selector).setAttribute("oninput", "onItemChanged1(" + i + ", this.value)");
    }
    function updateTotals1() {
        var totalIdPrefix = "electrical-item-";
        var totalIdSuffix = "-total";
        var subTotalId = "electrical-items-total";
        var gsTotalId = "electrical-items-gst-total";
        var finalTotalId = "electrical-items-final-total";
        var gst = 0.18;
        var total = 0;

        for (i=1; i <= numberOfAvailableItems; i++) {
            var selector = totalIdPrefix + i + totalIdSuffix;
            total += Number(document.getElementById(selector).innerHTML);
        }
        var gstTotal = Math.ceil(gst * total);
        var finalTotal = total + gstTotal;
        
        document.getElementById(subTotalId).innerHTML = total;
        document.getElementById(gsTotalId).innerHTML = gstTotal;
        document.getElementById(finalTotalId).innerHTML = finalTotal;

    }
    function onItemChanged1(number, quantity) {
        var priceId = "electrical-item-" + number + "-price";
        var totalId = "electrical-item-" + number + "-total";
        
        quantity = Number(quantity);
        price = Number(document.getElementById(priceId).innerHTML);
        
        if (quantity > 0) {
            var total = quantity * price;
        
            document.getElementById(totalId).innerHTML = total;
        } else {
            document.getElementById(totalId).innerHTML = "0";
        }

        updateTotals1();
    }
</script>