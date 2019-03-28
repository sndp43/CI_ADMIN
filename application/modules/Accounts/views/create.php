<section class="content-header">
      <h1>
        Add new
        <small> Account</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/create"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Account</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				
<?php if(isset($update_id)){  ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Account Options</h3>
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

					<a class="btn btn-mini btn-primary" href="<?= base_url() ?>Accounts/update_pword/<?= $update_id ?>">Update Password</a>


				    </div><!--/span-->

			</div><!--/row-->



						
					</div>
				</div>
<?php } ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?= $headline ?></h3>
					</div>
					<div class="panel-body">


<?php  
                       if( !null == $this->session->flashdata("flash_messege")) {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?= $this->session->flashdata("flash_messege") ?>
						</div>
<?php
                       } ?>


						<form id="create_account_form" class="form-horizontal" action="<?= base_url()?>Accounts/create" method="POST">


						<?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
						<?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

								<?php } ?>



							<div class="form-group">
								<label class="col-sm-4 control-label" for="firstname">Name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" id="firstname" placeholder="First name" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("firstname") ?> </div>
							</div>

                            <div class="form-group">
								<label class="col-sm-4 control-label" for="email">Email</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="email" value="<?= $email ?>" id="email" placeholder="Email" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("email") ?> </div>
							</div>
							<!-- <div class="form-group">
								<label class="col-sm-4 control-label" for="lastname">Last name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="lastname" value="<?= $lastname ?>" id="lastname" placeholder="Last Name" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("lastname") ?> </div>
							</div> -->



						<!-- 	<div class="form-group">
								<label class="col-sm-4 control-label" for="company">Company</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="company" value="<?= $company ?>" id="company" placeholder="Company" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("company") ?> </div>
							</div> -->


						<!-- 	<div class="form-group">
								<label class="col-sm-4 control-label" for="address1">Address L1:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="address1" value="<?= $address1 ?>" id="address1" placeholder="Address" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("address1") ?> </div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="address2">Address L1:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="address2" value="<?= $address2 ?>" id="address2" placeholder="Address" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("address2") ?> </div>
							</div>
 -->

						  <!-- <div class="form-group">
								<label class="col-sm-4 control-label" for="country">Country</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="country" value="<?= $country ?>" id="country" placeholder="Country" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("country") ?> </div>
							</div> -->

<!-- 
							 <div class="form-group">
								<label class="col-sm-4 control-label" for="town">Town</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="town" value="<?= $town ?>" id="town" placeholder="Town" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("town") ?> </div>
							</div> -->


							 <div class="form-group">
								<label class="col-sm-4 control-label" for="telnum">Mobile No.</label>
								<div class="col-sm-5">
								     <input type="hidden" id="country_code_num" name="country_code_num" value="<?= $country_code_num ?>" required>
									 <input class="form-control" id="telnum" name="telnum" type="tel" value="<?= $telnum ?>">
									 <input type="hidden" name="country_abbreviation" id="country_abbreviation" value="<?= $country_abbreviation ?>">

								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("telnum") ?> </div>
							</div>


							<!--  <div class="form-group">
								<label class="col-sm-4 control-label" for="postcode">Post Code</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="postcode" value="<?= $postcode ?>" id="postcode" placeholder="Post Code" />
								</div>
								<div class="help-inline" style="color:red;"> <?= form_error("postcode") ?> </div>
							</div> -->


<div class="form-group">
<label class="col-sm-4 control-label" for="role">Role:</label>
<div class="col-sm-5">
  	<select name="role" id="role" class="form-control">
							    	<option value="">Please Select Role</option>
                                      <?php 

             foreach ($roles as $roledata ) {?> 

             <option <?= $role == $roledata->id ? 'selected' : '' ?> value="<?= $roledata->id ?>"><?= $roledata->rolename; ?></option>
             	
            <?php }
                                      ?>

	</select>
	</div>
     <label class="control-label" for="role_err"></label>
     <div class="help-inline" style="color:red;">
		<?= form_error("role")  ?> 
	</div>
</div>

                          



		

							<!-- <div class="form-group">
								<div class="col-sm-5 col-sm-offset-4">
									<div class="checkbox">
										<label>
											<input <?= $agree == 1 ? 'checked' : '' ?> type="checkbox" id="agree" name="agree"  />Please agree to our policy
										</label>
									</div>
								</div>
							</div> -->

							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-4">
									
									<input onclick="submit_click(event)" type="submit" class="btn btn-primary" name="submit" value="Submit">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>





