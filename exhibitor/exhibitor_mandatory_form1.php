<?php require('../utils/form_logo_details.php'); ?>
<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr>
                <th>FORM 1</th>
                <th>STANDARD SHELL SCHEME PACKAGE</th>
                <th>MANDATORY</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 5th June 2019 </td>
            </tr>
        </table>
    </p>
</div>        
<?php include("../utils/booth_number_header.php"); ?>
<p id="fascia-name">
    Please enter below the Exhibitor’s name as you require on the fascia. This will be provided in upper case, standard English alphabets (Maximum 24 letters) cut in white vinyl and pasted on Name fascia.
</p>

<p>
    <p id="use-bold">PLEASE USE BOLD LETTERS</p>
    <ol id="list1">
        <li>
            <div class="form-group">
                <label for="fasica_name"></label>FASCIA NAME (As it should appear on your stall)</label>
                <input type="text" class="form-control required" id="fascia_name" name="fasica_name" maxlength="24" style="text-transform:uppercase">
            </div>
        </li>
        <li>
            SHELL SCHEME PACKAGE
            <p>Shell Scheme package includes partition walls on maximum 3 sides, needle punch carpet, name fascia with basic furniture and fittings etc. shown in the Application Form. <i class="fa fa-info-circle fa-2x id-icon" ></i></p>
        </li>
        <li>
            DRAWINGS / DIAGRAMS
            <p>The perspective of the Standard Shell Scheme Stall is shown on the Application Form. <i class="fa fa-info-circle fa-2x id-icon"></i></p>
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
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
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
                
                    <img src="../images/standard_booth_layout1.jpg" alt="standard layout 1">
                    <img src="../images/standard_booth_layout2.jpg" alt="standard layout 1">
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
        onInputFascia();
        $("#fascia_name").attr("oninput", "onInputFascia()");
    });
</script>