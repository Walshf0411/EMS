<?php
    require_once('../utils/globals.php');
    if(DEBUG) {
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getForm2Details(){
        global $conn;
        $id = $_GET["id"];
        $query = "SELECT * from fair_catalogue_listing where exhibitor_id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $details = $queryResult->fetch_assoc();
        return $details;
    }
?>

<?php require('../utils/form_logo_details.php'); ?>
    <div class="col-md-12 col-sm-12">
        <p class="table">
            <table style="width:100%;">
                <tr style="background-color:rgb(193, 13, 109);color:white;">
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
    <!-- Display Booth number -->
    <div style="margin-left: 1%;">
        <h5>Exhibitor Booth number: <?php echo getForm1Details()["booth_number"]; ?></h5>
    </div>
    <span id="fair-listing-form-error" class="text-danger" style="display:none">Kindly fill in all the details. If you think this is a mistake, press Next.</span>
    <form onsubmit="return false;" id="fair-listing"> 
        <div class="form-group">
            <label for="company-name">Company name:</label>
            <!-- Display Company name -->
            <h5><?php echo getForm2Details()["company_name"]; ?></h5>
        </div>
        <div class="form-group">
            <label for="address">Company address:</label>
            <!-- Display Company address -->
            <h5><?php echo getForm2Details()["company_address"]; ?></h5>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="telephone_isd_code">Telephone ISD code:</label>
                <div class="textbox"> 
                    <h5>+<?php echo getForm2Details()["telephone_isd_code"]; ?></h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="telephone_std_code">STD code:</label>
                <div class="textbox">
                    <h5><?php echo getForm2Details()["telephone_std_code"]; ?></h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="telephone">Phone number:</label>
                <div class="textbox">
                    <h5><?php echo getForm2Details()["telephone_number"]; ?></h5>
                </div>
            </div>
        </div>
        <div class="row">    
            <div class="col-md-4 col-sm-12">
                <label for="fax_isd_code">Fax ISD code:</label>
                <div class="textbox">
                    <h5>+<?php echo getForm2Details()["fax_isd_code"]; ?></h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="fax_std_code">STD code:</label>
                <div class="textbox">
                    <h5><?php echo getForm2Details()["fax_std_code"]; ?></h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="fax">Phone number:</label>
                <div class="textbox">
                    <h5><?php echo getForm2Details()["fax_number"]; ?></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="mobile_isd_code">Mobile ISD code:</label>
                <div class="textbox"> 
                    <h5>+<?php echo getForm2Details()["mobile_isd_code"]; ?></h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="mobile">Mobile Number:</label>
                <div class="textbox">
                    <h5><?php echo getForm2Details()["mobile_number"]; ?></h5>
                </div>                
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <div>
                <h5><?php echo getForm2Details()["email"]; ?></h5>
            </div>
        </div>
        <div class="form-group">
            <label for="website">Website:</label>
            <div>
                <h5><?php echo getForm2Details()["website"]; ?></h5>
            </div>
        </div>
        <div class="form-group">
            <label for="person">Contact Person:</label>
            <div>
                <h5><?php echo getForm2Details()["contact_person"]; ?></h5>
            </div>
        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <div>
                <h5><?php echo getForm2Details()["designation"]; ?></h5>
            </div>
        </div>
        <div class="form-group">
            <label for="profile">Company profile:(not more than 100 words)</label>
            <div>
                <h5><?php echo getForm2Details()["company_profile"]; ?></h5>
            </div>        
        </div>
        <div class="form-group">
            <label for="products">Products supplied / manufactured:</label>
            <div>    
                <h5><?php echo getForm2Details()["products_supplied"]; ?></h5>
            </div>
        </div>

        <div style="float:right">
        </div>
        <div style="clear:both"></div>
        <div align="center">
            <button class="btn btn-danger" data-toggle="pill" href="#v-pills-1">
                <i class="fa fa-caret-left"></i>Previous
            </button>
            <button class="btn btn-success" data-toggle="pill" href="#v-pills-3">
                Next<i class="fa fa-caret-right"></i>
            </button>
        </div>
    </form>