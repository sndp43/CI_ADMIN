<section class="content-header">
      <h1>
        Create
        <small>Email settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Email settings</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Email settings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
<?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                  <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?= $this->session->flashdata("flash_messege") ?>
                  </div>
                  <?php } ?>





 <div class="box-body">





<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

<form id="create_mail_setting_form" class="form-horizontal" action="<?= base_url()?>Manage_website/create" method="POST"  enctype="multipart/form-data">

            <?php if(isset($update_id)){ ?>
                           <input type="hidden"  name="update_id" value='<?= (int)$update_id ?>' id="update_id">

                
            <?php }else{?>
                       <input type="hidden"  name="update_id" value='' id="update_id">

                <?php } ?>



              <div class="box-body">




<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Mail User Name:</label>
 <div class="col-sm-10">
  <input type="text" name="MailUserName" value="<?= set_value($MailUserName) ? set_value($MailUserName) : $MailUserName ? $MailUserName: ''  ?>" class="form-control span6 typeahead" id="MailUserName">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailUserName") ?> </div>
 </div>
</div>

<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Mail Password:</label>
 <div class="col-sm-10">
 <input type="password" name="MailPassword" value="<?= set_value($MailPassword) ? set_value($MailPassword) : $MailPassword ? $MailPassword: ''  ?>" class="form-control span6 typeahead" id="MailPassword">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailPassword") ?> </div>
 </div>
</div>


<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Mail Host:</label>
 <div class="col-sm-10">
<input type="text" name="MailHost" value="<?= set_value($MailHost) ? set_value($MailHost) : $MailHost ? $MailHost: ''  ?>" class="form-control span6 typeahead" id="MailHost">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailHost") ?> </div>
 </div>
</div>



<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Mail Port:</label>
 <div class="col-sm-10">
     <input type="text" name="MailPort" value="<?= set_value($MailPort) ? set_value($MailPort) : $MailPort ? $MailPort: ''  ?>" class="form-control span6 typeahead" id="MailPort">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("MailPort") ?> </div>
 </div>
</div>

<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">From Mail:</label>
 <div class="col-sm-10">
  <input type="text" name="FromEmail" value="<?= set_value($FromEmail) ? set_value($FromEmail) : $FromEmail ? $FromEmail: ''  ?>" class="form-control span6 typeahead" id="FromEmail">
  <label class="control-label" for="lastname_err"></label> <div class="help-inline" style="color:red;"> <?= form_error("FromEmail") ?> </div>
 </div>
</div>
               


               
                            
                                                   
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                 <center><button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
				  <a href="<?= base_url()?>Manage_website/manage" class="btn btn">Cancel</a></center>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
</div>





        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>