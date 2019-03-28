<?php if($countries) { ?>
              <table width="100%" border="0">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Country</th>
                      <th>Country Code</th>
                      <th>Currancy Code</th>
                      <th>Actions</th>
                      <!--<th>Replied</th>
                      <th>Replied On</th>-->
                    </tr>
                  </thead>   
                  <tbody>
                    <?php 


                    foreach($countries as $countrie) {
                      //$edit_url = base_url()."Manage_Jobs/create/".$countrie->id;
                      $del_url = base_url()."Manage_Countries/delete/".$countrie->id;?>
                      <tr>
                        <td class="center"><?= $sr+1; ?></td>
                        <td class="center"><?= $countrie->country_name ?></td>
                        <td class="center"><?= $countrie->country_code ?></td>
                        <td class="center"><?= $countrie->currancy_code ?></td>
                        <td class="center">
                        
                          <a onclick="delete_style(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white trash"><span class="fa fa-trash-o"></span></i> 
                          </a> 
                          <a href="<?= base_url() ?>Manage_Countries/create/<?= $countrie->id ?>"  class="btn btn-primary" >
                            <i class="halflings-icon white trash"><span class="fa fa-pencil"></span></i> 
                          </a>
                        </td>
                      
                      </tr>
                    <?php $sr++; } ?>
                  </tbody>
                </table>
<?php echo $this->ajax_pagination->create_links(); ?>
<?php } ?>
