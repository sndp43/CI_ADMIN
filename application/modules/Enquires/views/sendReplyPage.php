<script>
function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var startDate = encodeURIComponent($('#startDate').val());
  var endDate = encodeURIComponent($('#endDate').val());
  var enquiryFor = $('#enquiryFor').val();
  // console.log(startDate + " " + endDate + " " + enquiryFor);
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
              <div class="form_detail">
                <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?= $this->session->flashdata("flash_messege") ?>
                </div>
                <?php } ?>
                <form id="enquiry_reply_form" method="post" action="<?= base_url()?>Enquires/enquiry_reply_form" onsubmit="return validateEnqFrom()">
                  <label>Reply To : <?= $data[0]->cfEmail ?></label><br />
                  <p id="check_mail_error" style="display:none;color:red"> Please Add Vaild Email ID or Keep it Blank </p>
                  <p class="cc_span"><strong>CC :</strong><input type="email" class="cc_name" name="tocc" id="tocc" data-role="tagsinput" onchange="checkcc(this)"></p>
                  <div class="row">
                  <label>Reply Type : <?= ($data[0]->productId == 0) ? "General Enquiry" : "Enquiry related product ".$data[0]->Product ?></label>
                  <input type="hidden" name="mName" value="<?= $data[0]->cfName ?>">
                  <input type="hidden" name="mEmail" value="<?= $data[0]->cfEmail ?>">
                  <input type="hidden" name="id" value="<?= $data[0]->id ?>">
                 <div class="row text_reply">
                  <textarea id="editor_reply" name="editor_reply"></textarea>
                  <script>
                    CKEDITOR.replace( 'editor_reply', {
                        height: 160,
                          //removePlugins: 'list,indent,indentblock,indentlist,link,about'
                          removePlugins: 'about'
                      
                    } );
                  </script>
                  </div>
                  <p id="showerror" style="display: none; color: red">Write something here to reply !</p>
                  <br />
                  <input type="submit" id="Manage_Jobs_Application_submit" value="Reply" class="btn btn-primary">
                  <a href="<?= base_url()?>Enquires/manage" class="btn btn-default">Cancel</a>
                   </div>
                </form>
              </div>
              
              
              <?php if($data[0]->replied == 1 && isset($rData) && count($rData) > 0) { ?>
            <div class="enquiry_log">
              <br /><h4>Enquiry Log</h4>
              <table class="table table-striped" >
                <th>Sr.</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>To Cc</th>
                <?php $i = 1; foreach ($rData as $data) { ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $data->subject ?></td>
                  <td><?= $data->message ?></td>
                  <td><?= $data->date ?></td>
                  <td><?= $data->cc ?></td>
                </tr>
                <?php } ?>
              </table>
            </div>
            <?php } ?>
            </div>
            
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>

</div>