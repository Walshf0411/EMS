    <?php require('../utils/form_logo_details.php'); ?>
    <div>
        <p class="table">
            <table style="width:100%;">
                <tr style="background-color:rgb(193, 13, 109);">
                    <th>FORM 2</th>
                    <th>LISTING IN FAIR CATALOGUE</th>
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
    if (isset($_SESSION['mandatory_forms_submitted'])) {
        // if the user has already filled in the form, the button will be disabled
        echo "<div class='alert alert-danger'>
            You have already submitted this form, wait for the admin to review it.
        </div>";
    }
    ?>
    <span id="fair-listing-form-error" class="text-danger" style="display:none">Kindly fill in all the details. If you think this is a mistake, press Next.</span>
    <form onsubmit="return false;" id="fair-listing"> 
        <div class="form-group">
            <label for="company-name">Company name:</label>
            <input type="text" name="company-name" class="form-control required">
        </div>
        <div class="form-group">
            <label for="address">Company address:</label>
            <textarea cols="7" class="form-control required" name="address"></textarea>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="telephone_isd_code">Telephone ISD code:</label>
                <div class="textbox"> 
                    <span class="prepend_text">+</span>
                    <input type="text" name="telephone_isd_code" class="form-control required number-input" maxlength="4">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="telephone_std_code">STD code:</label>
                <input type="text" name="telephone_std_code" maxlength="3" class="form-control required number-input">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="telephone">Phone number:</label>
                <input type="text" name="telephone" maxlength="8" class="form-control required number-input">
            </div>
        </div>
        <div class="row">    
            <div class="col-md-4 col-sm-12">
                <label for="fax_isd_code">Fax ISD code:</label>
                <div class="textbox"> 
                    <span class="prepend_text">+</span>
                    <input type="text" name="fax_isd_code" class="form-control required number-input" maxlength="4">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="fax_std_code">STD code:</label>
                <input type="text" name="fax_std_code" maxlength="3" class="form-control required number-input" >
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="fax">Phone number:</label>
                <input type="text" name="fax" maxlength="8" class="form-control required number-input">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="mobile_isd_code">Mobile ISD code:</label>
                <div class="textbox"> 
                    <span class="prepend_text">+</span>
                    <input type="text" name="mobile_isd_code" class="form-control required number-input" maxlength="4">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="mobile">Mobile Number:</label>
                <input type="text" name="mobile" maxlength="10" class="form-control required number-input">
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control required email">
        </div>
        <div class="form-group">
            <label for="website">Website:</label>
            <input type="url" name="website" class="form-control required" placeholder="Example: https://google.com">
        </div>
        <div class="form-group">
            <label for="person">Contact Person:</label>
            <input type="text" name="person" class="form-control required">
        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <input type="text" name="designation" class="form-control required">
        </div>
        <div class="form-group">
            <label for="profile">Company profile:(not more than 100 words)</label>
            <textarea name="profile" class="form-control required" maxlength="100" rows="7"></textarea>
        </div>
        <div class="form-group">
            <label for="products">Products supplied / manufactured:</label>
            <textarea name="products" class="form-control required" rows="7"></textarea>
        </div>

        <div style="float:right">
            <?php include("../utils/exhibitor_footer.php");?>
        </div>
        <div style="clear:both"></div>
        <div align=center>
            <button class="btn btn-danger" data-toggle="pill" href="#v-pills-4">
                <i class="fa fa-caret-left"></i>Previous
            </button>
            &nbsp;
            <button type="submit" class="btn btn-success" id="exhibitor_mandatory_form2_submit_btn">
                Next<i class="fa fa-caret-right"></i>
            </button>
        </div>
    </form>

    <script>
    var fairListingFormValid = false;
    function pasteFunction (e) {
        var pastedData = e.originalEvent.clipboardData.getData('text');
        const regex = /\d+/gm;
        if (pastedData.match(regex)) {
            return true;
        } else{
            return false;
        }
        
    }
    function keypressFunction (event) {
        return event.charCode >= 48 && event.charCode <= 57;
    }

    $(document).ready(function () {
        $(".number-input").on("keypress", function(event) {
            return keypressFunction(event);
        });
        $(".number-input").on("paste", function(event) {
            return pasteFunction(event);
        });

        var form = $("#fair-listing");
        form.validate();
        form.sisyphus({
            onSave: function() {
                
            }, 
            onRestore: function() {
            
            }, 
            timeout: 1,
        });
        $("#exhibitor_mandatory_form2_submit_btn").click(function() {
            if (form.valid()) {
                // the tab show method is based on the anchor in the navbar
                // and not on the tab pane.
                $("#fair-lising-form-error").css("display", "none");
                fairListingFormValid = true;
                $("#v-pills-tab-6").tab("show");
            } 
        });
    });
        
    </script>