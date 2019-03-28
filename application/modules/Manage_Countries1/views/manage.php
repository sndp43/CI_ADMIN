<script>
function searchFilter(page_num) {
  
  page_num = page_num?page_num:0;
  
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Manage_Countries/manage_search/'+page_num,
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
        <small>Countries</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Countries</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Countries</h3>

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
  	    <?php echo anchor('Manage_Countries/create', 'Add New Country', array('class'=>'btn btn-small btn-success add_manage'));  ?>

<form action="<?php echo base_url(); ?>Manage_Countries/import" method="post" name="upload_excel" enctype="multipart/form-data">
<input type="file" name="file" id="file">
<input type="submit" name="import" value="Import" class="btn btn-primary button-loading">
</form>	
<a href="<?php echo base_url(); ?>assets/adminfiles/samplecsvfile/counries_sample.csv"> Sample csv file </a>
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


            <?php if(isset($countries) && !empty($countries)) { ?>
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
               <div class="box-footer clearfix"> 
              <?php echo $this->ajax_pagination->create_links();  ?> </div><?php }
           
                  else {
                    echo "No Countries to view";
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

    </section>