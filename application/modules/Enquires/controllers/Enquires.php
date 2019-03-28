<?php
class Enquires extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('Ajax_pagination');
$this->perPage = 20;
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
$this->load->library("mail");
$this->load->model('mdl_enquires');
$this->load->module('Home');
// $this->load->model("CommonModel");
$this->form_validation->CI =& $this;

}


function delete()
{
    
   //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();


    $delete_id = $this->uri->segment(3);
     if(is_numeric($delete_id)){
        //delete  from store_accounts

    $this->_delete($delete_id);


    $flash_messege =  "Enquiry Deleted successfully";
    $flash_error_class =  "alert alert-danger";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
         redirect("Enquires/manage");
          
          }
}

function manage() {
  $this->load->module('Site_security');
  $this->site_security->_make_sure_is_admin();

  $data = array();
   
  //total rows count
  $totalRec = count($this->mdl_enquires->getEnquiries());
  
  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Enquires/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //get the posts data
  $data["enquires"] = $this->mdl_enquires->getEnquiries(array('limit'=>$this->perPage));
  $data['enquiresFor'] = $this->mdl_enquires->getEnquiriesForlist();
   //<!-- for export functionality add below code only start -->
  $data["json_enquires"] = json_encode($this->mdl_enquires->getEnquiries());
   //<!-- for export functionality add below code only end -->

  // echo "<pre>"; print_r($data['enquiresFor']); exit;
  $data['sr'] = '0';
  $data['headline'] = "Manage Enquiries";
  
  //load the view
  $data['title'] = "Enquiries";
  $data['view_file'] = "manage";
  $this->load->module('Templates');
  $this->templates->admin($data); 
}


function contactInsert() {

            $this->form_validation->set_rules('cfName','Name','required');
            $this->form_validation->set_rules('cfEmail','Email','required');
            $this->form_validation->set_rules('cfPhone','Phone Number','required');
            $this->form_validation->set_rules('terms','Terms and conditions','required');
 if($this->form_validation->run()== TRUE){
           
    $data=array(
        'cfName' => $this->input->post('cfName'),
        'cfEmail' => $this->input->post('cfEmail'),
        'cfPhone' => $this->input->post('cfPhone'),
        'cfMsg' => $this->input->post('cfMsg'),
        'terms' => ($this->input->post('terms') == "on") ? 1 : 0
        );

     $this->_insert($data);


    //send mail to user
   
     $body_template['message'] = "Thank you for contacting us. Our team will reach you shortly.";
 
   
     $body_template['name'] =  $this->input->post('cfName');

     $this->load->module('Templates');
     $body=$this->templates->email($body_template);
   
    $to = $this->input->post('cfEmail');    //user's email
    $websiteData = $this->session->userdata(WebSiteSession);
    $from = $websiteData->FromEmail;  //admin's email
    $subject = "Enquiry";
    $this->mail->send($body,$to,$from,$subject);   //Uncomment

    //send mail to admin
    $body = "Contact Form Enquiry";
    $to = $websiteData->FromEmail;    //admin's email
    $from = $this->input->post('cfEmail');  //user's email
    $subject = "Enquiry";
    $this->mail->send($body,$to,$from,$subject);   //Uncomment
    //echo true;
  }

    $this->home->contact();

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

  $startDate = urldecode($this->input->post('startDate'));
  $endDate = urldecode($this->input->post('endDate'));

  if(!empty($startDate)){
      $conditions['search']['startDate'] = $startDate;
  }
  if(!empty($endDate)){
      $conditions['search']['endDate'] = $endDate;
  }
  
  //total rows count
  $totalRec = count($this->mdl_enquires->getEnquiries($conditions));

  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Enquires/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //set start and limit
  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;
  
  //get posts data
  $data['enquires'] = $this->mdl_enquires->getEnquiries($conditions);
  $data['enquiresFor'] = $this->mdl_enquires->getEnquiriesForlist();
  //<!-- for export functionality add below code only start -->
  $data["json_enquires"] = json_encode($this->mdl_enquires->getEnquiries($conditions));
   //<!-- for export functionality add below code only end -->
  //load the view
  $this->load->view('Enquires/manage_search', $data, false);
}




function fetch_data_from_post()
{
    $data['title'] = $this->input->post('title',TRUE);
    $data['description'] = $this->input->post('description',TRUE);
    $data['technical_skills'] = $this->input->post('technical_skills',TRUE);

return $data;
}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
      $data['title'] = $row->title;
      $data['description'] = $row->description;
      $data['technical_skills'] = $row->technical_skills;

      return $data;
     
 }
}

function get($order_by) 
{

    $this->load->model('mdl_enquires');
    $query = $this->mdl_enquires->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_enquires');
    $query = $this->mdl_enquires->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_enquires');
    $query = $this->mdl_enquires->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_enquires');
    $this->mdl_enquires->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_enquires');
    $this->mdl_enquires->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_enquires');
    $this->mdl_enquires->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_accounts');
    $count = $this->mdl_store_accounts->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_enquires');
    $max_id = $this->mdl_enquires->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->_custom_query($mysql_query);
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