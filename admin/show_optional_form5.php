<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else {
        require_once('../utils/superz_connect.php');
    }
    function getServices($id) {
        global $conn;
        $query = "SELECT * from other_services where id = ".$id;
        $queryResult = executeQuery($conn,$query);
        $servicesList = $queryResult->fetch_assoc();
        
        return $servicesList;
    }
    function getUserServices() {
        global $conn;
        $query = "SELECT * from optional_other_services where exhibitor_id = ".$_GET["id"];
        $result = executeQuery($conn, $query);
        $userServices = array();
        $servicesList = array();
        foreach ($result as $row) {
            $servicesList = getServices($row["item_id"]);
            $row["amount"] = $servicesList['amount'];
            $row["item_description"] = $servicesList['item_description'];
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
    <table class="table " style="width:100%;">
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
            $count = 1;
            $subTotal = 0;
            foreach ($userServices as $row) {
                $total = $row["amount"] * $row['quantity'];
                $subTotal += $total;
                echo "<tr>
                <td>".$count."</td>
                <td>".$row["item_description"]."</td>
                <td>".$row["amount"]."</td>
                <td>".$row["quantity"]."</td>
                <td>".$total."</td>
                </tr>
                ";
                $count += 1;
            }
            
        ?>
        <tr>
            <td colspan=5>
                <div style="float:right;">
                    <strong>Total (Rs.) </strong>
                    <span><?php
                        echo $subTotal; 
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
                        $gstTotal = ceil($subTotal * 0.18);
                        echo $gstTotal; 
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
                        echo $subTotal + $gstTotal; 
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
    <form action="submitted_form.php?id=<?php echo $_GET["id"]; ?>" method="POST">
        <button class="btn btn-success" name="verify_form5">
            Verify&nbsp;<i class="fas fa-check"></i>
        </button>
    </form>
</div>
<?php
    if(isset($_POST["verify_form5"])){
        global $conn;
        $checkQuery = "SELECT * FROM exhibitor_forms_submitted WHERE exhibitor_id=".$_GET['id'];
        $checkQueryResults = executeQuery($conn, $checkQuery);
        if ($checkQueryResults->fetch_assoc()['optional_form5'] == 2) {
            notify("You have already reviewed Optional form 5.", "warn");
        } else {
            $setQuery = "UPDATE exhibitor_forms_submitted SET optional_form5 = 2 where exhibitor_id = ".$_GET["id"];
            $queryResult = executeQuery($conn,$setQuery);
            if($queryResult) {
                notify("You have successfully reviewed Optional form 5.", "success");
            } else {
                notify("Form Review failed: Optional form 5.", "error");
            }
        }
        
    }
?>