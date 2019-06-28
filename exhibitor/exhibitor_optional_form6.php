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
    <?php
        if (isset($_SESSION['optional_form6_submitted'])) {
            // if the user has already filled in the form, the button will be disabled
            echo "<div class='alert alert-danger'>
                You have already submitted this form, wait for the admin to review it.
            </div>";
        }
    ?>
    <div class="col-md-12 col-sm-12">
        <table style="width:100%;" class="table-layout-fixed">
            <tr >
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
                foreach (getElectricalRequirements() as $row) {
                    echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row["item_description"]."</td>
                        <td><span id='fitings_price_".$row["id"]."'>".$row["cost"]."</span></td>
                        <td><input type='number' min=0 class='data-input' id='fitings_quantity_".$row["id"]."' oninput='onItemChanged(".$row["id"].", this.value)'></td>
                        <td><span id='fitings_total_".$row["id"]."'>0</span></td>
                    </tr>";
                }
            ?>
            <tr>
                <td align="right" colspan=5><strong>Sub Total(A):</strong><span id="form6_subtotal_total">0</span></td>
            </tr>
            <tr>
                <td align="right" colspan=5><strong>GST 18.00%(B):</strong><span id="form6_gst_total">0</span></td>
            </tr>
            <tr>
                <td align="right" colspan=5><strong>Total cost(A + B):</strong><span id="form6_final_total">0</span></td>
            </tr>
        </table>
    </div>

    <p align="center"><strong>PLEASE INDICATE LOCATIONS OF THE ABOVE REQUIREMENTS BELOW - PLAN OF STALL</strong></p>

   <p>LEFT BACK TO STALL RIGHT / LEFT AISLE RIGHT <br>
1. The Organisers will forward your request to the respective shell contractor appointed for the hall <br>
2. Orders received after 10th June 2019 may be accepted subject to the availability. <br>
3. On spot orders will be subject to availability and 100% premium. <br>
</p>

<div style="float:right">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both"></div>

<div align=center>
    <button class="btn btn-success" id="exhibitor_optional_form6_submit_btn">
        Submit<i class="fas fa-paper-plane"></i>
    </button>
</div>
<!-- Invoice modal form 6-->
<div class="modal fade" id="optional_form6_modal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="alert alert-danger">
                        <strong>Note:</strong> Kindly review the form before submitting. You will not be able to make any changes to the form after submitting.
                    </div>
                    <div id="optional_form6_modal_content">
                        <table></table>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-info" id="optional_form6_invoice_accept">Accept <i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    <?php
        if (isset($_SESSION['optional_form6_submitted'])) {
            // if the user has already filled in the form, the button will be disabled
            echo "$('#exhibitor_optional_form6_submit_btn').attr('disabled', 'true');";
        }
    ?>
    var numberOfform6Items = "<?php echo count(getElectricalRequirements())?>";
    
    function setOptionalForm6Invoice() {
        // take the items and add it to a table and show it in the modal
        var inputTagPrefix = "#fitings_quantity_";
        var selected = 0;
        // start the building the table invoice by appending the table tag and the header tag
        var tableData = "<table width='100%'>\
                <tr><th>Sr.no</th>\
                <th>Item Description</th>\
                <th>Amount(INR)</th>\
                <th>Quantity</th>\
                <th>Total</th></tr>";
        var gst = 0.18;

        for(i=1; i <= Number(numberOfform5Items); i++) {
            // iterate through the input tags and construct a table row for each items 
            // that has a value greater than 0 in the input tag.
            var selector = inputTagPrefix + i;
            
            // convert the value to a number and check if there is a value
            if (Number($(selector).val())) {
                // if the selected input tag has a number greater than 0
                tableRow = $(selector).parents()[1]; // this will get the row of the element with value.
                tableRowChildren = $(tableRow).children(); // get the all tds of the selected tr
                tableRowString = "<tr><td>" + (selected + 1) + "</td>"; // set the Sr.no
                // 1 2 4 indexes of the table row are needed.
                tableRowString += $(tableRowChildren[1]).prop("outerHTML");
                tableRowString += $(tableRowChildren[2]).prop("outerHTML");
                tableRowString += "<td>" + $(selector).val() + "</td>";
                tableRowString += $(tableRowChildren[4]).prop("outerHTML");
                tableRowString += "</tr>";
                selected += 1;
                tableData += tableRowString;
            }
        }
        
        tableData += $($("#form6_subtotal_total").parents()[1]).prop('outerHTML');
        tableData += $($("#form6_gst_total").parents()[1]).prop('outerHTML');
        tableData += $($("#form6_final_total").parents()[1]).prop('outerHTML');

        tableData += "</table>";
        if (selected > 0) {
            // the user should be selecting at least one item
            console.log(tableData);
            $("#optional_form6_modal_content").html(tableData);
            $("#optional_form6_modal").modal("show");
        } else {
            $.notify.defaults({
                globalPosition: 'top center',
            });
            $.notify("Kindly select at least one of the options", "error");
        }
    }
    function submitOptionalForm6() {
        var fittingsInputPrefix = "#fitings_quantity_";
        var selectedItems = {}; 
        for (i=1; i < Number(numberOfform6Items); i++) {
            selector = fittingsInputPrefix + i;
            if (Number($(selector).val())) {
                selectedItems[i.toString()] = $(selector).val();
            }
        }
        formData = new FormData();
        formData.append("selected_items", JSON.stringify(selectedItems));
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "exhibitor_optional_form6_submit.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                $("#optional_form6_modal").modal("hide");
                $("#exhibitor_optional_form6_submit_btn").attr("disabled", "true");
                $.notify.defaults({
                    globalPosition: "top center"
                });
                $.notify("Form Submitted Successfully.", "success");
                $('#v-pills-tab-10').addClass('text-success');
            }
        });
        
    }
    
    function updateTotals() {
        
        var totalIdPrefix = "fitings_total_";
        var subTotalId = "form6_subtotal_total";
        var gsTotalId = "form6_gst_total";
        var finalTotalId = "form6_final_total";
        var gst = 0.18;
        var total = 0;

        for (i=1; i <= Number(numberOfform6Items); i++) {
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
    $(document).ready(function () {
        $("#exhibitor_optional_form6_submit_btn").click(function(e) {
            e.preventDefault();
            setOptionalForm6Invoice();
        });
        $("#optional_form6_invoice_accept").click(function (e) { 
            e.preventDefault();
            submitOptionalForm6();
        });
    });
</script>