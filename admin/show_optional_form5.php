<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getServices($id) {
        global $conn;
        $query = "SELECT amount from other_services where id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $servicesList = $queryResult->fetch_assoc();
        
        return $servicesList["amount"];
    }
    function getUserServices() {
        global $conn;
        $query = "SELECT * from optional_other_services where exhibitor_id = ".$_GET["id"];
        $result = executeQuery($conn, $query);
        $userServices = array();
        $servicesList = array();
        foreach ($result as $row) {
            $servicesList = getServices($row["item_id"]);
            $row["amount"]=$servicesList;
            $userServices[] = $row;
        }
        return $userServices;
        
    }
?>

<?php require('../utils/form_logo_details.php'); ?>

<div class="col-md-12 col-sm-12">
    <p class="table">
        <table style="width:100%;">
            <tr style="background-color:rgb(193, 13, 109);color:white;">
                <th>FORM 5</th>
                <th>OTHER SERVICES</th>
                <th>OPTIONAL</th>
            </tr>
            <tr>
                <td colspan="3">Submission Date - 5th June 2019 </td>
            </tr>
        </table>
    </p>
</div>

<div style="margin-left: 1%;">
    <h5>Your Booth Number: <?php echo getForm1Details()["booth_number"]; ?></h5>
</div>

<div class="table-wrapper">
    <table class="table table-bordered" style="width:100%;">
        <tr style="background-color:rgb(193, 13, 109);color:white;">
            <th>No.</th>
            <th>Item Description</th>
            <th>Amount(INR)</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
            function getTotal() {
                $total = 0;
                $userServices = getUserServices();
                foreach ($userServices as $row) {
                    $total += (int)$row["total"]; 
                }
                return $total;
            }
            
            $userServices = getUserServices();
            foreach ($userServices as $row) {
                echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["item_description"]."</td>
                <td>".$row["amount"]."</td>
                <td>".$row["quantity"]."</td>
                <td>".$row["total"]."</td>
                </tr>
                ";
            }
            
        ?>
        <tr>
            <td colspan=5>
                <div style="float:right;">
                    <strong>Total (Rs.) </strong>
                    <span><?php
                        echo getTotal(); 
                    ?></span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=5>
                <div style = "float:right;">
                    <strong>GST Total (Rs.) </strong>
                    <span>
                        <?php 
                        echo getTotal()*0.18; 
                        ?>
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan=5>
                <div style = "float:right;">
                    <strong>Grand Total (Rs.) </strong>
                    <span>
                        <?php 
                        echo getTotal() + getTotal()*0.18; 
                        ?>
                    </span>
                </div>
            </td>
        </tr>
    </table>
</div>

<div style="float:right">
    <!-- Insert contact details -->
    <strong><?php echo "CONTACT PERSON: ".getForm1Details()["contact_person"] ?><br></strong>
    <strong><?php echo "CONTACT NUMBER: ".getForm1Details()["phone_number"];?></strong>
</div>
<div style="clear:both"></div>

<div align=center>
    <button class="btn btn-success" id="review_form_5">
        Verify<i class="fas fa-paper-plane"></i>
    </button>
</div>
