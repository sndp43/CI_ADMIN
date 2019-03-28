<?php
class Site_setting extends MX_Controller 
{

function __construct() {
parent::__construct();
}


function _get_cookie_name() 
{

    $cookie_name = "adadfaf";
    return $cookie_name;
   
}





function get($order_by) 
{
    $this->load->model('mdl_site_setting');
    $query = $this->mdl_site_setting->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_site_setting');
    $query = $this->mdl_site_setting->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_site_setting');
    $query = $this->mdl_site_setting->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_site_setting');
    $query = $this->mdl_site_setting->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_site_setting');
    $this->mdl_site_setting->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_site_setting');
    $this->mdl_site_setting->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_site_setting');
    $this->mdl_site_setting->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_site_setting');
    $count = $this->mdl_site_setting->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_site_setting');
    $max_id = $this->mdl_site_setting->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_site_setting');
    $query = $this->mdl_site_setting->_custom_query($mysql_query);
    return $query;
}

}