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
          <h2><span>Manage Website Settings</span></h2>
          <ul>
            <li><a href="<?= base_url()?>Dashboard/home">Dashboard</a></li>
            <li><a href="#">Manage Website Settings</a></li>
          </ul>


          
          <form>  
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap detail mCustomScrollbar _mCS_4s">
                <div class="form_detail manage_website">
                <?php $count = count($application);

                if($count == 0){
                   echo anchor('Manage_Jobs/create', 'Add New Jobs', array('class'=>'btn btn-small btn-success add_manage','title' => 'Add New Accounts'));

                }

                ?>

                 <!--  <?php echo anchor('Manage_Jobs/create', 'Add New Jobs', array('class'=>'btn btn-small btn-success','title' => 'Add New Accounts'));  ?> -->
                <!--   <input type="text" name="search" placeholder="Search..">
                  <input type="button" value="Search"> -->
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
                      <th>Favicon</th>
                      <th class="center">
                        <img src="<?=base_url()?>assets/homefiles/images/favicons/<?=$applications->Favicon?>" style="width: 25px; height: 25px">
                      </th>
                      </tr>

                      <tr>
                      <th>Analytic Code</th>
                      <th class="center"><?= $applications->AnalyticCode ?></th>
                      </tr>
                      
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
                      <td>Meta Title</td>
                      <td class="center"><?= $applications->MetaTitle ?></td>
                      </tr>
                      
                      <tr>
                      <td>Meta Description</td>
                      <td class="center"><?= $applications->MetaDesc ?></td>
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
                    
                  
                  
                  
                  
                  
                  
                  
                </div>
              </div>
            </div> 
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>