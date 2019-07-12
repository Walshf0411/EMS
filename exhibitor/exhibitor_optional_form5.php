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

<div>
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
<?php include("../utils/booth_number_header.php");?>

<p align="center">
    <strong>Other services</strong>
    PLEASE FILL THIS FORM AND RETURN IT TO THE ORGANISERS IF THESE SERVICES ARE REQUIRED
</p>
<?php
    if (isset($_SESSION['optional_form5_submitted'])) {
        // if the user has already filled in the form, the button will be disabled
        echo "<div class='alert alert-danger'>
            You have already submitted this form, wait for the admin to review it.
        </div>";
    }
?>
<div class="table-wrapper">
    <table style="width:100%;" id="optional_form5_table">
        <tr>
            <th>No.</th>
            <th>Item Description</th>
            <th>Amount(INR)</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <form method="POST" id="optional_form5">
        <?php
            foreach (getServices() as $row) {
                $onchange = "itemChanged(".$row["amount"].", this.value, ".$row["id"].")";
                echo "
                    <tr>
                        <td>".$row["id"]."</td>
                        <td id='item_description".$row['id']."'>".$row["item_description"]."</td>
                        <td id='item_amount_".$row['id']."'>".$row["amount"]." ".$row["duration"]."</td>
                        <td><input min=0 type='number' class='data-input' id='item_quantity_".$row["id"]."' onchange='".$onchange."'></td>
                        <td>Rs: <span id='item_total_".$row["id"]."'>0</span></td>
                    </tr>
                ";
            }
        ?>
        </form>
        <tr>
            <td colspan=5>
                <div style="float:right">
                    <strong>Total (Rs): </strong><span id="form5_total_price">0</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=5>
                <div style="float:right">
                    <strong>GST Total (Rs)(18%): </strong><span id="form5_gst_total">0</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=5>
                <div style="float:right">
                    <strong>Grand Total (Rs): </strong><span id="form5_final_total">0</span>
                </div>
            </td>
        </tr>
    </table>
</div>


<small><small>Above rate is exclusive of 18W% GST.</small></small>
<br>
<strong>PLEASE NOTE :</strong>
<ol>
    <li>The organisers will forward your request to the respective shell contractor appointed for the hall.</li>
    <li>Orders received after 1st June 2019 may be accepted subject to the availability.</li>
</ol>

<div style="float:right">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both"></div>

<div align=center>
    <button class="btn btn-success" id="exhibitor_optional_form5_submit_btn">
        Submit<i class="fas fa-paper-plane"></i>
    </button>
</div>

<div class="modal fade" id="optional_form5_modal">
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
                    <div id="optional_form5_modal_content">
                        <table></table>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-info" id="optional_form5_invoice_accept">Accept <i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    <?php
        if (isset($_SESSION['optional_form5_submitted'])) {
            // if the user has already filled in the form, the button will be disabled
            echo "$('#exhibitor_optional_form5_submit_btn').attr('disabled', 'true');";
        }
    ?>
    var numberOfform5Items = "<?php echo count(getServices())?>";
    function setOptionalForm5Invoice() {
        // take the items and add it to a table and show it in the modal
        var inputTagPrefix = "#item_quantity_";
        var selected = 0;
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
        
        tableData += $($("#form5_total_price").parents()[2]).prop('outerHTML');
        tableData += $($("#form5_gst_total").parents()[2]).prop('outerHTML');
        tableData += $($("#form5_final_total").parents()[2]).prop('outerHTML');

        tableData += "</table>";
        if (selected > 0) {
            // the user should be selecting at least one item
            
            console.log(tableData);
            $("#optional_form5_modal_content").html(tableData);
            $("#optional_form5_modal").modal("show");
        } else {
            $.notify.defaults({
                globalPosition: 'top center',
            });
            $.notify("Kindly select at least one of the options", "error");
        }
    }
    function showWaitingOverlay(modalId) {
        $("#" + modalId).modal("hide");
        $(".loading-overlay").animate({
            opacity: 1
        }, 500); 
        $(".loading-overlay").css("z-index", "1000");
    }

    function hideWaitingOverlay() {
        $(".loading-overlay").animate({
            opacity: 0
        }, 500); 
        $(".loading-overlay").css("z-index", "-1");
    }
    function submitOptionalForm5() {
        var inputTagPrefix = "#item_quantity_";
        var obj = {};
        for (i=1; i<=numberOfform5Items; i++) {
            var selector = inputTagPrefix + i;
            
            // convert the value to a number and check if there is a value
            if (Number($(selector).val())) {
                obj[i.toString()] = $(selector).val();
            }
        }
        console.log(obj);
        formData = new FormData();
        formData.append("selected_items", JSON.stringify(obj));
        showWaitingOverlay("optional_form5_modal");
        $.ajax({
            type: "POST",
            url: "exhibitor_optional_form5_submit.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                hideWaitingOverlay();
                console.log(response);
                if (response[0] == 1) {
                    console.log(response);
                }
                $("#exhibitor_optional_form5_submit_btn").attr("disabled", "true");
                $("#optional_form5_modal").modal("hide");
                $.notify("Form Submitted Successfully", "success");
                $('#v-pills-tab-9').addClass('text-success');
            },
            error: function(response) {
                hideWaitingOverlay();
                $.notify("Error", "error", "top center");
            }
        });
    }

    $(document).ready(function () {
        $("#exhibitor_optional_form5_submit_btn").click(function() {
            // make and show the invoice.
            setOptionalForm5Invoice();
        });
        $("#optional_form5_invoice_accept").click(function() {
            submitOptionalForm5();
        });
    });
    function itemChanged(price, value, totalId) {
        value = Number(value);
        price = Number(price);
        var gst = 0.18;
        var item1Price = 200;
        if (value > 0) {
            var total = value * price;
            $("#item_total_" + totalId).html(total);
        } else {
            $("#item_total_" + totalId).html(0);
        }
        total = 0;
        for(i=1; i<=5; i++) {
            var selector = "item_total_" + i;
            total += parseInt(document.getElementById(selector).innerHTML);
        }
        var gstTotal = Math.ceil(gst * total);
        var finalTotal = total + gstTotal;
        $("#form5_total_price").html(total);
        $("#form5_gst_total").html(gstTotal);
        $("#form5_final_total").html(finalTotal);
    }
</script>