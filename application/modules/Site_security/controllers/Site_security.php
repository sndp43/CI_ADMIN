<?php
class Site_security extends MX_Controller 
{

function __construct() {
parent::__construct();
}

// function test(){

// $name = "sandeep";
// $hashed_name = $this->_hash_string($name) ;

// $submited_name ="sandeep";
// $result = $this->_verify_hash($submited_name,$hashed_name);

// if($result){
//     echo"well done";

// }else{
//     echo"fail";
// }
// }
function index(){
$this->not_allowed();

}

function _check_admin_login_details($username,$pword){
$target_username = "admin";
$target_password = "password";

if(($username==$target_username) && ($pword == $target_password)){

return TRUE;

}else{

    return FALSE;
}

}


function _make_sure_logged_in(){


    $user_id = $this->_get_user_id();
    if(!is_numeric($user_id)){

        redirect('accounts/Login');
    }
}


function _make_sure_user_logged_in(){

$user_session = $this->session->userdata(user_session);
if($user_session !== null){
$user_id = $user_session->id;
}else{
  $user_id = 0;
}

    
    if(!is_numeric($user_id) || $user_id ==0){ 
        redirect('Home/Login');
    }
}


function _get_user_id(){

$user_id=$this->session->userdata('your_name');

if(is_numeric($user_id)){

  $this->load->module('site_cookies');
  $user_id = $this->site_cookies->_attempt_get_user_id();
 }
 return $user_id;
}



function test(){
$length = 32;
echo $this->GenerateRandomString($length);

}

function GenerateRandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));

    $key = "";
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}





function _hash_string($str) 
{
    $hased_string = password_hash($str,PASSWORD_BCRYPT,array(
         "cost"=>9 ));

    return $hased_string;
}

function _hash($string, $type = 'md5') 
{
   if($type == 'hash')
       {
            return substr(hash('sha512', $string.config_item('hash_encryption_key')), 0, 10);
       }
       else
       {
            return md5($string.config_item('encryption_key'));
       }
}


function _verify_hash($plain_string,$hased_string) 
{
     $result = password_verify($plain_string,$hased_string);
     return $result;
}


function _make_sure_is_admin() 
{
    $is_admin = $this->session->userdata('is_admin');
    if ($is_admin==1){

        return TRUE;

    }else{

           redirect('Site_security/not_allowed');
        
    }
    
}

function _check_if_admin_has_loged_in() 
{
    $is_admin = $this->session->userdata('is_admin');
    if ($is_admin==1){

        return TRUE;

    }else{

            return False;
        
    }
    
}


function not_allowed(){

    //echo"You are not allowed to be here";
    $this->load->view('not_allowed');
}


}