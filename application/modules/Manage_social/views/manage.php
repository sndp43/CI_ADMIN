
<section class="content-header">
      <h1>
        Manage
        <small>Social Settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Social Settings</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Social Settings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">


<div class="row">
<div class="col-md-12">
<div class="col-sm-12 col-lg-12 col-md-12">
      <input type="hidden" name="activetab" id="activetab" value="<?= $activetab ?>">      
            <!-- /.box-header -->
         


        <div class="col-md-12">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active" id="fbid"><a id="fbidanchor" href="#fb"  data-toggle="tab">Facebook Settings</a></li>
                            <li class="" id="gpid"> <a id="gpidanchor" href="#gp"  data-toggle="tab">Google settings</a></li>
                           
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="fb">
                          
  <!-- fb form start -->
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

            </div>
                          <?php  


                       if( !null == $this->session->flashdata("flash_messege") && isset($activetab) && $activetab =="fb") {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?= $this->session->flashdata("flash_messege") ?>
            </div>
<?php
                       } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="create_fb_settings" class="form-horizontal" action="<?= base_url() ?>Manage_social/create_fb" method="POST">
             <input type="hidden" name="update_id"  id="update_id" value="<?= $update_id ?>">
             <input type="hidden" name="platform"  id="platform" value="facebook">
              <div class="box-body">
                 
               <div class="form-group">
                  <label for="fbapi_key" class="col-sm-2 control-label">API Key</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="fbapi_key" id="fbapi_key" placeholder="API Key" value=" <?= isset($data) ? $data['fbapi_key'] : (isset($fbapi_key) ? $fbapi_key : set_value('fbapi_key') )  ?>">
                  </div>
                  <div class="help-inline" style="color:red;"> <?= form_error("fbapi_key") ?> </div>
                </div>
                 <div class="form-group">
                  <label for="fbapp_secret" class="col-sm-2 control-label">App Secret</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="fbapp_secret" id="fbapp_secret" placeholder="Client Secret" value=" <?= isset($data) ? $data['fbapp_secret'] : (isset($fbapp_secret) ? $fbapp_secret :   set_value('fbapp_secret'))  ?>">
                  </div>
                  <div class="help-inline" style="color:red;"> <?= form_error("fbapp_secret") ?> </div>
                </div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
               
                <input type="submit" name="submit" value="Submit" class="btn btn-info pull-right">
              </div>
              <!-- /.box-footer -->
            </form>
                          <!-- fb form end -->
                        </div>
                        <div class="tab-pane fade" id="gp">
                          

  <!-- gp form start -->
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

            </div>
            <!-- /.box-header -->
            <!-- form start -->

                                        <?php  
                       if( !null == $this->session->flashdata("flash_messege") && isset($activetab) && $activetab =="gp") {
?>

                       <div class="<?= $this->session->flashdata("flash_error_class") ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?= $this->session->flashdata("flash_messege") ?>
            </div>
<?php
                       } ?>

            <form id="create_gp_settings"  class="form-horizontal" action="<?= base_url() ?>Manage_social/create_gp" method="POST">
            <input type="hidden" name="update_id"  id="update_id" value="<?= $update_id ?>">
            <input type="hidden" name="platform"  id="platform" value="google">
              <div class="box-body">
               <div class="form-group">
                  <label for="gpapplication_name" class="col-sm-2 control-label">Application Name</label>
                   <?php

                    $base_url = base_url();
                    $appname_array = explode("/",$base_url);
                   
                    $appindex  = count($appname_array) - 2;
                    $appname = $appname_array[3];

                  ?>
                  <div class="col-sm-10">

                    <input type="text" readonly class="form-control" name="gpapplication_name" id="gpapplication_name" placeholder="Application Name" value="<?= $appname ?>">

                    <input type="hidden" class="form-control" name="gpapplication_name_hidden" id="gpapplication_name_hidden" value="<?= $appname ?>">

                  </div>
                   <div class="help-inline" style="color:red;"> <?= form_error("gpapplication_name") ?> </div>
                </div>
                 <div class="form-group">
                  <label for="gpapi_key" class="col-sm-2 control-label">API Key</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="gpapi_key" id="gpapi_key" placeholder="API Key" value="<?= isset($data) ? $data['gpapi_key'] : (isset($gpapi_key) ? $gpapi_key : set_value('gpapi_key'))  ?>">
                  </div>
                  <div class="help-inline" style="color:red;"> <?= form_error("gpapi_key") ?> </div>
                </div>
                 <div class="form-group">
                  <label for="gpclient_secret" class="col-sm-2 control-label">Client Secret</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="gpclient_secret" id="gpclient_secret" placeholder="Client Secret" value="<?= isset($data) ? $data['gpclient_secret'] : ( isset($gpclient_secret) ? $gpclient_secret: set_value('gpclient_secret'))  ?>">
                  </div>
                  <div class="help-inline" style="color:red;"> <?= form_error("gpclient_secret") ?> </div>
                </div>
                <div class="form-group">
                  <label for="gpclient_id" class="col-sm-2 control-label">Client ID</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="gpclient_id" id="gpclient_id" placeholder="Client ID" value="<?= isset($data) ? $data['gpclient_id'] : ( isset($gpclient_id) ? $gpclient_id : set_value('gpclient_id') ) ?>">
                  </div>
                  <div class="help-inline" style="color:red;"> <?= form_error("gpclient_id") ?> </div>
                </div>
               
                 <div class="form-group">
                  <label for="gpredirect_uri" class="col-sm-2 control-label">Redirect URI</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="gpredirect_uri" id="gpredirect_uri" placeholder="Redirect URI" value="<?= isset($data) ? $data['gpredirect_uri'] : ( isset($gpredirect_uri) ? $gpredirect_uri : set_value('gpredirect_uri'))  ?>">
                  </div>
                   <div class="help-inline" style="color:red;"> <?= form_error("gpredirect_uri") ?> </div>

                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" name="submit" value="Submit" class="btn btn-info pull-right">
              </div>
              <!-- /.box-footer -->
            </form>
                          <!-- gp form end -->

                        </div>
                      
                       
                    </div>
                </div>
          </div>
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

    </section><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>