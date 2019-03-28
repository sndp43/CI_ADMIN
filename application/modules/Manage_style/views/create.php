<section class="content-header">
      <h1>
        Add new
        <small>style</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">style</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add new style<style type="text/css"></style></h3>

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

                       
        <form id="create_style_form" class="form-horizontal" action="<?= base_url()?>Manage_style/create" method="POST" enctype="multipart/form-data" >
         <input type="hidden" name="update_id" id="update_id" value="<?= isset($update_id) ? $update_id : 0 ?>">
 
         <input type="hidden" name="chk_file_add_removed" id="chk_file_add_removed" value="<?= isset($update_id) ? $update_id : 0 ?>">

                <div class="form-group">
                  <label class="col-sm-4 control-label" for="selected_css">Style</label>
                   <div class="col-sm-5">
                    <input id="selected_css" type="file" name="selected_css" value="<?= $selected_css ?>">

                    <input id="style_name" type="hidden" name="style_name" value="<?= $selected_css ?>">
                    <div id="thumb-output">
<?php           
   // if file exist show here 
if(isset($selected_css) && !empty($selected_css)){ ?>  

<label id="thumb-output_lbl" class="col-sm-4 control-label" ><?= $selected_css ?></label>
 <?php  }else{  }
?>
</div>
                  </div>
                  
                 <div class="help-inline" style="color:red;"> 
                  <span id="file_errorMessage" class="errorMessage"><?= null != $this->session->flashdata('file_errorMessage') ?  $this->session->flashdata('file_errorMessage') : ''; ?>
                  </span> 
                  </div>

                </div>

          
          <div class="form-group">
                <label class="col-sm-4 control-label" for="style_desc">Style Descrioption</label>
                <div class="col-sm-5">
                <textarea class="form-control" name="style_desc" id="style_desc"><?= $style_desc ?></textarea>
                  
                </div>
                <div class="help-inline" style="color:red;"> <?= form_error("style_desc") ?> </div>
              </div>
           <div class="form-group">
                
                  <label class="col-sm-4 control-label" for="status">Status</label>
                   <div class="col-sm-5">
                <select class="form-control select2" name="status">
                  <option value="" >Select status</option>
                  <option value="1"  <?=  ($status == "1") ? "selected" : "" ?>  >Active</option>
                  <option value="0"  <?=  ($status == "0") ? "selected" : "" ?> >Inactive</option>
                 
                </select>
                <div class="help-inline" style="color:red;"> <?= form_error("status") ?> </div>
                </div>
           </div>
           <div class="form-group">
              <label class="col-sm-4 control-label" for="style_default"> Default
              </label>
                <div class="col-sm-5"> <input  <?=  ($style_default == "1") ? "checked" : "" ?> type="checkbox" class="flat-red" name="style_default"> </div>
          </div>

              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-4">
                  
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit">


                </div>
              </div>
           </form>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>