<?php require('../utils/form_logo_details.php'); ?>

<div>
    <p class="table">
        <table style="width:100%;">
            <tr>
                <th>FORM 3</th>
                <th>REGISTRATION OF EXHIBITION PERSONNEL FOR BADGES</th>
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
<?php include("../utils/booth_number_header.php");?>

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
<span id="staff-personnel-form-error" class="text-danger" style="display:none">Kindly fill in all the details. If you think this is a mistake, press Next</span><br>
<div class="container">
    <ol style="padding:0;margin:0">
        <strong>THIS FORM MUST BE COMPLETED AND RETURNED BY EVERY EXHIBITOR</strong>
        <li><strong>APPLICATION :</strong>
        Please use this Form to apply for your stall personnel badges before <?php echo getSubmissionDates($conn)['mandatory_forms_deadline']?></li>
        <li><strong>PREPARATION OF EXHIBITORS’ BADGES :</strong>
        To avoid errors in the preparation of badges, Exhibitors are requested to TYPE all names in BLOCK LETTERS</li>
        <li><strong>COLLECTION OF BADGES :</strong>
        Badges can be collected from the Organiser’s Site Office in the Hall while taking possession of their stalls.</li>
        <li><strong>2 Badges per 6 sq. m. of booth and in multiple there off.</strong></li>
        <li><strong>BADGES :</strong>
        Kindly issue the Exhibitors’ badges for following stall personnel</li>
    </ol>
</div> <hr>

<form action="#" method="POST" id="number_of_staff_personnel_form">
<script>
    $(document).ready(function(){
        $(".table-input").hide();
    });
</script>

<div class="container input-fields" name="input-visible">
    <div class="form-group row">
        <label for="input_fields" class="form-md-label"><strong>Enter number of required Stall Personnel:</strong></label>
        <input type="number" class="form-control required" name="input_fields" max="100" min="1" id="input_fields" required>
        <div class="invalid-feedback" id="stall-personnel-error">
            Please enter your required number of stall personnel
        </div>
        <small class="form-text text-muted">
            Enter the number of stall personnel badges you require. 
        </small>        
    </div>
    <div class="row">
        <button type="submit" name="number_fields_submit" id="number_fields_submit" class="btn btn-success">Submit</button>
    </div>
</div>

<?php    
    if(isset($_POST["number_fields_submit"])){
        $fields = $_POST["input_fields"];
        echo "<script>
            $(document).ready(function(){
                $('#input_fields').val('$fields');
                $('#v-pills-tab-6').tab('show');
                $('.table-input').show();
            });
        </script>" ;
    }
?>
</form>
<br>
<form action="#" onsubmit="return false" id="exhibitor_staff_badges">
    <div class="table-input">
        <div class="row" id="header">
            <div class="col-md-2 col-sm-11 col-sm-offset-1">Sr.No.</div>
            <div class="col-md-6 col-sm-11 col-sm-offset-1">Name of the stall Personnel</div>
            <div class="col-md-4 col-sm-11 col-sm-offset-1">Designation</div>
        </div>
    
        <?php
            /* The frontend logic in the form */ 
            if(isset($_POST["number_fields_submit"])){
                if($fields>0){
                    for ($i=0; $i < $fields; $i++) { 
                        echo "<div class='row'>
                                    <div class='col-md-2 col-sm-11 col-sm-offset-1'>".($i+1).".</div>
                                    <div class='col-md-6 col-sm-11 col-sm-offset-1' style='width:100%;'><input class='required stall_personnel_name_field' name='stall_personnel_".($i+1)."'></div>
                                    <div class='col-md-4 col-sm-11 col-sm-offset-1' style='width:100%;'><input class='required' name='stall_personnel_".($i+1)."_designation'></div>
                                </div>";
                    }
                } else {
                    echo "<script>$(document).ready(function(){
                        $('.table-input').hide();
                    });</script>" ;            
                }
            }
        ?>
    </div>
</form>
<div style="float:right;">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both;"></div>
<div align=center>
    <button class="btn btn-danger" data-toggle="pill" href="#v-pills-5">
        <i class="fa fa-caret-left"></i>Previous
    </button>

    <button class="btn btn-success" id="mandatory_form3_next_btn">
        Next<i class="fa fa-caret-right"></i>
    </button>
</div>

<script>
    $("#exhibitor_staff_badges input, textarea").addClass("uppercase-text");
    var staffPersonnelFormValid = false;
    $(document).ready(function () {
        var staffPersonnelForm = $("#exhibitor_staff_badges");
        staffPersonnelForm.validate();
        staffPersonnelForm.sisyphus();
        $("#mandatory_form3_next_btn").click(function() {
        numberOfStallPersonnel = $(".stall_personnel_name_field").length;
        
        if (numberOfStallPersonnel > 0 && staffPersonnelForm.valid()){
            staffPersonnelFormValid = true;
            $("#staff-personnel-form-error").css("display", "none");
            $("#v-pills-tab-7").tab("show");
        } else {
            // error hai kuch toh
            if (numberOfStallPersonnel > 0){
                $("#stall-personnel-error").css('display', 'none');
                $("#input_fields").removeClass("is-invalid");
            }else {
                $("#stall-personnel-error").css('display', 'block');
                $("#input_fields").addClass("is-invalid");
                $("#staff-personnel-form-error").css("display", "block");
            }
        }
        });
    });
</script>
