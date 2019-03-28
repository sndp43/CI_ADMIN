<?php if($accounts) { ?>
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
<?php echo $this->ajax_pagination->create_links(); ?>
<?php } ?>