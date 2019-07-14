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
                    <?php 
                        require_once("../utils/connection.php");
                        require_once("../utils/globals.php");
                    ?>
                    <td colspan="3">Submission Date - <?php echo getSubmissionDates($conn)['mandatory_forms_deadline'];?></td>
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
    <span id="fair-listing-form-error" class="text-danger" style="display:none">Kindly fill in all the details. If you think this is a mistake, press Next.</span>
    <form onsubmit="return false;" id="fair-listing"> 
        <div class="form-group">
            <label for="company-name">Company name:</label>
            <input type="text" name="company-name" class="form-control required uppercase-text">
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
        <!-- Adding the product categories -->
        <div class="form-group">Product category</div>
        
        
        <label class="container-check">Lingerie
            <input type="checkbox" name="category[]"id="category" value="Lingerie">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Men's Innerwear
            <input type="checkbox" name="category[]"id="category" value="Men's Innerwear">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Kid's Innerwear
            <input type="checkbox" name="category[]"id="category" value="Kid's Innerwear">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Sleepwear
            <input type="checkbox" name="category[]"id="category" value="Sleepwear">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Loungewear
            <input type="checkbox" name="category[]"id="category" value="Loungewear">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Active wear
            <input type="checkbox" name="category6[]"id="category" value="Active wear">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Thermals
            <input type="checkbox" name="category7[]"id="category" value="Thermals">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Socks & Stockings
            <input type="checkbox" name="category8[]"id="category" value="Socks & Stockings">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Lingerie Accessories 
            <input type="checkbox" name="category9[]"id="category" value="Lingerie Accessories">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Retail Display
            <input type="checkbox" name="category10[]"id="category" value="Retail Display">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Retail Store Design Solution
            <input type="checkbox" name="category11[]" id="category" value="Retail Store Design Solution">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Retail Softwares 
            <input type="checkbox" name="category12[]" id="category" value="Retail Softwares">
            <span class="checkmark"></span>
        </label>
        <label class="container-check">Others
            <input type="checkbox" name="category13[]" id="category" value="Others">
            <span class="checkmark"></span>
        </label>
        
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
    $("#fair-listing input, textarea").addClass("uppercase-text");
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