
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
  
<form enctype="multipart/form-data" id="create_account_form" class="form-horizontal" action="<?= base_url()?>Accounts/ProfileUpdate" method="POST">

<fieldset>
    <legend>My Profile</legend>
            <?php if(isset($update_id)){ ?>

                       <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

            <?php }else{ ?>
                       <input type="hidden"  name="update_id" value='' id="update_id">
                <?php } ?>

          <div class="form-group">
                  <label class="col-sm-4 control-label" for="profilepic">Profile Pic</label>
                   <div class="col-sm-5">
                    <input id="profilepic" type="file" name="profilepic" value="<?= $useraccountinfo[0]->profilepic ?>">

                    <input id="profilepic_name" type="hidden" name="profilepic_name" value="<?= $useraccountinfo[0]->profilepic ?>">
                    <div id="thumb-output_pp">
<?php // if image exist show here 
if(isset($useraccountinfo[0]->profilepic) && ($useraccountinfo[0]->profilepic != '')){  $profilepic_path = base_url()."assets/homefiles/pics/profile/".$useraccountinfo[0]->profilepic; ?><img class="thumb" src="<?=  $profilepic_path ?>"> 
<input type="button" class="btn btn-danger" onclick="remove_image('profilepic')" value="remove image" />
<?php  }else{  }
?>
                   </div>
                  </div>
                  
                 <div class="help-inline" style="color:red;"> 
                  <span id="profilepicerrorMessage" class="errorMessage"><?= null != $this->session->flashdata('profilepicerrorMessage') ?  $this->session->flashdata('profilepicerrorMessage') : ''; ?>
                  </span> 
                  </div>
           </div>

              <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="firstname" value="<?= $useraccountinfo[0]->firstname ?>" id="firstname" placeholder="First name" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("firstname") ?> </div>
        </div>

               
     

               <div class="form-group">                 <label class="col-sm-4
control-label" for="telnum">Mobile No.</label>                 <div class
="col-md-12">                      <input type="hidden" id="country_code_num"
name="country_code_num" value="<?= $useraccountinfo[0]->country_code_num ?>"
required>                    <input class="form-control" id="telnum"
name="telnum" type="tel" value="<?= $useraccountinfo[0]->telnum ?>">
<input type="hidden" name="country_abbreviation" id="country_abbreviation"
value="<?= $useraccountinfo[0]->country_abbreviation ?>">

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
                <div class="col-sm-9 col-sm-offset-4">
                  
                  <input onclick="submit_click(event)" type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
              </div>

              


              </fieldset>
            </form>
</div>

</div>
            