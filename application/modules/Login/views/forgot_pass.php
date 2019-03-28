<fieldset>
    <legend>Reset Password</legend>
<form name="reset_password" id="reset_password" method="POST" action="<?= base_url() ?>Home/forgot_pass_submit" > 
     
    <div class="form-group col-sm-5">
      <label for="exampleInputEmail1">Email address</label>
      <input class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your registered email" type="email"><div class="help-inline" style="color:red;"> <?= form_error("email") ?> </div>
      <small id="emailHelp" class="form-text text-muted">you will receive reset password link on this mail.</small>
    </div>
    <input type="submit"  name="submit" class="btn btn-primary value="Submit"  >
 
</form>
</fieldset>
