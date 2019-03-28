<?php
class Common extends MX_Controller 
{

function __construct() {
parent::__construct();
$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$this->load->library('Ajax_pagination');
$this->perPage = "5";
// $this->load->model("CommonModel");
//FOR FORM VALIDATION  CALLBACKS TO WORK THese 2 lines are IMP
$this->load->library("form_validation");
$this->form_validation->CI =& $this;
}

function Get_hash_value($email,$accounts_tbl) {
    $this->load->model('mdl_common');
    return $this->mdl_common->Get_hash_value($email,$accounts_tbl);
    }

function update_email_verification_ckeck_done($email,$accounts_tbl){
 $this->load->model('mdl_common');
    return $this->mdl_common->update_email_verification_ckeck_done($email,$accounts_tbl);
}

function update_eemailverification_ckeck_done($email,$tbl_emailverification){
 $this->load->model('mdl_common');
    return $this->mdl_common->update_eemailverification_ckeck_done($email,$tbl_emailverification);
}

function GetEmailTemplate($key) {
        $this->load->model('mdl_common');
        return $query = $this->mdl_common->GetEmailTemplate($key);
        
    }

function get($order_by,$table) 
{
    $this->load->model('mdl_common');
    $query = $this->mdl_common->get($order_by,$table);
    return $query;
}

function get_with_limit($limit, $offset, $order_by,$table) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_common');
    $query = $this->mdl_common->get_with_limit($limit, $offset, $order_by,$table);
    return $query;
}

function get_where($id,$table) 
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_common');
    $query = $this->mdl_common->get_where($id,$table);
    return $query;
}
function get_user_email_where($id,$table) 
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_common');
    return $query = $this->mdl_common->get_user_email_where($id,$table);
    
}
function get_where_role($role,$table) 
{
    if (!is_numeric($role)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_common');
    $query = $this->mdl_common->get_where_role($role,$table);
    return $query;
}

function get_where_custom($col, $value,$table)  
{
    $this->load->model('mdl_common');
    $query = $this->mdl_common->get_where_custom($col, $value,$table);
    return $query;
}

function get_where_custom_2col($col, $value,$col1, $value1,$table)  
{
    $this->load->model('mdl_common');
    $query = $this->mdl_common->get_where_custom_2col($col, $value,$col1, $value1,$table);
    return $query;
}

function _insert($data,$table) 
{
    $this->load->model('mdl_common');
    $this->mdl_common->_insert($data,$table);
}

function _update($id, $data,$table) 
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_common');
    $this->mdl_common->_update($id, $data,$table);
}

function _delete($id,$table) 
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_common');
    $this->mdl_common->_delete($id,$table);
}

function count_where($column, $value,$table) 
{
    $this->load->model('mdl_common');
    $count = $this->mdl_common->count_where($column, $value,$table);
    return $count;
}

function get_max($table)  
{
    $this->load->model('mdl_common');
    $max_id = $this->mdl_common->get_max($table);
    return $max_id;
}

function _custom_query($mysql_query,$table)  
{
    $this->load->model('mdl_common');
    $query = $this->mdl_common->_custom_query($mysql_query,$table);
    return $query;
}


}