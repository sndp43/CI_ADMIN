<?php if($enquires) { ?>
    <table width="100%" border="0">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Name</th>
                      <th>Email</th>
                     
                      <th>Request On Date</th>
                      <th>Phone</th>
                      <th>Message</th>
                      <th>Actions</th>
                      <!--<th>Replied</th>
                      <th>Replied On</th>-->
                    </tr>
                  </thead>   
                  <tbody>
                    <?php foreach($enquires as $enquire) {
                      //$edit_url = base_url()."Manage_Jobs/create/".$enquire->id;
                      $del_url = base_url()."Enquires/delete/".$enquire['id'];?>
                      <tr>
                        <td class="center"><?= $sr+1; ?></td>
                        <td class="center"><?= $enquire['cfName'] ?></td>
                        <td class="center"><?= $enquire['cfEmail'] ?></td>
                    
                        <?php
                        //date_default_timezone_set('Asia/Calcutta'); 
                         $myDateTime = new DateTime($enquire['dateAdded']) ?>
                        <td class="center"><?= date_format($myDateTime, 'd M Y'); ?></td>
                        <td class="center"><?= $enquire['cfPhone'] ?></td>
                        <td class="center"><?= strlen($enquire['cfMsg']) > 80 ? substr($enquire['cfMsg'],0,80)."..." : $enquire['cfMsg']; ?></td>
                    
                        <td class="center">
                        
                          <a onclick="delete_enquiry(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white trash"><span class="fa fa-trash-o"></span></i> 
                          </a> 
                        </td>
                      
                      </tr>
                    <?php $sr++; } ?>
                  </tbody>
                </table>
<?php echo $this->ajax_pagination->create_links(); ?>
<?php } ?>

<!-- for export functionality add below code only start -->

    <script type="text/javascript" src="<?= base_url() ?>assets/adminfiles/js/excelexportjs/excelexportjs.js"></script>
  <script>

  $(function(){

  //assuming you have a json data as above
  var data = <?= $json_enquires ?>
          
  
  var $btnDLtoExcel = $('#DLtoExcel');
    $btnDLtoExcel.on('click', function () { 
        $("#dvjson").excelexportjs({
                    containerid: "dvjson"
                       , datatype: 'json'
                       , dataset: data
                       , columns: getColumns(data)     
                });

    });
  });  

  
</script>

<!-- for export functionality add below code only end -->
