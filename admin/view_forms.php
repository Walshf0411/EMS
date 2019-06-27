<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else{
        require_once('../utils/superz_connect.php');
    }

    function getSubmittedForms(){
        global $conn;
        $query = "SELECT id from exhibitor ;";
        $queryResult = executeQuery($conn,$query);

        $exhibitor_id = array();
        if ($queryResult && $queryResult-> num_rows>=1){
            foreach ($queryResult->fetch_assoc() as $row) {
                $exhibitor_id[$row] = array();
                echo "<script> alert('".$exhibitor_id."') </script>;";
            }
        }
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
            foreach (getSubmittedForms() as $row) {
                echo "
                    <tr>
                        <td>".$row["booth_number"]."</td>
                        <td><a href='./submitted_form.php'>".$row["participant_name"]."</td>
                        <td>4</td>
                ";

                echo "</tr>";
            }
        ?>
    </table>
</div>