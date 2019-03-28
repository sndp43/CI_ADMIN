


<div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?= $headline ?></h3>
          </div>
          <div class="panel-body">

          
           <div class="box span12">
          <div class="box-header" data-original-title>
            
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div> 
          </div>
          <div class="box-content">

<?php  
                       if( !null == $this->session->flashdata("flash_messege")) {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Well done!</strong> <?= $this->session->flashdata("flash_messege") ?>
            </div>
<?php
                       } ?>



      <form id="update_password_form" class="form-horizontal" action="<?= base_url()?>Accounts/update_pword" method="POST"> 
<?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
            <?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

                <?php } ?>


<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap detail mCustomScrollbar _mCS_4s">


<div class="row">

 
  


             <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Password</label>
                <div class="col-sm-5">
                  <input type="password" name="password" value="" class="form-control" value="" id="password" placeholder="password" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("password") ?> </div>
                <div class="help-inline" style="color:red;"> <?= form_error("password") ?> </div>
              </div>


              <div class="form-group">
                <label class="col-sm-4 control-label" for="firstname">Confirm Password</label>
                <div class="col-sm-5">
                  <input type="password" name="passconf" value="" class="form-control" value="" id="passconf" placeholder="Confirm Password" />
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("passconf") ?> </div>
                <div class="help-inline" style="color:red;"> <?= form_error("passconf") ?> </div>
              </div>








<div class="spend1">
<br>
<!-- <input type="submit" value="submit" class="btn btn-primary"/>
<input type="reset" value="cancel"  class="btn btn-warning" style="float: right;"/> -->
<button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
<!-- <button type="submit" name="cancel" value="Cancel" class="btn">Cancel</button> -->
 <a href="<?= base_url()?>Accounts/manage" class="btn btn">Cancel</a>

</div>





</div>



</div>
</div> 

  
</form>                  
         


            </div><!--/span-->

      </div><!--/row-->
    </div>
   </div>
  </div>
 </div>
</div>

