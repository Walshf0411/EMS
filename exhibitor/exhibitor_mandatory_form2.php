    <?php require('../utils/form_logo_details.php'); ?>
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
    
    <p id="booth">
        <label for="Booth number">Booth number:</label>
        <input oninput="this.className = ''" name="booth_number">
    </p>
    
    <form action=""> 
        <div class="form-group">
            <label for="company-name">Company name:</label>
            <input name ="company-name" class="form-control">
        </div>
        <div class="col-md-12 col-sm-12">
            <label for="address">Company address:</label>
            <input class="form-control" name="address">
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <label for="isd code">Telephone ISD code:</label>
                <input name="isd_code" class="form-control">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="std code">STD code:</label>
                <input name="std_code" class="form-control">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="phone">Phone number:</label>
                <input name="phone" class="form-control">
            </div>
        </div>
        <div class="row">    
            <div class="col-md-4 col-sm-12">
                <label for="isd code">Fax ISD code:</label>
                <input oninput="this.className = ''" name="f_isd_code"class="data-input">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="std code">STD code:</label>
                <input oninput="this.className = ''" name="f_std_code"class="data-input">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="phone number">phone no.</label>
                <input oninput="this.className = ''" name="f_isd_code"class="data-input">
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="isd code">Mobile ISD code:</label>
            <input oninput="this.className = ''" name="m_isd_code"class="data-input">
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="std code">STD code:</label>
            <input oninput="this.className = ''" name="m_std_code"class="data-input">
        </div>
        <div class="col-md-8 col-sm-12">
            <label for="email">Email:</label>
            <input oninput="this.className = ''" name="email"class="data-input">
        </div>
        <div class="col-md-8 col-sm-12">
            <label for="website">Website:</label>
            <input oninput="this.className = ''" name="website"class="data-input">
        </div>
        <div class="col-md-8 col-sm-12">
            <label for="person">Contact Person:</label>
            <input oninput="this.className = ''" name="person"class="data-input">
        </div>
        <div class="col-md-8 col-sm-12">
            <label for="designation">Designation:</label>
            <input oninput="this.className = ''" name="designation"class="data-input">
        </div>
        <div class="col-md-12 col-sm-12">
            <label for="profile">Company profile:(not more than 100 words)</label>
            <input oninput="this.className = ''" name="profile"class="data-input">
        </div>
        <div class="col-md-12 col-sm-12">
            <label for="products">Products supplied / manufactured:</label>
            <input oninput="this.className = ''" name="products"class="data-input">
        </div>
    </form>

    <p>
        <pre><strong>IMPORTANT:</strong> Please provide your company logo in either EPS, CDR, PDF or PSD format.
        (You can alternatively email us the logo and company profile on superjuniorzexpo@gmail.com)</pre>
    </p>