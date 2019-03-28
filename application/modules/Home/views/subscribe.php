<form action="<?= base_url() ?>Subscriptions/subscriptionInsert" method="POST" id="subscribe_form" name="subscribe_form">
  <fieldset>
    <legend>Subscribe</legend>
   
    <div class="form-group">
      <label for="scName">Name</label>
      <input class="form-control" name="scName" id="scName" aria-describedby="scNameHelp" placeholder="Enter Name" type="text">
      <small id="scNameHelp" class="form-text text-muted error" style="color:red;"><?= form_error("scName") ?> </small>
    </div>

    <div class="form-group">
      <label for="Email">Email</label>
      <input class="form-control" name="Email" id="Email" aria-describedby="EmailHelp" placeholder="Enter email" type="email">
      <small id="EmailHelp" class="form-text text-muted" style="color:red;"><?= form_error("Email") ?> </small>
    </div>

    <div class="form-check disabled">
       <label class="form-check-label">
         <input class="form-check-input" name="terms" id="terms"  type="checkbox">
                        <a href="#">Agree Terms & Conditions</a> 
          </label>      <small id="cfPhoneHelp" class="form-text text-muted" style="color:red;"><?= form_error("terms") ?></small>

    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>
