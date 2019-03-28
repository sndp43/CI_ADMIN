<script>
function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var startDate = encodeURIComponent($('#startDate').val());
  var endDate = encodeURIComponent($('#endDate').val());
  var enquiryFor = $('#enquiryFor').val();
  var fromDash = $('#fromDash').val();
  // console.log(startDate + " " + endDate + " " + enquiryFor);
  if(!fromDash) {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Enquires/manage_search/'+page_num,
      data:'page='+page_num+'&enquiryFor='+enquiryFor+'&startDate='+startDate+'&endDate='+endDate,
      beforeSend: function () {
         $('.loading').show();
      },
      success: function (html) {
        $('#postList').html(html);
         $('.loading').fadeOut("slow");
      }
    });
  } else {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Enquires/unViewedEnquiries_search/fromDash/'+page_num,
      data:'page='+page_num+'&enquiryFor='+enquiryFor+'&startDate='+startDate+'&endDate='+endDate,
      beforeSend: function () {
         $('.loading').show();
      },
      success: function (html) {
        $('#postList').html(html);
         $('.loading').fadeOut("slow");
      }
    });
  }
}
</script>
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
          <h2><span>Manage Enquires</span></h2>
          <ul>
            <li><a href="<?= base_url()?>Dashboard/home">Dashboard</a></li>
            <li><a href="#"><?= $headline ?></a></li>
          </ul>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gap detail mCustomScrollbar _mCS_4s">
            <?php if(isset($enquires) && !empty($enquires)) { ?>
              <div class="form_detail manage_form" >
                <input type="hidden" id="fromDash" name="fromDash" value="<?php echo $this->uri->segment(3); ?>" />
                <input type="text" id="startDate" name="startDate" class="datepicker" placeholder="Start Date" onchange="searchFilter()" />
                <input type="text" id="endDate" name="endDate" class="datepicker" placeholder="End Date" onchange="searchFilter()" />
                 
                <select id="enquiryFor" class="select_div" name="enquiryFor" onchange="searchFilter()">
                  <option value="All">Select Request For</option>
                  <!-- <?php foreach($enquiresFor as $enquiryFor) { 
                    if($enquiryFor->productId == 0) {
                    ?> -->
                  <option value="zero">General Enquires</option>
                  <?php } else { ?>
                  <option value="1"><?= "Product Enquires" ?></option>
                  <option value="2"><?= "Hosting Enquires" ?></option>
                  <!-- <?php }
                    }
                  ?> -->
                </select>

                
                <!-- for export functionality add below code only start 
                 <button id='DLtoExcel'>Export Data to Excel</button>
                for export functionality add below code only end -->


               <!--  <?php echo anchor('Manage_Jobs/create', 'Add New Jobs', array('class'=>'btn btn-small btn-success','title' => 'Add New Accounts'));  ?> -->
               <!--  <input type="text" name="search" placeholder="Search..">
                <input type="button" value="Search"> -->
                
                <div id="postList">
                <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?= $this->session->flashdata("flash_messege") ?>
                </div>



                
                <?php } ?>
                <table width="100%" border="0">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Request For</th>
                      <th>Request On Date</th>
                      <th>Phone</th>
                      <th>Message</th>
                      <th>Actions</th>
                      <th>Replied</th>
                      <th>Replied On</th>
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
                        <td class="center">
<?php if(isset($enquire['Product'])) {
            echo $enquire['Product'];
            } else if($enquire['productId'] != 0) {
              echo "N/A";
            } else if($enquire['hosting_solutions']) {
              echo $enquire['hosting_solutions'];
              } else {
                echo "General";
                }?> 

                        <!-- <?= isset($enquire['Product']) ? $enquire['Product'] : ($enquire['productId'] != 0) ? "N/A" : isset($enquire['hosting_solutions']) ? $enquire['hosting_solutions'] : "General" ?> -->
                          


                        </td>
                        <?php
                        //date_default_timezone_set('Asia/Calcutta'); 
                         $myDateTime = new DateTime($enquire['dateAdded']) ?>
                        <td class="center"><?= date_format($myDateTime, 'd M Y'); ?></td>
                        <td class="center"><?= $enquire['cfPhone'] ?></td>
                        <td class="center"><?= strlen($enquire['cfMsg']) > 80 ? substr($enquire['cfMsg'],0,80)."..." : $enquire['cfMsg']; ?></td>
                    
                        <td class="center">
                          <!-- <a class="btn btn-info" href="<?= $edit_url ?>">
                            <i class="halflings-icon white edit"><span class="fa fa-pencil"></span></i>  
                          </a> -->
                          <form method="post" action="<?=base_url()?>Enquires/replyEnq">
                            <input type="hidden" name="id" value="<?=$enquire['id']?>">
                            <button class="btn btn-info"><span class="fa fa-reply"></button>
                          </form>
                          <a onclick="delete_enquiry(this)" id="delete_user" class="btn btn-danger delete_user" data-del-url="<?= $del_url ?>">
                            <i class="halflings-icon white trash"><span class="fa fa-trash-o"></span></i> 
                          </a> 
                        </td>
                        <td>
                          <?php if($enquire['repliedOn'] != "0000-00-00 00:00:00") { ?>
                          <i class=""><span class="fa fa-thumbs-o-up" id="thumb-<?= $enquire['id']; ?>"></span></i>
                          <?php } else { ?>
                          <i class=""><span class="fa fa-thumbs-down" id="thumb-<?= $enquire['id']; ?>"></span></i>
                          <?php } ?>
                          <i class=""><span class="fa fa-thumbs-o-up" id="thumb-show-<?= $enquire['id']; ?>" style="display: none"></span></i>
                        </td>
                        <td id="date-ab-<?= $enquire['id'];?>">
                          <?php if($enquire['repliedOn'] != "0000-00-00 00:00:00") { ?>
                          <i class=""><?php echo $enquire['repliedOn']; ?></i>
                          <?php } ?>
                          <?php $myDateTime = new DateTime($enquire['repliedOn']) ?>
                          <td class="center" style="display: none" id="date-af-<?= $enquire['id']; ?>"><?= date_format($myDateTime, 'd M Y'); ?></td>
                        </td>
                      </tr>
                    <?php $sr++; } ?>
                  </tbody>
                </table>
                <?php echo $this->ajax_pagination->create_links(); ?>
                </div>
                
              </div>
              <?php } else { echo "<br />No enquiries to view !"; } ?>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- for export functionality add below code only start -->
  <script src="<?= base_url() ?>assets/adminfiles/global/vendor/jquery/jquery.js"></script>
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

