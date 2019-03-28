
<?php  
                       if( !null == $this->session->flashdata("flash_messege")) {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?= $this->session->flashdata("flash_messege") ?>
            </div>
<?php
                       } ?>

<div class="row"> 
  

<div class="col-md-6" >
  
            <form id="login_account_form" class="form-horizontal" action="<?= base_url()?>Home/SubmitLogin" method="POST">

<fieldset>
    <legend>Login</legend>
         
             

             <div class="form-group">
                <label class="col-sm-4 control-label" for="email">Email</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="email" value="<?= set_value("email") ?>" id="email" placeholder="Email" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("email") ?> </div>
              </div>
     
             <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Password</label>
                <div class="col-md-12">
                  <input type="password" name="pward" value="" class="form-control" value="" id="pward" placeholder="password" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("pward") ?> </div>
                
              </div>
              <div class="form-group"> <a href="<?= base_url() ?>Home/forgot_pass">Forgot Password</a> </div>

              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-4">
                  
                  <input type="submit" class="btn btn-primary" name="submit" value="Login">
                </div>
              </div>
          </fieldset>
      </form>
</div>
</div>
            