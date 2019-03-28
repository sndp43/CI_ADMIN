<?php
class Accounts extends MX_Controller 
{

function __construct() {
parent::__construct();


$this->load->library('Ajax_pagination');
$this->perPage = "5";
// $this->load->model("CommonModel");
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
$this->form_validation->CI =& $this;

}


// function test(){
//   $this->session->set_userdata('is_admin',1);


// }

 function verify_user($email) {
                $this->load->model('mdl_accounts');
         return $this->mdl_accounts->verify_user($email);
 }

function activate_user($id) {
    $this->load->model('mdl_accounts');
    $this->mdl_accounts->activate_user($id);
}

function deactivate_user($id) {
   $this->load->model('mdl_accounts');
   $this->mdl_accounts->deactivate_user($id);
}




function Profile() 
{
 //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_user_logged_in();


//get header info//

    $this->load->module("Manage_style");
    $dstyle = $this->manage_style->_get_style(); 

//set default style to session//
    $this->session->set_userdata("default_style",$dstyle);

    $styles = $this->manage_style->_get_all_styles();
    $data['dstyle'] = $dstyle;
    $data['styles'] = $styles;

//get header info end//

  //total rows count
  $this->load->model('mdl_accounts');
 
  //get the posts data
  $session_user_data = $this->session->userdata(user_session);
  $userid = $session_user_data->id;
  $user_query = $this->mdl_accounts->get_where($userid);
  $data["useraccountinfo"] = $user_query->result();

  //load the view
  $data['update_id'] = $userid;
  $data['view_file'] = "userprofile";
  $data['title'] = "User Profile";
  $this->load->module('Templates');
  $this->templates->home($data); 

}


function ProfileUpdate() 
{
$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
 //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_user_logged_in();

  //step 2 :: check update id in POST as well as in GET

    if(!null == $this->input->post("update_id",TRUE)){

           $update_id = $this->input->post("update_id",TRUE);
           $update_id = (int)$update_id ;
           
     }else{
          $update_id = $this->uri->segment(3);
     }



  if($REQUEST_METHOD == "POST"){

//form validation


            $this->form_validation->set_rules('firstname','Name','required');
            $this->form_validation->set_rules('telnum','Mobile Number','required');
           // $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim');

             $data = $this->fetch_data_from_post();
          if($this->form_validation->run()== TRUE){


          

           //update accounts
if(is_numeric($update_id)){
                
if (isset($_FILES['profilepic']['name']) && !empty($_FILES['profilepic']['name'])) {
                $data['profilepic']  = $this->upload_profile_pic($update_id);
 }else{
  unset($data['profilepic']);
 }


                unset($data['email']);
                unset($data['agree']);
                $data['role'] = 2;
                $pword = $this->input->post("password");

                if($pword !=""){

                  $data['pward'] =$this->site_security->_hash_string($pword);
                  //send mail to user for pass change
                $this->load->module("Common");
                $accounts_tbl = "accounts";
                $email_data = array(
                     "email"=>$this->common->get_user_email_where($update_id,$accounts_tbl),
                     "pword"=>$pword,
                     "fullName"=>$this->input->post("firstname")
                  );
                   $this->send_mail_to_user($email_data); 

                }else{
                  
                    unset($data['pward']);
                }

                $data['updated_time'] = time();
                $data['updated_by'] = $this->session->userdata(user_session)->id;
                ////update code ///

              
                $this->_update($update_id,$data); 
               
            
                $flash_messege =  "<strong>Well done ! </strong>Account updated successfully";
                $flash_error_class =  "alert alert-success";
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect(base_url()."Accounts/Profile"); 

      }else{ 
        redirect(base_url()."Accounts/Profile");
      }
    }
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


  //redirect  
  //total rows count
  $this->load->model('mdl_accounts');
  //get the posts data
  $session_user_data = $this->session->userdata(user_session);
  $userid = $session_user_data->id;
  $user_query = $this->mdl_accounts->get_where($userid);
  $data["useraccountinfo"] = $user_query->result();

  //load the view
  $data['update_id'] = $userid;
  $data['view_file'] = "userprofile";
  $data['title'] = "User Profile";
  $this->load->module('Templates');
  $this->templates->home($data); 

}



    public function upload_profile_pic($update_id) { 



        if (isset($_FILES['profilepic']['name']) && !empty($_FILES['profilepic']['name'])) {    
            $config['upload_path'] = './assets/homefiles/pics/profile';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size'] = ''; //kb
            $config['max_width'] = '';
            $config['max_height'] = '';
            $config['overwrite'] = false;

            $fdata = array();
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profilepic')) { 
                
                $sdata['error'] = $this->upload->display_errors();
                $this->session->set_userdata($sdata);
                $this->session->set_flashdata('profilepicerrorMessage', $sdata['error']);
               
                redirect('Accounts/Profile');

            } else {
                $fdata = $this->upload->data();
                $picture_name = $fdata['file_name'];
                return $picture_name;
            }
        } else {  
            $sdata['error'] = 'No file chosen !';
            $this->session->set_userdata($sdata);
            $this->session->set_flashdata('profilepicerrorMessage', $sdata['error']);
            redirect('Accounts/Profile');
        }
    }


    function remove_profile_pic(){

    $update_id = $this->input->post('update_id');
    $column_name = $this->input->post('column_name');
//get image
    $mysql_query = "Select $column_name from accounts where id = $update_id";
    $query = $this->_custom_query($mysql_query);
    $image = $query->row($column_name);

// delete image from folder
    if(unlink("assets/homefiles/pics/profile/".$image)) {
        //delete image from db
        $mysql_query = "Update accounts set $column_name = '' where id = '$update_id'";
        $query = $this->_custom_query($mysql_query);

    }
  }

function update_pword()
{  
    
   //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();

   //step 2 :: check update id in POST as well as in GET

    if(!null == $this->input->post("update_id",TRUE)){
          $update_id = $this->input->post("update_id",TRUE);
           $update_id = (int)$update_id ;
     }else{
          $update_id = $this->uri->segment(3);
     }
  

       $submit = $this->input->post('submit',TRUE);
       $cancel = $this->input->post('cancel',TRUE);
   // step3 :: get form data depending on action and if form is submited 
      //process the same 

      if($cancel == "Cancel"){
       redirect("Accounts/create/$update_id");

      }

     if(is_numeric($update_id)) {

           $this->load->module('Site_security');
           $pword = $this->input->post("password");
           $data['pward'] =$this->site_security->_hash_string($pword);
                   
                 
           $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[passconf]');
           $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

         //$this->form_validation->set_rules("firstname","Firstname","required|max_length[240]|callback_item_title_check");  // to make callback work add few line in __construct line 8 ,9 ca be seen  + add My_Form_validation file in library folder 
       

          if( $this->form_validation->run() == TRUE ) { //update code //
            $this->_update($update_id,$data);
            $flash_messege =  "Account Password updated successfully";
            $flash_error_class =  "alert alert-success";
            $this->session->set_flashdata("flash_messege",$flash_messege);
            $this->session->set_flashdata("flash_error_class",$flash_error_class);
            redirect("Accounts/create/".$update_id); 

          }
     }
   

   
         $data['headline'] = "Update Account Password";
         $data['update_id'] =$update_id;
    //$data['view_module'] = "Store_items";
    $data['view_file'] = "update_pword";
    $data['title'] = "Accounts";
    $this->load->module('Templates');
    $this->templates->admin($data);

}


function delete()
{
    
   //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();


    $delete_id = $this->uri->segment(3);
     if(is_numeric($delete_id)){
        //delete  from accounts

    $this->_delete($delete_id);


    $flash_messege =  "Account Deleted successfully";
    $flash_error_class =  "alert alert-success";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
         redirect("Accounts/manage");
          
          }
}

function manage() 
{
  $this->load->module('Site_security');
  $this->site_security->_make_sure_is_admin();

  $data = array();
   
  //total rows count
  $this->load->model('mdl_accounts');
  $totalRec = count($this->mdl_accounts->getAccounts());
  
  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Accounts/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //get the posts data
  $data["accounts"] = $this->mdl_accounts->getAccounts(array('limit'=>$this->perPage));

  $data['sr'] = '0';
  
  //load the view
  $data['view_file'] = "manage";
  $data['title'] = "Accounts";
  $this->load->module('Templates');
  $this->templates->admin($data); 

}

function manage_search() {

  $conditions = array();

  //calc offset number
  $page = $this->input->post('page');
  if(!$page) {
      $offset = 0;
  } else {
      $offset = $page;
  }

  $data['sr'] = $offset;

  //set conditions for search
  $search = urldecode($this->input->post('search'));
  $account_type = $this->input->post('account_type');

  if(!empty($search)){
      $conditions['search']['search'] = $search;
  }
  if(!empty($account_type)){
      $conditions['search']['account_type'] = $account_type;
  }
  
  //total rows count
  $this->load->model('mdl_accounts');
  $totalRec = count($this->mdl_accounts->getAccounts($conditions));


  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Accounts/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //set start and limit
  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;
  
  //get posts data
  $data['accounts'] = $this->mdl_accounts->getAccounts($conditions);
  
  //load the view
  $this->load->view('Accounts/manage_search', $data, false);
}


function create()
{ 



    // print_r($this->session->userdata()); exit;
   //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();

   //step 2 :: check update id in POST as well as in GET

    if(!null == $this->input->post("update_id",TRUE)){

           $update_id = $this->input->post("update_id",TRUE);
           $update_id = (int)$update_id ;
           
     }else{
          $update_id = $this->uri->segment(3);
     }
 

       $submit = $this->input->post('submit',TRUE);
       $cancel = $this->input->post('cancel',TRUE);
   // step3 :: get form data depending on action and if form is submited 
      //process the same 

      if($cancel == "Cancel"){
       redirect("Accounts/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){
       
         $data = $this->fetch_data_from_db($update_id);
     }else{ 
         
         $data = $this->fetch_data_from_post();
        
         


            $this->form_validation->set_rules('firstname','Name','required');
            //$this->form_validation->set_rules('lastname','Lastname','required');
            $this->form_validation->set_rules('role','Role','required');
            //$this->form_validation->set_rules('company','Company','required');
            //$this->form_validation->set_rules('address1','Address Line 1','required');
            //$this->form_validation->set_rules('address2','Address Line 2','required');
            //$this->form_validation->set_rules('town','Town','required');
            //$this->form_validation->set_rules('country','Country','required');
            //$this->form_validation->set_rules('postcode','Postcode','required');
            //$this->form_validation->set_rules('telnum','Telephone number','required');
            $this->form_validation->set_rules('email','Email','required');
            //$this->form_validation->set_rules('agree','Agree','required');
      



         //$this->form_validation->set_rules("firstname","Firstname","required|max_length[240]|callback_item_title_check");  // to make callback work add few line in __construct line 8 ,9 ca be seen  + add My_Form_validation file in library folder 
       



          if($this->form_validation->run()== TRUE){
           
             if(is_numeric($update_id)){

               $data['updated_time'] = time();
               $data['updated_by'] = $this->session->userdata(admin_session)->id;

                ////update code ///
               $this->_update($update_id,$data);
               $flash_messege =  "<strong>Well done ! </strong>Account updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Accounts/create/".$update_id); 

             }else{

               $data['added_time'] = time();
               $data['added_by'] = $this->session->userdata(admin_session)->id;
                  //insert code //
               $data['profilepic'] = '';
               $this->_insert($data);
               $flash_messege =  "<strong>Well done ! </strong>Account added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Accounts/create/".$update_id);

    
             }
          } else {
           // $flash_messege =  "Cannot Update Empty fields !";
           // $flash_error_class =  "alert alert-danger";
          //  $this->session->set_flashdata("flash_messege",$flash_messege);
          //  $this->session->set_flashdata("flash_error_class",$flash_error_class);
          }
     }
   

     if(is_numeric($update_id)){
         $data['headline'] = "Update Account Details";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add new Account";
     }


          //$mysql_query = "select * from role where id != 1";
          $mysql_query = "select * from role";
          $query = $this->_custom_query($mysql_query);
          $data['roles'] = $query->result();


    //$data['view_module'] = "Store_items";
    $data['view_file'] = "create";
    $data['title'] = "Accounts";
    $this->load->module('Templates');
    $this->templates->admin($data);

}

function fetch_data_from_post()
{
    $data['firstname'] = $this->input->post('firstname',TRUE);
    //$data['lastname'] = $this->input->post('lastname',TRUE);
    $data['role'] = $this->input->post('role',TRUE);
    //$data['company'] = $this->input->post('company',TRUE);
    //$data['address1'] = $this->input->post('address1',TRUE);
    //$data['address2'] = $this->input->post('address2',TRUE);
    //$data['town'] = $this->input->post('town',TRUE);
    //$data['country'] = $this->input->post('country',TRUE);
    //$data['postcode'] = $this->input->post('postcode',TRUE);
    $data['telnum'] = $this->input->post('telnum',TRUE);
    $data['email'] = $this->input->post('email',TRUE);
    $data['country_abbreviation'] = $this->input->post('country_abbreviation',TRUE);
    $data['country_code_num'] = $this->input->post('country_code_num',TRUE);
    $data['agree'] = ($this->input->post('agree',TRUE) == "on") ? "1" : "0";
    $data['profilepic'] = $this->input->post('profilepic',TRUE);
return $data;
}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
      $data['firstname'] = $row->firstname;
      //$data['lastname'] = $row->lastname;
      $data['role'] = $row->role;
      //$data['company'] = $row->company;
      //$data['address1'] = $row->address1;
      //$data['address2'] = $row->address2;
      //$data['town'] = $row->town;
      //$data['country'] = $row->country;
     // $data['postcode'] = $row->postcode;
        $data['telnum'] = $row->telnum;
        $data['email'] = $row->email;
        $data['country_code_num'] = $row->country_code_num;
        $data['country_abbreviation'] = $row->country_abbreviation;
        $data['agree'] = $row->agree;
        $data['profilepic'] = $row->profilepic;
      return $data;
     
 }
}

function get($order_by) 
{
    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->get_where_custom($col, $value);
    return $query;
}


function get_where_custom_twocol($col, $value,$col1, $value1) 
{
    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->get_where_custom_twocol($col, $value,$col1, $value1) ;
    return $query;
}


function get_where_custom_col_three($col, $value,$col1, $value1,$col2, $value2)
{
    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->get_where_custom_col_three($col, $value,$col1, $value1,$col2, $value2) ;
    return $query;
}



function _insert($data)
{
    $this->load->model('mdl_accounts');
    $this->mdl_accounts->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_accounts');
    $this->mdl_accounts->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_accounts');
    $this->mdl_accounts->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_accounts');
    $count = $this->mdl_accounts->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_accounts');
    $max_id = $this->mdl_accounts->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_accounts');
    $query = $this->mdl_accounts->_custom_query($mysql_query);
    return $query;
}



function autogen(){

$mysql_query = "show columns from drl_accounts";
$query = $this->_custom_query($mysql_query);


foreach ($query->result() as $row) {
    $coloumn_name = $row->Field;
    if($coloumn_name !="accounts_id"){

echo '$data[\''.$coloumn_name.'\'] = $this->input->post(\''.$coloumn_name.'\',TRUE)<br>';


    }
    
}
echo"<hr>";

foreach ($query->result() as $row) {
    $coloumn_name = $row->Field;
    if($coloumn_name !="accounts_id"){

echo '$data[\''.$coloumn_name.'\'] = $row->'.$coloumn_name.'<br>';


    }
    
}



/*
foreach ($query->result() as $row) {
    $coloumn_name = $row->Field;
    if($coloumn_name !="id"){


             $var = '<div class="control-group">
                <label class="control-label" for="'.$coloumn_name.'">'.ucfirst($coloumn_name).'</label>
                <div class="controls">
                <input type="text" name="'.$coloumn_name.'" value="<?= $'.$coloumn_name.' ?>" class="span6 typeahead" id="'.$coloumn_name.'">
                 </div>
                               <label class="control-label" for="'.$coloumn_name.'_err"></label>
                                <div class="help-inline" style="color:red;">
                <?= form_error("'.$coloumn_name.'")  ?> 
                  </div>
              </div>';


              echo htmlentities($var);
              echo"<br>";


    }
    
} */



// foreach ($query->result() as $row) {
//     $coloumn_name = $row->Field;
//     if($coloumn_name !="id"){

//             echo"set_rules('$coloumn_name','".ucfirst($coloumn_name)."','required')"; 
//             echo"<br>";
      
//   }
//  }

}


 public function getAccountsExport() {
       $Search_Type = ($this->input->post("SearchType"))? $this->input->post("SearchType") : "NIL";
        
        $this->load->model('mdl_accounts');
        $conditions['search']['account_type'] = $Search_Type;
        $totalRec = $this->mdl_accounts->getAccounts($conditions);
    
        foreach ($totalRec as $data) {
          if($data->FacebookId != ''){
            $type = 'facebook user';
          }
          else if($data->GoogleId != ''){
            $type = 'Google user';
          }
          else{
            $type = 'Normal user';
          }
          $this->load->module('Timedate');
          $date_c= $this->timedate->get_nice_date($data->added_time,'datepicker');
          $data->added_time;
            $arrangeData['First Name'] = trim($data->firstname);
            //$arrangeData['Last Name'] = trim($data->lastname);
            $arrangeData['User Type'] = $type;
            $arrangeData['Date Created'] =$date_c;
            $dataToExports[] = $arrangeData;
        }
       
        // set header
        $filename = "Account-list.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $this->exportExcelData($dataToExports);
    }

     private function exportExcelData($records) {
        $heading = false;
        if (!empty($records)) {
            foreach ($records as $row) {
                if (!$heading) {
                    // display field/column names as a first row
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", ($row)) . "\n";
            }
        }
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
    $flash_error_class =  "alert alert-danger";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
    redirect(base_url()."Login");

           }
        }
    }



function RegisterFBUser($userData) {
  $this->load->model('mdl_accounts');
  $returnData = $this->mdl_accounts->RegisterFBUser($userData);
  return $returnData;
}
function RegisterGPUser($userData) {
  $this->load->model('mdl_accounts');
  $returnData = $this->mdl_accounts->RegisterGPUser($userData);
  return $returnData;
}


function check_email() {
       $email = $this->input->post("email");
       $id = $this->input->post("id");
    if($id !=""){ 
          $mysql_query = "select * from accounts where email = '$email' and id != $id ";
}else{
      $mysql_query = "select * from accounts where email = '$email'";

}

    
    $query = $this->_custom_query($mysql_query) ;
     //echo $query->num_rows();
     //echo $this->db->last_query();
    if($query->num_rows()>0) {
        echo 'false';
    } else {
        echo 'true';
    }
  }



function check_email_forgot() {
       $email = $this->input->post("email");

      $mysql_query = "select * from accounts where email = '$email'";

    $query = $this->_custom_query($mysql_query) ;
     //echo $query->num_rows();
     //echo $this->db->last_query();
    if($query->num_rows()>0) {
        echo 'true';
    } else {
        echo 'false';
    }
  }



function check_telnum() {

       $telnum = $this->input->post("telnum");
       $id = $this->input->post("id");

if($id !=""){
          $mysql_query = "select * from accounts where telnum = '$telnum' and id != $id ";
}else{
          $mysql_query = "select * from accounts where telnum = '$telnum'";
}

    
    $query = $this->_custom_query($mysql_query) ;
     //echo $query->num_rows();
     //echo $this->db->last_query();
    if($query->num_rows()>0) {
        echo 'false';
    } else {
        echo 'true';
    }
  }

function send_mail_to_user($email_data){

                        $this->load->module("Common");
                        $this->load->module("Templates");
                        $this->load->library("Mail");

                        $email = $email_data['email'];
                        $pword = $email_data['pword'];
                        $fullName = $email_data['fullName'];
                       

                        // send mail
                        $emailData = $this->common->GetEmailTemplate('WEBSITE_USER_SUCCESSFUL_PASSWORD_RESET');
                   
                        $subject = $emailData->Subject; 
                        $body = $emailData->Bodya;

                        $body = str_replace("#Name#", ucwords($fullName), $body);
                        $body = str_replace("#password#", $pword, $body);
                        $body = str_replace("#projectname#", get_appname(), $body);


                        $data = array(
                            'body' => $body,
                        );

                       $body = $this->templates->email_temp($data);
                       $to = $email;
                       $from="";
                       $this->mail->send($body,$to,$from,$subject,$attach = null,$tocc=null);


 }

public function importUsers() {
   
      
        $limit_cars = 1000;

      
        $filename=$_FILES["import_file"]["tmp_name"];
        $i=0;
        if($_FILES["import_file"]["size"] > 0)
          {
 
             // Check Cloumn Name Start

             $files1 = fopen($filename, "r");
             $importdatas = fgetcsv($files1, 1000, ",");
             for($y=0;$y<11;$y++){
                 // echo $importdatas[$y];exit;
                    if(isset($importdatas[$y])){

                        if($y==0){
                            
                            if($importdatas[$y] != 'first name'){
                                
                                //$this->session->set_flashdata('AdminMessages', "1CSV/Excel broken or not defined properly");
                               // redirect('Admin/Car');
                              echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==1){
                            if($importdatas[$y] != 'last name'){
                                echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==2){
                            if($importdatas[$y] != 'role'){
                               echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }

                        if($y==3){
                            if($importdatas[$y] != 'company'){
                                echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==4){
                            if($importdatas[$y] != 'address1'){
                                echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }

                        if($y==5){
                            if($importdatas[$y] != 'address2'){
                               echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==6){
                            if($importdatas[$y] != 'town'){
                               echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==7){
                            if($importdatas[$y] != 'country'){
                                echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==8){
                            if($importdatas[$y] != 'postcode'){
                                echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==9){
                            if($importdatas[$y] != 'telnum'){
                               echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
                        if($y==10){
                            if($importdatas[$y] != 'email'){
                               echo "1CSV/Excel broken or not defined properly";exit;
                            }  
                        }
  
                    }
                    else{
                        // echo "asd";exit;
                         echo "1CSV/Excel broken or not defined properly";exit;
                    }
                   
                    
                }
                fclose($files1);
// Check Cloumn Name End




             $file = fopen($filename, "r");
             while (($importdata = fgetcsv($file, 1000, ",")) !== FALSE)
             { 

                 $i++;

                if($i==1){
                    continue;
                }
                $x=0;
                if($response=$this->CarModel->checkUniqueTitle($importdata[0])){
                    $x++;
                    $data1=array(
                         'user_id' =>$UserId,
                         'car_name' =>$importdata[0],
                         'car_description' =>$importdata[1],
                         'pros' =>$importdata[2],
                         'cons' =>$importdata[3],
                         'MFG_yaer' =>$importdata[4],
                         'modelYear' =>$importdata[5],
                         'Price' =>$importdata[6],
                         'comp_c1' =>$importdata[7],
                         'comp_c2' =>$importdata[8],
                         'comp_c3' =>$importdata[9],
                         'Comment' => $response

                        );

                         $dataToExports[] = $data1;
                            continue;
                }
                else{
                    $data = array(
                         'user_id' =>$UserId,
                         'car_name' =>$importdata[0],
                         'car_description' =>$importdata[1],
                         'pros' =>$importdata[2],
                         'cons' =>$importdata[3],
                         'MFG_yaer' =>$importdata[4],
                         'modelYear' =>$importdata[5],
                         'Price' =>$importdata[6],
                         'active' =>'0',
                         'date' =>date('Y-m-d H:i:s'),
                         'comp_c1' =>$importdata[7],
                         'comp_c2' =>$importdata[8],
                         'comp_c3' =>$importdata[9],
                         'Excel' =>'1',
                         'make_name' =>'1',
                         'model_name' =>'1',
                         );

                }
                      $insert = $this->CarModel->insertImportData($data); 
            }

                if(isset($dataToExports)){

                    $filename = "Failed_Data.xls";
                    header("Content-Type: application/vnd.ms-excel");
                    header("Content-Disposition: attachment; filename=\"$filename\"");
                    $this->exportExcelData($dataToExports);  
                }
                else{
                
                  $this->index();  
                }
                }
       
              fclose($file);
          
                   
             }             

}