<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else{
        require_once('../utils/superz_connect.php');
    }

    function getSubmittedForms(){
        global $conn;
        $query = "SELECT * from exhibitor_forms_submitted ;";
        $queryResult = executeQuery($conn,$query);
        $exhibitors = array();
        foreach ($queryResult as $row) {
            $exhibitors[$row["exhibitor_id"]] = $row;
        }
        return $exhibitors;
    }
?>

<div class="col-lg-12">
    <h5>List of submitted forms</h5>
    <table class="table table-bordered ">
        <tr>
            <th rowspan="2">Booth Number</th>
            <th rowspan="2">Exhibitor</th>
            <th rowspan="2">Mandatory Forms</th>
            <th colspan="4">Optional Forms</th>
        </tr>
        <tr>
            <td>form 4</td>
            <td>form 5</td>
            <td>form 6</td>
            <td>form 7 & 8</td>
        </tr>
        <?php
            $exhibitors = getSubmittedForms();
            foreach ($exhibitors as $row) {
                echo "<tr>
                    <td>".$row["booth_number"]."</td>
                    <td><a href='./submitted_form.php?id=".$row["exhibitor_id"]."'>".$row["participant_name"]."</a></td>";
                $forms=["mandatory_forms", "optional_form4", "optional_form5", "optional_form6", "optional_form7"];
                foreach ($forms as $form) {
                    if ($row[$form] == 1){
                        echo "<td><i class='fas fa-check' style='color:green;'></i></td>";
                    } else {
                        echo "<td><i class='fas fa-times' style='color:red;'></i></td>";
                    }
                }
                echo "</tr>";
            }
        ?>
    </table>
</div>