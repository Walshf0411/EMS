<?php require('../utils/form_logo_details.php'); ?>
<div>
    <p class="table">
        <table style="width:100%;">
            <tr>
                <th>FORM 1</th>
                <th>STANDARD SHELL SCHEME PACKAGE</th>
                <th>MANDATORY</th>
            </tr>
            <tr>
                <?php 
                    require_once("../utils/connection.php");
                    require_once("../utils/globals.php");
                ?>
                <td colspan="3">Submission Date - <?php echo getSubmissionDates($conn)['mandatory_forms_deadline']?></td>
            </tr>
        </table>
    </p>
</div>        
    <?php include("../utils/booth_number_header.php"); ?>
    
    <?php
    require_once("../utils/globals.php");
    require_once("../utils/connection.php");

    $status = getFormStatus($conn);
    $deadlineGone = strtotime(getSubmissionDates($conn)['mandatory_forms_deadline']) < strtotime("today");
    if ($status) {
        if ($status["mandatory_forms"] == 1) {
            // if the user has already filled in the form, the button will be disabled
            echo "<div class='alert alert-info'>
                You have already submitted this form, wait for the admin to review it.
            </div>";
        } else if ($status['mandatory_forms'] == 2) {
            echo "<div class='alert alert-success'>
                Hola! This form has been reviewed by the exhibitor.
            </div>";
        } else if ($status['mandatory_forms'] == 3) {
            echo "<div class='alert alert-danger'>
                Sorry! This form has been rejected, please re-submit it.
            </div>";
        } else if ($status["mandatory_forms"] == 0 && $deadlineGone) {
            echo "<div class='alert alert-danger'>
                Sorry! The deadline for this form has already passed, your submission will not be considered.
            </div>";
        }
    }
    
    ?>
<p id="fascia-name">
    Please enter below the Exhibitor’s name as you require on the fascia. This will be provided in upper case, standard English alphabets (Maximum 24 letters) cut in white vinyl and pasted on Name fascia.
</p>

<p>
    <p id="use-bold">PLEASE USE BOLD LETTERS</p>
    <ol id="list1">
        <li>
            <form action="#" onsubmit="return false" id="fascia_form">
                <div class="form-group">
                    <label for="fasica_name"></label>FASCIA NAME (As it should appear on your stall)</label>
                    <input type="text" class="form-control required" id="fascia_name" name="fasica_name" maxlength="24" style="text-transform:uppercase">
                </div>
            </form>
        </li>
        <li>
            SHELL SCHEME PACKAGE
            <p>Shell Scheme package includes partition walls on maximum 3 sides, needle punch carpet, name fascia with basic furniture and fittings.
            <i class="fa fa-info-circle fa-2x id-icon" data-toggle="tooltip" data-placement="top" title="Click Here To view Standard booth layout and stall amenties"></i></p>
        </li>
        <li>
            DRAWINGS / DIAGRAMS
            <p>The perspective of the Standard Shell Scheme Stall is shown on the Application Form.
            <i class="fa fa-info-circle fa-2x id-icon" data-toggle="tooltip" data-placement="top" title="Click Here To view Standard booth layout and stall amenties"></i></p>
        </li>
    </ol>
</p>
<div style="float:right;">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both;"></div>
<div align=center>
    <button id="mandatory-form1-next-btn" data-toggle="pill" href="#v-pills-5" class="btn btn-success">Next <i class="fa fa-caret-right"></i></button>
</div>

<button type="button" id="std-booth-layout-modal-toggler" class="btn btn-primary" data-toggle="modal" data-target="#imageModal" style="display:none;">
    Open modal
</button>

<div class="modal fade" id="imageModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="row">
                <div class="offset-sm-10"></div>
                <div class="col-sm-1">
                    <button type="button" class="close" data-dismiss="modal" style="float:right">&times;</button>
                </div>
                <div class="col-sm-1"></div>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container" align=center>
                    <div class="offset-sm-4"></div>
                    <div class="col-sm-4 colored-header">
                        STANDARD BOOTH LAYOUT
                    </div>
                    <div class="offset-sm-4"></div>
                </div>
                <div class="container" align=center>
                    <strong>STALL AMENITIES</strong><br>
                    <img src="../images/stall_amenities.png" alt="stall amenities"><br><br>
                    <strong>STALL LAYOUT</strong><br>
                    <br>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <img src="../images/standard_booth_layout_1.png" alt="standard booth layout 1">
                        </div>
                        <div class="col-md-4">
                            <div class="standard-booth-layout-text">
                            <b>Front View <br>
                            Technical Size : 9sqm <br>
                            Top View<br>
                            Technical Size : 9sqm<br></b>
                            </div>

                        </div>
                    </div><br><br>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="standard-booth-layout-text">
                            <b>Front View <br>
                            Technical Size : 12sqm<br>
                            Top View<br>
                            Technical Size : 12sqm<br></b>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <img src="../images/standard_booth_layout_2.png" alt="standard booth layout 2">
                        </div>
                    </div><br><br>

                    <div class="row">
                        <div class="col-md-8">
                            <img src="../images/standard_booth_layout_3.png" alt="standard booth layout 3">
                        </div>
                        <div class="col-md-4">
                            <div class="standard-booth-layout-text">
                            <b>Front View <br>
                            Technical Size : 15sqm <br>
                            Top View <br>
                            Technical Size : 15sqm <br></b>
                            </div>
                        </div>
                    </div><br><br>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="standard-booth-layout-text">
                            <b>Front View <br>
                            Technical Size : 18sqm<br>
                            Top View<br>
                            Technical Size : 18sqm<br></b>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <img src="../images/standard_booth_layout_4.png" alt="standard booth layout 4">
                        </div>
                    </div>

                </div>
            </div>
        
        </div>
    </div>
</div>

<script>
    function standardBoothLayoutInfoButtonClicked() {
        $("#std-booth-layout-modal-toggler").click();
    }
    function onInputFascia() {
        if ($("#fascia_name").val()) {
            // some value has been entered in the fascia field
            $("#mandatory-form1-next-btn").prop('disabled', false);
        } else {
            // fascia input field is empty.
            $("#mandatory-form1-next-btn").prop('disabled', true);
        }
    }
    $(document).ready(function () {
        $(".id-icon").attr('onclick', "standardBoothLayoutInfoButtonClicked()");
        $("#fascia_form").sisyphus();
        onInputFascia();
        $("#fascia_name").attr("oninput", "onInputFascia()");
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>