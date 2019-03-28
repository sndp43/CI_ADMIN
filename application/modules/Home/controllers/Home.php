<?php
class Home extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->module("Site_cookies");
$this->load->module("Site_security");
$this->load->module("Accounts");
$this->load->module("Invite");
$this->load->module("Manage_style");
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
$this->form_validation->CI =& $this;
}

function index(){

//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

    $data['view_module'] = "Home";
    $data['view_file'] = "home";
    $data['title'] = "Home";
     //get the posts data

    $this->load->module('Templates');
    $this->templates->home($data);

}

function contact(){
//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

    $data['view_module'] = "Home";
    $data['view_file'] = "contact";
    $data['title'] = "Contact";
     //get the posts data

    $this->load->module('Templates');
    $this->templates->home($data);

}

// function register(){
// //get header info//

//     $this->load->module("Manage_style");
//     $dstyle = $this->manage_style->_get_style(); 

// //set default style to session//
//     $this->session->set_userdata("default_style",$dstyle);

//     $styles = $this->manage_style->_get_all_styles();
//     $data['dstyle'] = $dstyle;
//     $data['styles'] = $styles;

// //get header info end//

//     $data['view_module'] = "Home";
//     $data['view_file'] = "register";
//     $data['title'] = "Register";
//      //get the posts data

//     $this->load->module('Templates');
//     $this->templates->home($data);

// }


function forgot_pass(){
//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

    $data['view_module'] = "Login";
    $data['view_file'] = "forgot_pass";
    $data['title'] = "Forgot Password";

//get the posts data

    $this->load->module('Templates');
    $this->templates->home($data);

}


function forgot_pass_submit(){

      $submit = $this->input->post("submit",TRUE);

      if($submit="Submit"){

         $this->load->library('form_validation');
         $this->form_validation->set_rules('email','Email Address','required');

         if($this->form_validation->run()==TRUE){ 
            

            $email = $this->input->post("email");
           $this->send_mail_to_user_forgot_pass($email);

           }else{ 

             $flash_messege =  validation_errors();
             $flash_error_class =  "alert alert-danger alert-dismissible";
             $this->session->set_flashdata("flash_messege",$flash_messege);
             $this->session->set_flashdata("flash_error_class",$flash_error_class);
             redirect(base_url()."Home/forgot_pass");

           }
        }
}


function Login(){
//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

    $data['view_module'] = "Home";
    $data['view_file'] = "login";
    $data['title'] = "Login";
     //get the posts data

    $this->load->module('Templates');
    $this->templates->home($data);

}



function subscribe(){ 
//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

    $data['view_module'] = "Home";
    $data['view_file'] = "subscribe";
    $data['title'] = "Subscribe";

//get the posts data

    $this->load->module('Templates');
    $this->templates->home($data);

}




function Verify(){

          $this->load->module("Accounts");
          $this->load->module("Common");
          $HashEmail = $this->uri->segment(3); 
          $hashPass = $this->uri->segment(4);
         
         $table = "tbl_emailverification";
         $emaildata = $this->common->get_where_custom_2col("hased_email", $HashEmail,"status",1,$table);
       
         if($emaildata->num_rows() >0){



         $email = $emaildata->result()[0]->email;
         $id = $emaildata->result()[0]->id;
         $hased_pass = $emaildata->result()[0]->hased_pass;

         //$emaildata = $this->common->_delete($id,$table);
         $accounts_tbl="accounts";
         $result = $this->common->Get_hash_value($email,$accounts_tbl); //get the hash value which belongs to given email from database
      
         if($hashPass != ""){ 

            if($hased_pass==$hashPass)  //check whether the input hash value matches the hash value retrieved from the database
                { 
                if($this->accounts->verify_user($email)){

                   //update accounts  mail verification status 1 ie. done of the user as verified
                  $this->common->update_email_verification_ckeck_done($email,$accounts_tbl);

                  //update tbl_emailverification  status 0 ie. done of the user as verified
                  $tbl_emailverification = "tbl_emailverification";
                  $this->common->update_eemailverification_ckeck_done($email,$tbl_emailverification);

                  $this->_in_you_go($email);
                } //update the status of the user as verified
                /*---Now you can redirect the user to whatever page you want---*/
            }
          }else{
            redirect(base_url());
          }
        
}else{

                $flash_messege =  "<strong>Notice! </strong>Email already verified";
                $flash_error_class =  "alert alert-success";
               //$update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect(base_url());
}
}



function Register()
{   


       $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
       $submit = $this->input->post('submit',TRUE);
       $cancel = $this->input->post('cancel',TRUE);
   // step3 :: get form data depending on action and if form is submited 
      //process the same 

  $data = $this->fetch_data_from_post();
        if($REQUEST_METHOD=="POST"){ 

            $this->form_validation->set_rules('firstname','Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required|min_length[3]');
            $this->form_validation->set_rules('passconf','Confirm Password','trim|required|matches[password]');
            $this->form_validation->set_rules('agree','Policy','trim|required');
            $this->form_validation->set_rules('regcapcha','Capcha','trim|required');
            $this->form_validation->set_rules('hiddencaptcha','Capcha','trim|required|matches[regcapcha]');
       
          if($this->form_validation->run()== TRUE){
               $email = $this->input->post('email',TRUE);
               $pword = $this->input->post("password");
               $data['pward'] =$this->site_security->_hash_string($pword);
               $data['added_time'] = time();
               $data['role'] = 2;
               $usertype = get_usertype($data['role']); 
               //$data['added_by'] = $this->session->userdata(user_session)->id;
                  //insert code //
                $this->accounts->_insert($data);
                //send mail to admin start //

               //for email verification hase pass and email
                $hased_pword = $this->site_security->_hash($pword);
                $hased_email = $this->site_security->_hash($email);


                $email_data = array(
                     "email"=>$email,
                     "hased_email"=>$hased_email,
                     "pword"=>$this->input->post("password"),
                     "hased_pword"=>$hased_pword,
                     "usertype"=>$usertype,
                     "fullName"=>$this->input->post("firstname")
                  );

                $email_verification_data = array(
                      "email"=>$email,
                      "hased_pass"=>$hased_pword,
                      "hased_email"=>$hased_email,
                      'added_time' => time()
                  );


                $this->send_mail_to_admin($email_data);

                //send mail to admin end //
                //send mail to user start //

                
                 $this->send_mail_to_user($email_data);
                 $this->add_emailverification($email_verification_data);
                //send mail to user end //

               $flash_messege =  "<strong>Well done ! </strong>Account added successfully";
               $flash_error_class =  "alert alert-success";
               //$update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);

                //redirect("Home/thankyou/".$update_id);
          } else { 
           // $flash_messege =  "Cannot Update Empty fields !";
           // $flash_error_class =  "alert alert-danger";
          //  $this->session->set_flashdata("flash_messege",$flash_messege);
          //  $this->session->set_flashdata("flash_error_class",$flash_error_class);
          }
     // }
    }

//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//
    $data['headline'] = "Register";
    $data['view_module'] = "Home";
    $data['view_file'] = "register";
    $data['title'] = "Register";
    $this->load->module('Templates');
    $this->templates->home($data);

}

function add_emailverification($email_data){

$table = "tbl_emailverification";
$this->load->module("Common");
$this->common->_insert($email_data,$table);
$this->db->last_query(); 
}

function Logout() 
{    
     
      unset($_SESSION['is_user']);
      $this->site_cookies->_destroy_cookie();
      unset($_SESSION[user_session]);
      $user_login = base_url()."Home/Login";
      redirect($user_login);

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
    redirect(base_url()."Home/Login");

           }
        }
    }

    function _in_you_go($email){  
    //set sessiion variable 
    $this->session->set_userdata('is_admin','1');
    $this->load->module("Accounts");
    $query = $this->accounts->get_where_custom_twocol('email', $email,'status',1);
    $data = $query->result();


    //$this->session->set_userdata(admin_session, $data[0]);

    $this->session->set_userdata(user_session, $data[0]);
  
    //send user to private admin page
    redirect(base_url()); 
    //redirect("Accounts/manage"); 
    }   


 public function email_check($str){


$error_msg  = "Email Id or Password is invalid";
    $this->load->module('Accounts');
    $this->load->module('Site_security');

     $col = 'email';
     $value = $str;
     $query = $this->accounts->get_where_custom_col_three($col, $value,"status",1,"role", 2);
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



 public function email_check_fp($str){


$error_msg  = "Email Id or Password is invalid";
    $this->load->module('Accounts');
    $this->load->module('Site_security');

     $col = 'email';
     $value = $str;
     $query = $this->accounts->get_where_custom($col, $value,"status");
     $num_rows =  $query->num_rows();
   
if($num_rows<1){

$this->form_validation->set_message('email_check_fp', $error_msg);
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

$this->form_validation->set_message('email_check_fp', $error_msg );
      return FALSE;
 }
}

public function thankyou(){
    $data['view_file'] = "thankyou";
    $data['title'] = "Thank you";
    $this->load->module('Templates');
    //$this->templates->admin($data);

}

function fetch_data_from_post()
{
    $data['firstname'] = $this->input->post('firstname',TRUE);
    $data['country_code_num'] = $this->input->post('country_code_num',TRUE);
    $data['country_abbreviation'] = $this->input->post('country_abbreviation',TRUE);
    $data['telnum'] = $this->input->post('telnum',TRUE);
    $data['email'] = $this->input->post('email',TRUE);
    $data['pward'] = $this->input->post('password',TRUE);
    $data['agree'] = ($this->input->post('agree',TRUE) == "on") ? 1 :0;

return $data;
}


function send_mail_to_admin($email_data){
                    
                        $this->load->module("Common");
                        $this->load->module("Templates");
                        $this->load->library("Mail");

                        $email = $email_data['email'];
                        $hased_email = $email_data['hased_email'];
                        $pword = $email_data['pword'];
                        $hased_pword = $email_data['hased_pword'];
                        $usertype = $email_data['usertype'];
                        $fullName = "Admin";
                       

                        // send mail
                        $emailData = $this->common->GetEmailTemplate('WEBSITE_USER_REGISTRATION_INFORM_ADMIN');
                   
                        $subject = $emailData->Subject . ' ' . $usertype; 
                        $body = $emailData->Bodya;

                        $resetUrl = base_url() . 'Home/Verify/'.$hased_email."/".$hased_pword;
                        $body = str_replace("#admin#", ucwords($fullName), $body);
                        $body = str_replace("#email#", $email, $body);
                        $body = str_replace("#projectname#", get_appname(), $body);


                        $data = array(
                            'body' => $body,
                        );

                       $body = $this->templates->email_temp($data);
                       $to = "";         //change this to admin mail
                       $from=$email;
                       $this->mail->send($body,$to,$from,$subject,$attach = null,$tocc=null);
}

function send_mail_to_user($email_data){

                        $this->load->module("Common");
                        $this->load->module("Templates");
                        $this->load->library("Mail");

                        $email = $email_data['email'];
                        $hased_email = $email_data['hased_email'];
                        $pword = $email_data['pword'];
                        $hased_pword = $email_data['hased_pword'];
                        $usertype = $email_data['usertype'];
                        $fullName = $email_data['fullName'];
                       

                        // send mail
                        $emailData = $this->common->GetEmailTemplate('WEBSITE_USER_REGISTRATION_VERIFY');
                   
                        $subject = $emailData->Subject . ' ' . $usertype; 
                        $body = $emailData->Bodya;

                        $resetUrl = base_url() . 'Home/Verify/'.$hased_email."/".$hased_pword;
                        $body = str_replace("#fullname#", ucwords($fullName), $body);
                        $body = str_replace("#username#", $email, $body);
                        $body = str_replace("#Password#", $pword, $body);
                        $body = str_replace("#link#", $resetUrl, $body);
                        $body = str_replace("#projectname#", get_appname(), $body);


                        $data = array(
                            'body' => $body,
                        );

                       $body = $this->templates->email_temp($data);
                       $to = $email;
                       $from="";
                       $this->mail->send($body,$to,$from,$subject,$attach = null,$tocc=null);


 }



function send_mail_to_user_forgot_pass($email){

                        $this->load->module("Common");
                        $this->load->module("Templates");
                        $this->load->library("Mail");


//ENTRY IN TBL 








                        $col = "email";
                        $value = $email;
                        $table = "accounts";
                        $userdata_query = $this->common->get_where_custom($col,$value,$table);
                        $fullName = $userdata_query->result()[0]->firstname;
                        $hased_email = $this->site_security->_hash($email);

                        // send mail
                        $emailData = $this->common->GetEmailTemplate('WEBSITE_USER_PASSWORD_RESET');
                   
                        $subject = $emailData->Subject; 
                        $body = $emailData->Bodya;

                        $resetUrl = base_url() . 'Home/Reset/'.$hased_email;

                        $body = str_replace("#Name#", ucwords($fullName), $body);
                        $body = str_replace("#link#", $resetUrl, $body);
                        $body = str_replace("#projectname#", get_appname(), $body);


                        $data = array(
                            'body' => $body,
                        );

                       $body = $this->templates->email_temp($data);
                       $to = $email;
                       $from="";
                       $this->mail->send($body,$to,$from,$subject,$attach = null,$tocc=null);


 }


 function Reset(){

   $email_hased = $this->uri->segment(1);
   $email = $this->get_mail_by_hased_mail($email_hased);
   $data['email'] = $email;
   
//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

    $data['view_module'] = "Home";
    $data['view_file'] = "resetpass";
    $data['title'] = "Reset Password";

//get the posts data

    $this->load->module('Templates');
    $this->templates->home($data);

}
}