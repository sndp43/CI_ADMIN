<?php
class Perfectcontroller extends MX_Controller 
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

function get($order_by) 
{
    $this->load->model('mdl_perfectmodel');
    $query = $this->mdl_perfectmodel->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectmodel');
    $query = $this->mdl_perfectmodel->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectmodel');
    $query = $this->mdl_perfectmodel->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_perfectmodel');
    $query = $this->mdl_perfectmodel->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_perfectmodel');
    $this->mdl_perfectmodel->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectmodel');
    $this->mdl_perfectmodel->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_perfectmodel');
    $this->mdl_perfectmodel->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_perfectmodel');
    $count = $this->mdl_perfectmodel->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_perfectmodel');
    $max_id = $this->mdl_perfectmodel->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_perfectmodel');
    $query = $this->mdl_perfectmodel->_custom_query($mysql_query);
    return $query;
}

}