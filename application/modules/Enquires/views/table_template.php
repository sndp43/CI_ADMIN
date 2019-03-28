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
          <h2><span>Manage Accounts</span></h2>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Manage Accounts</a></li>
          </ul>
          <form>  
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap detail mCustomScrollbar _mCS_4s">
                <div class="form_detail">
                  <?php echo anchor('Store_accounts/create', 'Add New Accounts', array('class'=>'btn btn-small btn-success','title' => 'Add New Accounts'));  ?>
                  <input type="text" name="search" placeholder="Search..">
                  <input type="button" value="Search">
                  <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                  <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?= $this->session->flashdata("flash_messege") ?>
                  </div>
                  <?php } ?>
                  <table width="100%" border="0">
                    <thead>
                      <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Company</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                      </tr>
                    </thead>   
                    <tbody>
                      <?php foreach ($accounts as $account) {
                        $edit_url = base_url()."Store_accounts/create/".$account->id;
                        $del_url = base_url()."Store_accounts/delete/".$account->id;?>
                        <tr>
                          <td><?= $account->firstname ?></td>
                          <td class="center"><?= $account->lastname ?></td>
                          <td class="center"><?= $account->company ?></td>
                          <td class="center"><?= $account->timestamp ?></td>
                          <td class="center">
                          <!-- <a class="btn btn-success" href="#">
                            <i class="halflings-icon white zoom-in"></i>  
                          </a> -->
                          <a class="btn btn-info" href="<?= $edit_url ?>">
                            <i class="halflings-icon white edit"></i>  
                          </a>
                          <!-- <a onclick="delete_user(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white trash"></i> 
                          </a> -->
                        </td>
                        </tr>
                      <?php } ?>
                    </tbody>
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