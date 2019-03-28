<?php
class Manage_email_templates extends MX_Controller 
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

function delete()
{
    
   //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();


    $delete_id = $this->uri->segment(3);
     if(is_numeric($delete_id)){
        //delete  from accounts

    $this->_delete($delete_id);


    $flash_messege =  "Template Deleted successfully";
    $flash_error_class =  "alert alert-success";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
         redirect("Manage_email_templates/manage");
          
          }
}

function manage() 
{
  $this->load->module('Site_security');
  $this->site_security->_make_sure_is_admin();

  $data = array();
   
  //total rows count
  $this->load->model('mdl_manage_email_templates');
  $totalRec = count($this->mdl_manage_email_templates->getEmailTemplates());
  
  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Manage_email_templates/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //get the posts data
  $data["emailtemplates"] = $this->mdl_manage_email_templates->getEmailTemplates(array('limit'=>$this->perPage));

  $data['sr'] = '0';
  
  //load the view
  $data['view_file'] = "manage";
  $data['title'] = "EmailTemplates";
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

  //total rows count
  $this->load->model('mdl_manage_email_templates');
  $totalRec = count($this->mdl_manage_email_templates->getEmailTemplates($conditions));


  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Manage_email_templates/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //set start and limit
  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;
  
  //get posts data
  $data['emailtemplates'] = $this->mdl_manage_email_templates->getEmailTemplates($conditions);
  
  //load the view
  $this->load->view('Manage_email_templates/manage_search', $data, false);
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
       redirect("Manage_email_templates/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){
       
         $data = $this->fetch_data_from_db($update_id);
     }else{ 
         
            $data = $this->fetch_data_from_post();
        
            $this->form_validation->set_rules('Key','Key','required');
            $this->form_validation->set_rules('Subject','Subject','required');
            $this->form_validation->set_rules('Bodya','Body','required');
  

         //$this->form_validation->set_rules("firstname","Firstname","required|max_length[240]|callback_item_title_check");  // to make callback work add few line in __construct line 8 ,9 ca be seen  + add My_Form_validation file in library folder 

          if($this->form_validation->run()== TRUE){
           
             if(is_numeric($update_id)){

               $data['updated_time'] = time();
               $data['updated_by'] = $this->session->userdata(admin_session)->id;

                ////update code ///
               $this->_update($update_id,$data);
               $flash_messege =  "<strong>Well done ! </strong>Email template updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_email_templates/create/".$update_id); 

             }else{

               $data['added_time'] = time();
               $data['added_by'] = $this->session->userdata(admin_session)->id;
                  //insert code //
               $this->_insert($data);
               $flash_messege =  "<strong>Well done ! </strong>Email template added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_email_templates/create/".$update_id);

    
             }
          } else {

           // $flash_messege =  "Cannot Update Empty fields !";
           // $flash_error_class =  "alert alert-danger";
           // $this->session->set_flashdata("flash_messege",$flash_messege);
           // $this->session->set_flashdata("flash_error_class",$flash_error_class);
          }
     }
   

     if(is_numeric($update_id)){
         $data['headline'] = "Update Email templates Details";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add new Email templates";
         $data['update_id'] = $update_id;
     }


    //$data['view_module'] = "Store_items";
    $data['view_file'] = "create";
    $data['title'] = "EmailTemplates";
    $this->load->module('Templates');
    $this->templates->admin($data);

}

function fetch_data_from_post()
{
    $data['Key'] = $this->input->post('Key',TRUE);
    $data['Subject'] = $this->input->post('Subject',TRUE);
    $data['Bodya'] = $this->input->post('Bodya',TRUE);

  
return $data;
}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
      $data['Key'] = $row->Key;
      $data['Subject'] = $row->Subject;
      $data['Bodya'] = $row->Bodya;

      return $data;
     
 }
}


function get($order_by) 
{
    $this->load->model('mdl_manage_email_templates');
    $query = $this->mdl_manage_email_templates->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_email_templates');
    $query = $this->mdl_manage_email_templates->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_email_templates');
    $query = $this->mdl_manage_email_templates->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_manage_email_templates');
    $query = $this->mdl_manage_email_templates->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_manage_email_templates');
    $this->mdl_manage_email_templates->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_email_templates');
    $this->mdl_manage_email_templates->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_email_templates');
    $this->mdl_manage_email_templates->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_manage_email_templates');
    $count = $this->mdl_manage_email_templates->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_manage_email_templates');
    $max_id = $this->mdl_manage_email_templates->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_manage_email_templates');
    $query = $this->mdl_manage_email_templates->_custom_query($mysql_query);
    return $query;
}

}