<div align=center>
    <h5>Edit Exhibitor Information</h5>
</div>
<div>
    <form action="#" id="edit_exhibitor_information_form">
        <div class="form-group">
            <strong><label for="company_name_edit">Company Name:</label></strong>
            <input type="text" name="company_name_edit" class="form-control required">
        </div>
        <div class="form-group">
            <strong><label for="email_edit">Email: </label></strong>
            <input type="email" name="email_edit" class="form-control required email">
        </div>
        <div class="form-group">
            <strong><label for="contact_person_edit">Contact person:</label></strong>
            <input type="text" name="contact_person_edit" class="form-control required">
        </div>
        <div class="form-group">
            <strong><label for="contact_number_edit">Contact Number: </label></strong>
            <input type="text" name="contact_number_edit" class="form-control required">
        </div>
        <div class="form-group">
            <strong><label for="brand_name_edit">Brand Name:</label></strong>
            <textarea name="brand_name_edit" class="form-control required"></textarea>
        </div>
        <div class="alert alert-danger">
            <strong>Caution!: </strong>Carefully check all the fields before you press the edit button
        </div>
        <button class="btn btn-info"><i class="fa fa-pen"></i>Edit Information</button>
    </form>
</div>
<script>
    $("#edit_exhibitor_information_form").validate();
</script>