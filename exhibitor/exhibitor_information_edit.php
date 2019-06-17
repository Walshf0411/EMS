<div align=center>
    <h5>Edit Exhibitor Information</h5>
</div>
<?php 
    require('../utils/globals.php');
    if (DEBUG){
        require('../utils/local_connect.php');
    } else {
        require('../utills/superz_connect.php');
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
            <strong><label for="brand_name_edit">Brand Name:</label></strong>
            <textarea name="brand_name_edit" class="form-control required"><?php echo($brand_name_edit); ?></textarea>
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
    $flag=0;
    if (isset($_POST["edit"])){
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
        } if (strcmp($_POST["brand_name_edit"], $brand_name_edit) !== 0) {
            $flag = $flag + 1;
            $brand_name_edit = $_POST["brand_name_edit"];
        }
        $query = "UPDATE exhibitor SET email = '".$email."',participant_name = '" .$company_name_edit."',contact_person = '".$contact_person_edit."', phone_number = '".$contact_number_edit."',brands = '".$brand_name_edit."'  WHERE id = ".$_SESSION["user_id"].";";

        $queryResult = executeQuery($conn,$query);
        if ($queryResult){
            notify("Fields updated successfully" ,"success");
        }
    }
?>