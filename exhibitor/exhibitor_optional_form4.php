 <?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getDetails(){
        global $conn;

        $query = "Select * from advertising_in_fair_catalogue";
        $queryResult = executeQuery($conn,$query);

        $advertising_in_fair_catalogue = array();
        while($row = $queryResult->fetch_assoc()){
            $advertising_in_fair_catalogue[]= $row;
        }

        return $advertising_in_fair_catalogue;
    }
 ?>   
    <?php include("../utils/form_logo_details.php");?>
    <div class="col-md-12 col-sm-12">
        <p class="table">
            <table style="width:100%;">
                <tr>
                    <th>FORM 4</th>
                    <th>ADVERTISING IN FAIR CATALOGUE</th>
                    <th>OPTIONAL</th>
                </tr>
                <tr>
                    <td colspan="3">Submission Date - 8th June 2019 </td>
                </tr>
            </table>
        </p>
    </div>

    <p>
        <strong>ADVERTISING IN FAIR CATALOGUE</strong>
        Advertise in the Fair Catalogue and gain maximum advantage of your participation in Super Juniorz.
        Advertising in the Fair Catalogue is cost effective and will be retained by the trade visitors as a sourcing referencer.
    </p>

    <p>
        <strong>Advertising rates: </strong>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="col-md-12">
                    <table style="width:100%;">
                        <tr style="background-color:rgb(193, 13, 109);color:white;">
                            <th>Position</th>
                            <th>Rate(Rs.)</th>
                        </tr>
                        <?php
                            foreach (getDetails() as $row) {
                                if($row["id"] <= 5){
                                    echo "
                                        <tr>
                                            <td>".$row["position"]."</td>
                                            <td>".$row["rate"]."</td>
                                        </tr>
                                    ";
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="col-md-11">
                    <table style="width:100%;">
                        <tr style="background-color:rgb(193, 13, 109);color:white;">
                            <th>Position</th>
                            <th>Rate(Rs.)</th>
                        </tr>
                        <?php
                            foreach (getDetails() as $row) {
                                if($row["id"] > 5){
                                    echo "
                                        <tr>
                                            <td>".$row["position"]."</td>
                                            <td>".$row["rate"]."</td>
                                        </tr>
                                    ";
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </p>

    <pre>
<strong>Full page size (Techinical Specifications) :</strong>
• Trim Size: 125mm X 215mm
• Bleed: 150mm X 210mm
• Non-bleed: 140mm X 200mm
• Require Bleed margin of 5mm on all side of the page.
    </pre>

    <p>
        <strong>Format :</strong>
        <p>Files must be provided to us in the following format(s): EPS | CDR | PSD | PDF
        ------------------------------------------------------------------------------------------------------------------------------------------------------------ 
        I would wish to place an Advertisement in the Fair Catalogue</p>
        <label for="Position">Position </label>
        <select name="position" id="">
            <?php
                foreach (getDetails() as $row) {
                    echo "
                    <option value =".$row["id"].">".$row["position"]."</option>
                    ";
                }
            ?>
        </select>
    </p>

    <pre>
<strong>FOR ADVERTISEMENT QUERY:</strong>
<strong>CONTACT:</strong> Farheen Khan
            +91 80808 99927
            farheen.khan@peppermint.co.in
    </pre>

    <pre>
<strong>IMPORTANT:</strong>
1. Please provide ‘open files’ along with the fonts used in the advertisement
2. Provide us the Advertisement material on CD
3. All materials and payment must reach us on or before 8th June 2019.
    </pre>
<div style="float:right">
    <?php include("../utils/exhibitor_footer.php");?>
</div>
<div style="clear:both;"></div>