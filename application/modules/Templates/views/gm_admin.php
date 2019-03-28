<?php 
include"gm_admin_header.php";
?>
<?php   
// echo $view_module;
// echo $view_file;exit;

$this->load->view($view_module.'/'.$view_file);
?>
<?php 
include"gm_admin_footer.php";
?>