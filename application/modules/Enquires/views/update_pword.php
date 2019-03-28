<h1><?= $headline ?></h1> 

                      <?php  
                       if( !null == $this->session->flashdata("flash_messege")) {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
							<button type="button" class="close" data-dismiss="alert">×</button>
							 <?= $this->session->flashdata("flash_messege") ?>
						</div>
<?php
                       } ?>




	<div class="row-fluid sortable">

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">


						<form id="update_password_form" class="form-horizontal" action="<?= base_url()?>Store_accounts/update_pword" method="POST">


						<?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
						<?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

								<?php } ?>


						  <fieldset>


<div class="control-group"> <label class="control-label" for="password">Password</label> <div class="controls"> <input type="password" name="password" value="" class="span6 typeahead" id="password"> </div> <label class="control-label" for="password_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("password") ?> </div> </div>


<div class="control-group"> <label class="control-label" for="passconf">Confirm Password</label> <div class="controls"> <input type="password" name="passconf" value="" class="span6 typeahead" id="passconf"> </div> <label class="control-label" for="passconf_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("passconf") ?> </div> </div>


							<div class="form-actions">
							  <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
							  <button type="submit" name="cancel" value="Cancel" class="btn">Cancel</button>
							</div>



						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
</div><!--/row fluid-->
