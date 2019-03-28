<div class="page">
    <div class="page-header">
   
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap right_side_dash colm" >
<!-- <div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap period">
<p>Period for Selection Should be maximum 6 Months Only.</p>
</div>
</div> -->
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap supplier">
<h2><span><?= $headline ?></span></h2>
<ul>
<li><a href="#">Home</a></li>
<li><a href="#"><?= $headline ?></a></li>
</ul>

<form id="create_account_form" class="form-horizontal" action="<?= base_url()?>Manage_Jobs/create" method="POST"> 

<?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
						<?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

								<?php } ?>

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap detail mCustomScrollbar _mCS_4s">


<div class="row">
<div class="form1">
  


  <p>Title:</p>
  <input type="text" name="title" value="<?= $title ?>" class="span6 typeahead" id="title">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("title") ?> </div>
  <br>


  <p>Description:</p>
  <textarea id="description" class="form-control" name="description" placeholder="Address" ><?= $description ?></textarea>
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("description") ?> </div>
             <script>
                  CKEDITOR.replace( 'description', {
                      height: 160,
                        removePlugins: 'about'
                    
                  } );
              </script>
  <br>
  <label class="control-label" for="company_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("company") ?> </div>

  <p>Technical S</p>
  <textarea id="technical_skills" class="form-control" name="technical_skills" placeholder="Address" ><?= $title ?></textarea>
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("description") ?> </div>
             <script>
                  CKEDITOR.replace( 'technical_skills', {
                      height: 160,
                        removePlugins: 'about'
                    
                  } );
              </script>
  <br>

                                <div class="help-inline" style="color:red;">
								<?= form_error("role")  ?> 
							    </div>
  

<div class="spend1">
<br>
<!-- <input type="submit" value="submit" class="btn btn-primary"/>
<input type="reset" value="cancel" 	class="btn btn-warning" style="float: right;"/> -->
 <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
  <a href="<?= base_url()?>Manage_enquiries/manage" class="btn btn">Cancel</a>

							  <!-- <button type="submit" name="cancel" value="Cancel" class="btn">Cancel</button> -->

</div>


</div>


</div>



</div>
</div> 

  
</form>      
</div>
</div>
</div>
   
    </div>

  </div>
