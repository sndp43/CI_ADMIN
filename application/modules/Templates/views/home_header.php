<!DOCTYPE html>
<html>
<head>
  <title>Simple Login</title>
<?php 
$user_session = $this->session->userdata(user_session);
if($user_session !== null){
$user_id = $user_session->id;
}else{
  $user_id = 0;
}

?>

<?php 

$session_style = $this->session->userdata('session_style');

if(!null == $session_style && $session_style != ""){
  ?>
<link rel="stylesheet" id="style_dyna" href="<?= base_url() ?>assets/homefiles/css/custom/<?= $session_style ?>" />
  <?php 
$current_style = $session_style;

}else{
  ?>
<link rel="stylesheet" id="style_dyna" href="<?= base_url() ?>assets/homefiles/css/custom/<?= $dstyle ?>" />
  <?php
  $current_style = $dstyle;
}
?>
  
  <link rel="stylesheet" href="<?=  base_url()  ?>assets/homefiles/css/intltellinput/intlTelInput.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script type="text/javascript" src="<?= base_url() ?>assets/homefiles/js/lib/jquery-1.11.1.js"></script>
  <script src="<?= base_url() ?>assets/homefiles/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/homefiles/js/dist/jquery.validate.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/homefiles/css/sharetastic.css"/>
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <script src="<?= base_url() ?>assets/homefiles/js/sharetastic.js"></script>
    <style type="text/css">
    .thumb{
    margin: 10px 5px 0 0;
    width: 100px;
}
  </style>
</head>
<body>

      <!-- Modal -->
<div class="modal fade" id="my_dynamic_model_id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="mydynamiv_model_label">Modal title</h4>
          </div>
          <div id="mydynamiv_model_body" class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a id="mydynamiv_model" href="" class="btn btn-danger" data-animal-type="bird">
                    <i class="halflings-icon white trash"><span class="fa fa-trash-o"></span></i> 
                  </a>
             <!-- <button type="button" class="btn btn-danger">Confirm</button> -->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<!-- Modal for confirmation end-->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Simple Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">

      <!-- <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url() ?>Login/Logout">Logout <span class="sr-only">(current)</span></a>
        </li>
      </ul> -->
     <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url() ?>Home/Register">Register <span class="sr-only">(current)</span></a>
        </li>
        <?php  if( $user_id == 0 || $user_id == "" ){ ?>
          
          <li class="nav-item active">
          <a class="nav-link" href="<?= base_url() ?>Home/Login">Login <span class="sr-only">(current)</span></a>
         </li>

          <?php }else{ ?>
           
          <li class="nav-item active">
           <a class="nav-link" href="<?= base_url() ?>Home/Logout">Logout <span class="sr-only">(current)</span></a>
          </li>
           <li class="nav-item active">
           <a class="nav-link" href="<?= base_url() ?>Accounts/Profile">My Profile<span class="sr-only">(current)</span></a>
          </li>
           <?php } ?>
        
      </ul>

  </div>
   <div class="form-group">
    <select class="custom-select" id="csschange">
      <!-- <option value="" >Select Style</option> -->
<?php 

 foreach ($styles as $style) {
?> 
<option  <?php if($style['selected_css'] == $current_style ){ echo "selected"; } ?>    id="style<?= $style['id']  ?>" value="<?= $style['id']  ?>"  ><?= $style['selected_css']  ?></option>
<?php 
 }
 
    ?>
    </select>
  <!--   <input type="text" name="default_style" id="default_style" value="<?= $dstyle ?>"> -->
  </div>
</nav>
<div class="container">
