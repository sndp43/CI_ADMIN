<section class="content-header">
      <h1>
        Manage
        <small>Style</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Style</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Style</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         <?php

$style_array = array();
if ($handle = opendir('./assets/homefiles/css/custom')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            array_push($style_array, $entry);
        }
    }

    closedir($handle);
}




          ?>

          <div class="row">
            <div class="col-md-12">


<form action="<?= base_url() ?>Manage_style/create" method="POST" > 
<input type="hidden" name="update_id" value="<?= $update_id ?>">

              <div class="form-group">
                <label>Select Style</label>
                <select class="form-control select2" name="selected_css" style="width: 100%;">
                  <option value="">Select Style</option>
                  <?php foreach ($style_array as $key => $style) {
                   ?>
                      <option value="<?=  $style ?>"  <?php if($style==$selected_css){ echo"selected"; } ?>  ><?= $style  ?></option>

                   <?php
                  } ?>
                 
                  
                </select>
              </div>

               <div class="box-footer">
                 <center><button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
         <!--  <a href="<?= base_url()?>Manage_style/manage" class="btn btn">Cancel</a></center> -->
              </div>
  </form>           
            </div>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
    
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>