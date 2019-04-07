<?php
class Manage_Countries1 extends MX_Controller 
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

function check_country_name() {

       $country_name = $this->input->post("country_name");
 $id = ($this->input->post("id") == "") ? 0 : $this->input->post("id") ;
    if($id !="" && $id !=0){ 
          $mysql_query = "select * from tbl_countries where country_name = '$country_name' and id != $id ";
}else{
      $mysql_query = "select * from tbl_countries where country_name = '$country_name'";

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

  function check_currancy_code() {

       $currancy_code = $this->input->post("currancy_code");
      $id = ($this->input->post("id") == "") ? 0 : $this->input->post("id") ;

       
    if($id !="" && $id !=0){ 
          $mysql_query = "select * from tbl_countries where currancy_code = '$currancy_code' and id != $id ";
}else{
          $mysql_query = "select * from tbl_countries where currancy_code = '$currancy_code'";

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


  function check_country_code() {

       $country_code = $this->input->post("country_code");
      $id = ($this->input->post("id") == "") ? 0 : $this->input->post("id") ;
       
    if($id !="" && $id !=0){ 
          $mysql_query = "select * from tbl_countries where country_code = '$country_code' and id != $id ";
}else{
      $mysql_query = "select * from tbl_countries where country_code = '$country_code'";

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

function delete()
{
    
   //step 1 :: sequrity check
    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();


    $delete_id = $this->uri->segment(3);
     if(is_numeric($delete_id)){
        //delete  from accounts

    $this->_delete($delete_id);


    $flash_messege =  "Country Deleted successfully";
    $flash_error_class =  "alert alert-success";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
         redirect("Manage_Countries/manage");
          
          }
}

public function import(){
  $admin_user = $this->session->userdata(admin_session)->id; 
  if(null != $this->input->post("import"))
    { 
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
            $file = fopen($filename, "r");
            $count = 0;
             while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
             {      

             $count++;
             if ($count == 1) { continue; }else{

              $data = array(
                        'country_name' => strtolower(trim($importdata[0])),
                        'country_code' => "+".strtolower(trim($importdata[1])),
                        'currancy_code' => strtolower(trim($importdata[2])),
                        'added_by' => $admin_user,
                        'added_time' => time(),
                        );

                 //check if already exist country_name,country_code,currancy_code
                  $country_name_query = $this->get_where_custom("country_name", strtolower(trim($importdata[0])));
                   $country_name_count = $country_name_query->num_rows();
                  if($country_name_count>0){


                    $country_data = $country_name_query->result();
                    $country_id = $country_data[0]->id;
                   
                     $this->_update($country_id,$data);
                  }else{ 
                     $this->_insert($data);
                  }
                  
             }
           }                    
            fclose($file);

                $flash_messege =  "<strong>Well done ! </strong>Countries added/updated successfully";
                $flash_error_class =  "alert alert-success";
                $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_Countries/manage");
          }else{

                $flash_messege =  "Failed to import!";
                $flash_error_class =  "alert alert-danger";
                $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_Countries/manage");
    }
  }
}

function manage() 
{
  $this->load->module('Site_security');
  $this->site_security->_make_sure_is_admin();

  $data = array();
   
  //total rows count
  $this->load->model('mdl_manage_Countries1');
  $totalRec = count($this->mdl_manage_Countries1->getCountries());
  
  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Manage_Countries/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //get the posts data
  $data["countries"] = $this->mdl_manage_Countries1->getCountries(array('limit'=>$this->perPage));

  $data['sr'] = '0';
  
  //load the view
  $data['view_file'] = "manage";
  $data['title'] = "Countries";
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
  $this->load->model('mdl_manage_Countries1');
  $totalRec = count($this->mdl_manage_Countries1->getCountries($conditions));


  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Manage_Countries/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //set start and limit
  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;
  
  //get posts data
  $data['countries'] = $this->mdl_manage_Countries1->getCountries($conditions);
  
  //load the view
  $this->load->view('Manage_Countries/manage_search', $data, false);
}



function create()
{ 

     // country from sandeep modak2
    // country 22
    //added comment
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
       redirect("Manage_Countries/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){
       
         $data = $this->fetch_data_from_db($update_id);
     }else{ 
         
            $data = $this->fetch_data_from_post();
        
            $this->form_validation->set_rules('country_name','Country Name','required');
            $this->form_validation->set_rules('country_code','Country Code','required');
            $this->form_validation->set_rules('currancy_code','Currancy Code','required');
  

         //$this->form_validation->set_rules("firstname","Firstname","required|max_length[240]|callback_item_title_check");  // to make callback work add few line in __construct line 8 ,9 ca be seen  + add My_Form_validation file in library folder 

          if($this->form_validation->run()== TRUE){
           
             if(is_numeric($update_id)){

               $data['updated_time'] = time();
               $data['updated_by'] = $this->session->userdata(admin_session)->id;

                ////update code ///
               $this->_update($update_id,$data);
               $flash_messege =  "<strong>Well done ! </strong>Country updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_Countries/create/".$update_id); 

             }else{

               $data['added_time'] = time();
               $data['added_by'] = $this->session->userdata(admin_session)->id;
                  //insert code //
               $this->_insert($data);

               $flash_messege =  "<strong>Well done ! </strong>Country added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_Countries/create/".$update_id);

    
             }
          } else {

           // $flash_messege =  "Cannot Update Empty fields !";
           // $flash_error_class =  "alert alert-danger";
           // $this->session->set_flashdata("flash_messege",$flash_messege);
           // $this->session->set_flashdata("flash_error_class",$flash_error_class);
          }
     }
   

     if(is_numeric($update_id)){
         $data['headline'] = "Update Country";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add new Country";
         $data['update_id'] = $update_id;
     }


    //$data['view_module'] = "Store_items";
    $data['view_file'] = "create";
    $data['title'] = "Countries";
    $this->load->module('Templates');
    $this->templates->admin($data);

}

function fetch_data_from_post()
{
    $data['country_code'] = $this->input->post('country_code',TRUE);
    $data['country_name'] = $this->input->post('country_name',TRUE);
    $data['currancy_code'] = $this->input->post('currancy_code',TRUE);

  
return $data;
}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
      $data['country_code'] = $row->country_code;
      $data['country_name'] = $row->country_name;
      $data['currancy_code'] = $row->currancy_code;

      return $data;
     
 }
}


function get($order_by) 
{
    $this->load->model('mdl_manage_Countries1');
    $query = $this->mdl_manage_Countries1->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_Countries1');
    $query = $this->mdl_manage_Countries1->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_Countries1');
    $query = $this->mdl_manage_Countries1->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_manage_Countries1');
    $query = $this->mdl_manage_Countries1->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_manage_Countries1');
    $this->mdl_manage_Countries1->_insert($data);
}
function _insertcountry($data)
{
    $this->load->model('mdl_manage_Countries1');
    $this->mdl_manage_Countries1->_insertcountry($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_Countries1');
    $this->mdl_manage_Countries1->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_manage_Countries1');
    $this->mdl_manage_Countries1->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_manage_Countries1');
    $count = $this->mdl_manage_Countries1->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_manage_Countries1');
    $max_id = $this->mdl_manage_Countries1->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_manage_Countries1');
    $query = $this->mdl_manage_Countries1->_custom_query($mysql_query);
    return $query;
}

}