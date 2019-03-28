<script>
function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var search = $('#search').val();
  var account_type = $('#account_type').val();
  $('#SearchType').val(account_type);
  console.log(search);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url(); ?>Accounts/manage_search/'+page_num,
    data:'page='+page_num+'&search='+search+'&account_type='+account_type,
    beforeSend: function () {
       $('.loading').show();
    },
    success: function (html) {
      $('#postList').html(html);
       $('.loading').fadeOut("slow");
    }
  });
}
</script>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       User
        <small>listing</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">listing</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">User Listing</h3>
          
           

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class="col-md-4">
           <?php echo anchor('Accounts/create', 'Add New User', array('class'=>'btn btn-small btn-success add_manage','title' => 'Add New User'));  ?>
        </div>
          <!-- <div class="col-md-4">
              
          <select class="form-control select2" id="account_type" name="account_type" onchange="searchFilter()" >
                 
                    <option value="0">Select User Type</option>

                    <option value="1">Facebook Users</option>
                    <option value="2">Google Users</option>
                    <option value="3">Normal Users</option>
                    <option value="4">Admin</option>
                  
          </select>
        </div> -->
          <div class="col-md-4">
              <input type="text" placeholder="Search by Name" name="search" id="search"  class="form-control" onkeyup="searchFilter()">
          </div>

 
           <div class="col-sm-4 col-lg-4 col-md-4">
                        <!-- Export Start -->
                <?= form_open('Accounts/getAccountsExport'); ?>
                  <input type="hidden" name="SearchType" id="SearchType" value="<?= set_value('SearchTitle') ?>">
                  <input type="submit" value="Export All Users" name="" class=" btn btn-primary top_btn">
                <?= form_close();?>
                <!-- Export End -->
            </div>
        </div>
        <div class="box-body">
        
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listing</h3>
            </div>
       
            <!-- /.box-header -->
            <div class="box-body">
            <div id="postList">
            
            <?php if(isset($accounts) && !empty($accounts)) { ?>
              <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Sr#</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>User Types</th>
                  <th>Date Created</th>
                  <th>Register Time</th>
                   <th>Actions</th>
                   <th class="col110">Status</th>
                </tr>
                
                <tbody>
                    <?php $this->load->module('Timedate'); ?>
                      <?php foreach ($accounts as $account) {
                        $edit_url = base_url()."Accounts/create/".$account->id;
                        $del_url = base_url()."Accounts/delete/".$account->id;?>
                        <tr>
                          <td><?= $sr+1; ?></td>
                          <td><?= $account->firstname ?></td>
                          <td><?= $account->email  ?></td>
                          
                          <!-- <td class="center"><?= $account->company ?></td> -->
                          <td class="center">
                          <?php
                            if($account->FacebookId != '' && $account->GoogleId != '') {
                              echo "Both";
                            } else if($account->FacebookId != '') { 
                              echo "Facebook User";
                            } else if ($account->GoogleId != '') {
                              echo "Google User";
                            } else {
                              echo "Normal user";
                            }
                          ?>
                          </td>
                          <td class="center"><?php echo $this->timedate->get_nice_date($account->added_time, 'monyear'); ?></td>
                          <td><?php echo date('h:i:s A', $account->added_time); ?></td>
                          
                          <td class="center" style="border-left : 0px !important">
                          <!-- <a class="btn btn-success" href="#">
                            <i class="halflings-icon white zoom-in"></i>  
                          </a> -->
                          <a class="btn btn-info" href="<?= $edit_url ?>">
                            <i class="halflings-icon white edit"><span class="fa fa-pencil"></span></i>  
                          </a>
                         <?php /*  if($account->role != 1) { ?>
                           <a onclick="delete_user(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white edit"><span class="fa fa-trash"></span></i>
                          <?php } ?>
                          </a> */ ?>
                        </td>

                          <td>
                          <label class="switch">
                           <input data-acc-id="<?= $account->id ?>" class="checkbox4" type="checkbox" id="checkbox4" <?= ($account->status == 1) ? 'checked' : '' ?>>
                           <div class="slider round"></div>
                          </label>
                        </td>
                        </tr>
                      <?php $sr++; } ?>
                    </tbody>
                
                
              </table>
              </div>
               <div class="box-footer clearfix"> 
              <?php echo $this->ajax_pagination->create_links(); ?> </div><?php }
           
                  else {
                    echo "No accounts to show";
                  }
                  ?>
            </div>
            </div>
            <!-- /.box-body -->
           <!--  <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div> -->
          </div>
         </div>
         </div> 
        
 </section>



 