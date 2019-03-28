<form action="<?= base_url() ?>Enquires/contactInsert" method="POST" id="contact_form" name="contact_form">
  <fieldset>
    <legend>Contact Us</legend>
   
   <div class="form-group">
      <label for="cfName">Name</label>
      <input class="form-control" name="cfName" id="cfName" aria-describedby="cfNameHelp" placeholder="Enter Name" type="text">
      <small id="cfNameHelp" class="form-text text-muted error" style="color:red;"><?= form_error("cfName") ?> </small>
    </div>
    <div class="form-group">
      <label for="cfEmail">Email</label>
      <input class="form-control" name="cfEmail" id="cfEmail" aria-describedby="cfEmailHelp" placeholder="Enter email" type="email">
      <small id="cfEmailHelp" class="form-text text-muted" style="color:red;"><?= form_error("cfEmail") ?> </small>
    </div>
    <div class="form-group">
      <label for="cfPhone">Phone Number</label>
      <input class="form-control" name="cfPhone" id="cfPhone" aria-describedby="cfPhoneHelp" placeholder="Enter Phone Number" type="text">
      <small id="cfPhoneHelp" class="form-text text-muted" style="color:red;"><?= form_error("cfPhone") ?> </small>
    </div>
    <div class="form-group">
      <label for="cfMsg">Messege</label>
      <textarea class="form-control" name="cfMsg" id="cfMsg" rows="3"></textarea>
    </div>
    <div class="form-check disabled">
       <label class="form-check-label">
         <input class="form-check-input" name="terms" id="terms"  type="checkbox">
                        <a href="#">Agree Terms & Conditions</a> 
          </label>      <small id="cfPhoneHelp" class="form-text text-muted" style="color:red;"><?= form_error("terms") ?> </small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>