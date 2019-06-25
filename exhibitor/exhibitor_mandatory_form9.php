<?php require('../utils/form_logo_details.php'); ?>

    <div class="col-md-12 col-sm-12">
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
    <pre>
To,
The Chief Organiser
PEPPERMINT COMMUNICATIONS PVT. LTD.
Mumbai
</pre>
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
    <input type="checkbox" name="" id="agreement_checkbox">
    <p>I have read the terms and conditions.</p>
    <br><br>
    <button class="btn btn-danger" data-toggle="pill" href="#v-pills-6">
        <i class="fa fa-caret-left"></i>Previous
    </button>

    <button class="btn btn-info" id="mandatory-forms-submit-btn" disabled>
        Submit<i class="fas fa-paper-plane"></i>
    </button>
</div>
<script>
    function submitMandatoryForms() {
        // get all the forms.
        var fasciaName = $("#fascia_name");
        var fairListingForm = $("#fair-listing");
        var stallPersonnelForm = $("#exhibitor_staff_badges");
        // creating form Data objects for the two forms.
        var fairListingFormData = new FormData(fairListingForm.get(0));
        var stallPersonnelFormData = new FormData(stallPersonnelForm.get(0));
        var finalFormData = new FormData();
        
        // add all the details to the final form Data object
        finalFormData.append("fascia_name", fasciaName.val());
        for (pair of fairListingFormData.entries()) {
            finalFormData.append(pair[0], pair[1]);
        }
        for (pair of stallPersonnelFormData.entries()) {
            finalFormData.append(pair[0], pair[1]);
        }

        for (pair of finalFormData.entries()) {
            console.log("key: " + pair[0] + " - " + "value: " + pair[1]);
        }
        $("#full-overlay").css("z-index", 1000);
        $("#full-overlay").animate({
            opacity: 1
        }, 500); 

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
            var fasciaName = $("#fascia_name");
            var fairListingForm = $("#fair-listing");
            var stallPersonnelForm = $("#exhibitor_staff_badges");
            var fairListingFormError = $("#fair-listing-form-error");
            var staffPersonnelFormError = $("#staff-personnel-form-error");
            var valid = true;
            var fasciaNameTab = $("#v-pills-tab-4");
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
                alert("thanks for submitting");
                submitMandatoryForms();
                mandatoryFormsDropdown.removeClass("text-danger");
            }

        });
    });

</script>