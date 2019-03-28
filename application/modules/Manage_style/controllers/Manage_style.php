<?php
class Manage_style extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->library('Ajax_pagination');
$this->perPage = 20;
$this->load->model('mdl_store_style');
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
// $this->load->model("CommonModel");
$this->form_validation->CI =& $this;

}

function set_style(){
  $style = $this->input->post("style");
  $this->session->set_userdata("session_style",$style);
}

function _get_all_styles(){

  return $data["styles"] = $this->mdl_store_style->getStyle();

}

function check_style() {

       $style = $this->input->post("style");
       $id = $this->input->post("id");
       $style_name = $this->input->post("style_name");

if($id !=""){
          $mysql_query = "select * from tbl_style where   selected_css = '$style_name' and id != $id ";
}else{
      $mysql_query = "select * from tbl_style where   selected_css = '$style_name' ";
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
function _get_style(){
      $mysql_query="select * from tbl_style where style_default = 1";
      $query = $this->_custom_query($mysql_query);

    if($query->num_rows() == 0){
      
      $data['selected_css'] = "default.css";
    }else{

       $result =$query->result();

       $data['selected_css'] = $result[0]->selected_css;
     

    }

return $data['selected_css'];

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


    $flash_messege =  "Style Deleted successfully";
    $flash_error_class =  "alert alert-success";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
         redirect("Manage_style/manage");
          
          }
}





function manage() {
  $this->load->module('Site_security');
  $this->site_security->_make_sure_is_admin();

  $data = array();
   
  //total rows count
  $totalRec = count($this->mdl_store_style->getStyle());
  
  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Manage_style/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //get the posts data
  $data["styles"] = $this->mdl_store_style->getStyle(array('limit'=>$this->perPage));
  
  
  $data['sr'] = '0';
  $data['headline'] = "Manage Styles";
  
  //load the view
  $data['title'] = "Styles";
  $data['view_file'] = "manage";
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

  if(!empty($search)){
      $conditions['search']['search'] = $search;
  }

  //total rows count
  $totalRec = count($this->mdl_store_style->getStyle($conditions));

  //pagination configuration
  $config['target']      = '#postList';
  $config['base_url']    = base_url().'Manage_style/manage_search';
  $config['total_rows']  = $totalRec;
  $config['per_page']    = $this->perPage;
  $config['link_func']   = 'searchFilter';
  $this->ajax_pagination->initialize($config);
  
  //set start and limit
  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;
  
  //get posts data
  $data['styles'] = $this->mdl_store_style->getStyle($conditions);
 
  //load the view
  $this->load->view('Manage_style/manage_search', $data, false);
}


function create()
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
       redirect("Manage_style/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){

       
         $data = $this->fetch_data_from_db($update_id);
         // echo $this->db->last_query();
         // echo "<pre>"; print_r($data);exit;
     }else{ 
          $data = $this->fetch_data_from_post();
        
          $this->form_validation->set_rules('status','Status','required');
      
          if($this->form_validation->run() == TRUE){

             //check if default is checked and if checked reset all to 0 and update/insert default
             
             // 1 check if default is checked
             if($data['style_default'] == 1){
             // reset all to 0 and update/insert default
                $this->_reset_all_to_not_default();
             } 

         
              
             if(is_numeric($update_id)){

                  // echo "img".$image_one; exit;
                ////update code ///
               $chk_file_add_removed = $this->input->post("chk_file_add_removed",TRUE);
                
               if($chk_file_add_removed == 0){
                 $data['selected_css'] = $this->upload_style();
               }else{
                unset($data['selected_css']);
               }
               
                $data['updated_time '] = time();
                $admin_session = $this->session->userdata(admin_session);
                $data['updated_by'] =  $admin_session->id;

               $this->_update($update_id,$data);
               $flash_messege =  "Style updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_style/create/".$update_id); 

             }else{
   
                 $data['selected_css'] = $this->upload_style();

                  ////insert code ///
                $data['added_time '] = time();
                $admin_session = $this->session->userdata(admin_session);

                $data['added_by'] = $admin_session->id;
               $this->_insert($data);
               $flash_messege =  "Style added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_style/create/".$update_id);

            }
          }else{
        }
     }
   

     if(is_numeric($update_id)){

         $data['headline'] = "Update Style";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add New Style";
     }




    //$data['view_module'] = "Store_items";
     $data['title'] = "Style";
    $data['view_file'] = "create";
    $this->load->module('Templates');
    $this->templates->admin($data);

}

function _reset_all_to_not_default(){
$mysql_query = "update tbl_style set style_default = 0 ";
$this->_custom_query($mysql_query);

}

    public function upload_style() {

        if (isset($_FILES['selected_css']['name']) && !empty($_FILES['selected_css']['name'])) {
           
            $config['upload_path'] = 'assets/homefiles/css/custom';
            $config['allowed_types'] = 'css';
            $config['max_size'] = ''; //kb
            $config['max_width'] = '';
            $config['max_height'] = '';
            $config['overwrite'] = true;

            $fdata = array();
            $this->load->library('upload', $config);
         
            if (!$this->upload->do_upload('selected_css')) {
               
                $sdata['error'] = $this->upload->display_errors();
                $this->session->set_userdata($sdata);
                $this->session->set_flashdata('file_errorMessage', $sdata['error']);
                redirect(base_url().'Manage_style/create');

            } else {   
                $fdata = $this->upload->data();
                $style_name = $fdata['file_name'];
                return $style_name;
            }
        } else {
            $sdata['error'] = 'No file chosen !';
            $this->session->set_userdata($sdata);
            redirect(base_url().'Manage_style/create');
        }
    }



function fetch_data_from_post()
{
  
      $data['selected_css'] = $this->input->post('selected_css',TRUE);
      $data['style_desc'] = $this->input->post('style_desc',TRUE);
      $data['status'] = $this->input->post('status',TRUE);
      $data['style_default'] = ($this->input->post('style_default',TRUE) == "on") ? 1 : 0 ;

return $data;
}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
     
         $data['selected_css'] = $row->selected_css;
         $data['style_desc'] = $row->style_desc;
         $data['style_default'] = $row->style_default;
         $data['status'] = $row->status;
         $data['id'] = $row->id;
      return $data;
     
 }
}

function get($order_by) 
{
    $this->load->model('mdl_store_style');
    $query = $this->mdl_store_style->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_style');
    $query = $this->mdl_store_style->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_style');
    $query = $this->mdl_store_style->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_style');
    $query = $this->mdl_store_style->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_style');
    $this->mdl_store_style->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_style');
    $this->mdl_store_style->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_style');
    $this->mdl_store_style->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_style');
    $count = $this->mdl_store_style->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_style');
    $max_id = $this->mdl_store_style->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_style');
    $query = $this->mdl_store_style->_custom_query($mysql_query);
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