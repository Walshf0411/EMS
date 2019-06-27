<?php require('../utils/form_logo_details.php'); ?>
<?php 
    require_once('../utils/globals.php');
    if(DEBUG) {
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getForm3Details(){
        $details = array();
        global $conn;
        $query = "SELECT * from exhibitor_stall_personnel where exhibitor_id = ".$_GET["id"];
        $queryResult = executeQuery($conn,$query);
        $count = $queryResult-> num_rows;
        while($count >0){
            $details[] = $queryResult->fetch_assoc();
            $count -= 1;
        }
        return $details;
    }
?>

<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
                <tr style="background-color:rgb(193, 13, 109);color:white;">
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

<h5>Your Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>

<span id="staff-personnel-form-error" class="text-danger" style="display:none">Kindly fill in all the details. If you think this is a mistake, press Next</span><br>
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
<div class="table-input">
    <div class="row" id="header">
        <div class="col-md-2 col-sm-11 col-sm-offset-1">Sr.No.</div>
        <div class="col-md-6 col-sm-11 col-sm-offset-1">Name of the stall Personnel</div>
        <div class="col-md-4 col-sm-11 col-sm-offset-1">Designation</div>
    </div>

    <?php 
        $i=0;
        foreach (getForm3Details() as $row) {    
            echo "<div class=row>
            <div class='col-md-2 col-sm-11 col-sm-offset-1'>".$row["id"]."</div>
            <div class='col-md-6 col-sm-11 col-sm-offset-1' >".$row["stall_personnel_name"]."</div>
            <div class='col-md-4 col-sm-11 col-sm-offset-1'>".$row["designation"]."</div>
            </div>
            ";
            $i += 1;
        }
    ?>
</div>
</form>
<div style="float:right; margin-bottom:1%;">
    <strong><?php echo "CONTACT PERSON: ".getForm1Details()["contact_person"] ?><br></strong>
    <strong><?php echo "CONTACT NUMBER: ".getForm1Details()["phone_number"];?></strong>
</div>
<div style="clear:both;"></div>
<div align=center>
    <button class="btn btn-success">
        Verify
    </button>
</div>
