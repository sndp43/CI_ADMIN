<section class="content-header">
      <h1>
        Manage
        <small>Countries</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        
        <li class="active">Countries</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Countries</h3>

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
          <form id="countries_create"  name="emailtemplate_create" class="form-horizontal" method="POST" action="<?= base_url() ?>Manage_Countries/create">
          <input type="hidden" id="update_id" name="update_id" value="<?= $update_id  ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="country_name" class="col-sm-2 control-label">Country</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="country_name" name="country_name" placeholder="Country Name" value="<?= $country_name ?>"><div class="help-inline" style="color:red;"> <?= form_error("country_name") ?> </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="country_code" class="col-sm-2 control-label">Country Code</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Country Code" value="<?= $country_code ?>"><div class="help-inline" style="color:red;"> <?= form_error("country_code") ?> </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="currancy_code" class="col-sm-2 control-label">Currancy Code</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="currancy_code" name="currancy_code" placeholder="Currancy Code" value="<?= $currancy_code ?>"><div class="help-inline" style="color:red;"> <?= form_error("currancy_code") ?> </div>
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