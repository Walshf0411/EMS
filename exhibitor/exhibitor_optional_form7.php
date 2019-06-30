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
    <?php
        if (isset($_SESSION['optional_form7_submitted'])) {
            // if the user has already filled in the form, the button will be disabled
            echo "<div class='alert alert-danger'>
                You have already submitted this form, wait for the admin to review it.
            </div>";
        }
    ?>
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
                $priceId = "electrical-item-" . $item['id'] . "-price";
                $quantityId = "electrical-item-" . $item['id'];
                $totalId = "electrical-item-" . $item['id'] . "-total";
                $onInput = "onItemChanged1(" . $item['id'] . ", this.value)";
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $codeNumber;?></td>
                <td><?php echo $productName?></td>
                <td><span id="<?php echo $priceId;?>"><?php echo $price;?></span><?php if($days > 1) echo $days." Days"?></td>
                <td><input type="number" id="<?php echo $quantityId;?>" min=0 oninput='<?php echo $onInput ?>'></td>
                <td><span id="<?php echo $totalId;?>">0</span></td>
            </tr>
            <?php $count++; endforeach ?>
            <!-- rows for total gst-total and final total-->
            <tr>
                <td align=right colspan=6>
                    <strong>Sub Total(Rs):</strong> <span id="electrical-items-total">0</span>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Gst Total (Rs): </strong><span id="electrical-items-gst-total">0</span>
                </td>
            </tr>
            <tr>
                <td align=right colspan=6>
                    <strong>Total(Rs):</strong> <span id="electrical-items-final-total">0</span>
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
    <button class="btn btn-success" id="exhibitor_optional_form7_submit_btn">
        Submit<i class="fas fa-paper-plane"></i>
    </button>
</div>

<div class="modal fade" id="optional_form7_modal">
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
                    <div id="optional_form7_modal_content">
                        <table></table>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-success" id="optional_form7_invoice_accept">Accept <i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    <?php
        if (isset($_SESSION['optional_form7_submitted'])) {
            // if the user has already filled in the form, the button will be disabled
            echo "$('#exhibitor_optional_form7_submit_btn').attr('disabled', 'true');";
        }
    ?>
    var numberOfForm7Items = <?php echo count($additionalItems)?>;
    function setOptionalForm7Invoice() {
        // take the items and add it to a table and show it in the modal
        var inputTagPrefix = "#electrical-item-";
        var selected = 0;
        var tableData = "<table width='100%'>\
                <tr><th>Sr.no</th>\
                <th>Code no.</th>\
                <th>Product name</th>\
                <th>Amount(INR)</th>\
                <th>Quantity</th>\
                <th>Total</th></tr>";
        var gst = 0.18;

        for(i=1; i <= Number(numberOfForm7Items); i++) {
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
                tableRowString += $(tableRowChildren[3]).prop("outerHTML");
                tableRowString += "<td>" + $(selector).val() + "</td>";
                tableRowString += $(tableRowChildren[5]).prop("outerHTML");
                tableRowString += "</tr>";
                selected += 1;
                tableData += tableRowString;
            }
        }
        
        tableData += $($("#electrical-items-total").parents()[1]).prop('outerHTML');
        tableData += $($("#electrical-items-gst-total").parents()[1]).prop('outerHTML');
        tableData += $($("#electrical-items-final-total").parents()[1]).prop('outerHTML');

        tableData += "</table>";
        if (selected > 0) {
            // the user should be selecting at least one item
            
            console.log(tableData);
            $("#optional_form7_modal_content").html(tableData);
            $("#optional_form7_modal").modal("show");
        } else {
            $.notify.defaults({
                globalPosition: 'top center',
            });
            $.notify("Kindly select at least one of the options", "error");
        }
    }
    function submitOptionalForm7() {
        var quantityIdPrefix = "#electrical-item-";
        var selectedItems = {}; 
        for (i=1; i < Number(numberOfForm7Items); i++) {
            selector = quantityIdPrefix + i;
            console.log(selector);
            if (Number($(selector).val())) {
                selectedItems[i.toString()] = $(selector).val();
            }
        }
        formData = new FormData();
        formData.append("selected_items", JSON.stringify(selectedItems));
        console.log(formData);
        showWaitingOverlay();
        $.ajax({
            type: "POST",
            url: "exhibitor_optional_form7_submit.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                hideWaitingOverlay();
                console.log(response);
                $("#optional_form7_modal").modal("hide");
                $("#exhibitor_optional_form7_submit_btn").attr("disabled", "true");
                $.notify.defaults({
                    globalPosition: "top center"
                });
                $.notify("Form Submitted Successfully.", "success");
                $('#v-pills-tab-11').addClass('text-success');
            },
            error: function(response) {
                hideWaitingOverlay();
                $.notify("Error", "error", "top center");
            }
        });
    }
    var inputIdPrefix = "electrical-item-";
    for (i=1; i <= numberOfForm7Items; i++) {
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

        for (i=1; i <= numberOfForm7Items; i++) {
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
    $(document).ready(function () {
        $("#exhibitor_optional_form7_submit_btn").click(function (e) { 
            e.preventDefault();
            setOptionalForm7Invoice();
        });
        $("#optional_form7_invoice_accept").click(function (e) { 
            e.preventDefault();
            submitOptionalForm7();
        });
    });
</script>