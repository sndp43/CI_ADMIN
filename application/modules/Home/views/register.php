
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
  
<div class="col-md-6">
  
<form id="create_account_form" class="form-horizontal" action="<?= base_url()?>Home/Register" method="POST">

<fieldset>
    <legend>Register</legend>
            <?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
            <?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

                <?php } ?>



              <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" id="firstname" placeholder="First name" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("firstname") ?> </div>
              </div>

                            <div class="form-group">
                <label class="col-sm-4 control-label" for="email">Email</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="email" value="<?= $email ?>" id="email" placeholder="Email" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("email") ?> </div>
              </div>
     

               <div class="form-group">
                <label class="col-sm-4 control-label" for="telnum">Mobile No.</label>
                <div class="col-md-12">
                     <input type="hidden" id="country_code_num" name="country_code_num" value="<?= $country_code_num ?>" required>
                   <input class="form-control" id="telnum" name="telnum" type="tel" value="<?= $telnum ?>">
                   <input type="hidden" name="country_abbreviation" id="country_abbreviation" value="<?= $country_abbreviation ?>">

                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("telnum") ?> </div>
              </div>

             <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Password</label>
                <div class="col-md-12">
                  <input type="password" name="password" value="" class="form-control" value="" id="password" placeholder="password" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("password") ?> </div>
                
              </div>


              <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Confirm Password</label>
                <div class="col-md-12">
                  <input type="password" name="passconf" value="" class="form-control" value="" id="passconf" placeholder="Confirm Password" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("passconf") ?> </div>
                
              </div>
<div class="form-group">
    <?php 


            $this->load->library('Antispam');
            $configs = array(
                    'img_path' => './assets/homefiles/pics/captcha_images/',
                    'img_url' => base_url().'assets/homefiles/pics/captcha_images/',
                    'img_height' => '30',
                );          
             $captcha = $this->antispam->get_antispam_image($configs);
             $this->session->unset_userdata('captchaCode');
             $this->session->set_userdata('captchaCode',$captcha['word']);
        
      
                        ?>
            <div class="col-md-12">
              <input class="form-control" type="text" placeholder="Enter Code" name="regcapcha" id="regcapcha"/>
            </div>  <div class="help-inline" style="color:red;"> <?= form_error("regcapcha") ?> </div>
            <div class="cap_ref"> 
               <i class="fa fa-refresh" aria-hidden="true"></i>
            </div>

          <input type="hidden" name="hiddencaptcha" id="hiddencaptcha">
          <p id="captImg"><?php echo $captcha['image'];?></p> 

      <small id="regcapchaHelp" class="form-text text-muted" style="color:red;"> </small>
    </div> 
             <div class="form-group">
                <div class="col-md-12 col-sm-offset-4">
                  <div class="checkbox">
                    <label>
                      <input <?= $agree == 1 ? 'checked' : '' ?> type="checkbox" id="agree" name="agree"  />Please agree to our policy
                    </label>
                  </div> <div class="help-inline" style="color:red;"> <?= form_error("agree") ?> </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-4">
                  
                  <input onclick="submit_click(event)" type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
              </div>

              


              </fieldset>
            </form>
</div>

</div>
            