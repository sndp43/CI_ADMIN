<?php if($emailtemplates) { ?>
   <table width="100%" border="0">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Key</th>
                      <th>Subject</th>
                      <th>Body</th>
                      <th>Actions</th>
                      <!--<th>Replied</th>
                      <th>Replied On</th>-->
                    </tr>
                  </thead>   
                  <tbody>
                    <?php 


                    foreach($emailtemplates as $emailtemplate) {
                      //$edit_url = base_url()."Manage_Jobs/create/".$emailtemplate->id;
                      $del_url = base_url()."Manage_email_templates/delete/".$emailtemplate->id;?>
                      <tr>
                        <td class="center"><?= $sr+1; ?></td>
                        
                        <td class="center"><?= $emailtemplate->Key ?></td>
                        
                        <td class="center"><?= $emailtemplate->Subject ?></td>
                        <td class="center"><code><?= $emailtemplate->Bodya ?></code></td>
                        <td class="center">
                        
                          <a onclick="delete_email_templates(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white trash"><span class="fa fa-trash-o"></span></i> 
                          </a> 
                          <a href="<?= base_url() ?>Manage_email_templates/create/<?= $emailtemplate->id ?>"  class="btn btn-primary" >
                            <i class="halflings-icon white trash"><span class="fa fa-pencil"></span></i> 
                          </a>
                        </td>
                      
                      </tr>
                    <?php $sr++; } ?>
                  </tbody>
                </table>
<?php echo $this->ajax_pagination->create_links(); ?>
<?php } ?>
