<script>
function searchFilter(page_num) {
  
  page_num = page_num?page_num:0;
  var startDate = encodeURIComponent($('#startDate').val());
  var endDate = encodeURIComponent($('#endDate').val());
 

   console.log(startDate + " " + endDate );
  
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Manage_style/manage_search/'+page_num,
      data:'page='+page_num+'&search='+search,
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
        <small>Style</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>Dashboard/home"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Style</li>
      </ol>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Style</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         <?php

$style_array = array();
if ($handle = opendir('./assets/homefiles/css/custom')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            array_push($style_array, $entry);
        }
    }

    closedir($handle);
}




          ?>

<div class="row">
<div class="col-md-12">
  
  <div class="box-body">
  	    <?php echo anchor('Manage_style/create', 'Add New Style', array('class'=>'btn btn-small btn-success add_manage'));  ?>	

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


            <?php if(isset($styles) && !empty($styles)) { ?>
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
                          <a href="<?= base_url() ?>Manage_style/create/<?= $style['id'] ?>"  class="btn btn-primary" >
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
                    echo "No Styles to view";
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