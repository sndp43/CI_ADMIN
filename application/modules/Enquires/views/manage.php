<script>
function searchFilter(page_num) {
  
  page_num = page_num?page_num:0;
  var startDate = encodeURIComponent($('#startDate').val());
  var endDate = encodeURIComponent($('#endDate').val());
 

   console.log(startDate + " " + endDate );
  
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Enquires/manage_search/'+page_num,
      data:'page='+page_num+'&startDate='+startDate+'&endDate='+endDate,
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
       Manage
        <small>Enquires</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       
        <li class="active">Enquires</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Enquires</h3>
          
           

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="startDate" name="startDate" class="datepicker" placeholder="Start Date" onchange="searchFilter()">
                </div>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="endDate" name="endDate" class="datepicker" placeholder="End Date" onchange="searchFilter()">
                </div>

                 
                <!-- for export functionality add below code only start 
                 <button id='DLtoExcel'>Export Data to Excel</button>
                for export functionality add below code only end -->


               <!--  <?php echo anchor('Manage_Jobs/create', 'Add New Jobs', array('class'=>'btn btn-small btn-success','title' => 'Add New Accounts'));  ?> -->
               <!--  <input type="text" name="search" placeholder="Search..">
                <input type="button" value="Search"> -->



        </div>
        <div class="box-body">
        
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
             <div class="col-sm-12 col-lg-12 col-md-12">
             
             </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div id="postList">

             <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?= $this->session->flashdata("flash_messege") ?>
                </div>

                <?php } ?>


            <?php if(isset($enquires) && !empty($enquires)) { ?>
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
               <div class="box-footer clearfix"> 
              <?php echo $this->ajax_pagination->create_links();  ?> </div><?php }
           
                  else {
                    echo "No enquiries to view";
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




 