 <?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getDetails(){
        global $conn;

        $query = "Select * from advertising_in_fair_catalogue";
        $queryResult = executeQuery($conn,$query);

        $advertising_in_fair_catalogue = array();
        while($row = $queryResult->fetch_assoc()){
            $advertising_in_fair_catalogue[]= $row;
        }

        return $advertising_in_fair_catalogue;
    }
 ?>   
    <?php include("../utils/form_logo_details.php");?>
    <div>
        <p class="table">
            <table style="width:100%;">
                <tr>
                    <th>FORM 4</th>
                    <th>ADVERTISING IN FAIR CATALOGUE</th>
                    <th>OPTIONAL</th>
                </tr>
                <tr>
                    <?php 
                        require_once("../utils/connection.php");
                        require_once("../utils/globals.php");
                    ?>
                    <td colspan="3">Submission Date - <?php echo getSubmissionDates($conn)['optional_form4_deadline'];?></td>
                </tr>
            </table>
        </p>
    </div>
    <?php include("../utils/booth_number_header.php");?>
    <p>
        <strong>ADVERTISING IN FAIR CATALOGUE</strong>
        Advertise in the Fair Catalogue and gain maximum advantage of your participation in Super Juniorz.
        Advertising in the Fair Catalogue is cost effective and will be retained by the trade visitors as a sourcing referencer.
    </p>
    <?php
        require_once("../utils/globals.php");
        require_once("../utils/connection.php");

        $status = getFormStatus($conn);
        $deadlineGone = strtotime(getSubmissionDates($conn)['optional_form4_deadline']) < strtotime("today");
        if ($status) {
            if ($status["optional_form4"] == 1) {
                // if the user has already filled in the form, the button will be disabled
                echo "<div class='alert alert-info'>
                    You have already submitted this form, wait for the admin to review it.
                </div>";
            } else if ($status['optional_form4'] == 2) {
                echo "<div class='alert alert-success'>
                    Hola! This form has been reviewed by the exhibitor. Kindly find the invoice in your mail inbox & pay the amount to the organizers.
                </div>";
            } else if ($status['optional_form4'] == 3) {
                echo "<div class='alert alert-danger'>
                    Sorry! This form has been rejected, please re-submit it.
                </div>";
            } else if ($status["optional_form4"] == 0 && $deadlineGone) {
                echo "<div class='alert alert-danger'>
                    Sorry! The deadline for this form has already passed, your submission will not be considered.
                </div>";
            }
        }
    ?>
    
    <p>
        <strong>Advertising rates: </strong>
        <form>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="col-md-12">
                        <table style="width:100%;">
                            <tr style="background-color:rgb(193, 13, 109);color:white;">
                                <th>Position</th>
                                <th>Rate(Rs.)</th>
                                <th></th>
                            </tr>
                            <?php
                                foreach (getDetails() as $row) {
                                    if($row["id"] <= 5){
                                        echo "
                                            <tr>
                                                <td id='form4_item_position_".$row['id']."'>".$row["position"]."</td>
                                                <td id='form4_item_price_".$row['id']."'>".$row["rate"]."</td>
                                                <td><input type='checkbox' name='optional_form4_checkbox' value='".$row['id']."'</td>
                                            </tr>
                                        ";
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="col-md-12">
                        <table style="width:100%;">
                            <tr style="background-color:rgb(193, 13, 109);color:white;">
                                <th>Position</th>
                                <th>Rate(Rs.)</th>
                                <th></th>
                            </tr>
                            <?php
                                foreach (getDetails() as $row) {
                                    if($row["id"] > 5){
                                        echo "
                                            <tr>
                                                <td id='form4_item_position_".$row['id']."'>".$row["position"]."</td>
                                                <td id='form4_item_price_".$row['id']."'>".$row["rate"]."</td>
                                                <td><input type='checkbox' name='optional_form4_checkbox' value='".$row['id']."'</td>
                                            </tr>
                                        ";
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </p>

    <div>
        <strong>Full page size (Techinical Specifications) :</strong>
        <ul>
            <li>Trim Size: 125mm X 215mm</li>
            <li>Bleed: 150mm X 210mm</li>
            <li>Non-bleed: 140mm X 200mm</li>
            <li>Require Bleed margin of 5mm on all side of the page.</li>
        </ul>
    </div>

    
    <div class="container">
        <strong>FOR ADVERTISEMENT QUERY:</strong><br>
        <strong>CONTACT:</strong>
        Farheen Khan <br>
        <a href="tel:+91 8080899927">+91 8080899927<br>
        <a href="mailto:farheen.khan@peppermint.co.in">farheen.khan@peppermint.co.in</a><br>
    </div><br>

    <div style="float:right">
        <?php include("../utils/exhibitor_footer.php");?>
    </div>
    <div style="clear:both"></div>

    <div align=center>
        <button class="btn btn-success" id="exhibitor_optional_form4_submit_btn">
            Submit<i class="fas fa-paper-plane"></i>
        </button>
    </div>

    <div class="modal fade" id="optional_form4_modal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
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
                        <div id="optional_form4_modal_content">
                            <table></table>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success" id="optional_form4_accept_btn">Accept <i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


<script>
    <?php
        require_once("../utils/globals.php");
        require_once("../utils/connection.php");

        $status = getFormStatus($conn);
        if ($status) {
            if ($status["optional_form4"] == 1) {
                // if the user has already filled in the form, the button will be disabled
                echo "$('#exhibitor_optional_form4_submit_btn').attr('disabled', 'true');";
            } else if ($status['optional_form4'] == 2) {
                echo "$('#exhibitor_optional_form4_submit_btn').attr('disabled', 'true');";
            } 
        }
    ?>
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
    function setOptionalForm4Invoice(items) {
        // take the items and add it to a table and show it in the modal
        var tableData = "<table width='100%'>\
        <tr><th>Sr.no</th>\
        <th>Position</th>\
        <th>Price</th></tr>";

        total = 0;
        gst = 0.18;
        for(i=0; i < items.length; i++) {
            item = items[i];
            itemPosition = $("#form4_item_position_" + item).html();
            itemPrice = $("#form4_item_price_" + item).html();
            total += Number(itemPrice);

            tableData += "<tr>\
                <td>" + (i + 1) + "</td>\
                <td>" + itemPosition + "</td>\
                <td>" + itemPrice + "</td>\
            </tr>";
        }
        gstTotal = Math.ceil(Number(gst * total));
        finalTotal = total + gstTotal;

        tableData += "<tr><td colspan=4 align='right'></strong>Total(Rs): </strong>" + total + "</td></tr>";
        tableData += "<tr><td colspan=4 align='right'><strong>GST Total(18%)(Rs): </strong>" + gstTotal + "</td></tr>";
        tableData += "<tr><td colspan=4 align='right'><strong>Grand Total(Rs): </strong>" + finalTotal + "</td></tr>";

        tableData += "</table>";
        $("#optional_form4_modal_content").html(tableData);
        $("#optional_form4_modal").modal("show");
        
    }
    var selectedOptions;
    $(document).ready(function () {
        // click function for the main outer button(Submit)
        $("#exhibitor_optional_form4_submit_btn").click(function () {
            // initialize empty array
            selectedOptions = [];
            // take each of the selected items and add it to the favourite array
            var selected = $("input[name='optional_form4_checkbox']:checked");
            if (selected.length > 0) {
                // only show invoice if user has checked something
                $.each(selected, function(){            
                    selectedOptions.push($(this).val());
                });
                setOptionalForm4Invoice(selectedOptions);
            } else {
                $.notify.defaults({
                    globalPosition: 'top center',
                });
                $.notify("Kindly select at least one of the options", "error");
            }
        });  
        $("#optional_form4_accept_btn").click(function (e) { 
            e.preventDefault();
            formData = new FormData();
            formData.append("selected_items", JSON.stringify(selectedOptions));
            showWaitingOverlay("optional_form4_modal");
            $.ajax({
                type: "POST",
                url: "exhibitor_optional_form4_submit.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    $("#exhibitor_optional_form4_submit_btn").attr("disabled", "true");
                    $.notify("Form submitted Successfully.", "success");
                    $('#v-pills-tab-8').addClass('text-success');
                    hideWaitingOverlay();
                },
                error: function(response) {
                    hideWaitingOverlay();
                    $.notify("Error", "error", "top middle");
                }
            });
        });  
    });
</script>