<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }

    function getServices() {
        global $conn;
        $query = "SELECT * from other_services";
        $queryResult = executeQuery($conn,$query);
        $services =array();
        while($row = $queryResult-> fetch_assoc()) {    
            $services[] = $row;
        }

        return $services;
    }
?>

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

        <?php
            foreach (getServices() as $row) {
                $onchange = "itemChanged(".$row["amount"].", this.value, ".$row["id"].")";
                echo "
                    <tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["item_description"]."</td>
                        <td>".$row["amount"]." ".$row["duration"]."</td>
                        <td><input min=0 type='number' class='data-input' id='item_quantity_".$row["id"]."' onchange='".$onchange."'></td>
                        <td>Rs: <span id='item_total_".$row["id"]."'>0</span></td>
                    </tr>
                ";
            }
        ?>
   
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
    function itemChanged(price, value, totalId) {
        value = Number(value);
        price = Number(price);
        var item1Price = 200;
        if (value > 0) {
            var total = value * price;
            document.getElementById("item_total_" + totalId).innerHTML = total;
        } else {
            document.getElementById("item_total_" + totalId).innerHTML = 0;
        }
        total = 0;
        for(i=1; i<=5; i++) {
            var selector = "item_total_" + i;
            total += parseInt(document.getElementById(selector).innerHTML);
        }
        document.getElementById("form4_total_price").innerHTML = total;
    }
</script>