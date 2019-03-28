<section class="content-header">
      <h1>
        Manage
        <small>Email Template</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        
        <li class="active">Email Template</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Email Template</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php  
                       if( !null == $this->session->flashdata("flash_messege")) {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?= $this->session->flashdata("flash_messege") ?>
            </div>
<?php
                       } ?>
          <form id="emailtemplate_create"  name="emailtemplate_create" class="form-horizontal" method="POST" action="<?= base_url() ?>Manage_email_templates/create">
          <input type="hidden" name="update_id" value="<?= $update_id  ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="Key" class="col-sm-2 control-label">Key</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="Key" name="Key" placeholder="Key" value="<?= $Key ?>"><div class="help-inline" style="color:red;"> <?= form_error("Key") ?> </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject" class="col-sm-2 control-label">Subject</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="Subject" name="Subject" placeholder="Subject" value="<?= $Subject ?>"><div class="help-inline" style="color:red;"> <?= form_error("Subject") ?> </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="Bodya" class="col-sm-2 control-label">Body</label>

                  <div class="col-sm-10">
                     <textarea id="Bodya" name="Bodya" rows="10" cols="80">
                           <?= $Bodya ?>               
                    </textarea><div class="help-inline" style="color:red;"> <?= form_error("Bodya") ?> </div>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-info pull-right">
              </div>
              <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>