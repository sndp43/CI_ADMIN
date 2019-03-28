<?php
class Templates extends MX_Controller 
{

function __construct() {
parent::__construct();
}
function test()
{ $data = "";
    $this->admin($data);
}

function login($data)
{ 


	if(!isset($data['view_module'])){
 	$data['view_module'] = $this->uri->segment(1);

 }
     $this->load->view("login_page1",$data);
}


  function admin($data)
 {   
 	if(!isset($data['view_module'])){
 	$data['view_module'] = $this->uri->segment(1);

 }
     $this->load->view("gm_admin",$data);
    
 } 
  function email($data)
 { 
    return $email_body= $this->load->view("email/thank_you",$data,true);
 }

 function email_temp($data)
 { 
    return $email_body= $this->load->view("email/email",$data,true);
 }

  function home($data)
 {
 	if(!isset($data['view_module'])){
 	$data['view_module'] = $this->uri->segment(1);

 }    $data['view_file'];
      $data['view_module'];
     $this->load->view("home",$data);
    
 }

}