<?php require('../utils/form_logo_details.php'); ?>

    <div>
        <p class="table">
            <table style="width:100%;">
                <tr style="background-color:rgb(193, 13, 109);">
                    <th>FORM 9</th>
                    <th>UNDERTAKING</th>
                    <th>MANDATORY</th>
                </tr>
                <tr>
                    <td colspan="3">Submission Date - 5th June 2019 </td>
                </tr>
            </table>
        </p>

    </div>
    <?php include("../utils/booth_number_header.php");?>
    <?php
    require_once("../utils/globals.php");
    require_once("../utils/connection.php");

    $status = getFormStatus($conn);
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
        } 
    }
    
    ?><br>
    To,<br>
    The Chief Organiser <br>
    PEPPERMINT COMMUNICATIONS PVT. LTD. <br>
    Mumbai <br><br>

        <strong>Subject:</strong> Undertaking towards participation at Super Juniorz, Chennai 2019
        <p>
        We, hereby undertake not to leave our booth unattended on 24th & 25th June 2019 from 10AM to 7PM on both the days at
        Super Juniorz 2019. Furthermore, we shall abide by all the rules and regulations as mentioned in participation form and Exhibitors
        Manual. We also understand the dismantling of booths before the end of exhibition or leaving the booths unattended shall attract a
        penalty of Rs.50,000 (Rupees Fifty Thousand Only) in addition to being bared from participating in any future event of Peppermint
        Communications Pvt. Ltd.
        </p>

<div style="float:right;">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style = "clear:both;"></div>
<div align=center>
    
    <input type="checkbox" id="agreement_checkbox" style="display:inline-block; width:5%" class="" value="" name="agreement_checkbox">I have read & agree the terms and conditions.
    
    <br><br>

    <button class="btn btn-danger" data-toggle="pill" href="#v-pills-6">
        <i class="fa fa-caret-left"></i>Previous
    </button>

    <button class="btn btn-info" id="mandatory-forms-submit-btn">
        Submit<i class="fas fa-paper-plane"></i>
    </button>
</div>
<script>
    
    <?php
    require_once("../utils/globals.php");
    require_once("../utils/connection.php");

    $status = getFormStatus($conn);
    if ($status) {
        if ($status["mandatory_forms"] == 1) {
            // if the user has already filled in the form, the button will be disabled
            echo "$('#mandatory-forms-submit-btn, #agreement_checkbox').attr('disabled', 'true');";
        } else if ($status['mandatory_forms'] == 2) {
            echo "$('#mandatory-forms-submit-btn, #agreement_checkbox').attr('disabled', 'true');";
        }
    }
    ?>
    function showWaitingOverlay() {
        
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
    function sendData(finalFormData) {
        showWaitingOverlay();
        $.ajax({
            type: "POST",
            url: "exhibitor_mandatory_form_submit.php",
            data: finalFormData,
            success: function (response) {
                console.log(response);
                hideWaitingOverlay();
                $('#mandatory-forms-submit-btn, #agreement_checkbox').attr('disabled', 'true');
                $.notify.defaults({
                    globalPosition: "top center"
                });
                $.notify("Form Submitted successfully", "success");
                $('#mandatory-forms-dropdown').addClass('text-success');
                $('#v-pills-tab-4').addClass('text-success');
                $('#v-pills-tab-5').addClass('text-success');
                $('#v-pills-tab-6').addClass('text-success');
                $('#v-pills-tab-7').addClass('text-success');
            },
            error: function(response) {
                hideWaitingOverlay();
                $.notify("Error", "error", "top center");
            },
            processData: false,
            contentType: false,
        });

    }
    function submitMandatoryForms() {
        // get all the forms.
        var fasciaName = $("#fascia_name");
        var fairListingForm = $("#fair-listing");
        var stallPersonnelForm = $("#exhibitor_staff_badges");
        var numberOfStallPersonnelForm = $("#number_of_staff_personnel_form");
        // creating form Data objects for the two forms.
        var fairListingFormData = new FormData(fairListingForm.get(0));
        var stallPersonnelFormData = new FormData(stallPersonnelForm.get(0));
        var numberOfStallPersonnelFormData = new FormData(numberOfStallPersonnelForm.get(0));
        var finalFormData = new FormData();
        
        // add all the details to the final form Data object
        finalFormData.append("fascia_name", fasciaName.val());
        for (pair of fairListingFormData.entries()) {
            finalFormData.append(pair[0], pair[1]);
        }
        for (pair of stallPersonnelFormData.entries()) {
            finalFormData.append(pair[0], pair[1]);
        }
        for (pair of numberOfStallPersonnelFormData.entries()) {
            finalFormData.append(pair[0], pair[1]);
        }

        for (pair of finalFormData.entries()) {
            console.log("key: " + pair[0] + " - " + "value: " + pair[1]);
        }
        showWaitingOverlay();
        sendData(finalFormData);
    }

    $(document).ready(function() {
        $("#agreement_checkbox").click(function () {
            if ($(this) .prop("checked") == true) {
                $("#mandatory-forms-submit-btn").attr("disabled", false);
            } else {
                $("#mandatory-forms-submit-btn").attr("disabled", true);
            }
        });
        $("#mandatory-forms-submit-btn").click(function() {
            // form 1 input tag
            var fasciaName = $("#fascia_name");
            var fairListingForm = $("#fair-listing"); // mandatory form 2 
            var stallPersonnelForm = $("#exhibitor_staff_badges"); // mandatory form 3
            var fairListingFormError = $("#fair-listing-form-error"); // mandatory form  2 error
            var staffPersonnelFormError = $("#staff-personnel-form-error"); // mandatory form 3 error
            var valid = true;
            var fasciaNameTab = $("#v-pills-tab-4"); // tab in the side tab
            var fairListingFormTab = $("#v-pills-tab-5");
            var exhibhitorStaffBadgesFormTab = $("#v-pills-tab-6");
            var mandatoryFormsDropdown = $("#mandatory-forms-dropdown");
            
            // check all the previous page forms and add errors in the dropdown
            // fascia name validation
            if (!fasciaName.val()) {
                // set an erro on the link in the dropdown
                valid = false;
                fasciaName.addClass("is-invalid");
                fasciaNameTab.addClass("text-danger");
            } else {
                fasciaName.removeClass("is-invalid");
                fasciaNameTab.removeClass("text-danger");
            }

            // fair catalogue listing validation
            if (!fairListingFormValid) {
                // set an error on the fair catalogue listing tab
                valid = false;
                fairListingFormError.css("display", "block");
                fairListingFormTab.addClass("text-danger");
            } else {
                fairListingFormError.css("display", "none");
                fairListingFormTab.removeClass("text-danger");
            }

            // staff badges listing validation
            if (!staffPersonnelFormValid) {
                // set an error on the staff badges tab
                valid = false;
                staffPersonnelFormError.css("display", "block");
                exhibhitorStaffBadgesFormTab.addClass("text-danger");
            } else {
                staffPersonnelFormError.css("display", "none");
                exhibhitorStaffBadgesFormTab.removeClass("text-danger");
            }

            // at the end of the form if there is an error in any of the forms
            // show a notification asking the user to correct the errors.
            if (!valid) {
                mandatoryFormsDropdown.addClass("text-danger");
                $.notify.defaults({
                    globalPosition: 'top center',
                });
                $.notify('Kindly Correct the errors', 'error');
            } else {
                submitMandatoryForms();
                mandatoryFormsDropdown.removeClass("text-danger");
            }

        });
    });

</script>