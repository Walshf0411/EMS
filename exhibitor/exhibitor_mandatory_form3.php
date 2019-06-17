<?php require('../utils/form_logo_details.php'); ?>

<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr style="background-color:rgb(193, 13, 109);">
                <th>FORM 3</th>
                <th>REGISTRATION OF EXHIBITION PERSONNEL FOR BADGES</th>
                <th>MANDATORY</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 5th June 2019 </td>
            </tr>
        </table>
    </p>    
</div>
<?php include("../utils/booth_number_header.php");?>
<p>
    <ol>
        <strong>THIS FORM MUST BE COMPLETED AND RETURNED BY EVERY EXHIBITOR</strong>
        <li><strong>1. APPLICATION :</strong>
        Please use this Form to apply for your stall personnel badges before 15th May 2019</li>
        <li><strong>2. PREPARATION OF EXHIBITORS’ BADGES :</strong>
        To avoid errors in the preparation of badges, Exhibitors are requested to TYPE all names in BLOCK LETTERS</li>
        <li><strong>3. COLLECTION OF BADGES :</strong>
        Badges can be collected from the Organiser’s Site Office in the Hall while taking possession of their stalls.</li>
        <li><strong>4. 2 Badges per 6 sq. m. of booth and in multiple there off.</strong></li>
        <li><strong>5. BADGES :</strong>
        Kindly issue the Exhibitors’ badges for following stall personnel</li>
    </ol>
</p>
<?php include("../utils/booth_number_header.php");?>

<div class="table-input">
    <div class="row" id="header">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">Sr.No.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1">Name of the stall Personnel</div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1">Designation</div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">1.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_1"></div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_1_designation"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">2.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_2"></div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_2_designation"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">3.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_3"></div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_3_designation"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">4.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_4"></div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_4_designation"></div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">5.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_5"></div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1" style="width:100%;"><input oninput="this.className = ''" name="stall_personnel_5_designation"></div>
    </div>
</div>
<div style="float:right;">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both;"></div>
<div align=center>
    <button class="btn btn-danger" data-toggle="pill" href="#v-pills-5">
        <i class="fa fa-caret-left"></i>Previous
    </button>

    <button class="btn btn-success" data-toggle="pill" href="#v-pills-7">
        Next<i class="fa fa-caret-right"></i>
    </button>
</div>