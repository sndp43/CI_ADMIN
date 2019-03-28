<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_manage_social extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "tbl_social_settings";
    return $table;
}


function _get_update_id(){

    $table = $this->get_table();
    $query=$this->db->get($table);
    return $query;

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

function _insert($data){
    $table = $this->get_table();
    $this->db->insert($table, $data);
}

function _updategp($id, $data){

    unset($data['fbapi_key']);
    unset($data['fbapp_secret']);

    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}
function _updatefb($id, $data){

         unset($data['gpapi_key']);
         unset($data['gpredirect_uri']);
         unset($data['gpclient_id']);
         unset($data['gpclient_secret']);
         unset($data['gpapplication_name']);
   
   
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



function getSocial($params = array()) {

    $table = $this->get_table();

    $this->db->select('e.*');
    $this->db->from("$table e");
    if(array_key_exists("search",$params)){
      
        $this->db->like('selected_css',$params['search']['search']);
    }
    //set start and limit
    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
    }
    //get records
    $this->db->order_by('added_time','desc');
    $query = $this->db->get();
    //return fetched data
    return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
 }


}