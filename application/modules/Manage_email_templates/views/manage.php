<script>
function searchFilter(page_num) {
  
  page_num = page_num?page_num:0;
  
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Manage_email_templates/manage_search/'+page_num,
      data:'page='+page_num,
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

<section class="content-header">
      <h1>
        Manage
        <small>Email templates</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Email templates</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Email templates</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

<div class="row">
<div class="col-md-12">
  
  <div class="box-body">
  	    <?php echo anchor('Manage_email_templates/create', 'Add New Email templates', array('class'=>'btn btn-small btn-success add_manage'));  ?>	

</div>
  
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
             <div class="col-sm-12 col-lg-12 col-md-12">
            
            <!-- /.box-header -->
            <div class="box-body">
            <div id="postList">

             <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?= $this->session->flashdata("flash_messege") ?>
                </div>

                <?php } ?>


            <?php if(isset($emailtemplates) && !empty($emailtemplates)) { ?>
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
                      $del_url = base_url()."Manage_email_templates/delete/".$emailtemplate->id; ?>
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
               <div class="box-footer clearfix"> 
              <?php echo $this->ajax_pagination->create_links();  ?> </div><?php }
           
                  else {
                    echo "No Email templatess to view";
                  }
                  ?>
            </div>
            </div>
          </div>

</div>
</div>

</div>
</div>
    
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>