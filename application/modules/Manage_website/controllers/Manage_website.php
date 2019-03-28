<?php
class Manage_website extends MX_Controller 
{

function __construct() {
parent::__construct();
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
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


    $flash_messege =  "Website Settings Deleted successfully";
    $flash_error_class =  "alert alert-success";
    $this->session->set_flashdata("flash_messege",$flash_messege);
    $this->session->set_flashdata("flash_error_class",$flash_error_class);
         redirect("Manage_website/manage");
          
          }
}





function manage() 
{


    $this->load->module('Site_security');
    $this->site_security->_make_sure_is_admin();
    //$data['view_module'] = "Store_items";

    // $data['view_file'] = "manage";
    $data['view_file'] = "manage";

    $query = $this->get("id");
    $data['application'] =  $query->result();

    $data['title'] = "Website";
    $this->load->module('Templates');
    // echo"<pre>";
    // print_r($data); exit;
    $this->templates->admin($data);


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
       redirect("Manage_website/manage");

      }

     if((is_numeric($update_id)) && ($submit != "Submit")){

       
         $data = $this->fetch_data_from_db($update_id);
         // echo $this->db->last_query();
         // echo "<pre>"; print_r($data);exit;
     }else{ 
        
         $data = $this->fetch_data_from_post();
        
         


            // $this->form_validation->set_rules('image_one','Favicon Icon','required');
            //$this->form_validation->set_rules('AnalyticCode','Analytic Code','required');
            $this->form_validation->set_rules('MailHost','Mail Host','required');
            $this->form_validation->set_rules('MailPort','Mail Port','required');
            $this->form_validation->set_rules('MailUserName','Mail User Name','required');
            $this->form_validation->set_rules('MailPassword','Mail Password','required');
            $this->form_validation->set_rules('FromEmail','From Email','required');
            //$this->form_validation->set_rules('MetaTitle','Meta Title','required');
            //$this->form_validation->set_rules('MetaDesc','Meta Description','required');


         //$this->form_validation->set_rules("firstname","Firstname","required|max_length[240]|callback_item_title_check");  // to make callback work add few line in __construct line 8 ,9 ca be seen  + add My_Form_validation file in library folder 
       



          if($this->form_validation->run()== TRUE){

        
              
              
             if(is_numeric($update_id)){

         
                  // echo "img".$image_one; exit;
                ////update code ///
               $this->_update($update_id,$data);
               $flash_messege =  "Website updated successfully";
               $flash_error_class =  "alert alert-success";
               $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_website/create/".$update_id); 

             }else{


                  ////insert code ///
               
               $this->_insert($data);
               $flash_messege =  "Website added successfully";
               $flash_error_class =  "alert alert-success";
               $update_id =$this->get_max();
                $this->session->set_flashdata("flash_messege",$flash_messege);
                $this->session->set_flashdata("flash_error_class",$flash_error_class);
                redirect("Manage_website/create/".$update_id);

    
             }
          }
     }
   

     if(is_numeric($update_id)){

         $data['headline'] = "Update Website Details";
         $data['update_id'] =$update_id;

     }else{
         $data['headline'] = "Add New Website";
     }

    //$data['view_module'] = "Store_items";
     $data['title'] = "Website";
    $data['view_file'] = "create";
    $this->load->module('Templates');
    $this->templates->admin($data);

}

function fetch_data_from_post()
{
  
    $data['MailHost'] = $this->input->post('MailHost',TRUE);
    $data['MailPort'] = $this->input->post('MailPort',TRUE);
    $data['MailUserName'] = $this->input->post('MailUserName',TRUE);
    $data['MailPassword'] = $this->input->post('MailPassword',TRUE);
    $data['FromEmail'] = $this->input->post('FromEmail',TRUE);
    


return $data;
}

function fetch_data_from_db($update_id)
{

 $query = $this->get_where($update_id);


 foreach($query->result() as $row)
 {   
     
      $data['MailHost'] = $row->MailHost;
      $data['MailPort'] = $row->MailPort;
      $data['MailUserName'] = $row->MailUserName;
      $data['MailPassword'] = $row->MailPassword;
      $data['FromEmail'] = $row->FromEmail;
     
      return $data;
     
 }
}

function get($order_by) 
{
    $this->load->model('mdl_store_website');
    $query = $this->mdl_store_website->get($order_by);
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

    $this->load->model('mdl_store_website');
    $query = $this->mdl_store_website->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_website');
    $query = $this->mdl_store_website->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_website');
    $this->mdl_store_website->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_website');
    $this->mdl_store_website->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_website');
    $this->mdl_store_website->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_accounts');
    $count = $this->mdl_store_accounts->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_website');
    $max_id = $this->mdl_store_website->get_max();
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