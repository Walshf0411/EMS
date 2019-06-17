    <?php require('../utils/form_logo_details.php'); ?>
    <div class="col-md-12 col-sm-12">
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
    
    <form action="" id="fair-listing"> 
        <div class="form-group">
            <label for="company-name">Company name:</label>
            <input name ="company-name" class="form-control required">
        </div>
        <div class="form-group">
            <label for="address">Company address:</label>
            <input class="form-control required" name="address">
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="isd code">Telephone ISD code:</label>
                <input name="isd_code" class="form-control required">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="std code">STD code:</label>
                <input name="std_code" class="form-control required">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="phone">Phone number:</label>
                <input name="phone" class="form-control required">
            </div>
        </div>
        <div class="row">    
            <div class="col-md-4 col-sm-12">
                <label for="isd code">Fax ISD code:</label>
                <input name="f_isd_code" class="form-control required">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="std code">STD code:</label>
                <input name="f_std_code" class="form-control required">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="phone number">phone no.</label>
                <input name="f_isd_code" class="form-control required">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="isd code">Mobile ISD code:</label>
                <input name="m_isd_code" class="form-control required">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="std code">STD code:</label>
                <input name="m_std_code" class="form-control required">
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input name="email" class="form-control required email">
        </div>
        <div class="form-group">
            <label for="website">Website:</label>
            <input name="website" class="form-control required">
        </div>
        <div class="form-group">
            <label for="person">Contact Person:</label>
            <input name="person" class="form-control required">
        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <input name="designation" class="form-control required">
        </div>
        <div class="form-group">
            <label for="profile">Company profile:(not more than 100 words)</label>
            <textarea name="profile" class="form-control required" maxlength="100"></textarea>
        </div>
        <div class="form-group">
            <label for="products">Products supplied / manufactured:</label>
            <textarea name="products" class="form-control required"></textarea>
        </div>

        <div class="form-group">
            <label for="company-logo">Company Logo</label>
            <input type=file name="company-logo" class="form-control required">
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
            <button class="btn btn-success" data-toggle="pill" href="#v-pills-6">
                Next<i class="fa fa-caret-right"></i>
            </button>
        </div>
    </form>

    <script>
        $("#fair-listing").validate();
    </script>