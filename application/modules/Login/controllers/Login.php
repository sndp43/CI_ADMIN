<?php
class Login extends MX_Controller 
{

function __construct() { 
parent::__construct();
$this->load->module("Site_cookies");
$this->load->module("Site_security"); 

//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
//$this->load->library("Form_validation");
// $this->load->model("CommonModel");
//$this->Form_validation->CI =& $this;

$this->load->library('form_validation');
        $this->form_validation->CI =& $this;
}

function test1(){
  $your_name = "sandeep";
  $this->session->set_userdata('your_name',$your_name);
  //$this->session->set_userdata('is_admin',1);
  echo"the session variable set";


echo anchor("Login/test2","Get Session") ;
echo anchor("Login/test3","Destroy Session") ;

}

function test2(){
$your_name =  $this->session->userdata('your_name');
  if($your_name !=""){
    echo "<h1>Hello $your_name</h1>";
 }else{

  echo "no session fond";
 }

 echo anchor("Login/test1","Set Session") ;
 echo anchor("Login/test3","Destroy Session") ;

}


function test3(){
unset($_SESSION['your_name']);
echo"session destroyed";
echo anchor("Login/test1","Set Session") ;
echo anchor("Login/test2","Get Session") ;
echo anchor("Login/test3","Destroy Session") ;

}



function Logout() 
{    
      unset($_SESSION['is_admin']);
      $this->site_cookies->_destroy_cookie();
      unset($_SESSION[admin_session]);
      $admin_login = base_url()."Login";
      redirect($admin_login);

}



function index() 
{    


      if($this->site_security->_check_if_admin_has_loged_in()){
        redirect("Dashboard/home");
      }


      $data['email'] = $this->input->post('email',True);   
      $this->load->module('Templates');
      $this->templates->login($data);
}

function SubmitLogin() 
{     
      $submit = $this->input->post("submit",TRUE);
      if($submit="Submit"){
         $this->load->library('form_validation');
         $this->form_validation->set_rules('email','Email Address','required|callback_email_check');
         $this->form_validation->set_rules('pward','Password','required');

         if($this->form_validation->run()==TRUE){ 

               //   $col = 'email';
               //   $value = $this->input->post("email",TRUE);
               //   $query = $this->accounts->get_where_custom($col, $value) ;
               //   $num_rows =  $query->num_rows();
               //   foreach ($query->result() as $row) {    
               //         $user_id = $row->id;


               // }

               // $remembeme = $this->input->post("remember");

               // if($remembeme == "remember-me"){
               //  $login_type = "longterm";

               // }else{

               //   $login_type = "shortterm";

               // }


               ////now send to private page///

               //$this->_in_you_go($user_id,$login_type);

               $this->_in_you_go($this->input->post("email",TRUE)); 


           }else{

    $flash_messege =  validation_errors();
    $flash_error_class =  "alert alert-danger alert-dismissible";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
    redirect(base_url()."/Login");

           }
        }
    }


    function _in_you_go($email){  

    //set sessiion variable 
    
    $this->load->module("Accounts");
    $query = $this->accounts->get_where_custom_twocol('email', $email,'status',1);
    $data = $query->result();
    $role = $data[0]->role;

    switch ($role) {
      case 1:
        $this->session->set_userdata('is_admin','1');
        $this->session->set_userdata(admin_session, $data[0]);
        redirect("Dashboard/home"); 
        break;
      case 2:
        $this->session->set_userdata('is_user','1');
        $this->session->set_userdata(user_session, $data[0]);
        redirect(base_url()); 
    }
  
    //send user to private admin page
    
    //redirect("Accounts/manage"); 

    }   


 public function email_check($str){


$error_msg  = "Email Id or Password is invalid";
    $this->load->module('Accounts');
    $this->load->module('Site_security');

     $col = 'email';
     $value = $str;
     $query = $this->accounts->get_where_custom_twocol($col, $value,'status',1) ;
     $num_rows =  $query->num_rows();
if($num_rows<1){

$this->form_validation->set_message('email_check', $error_msg);
                        return FALSE;

}

foreach ($query->result() as $row) {
   $pward_on_tbl = $row->pward;

}

$pward = $this->input->post('pward',TRUE);
$result = $this->site_security->_verify_hash($pward,$pward_on_tbl); 
if($result == TRUE){

    return TRUE;
}else{

$this->form_validation->set_message('email_check', $error_msg );
                        return FALSE;

         }
    }
}