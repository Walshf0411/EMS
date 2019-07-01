<?php
    require_once('../utils/globals.php');
    if(DEBUG) {
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getForm1Details(){
        global $conn;
        $id =$_GET["id"];
        $query = "SELECT booth_number, participant_name, phone_number, contact_person, email from exhibitor where id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $details = $queryResult->fetch_assoc();
        return $details;
    }
    function getFasciaName() {
        global $conn;
        $id = $_GET['id'];
        $query = "SELECT * from fascia_names where exhibitor_id=".$id;
        $queryResult = executeQuery($conn, $query);
        return $queryResult->fetch_assoc()['fascia_name'];
    }
?>
<style>
    table, tr, td, th{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 1%;    
}
#end {
    margin-bottom: 1%;
}
</style>
<?php require('../utils/form_logo_details.php'); ?>
<div class="col-md-12 col-sm-12">
    <p class="table table-bordered">
        <table style="width:100%;">
            <tr style="background-color:rgb(193, 13, 109);color:white;">
                <th>FORM 1</th>
                <th>STANDARD SHELL SCHEME PACKAGE</th>
                <th>MANDATORY</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 5th June 2019 </td>
            </tr>
        </table>
    </p>
</div>        
<!-- Display booth number -->
<div style="margin-left: 1%;">
    <h5>Exhibitor Booth number: <?php echo getForm1Details()["booth_number"];?></h5>
</div>

<p id="fascia-name">
    Please enter below the Exhibitor’s name as you require on the fascia. This will be provided in upper case, standard English alphabets (Maximum 24 letters) cut in white vinyl and pasted on Name fascia.
</p>

<p>
    <p id="use-bold">PLEASE USE BOLD LETTERS</p>
    <ol id="list1">
        <li>
            <label for="fasica_name"></label>FASCIA NAME (As it should appear on your stall)</label>
            <!-- Display name --> 
            <h5><?php echo getFasciaName(); ?></h5>
        </li>
        <li>
            SHELL SCHEME PACKAGE
            <p>Shell Scheme package includes partition walls on maximum 3 sides, needle punch carpet, name fascia with basic furniture and fittings.
            <i class="fa fa-info-circle fa-2x id-icon" data-toggle="tooltip" data-placement="top" title="Click Here To view Standard booth layout and stall amenties"></i></p>
        </li>
        <li>
            DRAWINGS / DIAGRAMS
            <p>The perspective of the Standard Shell Scheme Stall is shown on the Application Form.
            <i class="fa fa-info-circle fa-2x id-icon" data-toggle="tooltip" data-placement="top" title="Click Here To view Standard booth layout and stall amenties"></i></p>
        </li>
    </ol>
</p>

<div style="clear:both;"></div>

<div align="center">
    <button id="review_form1" class="btn btn-success" data-toggle="pill" href="#v-pills-2">
        <i class="fa fa-caret-right"></i>Next
    </button>
</div>

<button type="button" id="std-booth-layout-modal-toggler" class="btn btn-primary" data-toggle="modal" data-target="#imageModal" style="display:none;">
    Open modal
</button>

<div class="modal fade" id="imageModal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="row">
                <div class="offset-sm-10"></div>
                <div class="col-sm-1">
                    <button type="button" class="close" data-dismiss="modal" style="float:right">&times;</button>
                </div>
                <div class="col-sm-1"></div>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container" align=center>
                    <div class="offset-sm-4"></div>
                    <div class="col-sm-4 colored-header">
                        STANDARD BOOTH LAYOUT
                    </div>
                    <div class="offset-sm-4"></div>
                </div>
                <div class="container" align=center>
                    <strong>STALL AMENITIES</strong><br>
                
                    <img src="../images/standard_booth_layout1.jpg" alt="standard layout 1">
                    <img src="../images/standard_booth_layout2.jpg" alt="standard layout 1">
                </div>
            </div>
        
        </div>
    </div>
</div>

<script>
    function standardBoothLayoutInfoButtonClicked() {
        $("#std-booth-layout-modal-toggler").click();
    }
    $(document).ready(function () {
        $(".id-icon").attr('onclick', "standardBoothLayoutInfoButtonClicked()");
        $("#fascia_name").attr("oninput", "onInputFascia()");
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>