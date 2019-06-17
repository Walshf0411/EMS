

<?php require('../utils/form_logo_details.php'); ?>

<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr style="background-color:rgb(193, 13, 109);">
                <th>FORM 5</th>
                <th>OTHER SERVICES</th>
                <th>OPTIONAL</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 5th June 2019 </td>
            </tr>
        </table>
    </p>
</div>
<p id="booth">
    <label for="Booth number">Booth number:</label>
    <input oninput="this.className = ''" name="booth_number">
</p>

<p align="center">
    <strong>Other services</strong>
    PLEASE FILL THIS FORM AND RETURN IT TO THE ORGANISERS IF THESE SERVICES ARE REQUIRED
</p>

<div class="table-wrapper">
    <table style="width:100%;">
        <tr style="background-color:rgb(193, 13, 109);color:white;">
            <th>No.</th>
            <th>Item Description</th>
            <th>Amount(INR)</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>1.</td>
            <td>Hanger</td>
            <td>Rs. 200 per dozen</td>
            <td><input min=0 type="number" class="data-input" id="item_quantity_1" onchange="itemChanged(200, this.value, 'item_total_1')"></td>
            <td>Rs: <span id="item_total_1">0</span></td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Hostesses(10:00 am to 7:00pm)</td>
            <td>Rs. 3,000 per day</td>
            <td><input min=0 type="number" class="data-input" id="item_quantity_2" onchange="itemChanged(3000, this.value, 'item_total_2')"></td>
            <td>Rs: <span id="item_total_2">0</span></td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Malyalam Translater(10:00 am to 7:00pm)</td>
            <td>Rs. 5,000 per day</td>
            <td><input min=0 type="number" class="data-input" id="item_quantity_3" onchange="itemChanged(5000, this.value, 'item_total_3')"></td>
            <td>Rs: <span id="item_total_3">0</span></td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Full Body Mannequin</td>
            <td>Rs. 3,500 Three Days</td>
            <td><input min=0 type="number" class="data-input" id="item_quantity_4" onchange="itemChanged(3500, this.value, 'item_total_4')"></td>
            <td>Rs: <span id="item_total_4">0</span></td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Half Mannequin</td>
            <td>Rs. 2,500 Three Days</td>
            <td><input min=0 type="number" class="data-input" id="item_quantity_5" onchange="itemChanged(2500, this.value, 'item_total_5')"></td>
            <td>Rs: <span id="item_total_5">0</span></td>
        </tr>   
        <tr>
            <td colspan=5>
                <div style="float:right">
                    Total (Rs): <span id="form4_total_price">0</span>
                </div>
            </td>
        </tr>
    </table>
</div>
<small><small>Above rate is exclusive of 18W% GST.</small></small>
<pre>
<strong>PLEASE NOTE :</strong>
1. The organisers will forward your request to the respective shell contractor appointed for the hall.
2. Orders received after 1st June 2019 may be accepted subject to the availability.
</pre>

<div style="float:right;">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both"></div>

<script>
    function itemChanged(price, value, totalId) {
        value = Number(value);
        price = Number(price);
        var item1Price = 200;
        if (value > 0) {
            var total = value * price;
            document.getElementById(totalId).innerHTML = total;
        } else {
            document.getElementById(totalId).innerHTML = 0;
        }
        total = 0;
        for(i=1; i<=5; i++) {
            var selector = "item_total_" + i;
            total += parseInt(document.getElementById(selector).innerHTML);
        }
        document.getElementById("form4_total_price").innerHTML = total;
    }
</script>