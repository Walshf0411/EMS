    <?php
        require_once('../utils/globals.php');
        if(DEBUG){
            require_once('../utils/local_connect.php');
        } else {
            require_once('../utils/superz_connect.php');
        }
        function getAdvertisingList() {
            global $conn;
            $query = "SELECT * from advertising_in_fair_catalogue";
            $queryResult = executeQuery($conn, $query);
            $advertisingList = array();
            foreach ($queryResult->fetch_assoc() as $row) {
                $advertisingList[] = $row ;
            }
            return $advertisingList;
        }

        function getUserAdvertisements(){
            global $conn;
            $advertisingList = getAdvertisingList();
            $query = "SELECT * FROM optional_form_advertising" ;
            $queryResult = executeQuery($conn, $query);
            $userAdvertisements = array();
            foreach ($queryResult as $row) {
                $query = "SELECT position,rate from advertising_in_fair_catalogue where id = ".$row["position"];
                $result = executeQuery($conn,$query);
                $userAdvertisements[] = $result ->fetch_assoc();
            }
            return $userAdvertisements;
        }
    ?>   
    <?php include("../utils/form_logo_details.php");?>

    <div class="col-md-12 col-sm-12">
        <p class="table">
            <table style="width:100%;">
                <tr style="background-color:rgb(193, 13, 109);color:white;">
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

    <div style="margin-left: 1%;">
        <h5>Your Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>
    </div>

    <div>
        <strong>SUBMITTED RATES</strong>
        <table class="table">
            <tr style="background-color:rgb(193, 13, 109);color:white">
                <th>
                    Position
                </th>
                <th>
                    Rate
                </th>
            </tr>
            <?php
                $userAdvertisements = getUserAdvertisements();
                echo "<tr>";
                $rate = 0;
                foreach ($userAdvertisements as $row) {
                    echo "<td>".$row["position"]."</td>";
                    echo "<td>".$row["rate"]."</td>";
                    echo "</tr>";
                    $rate +=(int)$row["rate"];
                }

                echo "<tr>
                    <td colspan ='2' align='right'><strong>Sub Total : Rs.".$rate."</strong></td>;
                </tr>"
            ?>
            
        </table>
    </div>

    <div>
        <strong>Full page size (Techinical Specifications) :</strong>
        <ul>
            <li>Trim Size: 125mm X 215mm</li>
            <li>Bleed: 150mm X 210mm</li>
            <li>Non-bleed: 140mm X 200mm</li>
            <li>Require Bleed margin of 5mm on all side of the page.</li>
        </ul>
    </div>
    
    
    <div style="float:right">
        <strong><?php echo "CONTACT PERSON: ".getForm1Details()["contact_person"] ?><br></strong>
        <strong><?php echo "CONTACT NUMBER: ".getForm1Details()["phone_number"];?></strong>
    </div>
    <div style="clear:both"></div>

    <div align=center>
        <button class="btn btn-success" id="review_optional_form4">
            Verify<i class="fas fa-paper-plane"></i>
        </button>
    </div>
