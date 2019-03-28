<?php
class Manage_social extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('Ajax_pagination');
$this->perPage = 20;
$this->load->model('mdl_manage_social');
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
// $this->load->model("CommonModel");
$this->form_validation->CI =& $this;

}

function manage() {

  $this->load->module('Site_security');
  $this->site_security->_make_sure_is_admin();

  $data['headline'] = "Manage Social Settings";

  $update_id   = (count($this->_get_update_id()->result()) == 0) ? 0 : $this->_get_update_id()->result()[0]->id ;
  //load the view
  $data['update_id'] = $update_id ;

if($update_id>0){
 $data['data'] = $this->fetch_data_from_db($update_id);
}else{
   $data['data'] = $this->fetch_data_from_post();
}


// echo"<pre>";
// print_r($data); exit;
  $data['activetab'] = "fb";
  $data['title'] = "Social Settings";
  $data['view_file'] = "manage";
  $this->load->module('Templates');
  $this->templates->admin($data);


}

function _get_update_id(){

  $query = $this->mdl_manage_social->_get_update_id();
return $query;
}


function create_fb()
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
       redirect("Manage_social/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){

       
         $data = $this->fetch_data_from_db($update_id);
         // echo $this->db->last_query();
         // echo "<pre>"; print_r($data);exit;
     }else{ 
                    $data = $this->fetch_data_from_post();
        
                    $this->form_validation->set_rules('fbapi_key','API Key','required');
                    $this->form_validation->set_rules('fbapp_secret','Client Secret','required');

      
          if($this->form_validation->run() == TRUE){

             if(is_numeric($update_id)){

                ////update code ///
           
                $data['updated_time '] = time();
                $admin_session = $this->session->userdata(admin_session);
                $data['updated_by'] =  $admin_session->id;

               $this->_updatefb($update_id,$data);
               $flash_messege =  "Facebook Settings updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_social/create_fb/".$update_id); 

             }else{
   
               
                  ////insert code ///
                $data['added_time '] = time();
                $admin_session = $this->session->userdata(admin_session);

                $data['added_by'] = $admin_session->id;
               $this->_insert($data);
               $flash_messege =  "Facebook Settings added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_social/create_fb/".$update_id);

            }
          }else{
        }
     }
   

     if(is_numeric($update_id)){

         $data['headline'] = "Update Social Settings";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add New Social Setting";
     }
// echo"<pre>";
// print_r($data); exit;


    //$data['view_module'] = "Store_items";
      $data['activetab'] = "fb";
     $data['title'] = "Social Setting";
    $data['view_file'] = "manage";
    $this->load->module('Templates');
    $this->templates->admin($data);

}



function create_gp()
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
       redirect("Manage_social/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){

       
         $data = $this->fetch_data_from_db($update_id);
         // echo $this->db->last_query();
         // echo "<pre>"; print_r($data);exit;
     }else{ 
          $data = $this->fetch_data_from_post();
        
          $this->form_validation->set_rules('gpapplication_name','Application Name','required');
             $this->form_validation->set_rules('gpapi_key','API Key','required');
                $this->form_validation->set_rules('gpclient_secret','Client Secret','required');
                   $this->form_validation->set_rules('gpclient_id','Client ID','required');
      
          if($this->form_validation->run() == TRUE){

          
             if(is_numeric($update_id)){

                $data['updated_time'] = time();
                $admin_session = $this->session->userdata(admin_session);
                $data['updated_by'] =  $admin_session->id;

               $this->_updategp($update_id,$data);
               $flash_messege =  "Google Settings updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_social/create_gp/".$update_id); 

             }else{
   
              
                  ////insert code ///
                $data['added_time'] = time();
                $admin_session = $this->session->userdata(admin_session);

                $data['added_by'] = $admin_session->id;
               $this->_insert($data);
               $flash_messege =  "Google Settings added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_social/create_gp/".$update_id);

            }
          }else{
        }
     }
   

     if(is_numeric($update_id)){

         $data['headline'] = "Update Social Settings";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add New Social Setting";
     }




    //$data['view_module'] = "Store_items";
    $data['activetab'] = "gp";
    $data['title'] = "Social";
    $data['view_file'] = "manage";
    $this->load->module('Templates');
    $this->templates->admin($data);

}


function fetch_data_from_post_gp()
{
      
      $data['gpapplication_name'] = trim($this->input->post('gpapplication_name',TRUE));
      $data['gpclient_secret'] = trim($this->input->post('gpclient_secret',TRUE));
      $data['gpclient_id'] = trim($this->input->post('gpclient_id',TRUE));
      $data['gpredirect_uri'] = trim($this->input->post('gpredirect_uri',TRUE));
      $data['gpapi_key'] = trim($this->input->post('gpapi_key',TRUE));

return $data;
}

function fetch_data_from_db_gp($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
     
         $data['gpapplication_name'] = trim($row->gpapplication_name);
         $data['gpclient_secret'] = trim($row->gpclient_secret);
         $data['gpclient_id'] = trim($row->gpclient_id);
         $data['gpredirect_uri'] = trim($row->gpredirect_uri);
         $data['gpapi_key'] = trim($row->gpapi_key);
      return $data;
     
 }
}

function fetch_data_from_post()
{
      
      $data['gpapplication_name'] = trim($this->input->post('gpapplication_name',TRUE));
      $data['gpclient_secret'] = trim($this->input->post('gpclient_secret',TRUE));
      $data['gpclient_id'] = trim($this->input->post('gpclient_id',TRUE));
      $data['gpredirect_uri'] = trim($this->input->post('gpredirect_uri',TRUE));
      $data['gpapi_key'] = trim($this->input->post('gpapi_key',TRUE));
      $data['fbapi_key'] = trim($this->input->post('fbapi_key',TRUE));
      $data['fbapp_secret'] = trim($this->input->post('fbapp_secret',TRUE));
return $data;

}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
     
         $data['gpapplication_name'] = trim($row->gpapplication_name);
         $data['gpclient_secret'] = trim($row->gpclient_secret);
         $data['gpclient_id'] = trim($row->gpclient_id);
         $data['gpredirect_uri'] = trim($row->gpredirect_uri);
         $data['gpapi_key'] = trim($row->gpapi_key);
         $data['fbapi_key'] = trim($row->fbapi_key);
         $data['fbapp_secret'] = trim($row->fbapp_secret);
      return $data;
     
 }
}


function fetch_data_from_post_fb()
{
  
      $data['fbapi_key'] = trim($this->input->post('fbapi_key',TRUE));
      $data['fbapp_secret'] = trim($this->input->post('fbapp_secret',TRUE));
      $data['fbapi_key'] = trim($row->fbapi_key);
      $data['fbapp_secret'] = trim($row->fbapp_secret);

return $data;
}

function fetch_data_from_db_fb($update_id)
{

 $query = $this->get_where($update_id);
 foreach($query->result() as $row)
 {   
     
         $data['fbapi_key'] = trim($row->fbapi_key);
         $data['fbapp_secret'] = trim($row->fbapp_secret);
         
      return $data;
     
 }
}



function get($order_by) 
{
    $this->load->model('mdl_manage_social');
    $query = $this->mdl_manage_social->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_social');
    $query = $this->mdl_manage_social->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_social');
    $query = $this->mdl_manage_social->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_manage_social');
    $query = $this->mdl_manage_social->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_manage_social');
    $this->mdl_manage_social->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_social');
    $this->mdl_manage_social->_update($id, $data);
}



function _updatefb($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_social');
    $this->mdl_manage_social->_updatefb($id, $data);
}




function _updategp($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_social');
    $this->mdl_manage_social->_updategp($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_social');
    $this->mdl_manage_social->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_manage_social');
    $count = $this->mdl_manage_social->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_manage_social');
    $max_id = $this->mdl_manage_social->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_manage_social');
    $query = $this->mdl_manage_social->_custom_query($mysql_query);
    return $query;
}



function autogen(){

$mysql_query = "show columns from store_accounts";
$query = $this->_custom_query($mysql_query);


foreach ($query->result() as $row) {
    $coloumn_name = $row->Field;
    if($coloumn_name !="store_accounts_id"){

echo '$data[\''.$coloumn_name.'\'] = $this->input->post(\''.$coloumn_name.'\',TRUE)<br>';


    }
    
}
echo"<hr>";

foreach ($query->result() as $row) {
    $coloumn_name = $row->Field;
    if($coloumn_name !="store_accounts_id"){

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

}