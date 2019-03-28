<section class="content-header">
      <h1>
        Manage
        <small>Email Settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
      
        <li class="active">Email Settings</li>
      </ol>
</section>
<section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Email Settings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <?php $count = count($application);

                if($count == 0){
                   echo anchor('Manage_website/create', 'Add Settings', array('class'=>'btn btn-small btn-success add_manage','title' => 'Add Settings'));

                }

                ?>

        </div>
        <div class="box-body">
      


 <form>

 <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                  <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Well done!</strong><?= $this->session->flashdata("flash_messege") ?>
                  </div>
                  <?php } ?>
                  
                  <table width="100%" border="0">
                   <?php foreach ($application as $applications) {
                        $del_url = base_url()."Manage_website/delete/".$applications->id;
                        $edit_url = base_url()."Manage_website/create/".$applications->id;?>
                    <thead>
                   
                      <tr>
                      <td>Mail Host</td>
                      <td class="center"><?= $applications->MailHost ?></td>
                      </tr>
                      
                      <tr>
                      <td>Mail Port</td>
                      <td class="center"><?= $applications->MailPort ?></td>
                      </tr>
                      
                      <tr>
                      <td>Mail UserName</td>
                      <td class="center"><?= $applications->MailUserName ?></td>
                      </tr>
                      
                      <tr>
                      <td>From Mail</td>
                      <td class="center"><?= $applications->FromEmail ?></td>
                      </tr>
                      
                    
                    
                      <tr>
                      <td>Action</td>
                      <td class="center">
                          
                          <a class="btn btn-info" href="<?= $edit_url;?>">
                            <i class="halflings-icon white edit"><span class="fa fa-pencil"></span></i>  
                          </a>
                          <a onclick="delete_website(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white trash"><span class="fa fa-trash-o"></span></i> 
                          </a> 
                        </td>
                      </tr>
                      
                     
                    </thead>   
                     <?php } ?>
                    </table>


               </form>        
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>