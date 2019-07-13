<div align=center>
    <h5>Edit Exhibitor Information</h5>
</div>
<?php 
    require_once('../utils/globals.php');
    if (DEBUG){
        require('../utils/local_connect.php');
    } else {
        require('../utils/superz_connect.php');
    }
    
    $query = "Select * from exhibitor where id = ".$_SESSION["user_id"];
    $queryResult = executeQuery($conn,$query);
    $company_name_edit = $email = $contact_person_edit = $contact_number_edit = $brand_name_edit = "" ;

    if($queryResult && $queryResult->num_rows == 1){
        $user = $queryResult->fetch_assoc();
        $company_name_edit = $user["participant_name"];
        $email = $user["email"];
        $contact_person_edit = $user["contact_person"];
        $contact_number_edit = $user["phone_number"];
        $brand_name_edit = $user["brands"];
        $brandsArray = explode(",", $brand_name_edit);
    }
?>
<div>
    <form action="#" method="post" id="edit_exhibitor_information_form">
        <div class="form-group">
            <strong><label for="company_name_edit">Company Name:</label></strong>
            <input type="text" name="company_name_edit" class="form-control required" value="<?php echo($company_name_edit); ?>" >
        </div>
        <div class="form-group">
            <strong><label for="email_edit">Email: </label></strong>
            <input type="email" name="email_edit" class="form-control required email" value ="<?php echo($email); ?>">
        </div>
        <div class="form-group">
            <strong><label for="contact_person_edit">Contact person:</label></strong>
            <input type="text" name="contact_person_edit" class="form-control required" value="<?php echo($contact_person_edit); ?>">
        </div>
        <div class="form-group">
            <strong><label for="contact_number_edit">Contact Number: </label></strong>
            <input type="text" name="contact_number_edit" class="form-control required" value ="<?php echo($contact_number_edit) ?>" >
        </div>
        <div class="form-group">
            <strong><label for="brand_name_edit">Brands supplied:</label></strong>
            <div class="row">
                <div class="col-md">
                    <input type="text" name="brand_name1" class="form-control required" placeholder="Brand 1" required value="<?php if(isset($brandsArray[0])) echo trim($brandsArray[0])?>">
                </div>
                <div class="col-md">
                    <input type="text" name="brand_name2" class="form-control" placeholder="Brand 2" value="<?php if(isset($brandsArray[1])) echo trim($brandsArray[1])?>">
                </div>
                <div class="col-md">
                    <input type="text" name="brand_name3" class="form-control" placeholder="Brand 3" value="<?php if(isset($brandsArray[2])) echo trim($brandsArray[2])?>">
                </div>
                <div class="col-md">
                    <input type="text" name="brand_name4" class="form-control" placeholder="Brand 4" value="<?php if(isset($brandsArray[3])) echo trim($brandsArray[3])?>">
                </div>
                <div class="col-md">
                    <input type="text" name="brand_name5" class="form-control" placeholder="Brand 5" value="<?php if(isset($brandsArray[4])) echo trim($brandsArray[4])?>">
                </div>
            </div>
            <small id="passwordHelpBlock" class="form-text text-muted">
            Enter minimum 1 and maximum of 5 brands supplied.   
            </small>
        </div>
        <div class="alert alert-danger">
            <strong>Caution!: </strong>Carefully check all the fields before you press the edit button
        </div>
        <button class="btn btn-info" name="edit"><i class="fa fa-pen"></i>Edit Information</button>
    </form>
</div>
<script>
    $("#edit_exhibitor_information_form").validate();
</script>
<?php 
    $flag = 0;
    
    if (isset($_POST["edit"])){
        $brands = "";
        for ($i = 1; $i <=5 ; $i++) {
            
            if (isset($_POST['brand_name' . $i]) && $_POST['brand_name' . $i] !== ''){
                $brand = trim($_POST['brand_name' . $i]) . ", ";
                $brands .= $brand;
            }
        }
        $brands = substr($brands, 0, -2);
        if (strcmp($_POST["company_name_edit"], $company_name_edit) !== 0){
            $flag = $flag + 1;
            $company_name_edit = $_POST["company_name_edit"];
        } if (strcmp($_POST["email_edit"], $email) !== 0) {
            $flag = $flag + 1;
            $email = $_POST["email"];
        } if(strcmp($_POST["contact_person_edit"], $contact_person_edit) !== 0){
            $flag = $flag + 1;
            $contact_person_edit = $_POST["contact_person_edit"];
        } if (strcmp($_POST["contact_number_edit"], $contact_number_edit) !== 0) {
            $flag = $flag + 1;
            $contact_number_edit = $_POST["contact_number_edit"];
        } if (strcmp($brands, $brand_name_edit) !== 0) {
            $flag = $flag + 1;
            $brand_name_edit = $brands;
        }
        $query = "UPDATE exhibitor SET email = '".$email."',participant_name = '" .$company_name_edit."',contact_person = '".$contact_person_edit."', phone_number = '".$contact_number_edit."',brands = '".$brands."'  WHERE id = ".$_SESSION["user_id"].";";

        $queryResult = executeQuery($conn,$query);
        if ($queryResult){
            notify("Fields updated successfully" ,"success");
        }
    }
?>