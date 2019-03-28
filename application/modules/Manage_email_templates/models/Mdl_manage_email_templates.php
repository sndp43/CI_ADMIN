<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_manage_email_templates extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "tblemailtemplate";
    return $table;
}

function get($order_by){
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $table = $this->get_table();
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_where($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query;
}

function get_where_custom($col, $value) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}

function get_where_custom_twocol($col, $value,$col1, $value1) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $this->db->where($col1, $value1);
    $query=$this->db->get($table);
   // echo $this->db->last_query(); exit;
    return $query;
}

function _insert($data){
    $table = $this->get_table();
    $this->db->insert($table, $data);
}

function _update($id, $data){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}

function _delete($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->delete($table);
}

function count_where($column, $value) {
    $table = $this->get_table();
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function count_all() {
    $table = $this->get_table();
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_max() {
    $table = $this->get_table();
    $this->db->select_max('id');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->id;
    return $id;
}

function _custom_query($mysql_query) {
    $query = $this->db->query($mysql_query);
    return $query;
}


function activate($id) {
    $table = $this->get_table();
    $this->db->query("UPDATE $table SET status = '1' WHERE id = $id;");
}

function deactivate($id) {
     $table = $this->get_table();
    $this->db->query("UPDATE $table SET status = '0' WHERE id = $id;");
}



function getEmailTemplates($params = array()) {
    $table = $this->get_table();
    $this->db->select('*');
    $this->db->from($table);

    //set start and limit
    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
    }
    //get records
       $this->db->order_by('id','desc');
      $query = $this->db->get();

    //return fetched data
    return ($query->num_rows() > 0)?$query->result():FALSE;
 }
}