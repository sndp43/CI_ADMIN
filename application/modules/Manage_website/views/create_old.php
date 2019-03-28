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
<li><a href="#">Dashboard</a></li>
<li><a href="#"><?= $headline ?></a></li>
</ul>



<?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                  <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?= $this->session->flashdata("flash_messege") ?>
                  </div>
                  <?php } ?>



<form id="create_account_form" class="form-horizontal" action="<?= base_url()?>Manage_website/create" method="POST"  enctype="multipart/form-data"> 

<?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
						<?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

								<?php } ?>

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap detail mCustomScrollbar _mCS_4s">


<div class="row">
<div class="form1">
  
<div class="form-input">
  <p>Favicon:</p>
  <input type="file" name="image_one" class="form-control" id="Favicon" />
   <div id="thumb-output" class="thumb">
  <?php // if image exist show here 
    if(isset($image_one)) {
      $image_one_path = base_url()."assets/homefiles/images/favicons/".$image_one; ?>
    <img class="thumb" src="<?=  $image_one_path ?>">
    <input type="hidden" name="hidden_image" value="<?= $image_one?>">
  <?php } else {  } ?>

  </div>
  <div class="help-inline" style="color:red;" id="FaviconErr"> <?= form_error("image_one") ?> </div>
</div>

<div class="form-input">
  <p>Analytic Code:</p>
  <input type="text" name="AnalyticCode" value="<?= set_value($AnalyticCode) ? set_value($AnalyticCode) : $AnalyticCode ? $AnalyticCode: ''  ?>" class="span6 typeahead" id="AnalyticCode">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("AnalyticCode") ?> </div>
</div>

<div class="form-input">
  <p>Mail Port:</p>
  <input type="text" name="MailPort" value="<?= set_value($MailPort) ? set_value($MailPort) : $MailPort ? $MailPort: ''  ?>" class="span6 typeahead" id="MailPort">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailPort") ?> </div>
</div>

<div class="form-input">
  <p>Mail Password:</p>
  <input type="password" name="MailPassword" value="<?= set_value($MailPassword) ? set_value($MailPassword) : $MailPassword ? $MailPassword: ''  ?>" class="span6 typeahead" id="MailPassword">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailPassword") ?> </div>
</div>

<div class="form-input">
  <p>Meta Title:</p>
  <input type="text" name="MetaTitle" value="<?= set_value($MetaTitle) ? set_value($MetaTitle) : $MetaTitle ? $MetaTitle: ''  ?>" class="span6 typeahead" id="MetaTitle">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MetaTitle") ?> </div>
</div>

<div class="form-input">
  <p>Website Address:</p>
  <textarea id="WebsiteAddr" name="WebsiteAddr"><?= set_value('WebsiteAddr') ? set_value('WebsiteAddr') : $WebsiteAddr ? $WebsiteAddr: ''  ?></textarea>
  <script>
                                 CKEDITOR.replace( 'WebsiteAddr', {
                                     height: 160,
                                       removePlugins: 'about'
                                   
                                 } );
                              </script>
                              
  <label class="control-label" for="WebsiteAddr"></label> <div class="help-inline" style="color:red;"> <?= form_error("WebsiteAddr") ?> 
  </div>
</div>

                                <div class="help-inline" style="color:red;">
								<?= form_error("role")  ?> 
							    </div>
  




</div>

<div class="form1">
<div class="form-input">
  <p>Mail Host:</p>
  <input type="text" name="MailHost" value="<?= set_value($MailHost) ? set_value($MailHost) : $MailHost ? $MailHost: ''  ?>" class="span6 typeahead" id="MailHost">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailHost") ?> </div>
</div>

<div class="form-input">
  <p>Mail User Name:</p>
  <input type="text" name="MailUserName" value="<?= set_value($MailUserName) ? set_value($MailUserName) : $MailUserName ? $MailUserName: ''  ?>" class="span6 typeahead" id="MailUserName">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailUserName") ?> </div>
</div>

<div class="form-input">
  <p>From Mail:</p>
  <input type="text" name="FromEmail" value="<?= set_value($FromEmail) ? set_value($FromEmail) : $FromEmail ? $FromEmail: ''  ?>" class="span6 typeahead" id="FromEmail">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("FromEmail") ?> </div>
</div>

<div class="form-input">
  <p>Mail User Description:</p>
  <input type="text" name="MetaDesc" value="<?= set_value($MetaDesc) ? set_value($MetaDesc) : $MetaDesc ? $MetaDesc: ''  ?>" class="span6 typeahead" id="MetaDesc">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MetaDesc") ?> </div>
</div>

<div class="form-input">
  <p>Facebook Link:</p>
  <input type="text" name="fbLink" value="<?= set_value($fbLink) ? set_value($fbLink) : $fbLink ? $fbLink: ''  ?>" class="span6 typeahead" id="fbLink">
  <label class="control-label" for="fbLink_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("fbLink") ?> </div>
</div>

<div class="form-input">
  <p>Google plus Link:</p>
  <input type="text" name="gpLink" value="<?= set_value($gpLink) ? set_value($gpLink) : $gpLink ? $gpLink: ''  ?>" class="span6 typeahead" id="gpLink">
  <label class="control-label" for="gpLink_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("gpLink") ?> </div>
</div>

<div class="form-input">
  <p>Twitter Link:</p>
  <input type="text" name="tlink" value="<?= set_value($tlink) ? set_value($tlink) : $tlink ? $tlink: ''  ?>" class="span6 typeahead" id="tlink">
  <label class="control-label" for="tlink_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("tlink") ?> </div>
</div>

</div>

<div class="row">
<div class="spend1">

<!-- <input type="submit" value="submit" class="btn btn-primary"/>
<input type="reset" value="cancel" 	class="btn btn-warning" style="float: right;"/> -->
 <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
 <a href="<?= base_url()?>Manage_website/manage" class="btn btn">Cancel</a>

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
