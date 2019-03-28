<?php if($Manage_style) { ?>
     <table width="100%" border="0">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Style</th>
                      <th>Description</th>
                      <th>Actions</th>
                      <!--<th>Replied</th>
                      <th>Replied On</th>-->
                    </tr>
                  </thead>   
                  <tbody>
                    <?php foreach($styles as $style) {
                      //$edit_url = base_url()."Manage_Jobs/create/".$style->id;
                      $del_url = base_url()."Manage_style/delete/".$style['id'];?>
                      <tr>
                        <td class="center"><?= $sr+1; ?></td>
                        
                        <td class="center"><?= $style['selected_css'] ?></td>
                        
                        <td class="center"><?= $style['style_desc'] ?></td>
                        
                        <td class="center">
                        
                          <a onclick="delete_style(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
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
