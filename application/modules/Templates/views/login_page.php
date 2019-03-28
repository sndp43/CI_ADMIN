<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url() ?>assets/adminfiles/favicon/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>assets/adminfiles/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url() ?>assets/adminfiles/css/signin.css" rel="stylesheet">
  </head>

  <body>
<?php 
$first_bit = $this->uri->segment(1);
$form_location = base_url().$first_bit."/SubmitLogin"; ?>
    <div class="container">
<?php  
         if( !null == $this->session->flashdata("flash_messege")) {
?>

<div class="<?= $this->session->flashdata("flash_error_class") ?>" role="alert">
  
  <center><?= $this->session->flashdata("flash_messege") ?></center>
</div>


<?php
       } ?>
      <form class="form-signin" method="post" action="<?= $form_location ?>">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="email" name="email" value="<?= $email ?>" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pward" id="pward" class="form-control" placeholder="Password" required>
          <?php if($first_bit == "useraccounts"){ ?>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div><?php } ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?= base_url() ?>assets/adminfiles/js/workaround.js"></script>
  </body>
</html>