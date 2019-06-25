<?php
    require_once('../utils/globals.php');
    if(DEBUG){
        require_once('../utils/local_connect.php');
    } else{
        require_once('../utils/superz_connect.php');
    }

    function getSubmittedForms(){
        global $conn;

        $query = "select distinct exhibitor.id,booth_number,participant_name
        from exhibitor
        inner join fascia_names as names on exhibitor.id =names.exhibitor_id
        inner JOIN fair_catalogue_listing as listing 
        on exhibitor.id=listing.exhibitor_id 
        inner join exhibitor_stall_personnel as stalls 
        on exhibitor.id = stalls.exhibitor_id;
        ";
        
        $queryResult = executeQuery($conn,$query);
        $count = $queryResult -> num_rows;
        
        $exhibitors = array();

        while ($row = $queryResult-> fetch_assoc()){   
            $exhibitors[] = $row;
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
<!-- 
    
    <a class="nav-link" id="v-pills-tab5" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-settings" aria-selected="false">Form 1</a>
    <a class="nav-link" id="v-pills-tab6" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-settings" aria-selected="false">Form 2</a>
    <a class="nav-link" id="v-pills-tab7" data-toggle="pill" href="#v-pills-7" role="tab" aria-controls="v-pills-settings" aria-selected="false">Form 3</a>
    <a class="nav-link" id="v-pills-tab8" data-toggle="pill" href="#v-pills-8" role="tab" aria-controls="v-pills-settings" aria-selected="false">Form 4</a>
    <a class="nav-link" id="v-pills-tab9" data-toggle="pill" href="#v-pills-9" role="tab" aria-controls="v-pills-settings" aria-selected="false">Form 5</a>
    <a class="nav-link" id="v-pills-tab10" data-toggle="pill" href="#v-pills-10" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-key"></i>Change Password</a>
    <a class="nav-link" id="v-pills-tab11" data-toggle="pill" href="#v-pills-11" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-key"></i>Change Password</a>
                    
-->