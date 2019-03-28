<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mdl_enquires extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "enquiry";
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

function getAllEnquiries() {
    $this->db->SELECT("e.*");
    $this->db->FROM("enquiry e");
    $query = $this->db->get();
    return $query->result();
}


function getAllEnquiriesInLimit($limit, $offset) {
    $this->db->SELECT("e.*");
    $this->db->FROM("enquiry e");
    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query->result();
}

function custom_get_where($id) {
    $this->db->SELECT("e.*");
    $this->db->FROM("enquiry e");
    $this->db->where("e.id", $id);
    $query = $this->db->get();
    return $query->result();
}

function getEnquiriesForlist() {
    $this->db->distinct();
    $this->db->SELECT("e.productId");
    $this->db->FROM("enquiry e");
    $query = $this->db->get();
    return $query->result();
}

function insertEnquiryLog($data) {
    $this->db->insert('store_enquiry_log', $data);
}

function getEnquiries($params = array()) {

    // echo $params['fromDash']; exit;
    if(!empty($params['search']['startDate'])) {
        $StartDate = date("Y-m-d", strtotime($params['search']['startDate']));
    } else {
        $StartDate = '';
    }
    if(!empty($params['search']['endDate'])) {
        $EndDate = date("Y-m-d", strtotime($params['search']['endDate']));
    } else {
        $EndDate = '';
    }

    $StartDt = $StartDate.' 00:00:00';
    $EndDt   = $EndDate.' 23:59:59';
// echo $StartDate." ".$EndDate;
    $this->db->select('e.*');
    $this->db->from('enquiry e');
  

    if(!empty($params['fromDash']) == "fromDash" || !empty($params['search']['fromDash']) == "fromDash") {
        $this->db->where('e.replied !=', 1);
    }
    //filter data by searched keywords
    // if(!empty($params['search']['enquiryFor']) && $params['search']['enquiryFor'] != 'zero' && $params['search']['enquiryFor'] != 'All') {
    //     $this->db->where('productId !=','0');
    // } else if(!empty($params['search']['enquiryFor']) && $params['search']['enquiryFor'] == 'zero' && $params['search']['enquiryFor'] != 'All') {
    //     $this->db->where('productId =','0');
    // }

     if(!empty($params['search']['enquiryFor']) && $params['search']['enquiryFor'] == '1') {
        $this->db->where('productId !=','0');
    } else if(!empty($params['search']['enquiryFor']) && $params['search']['enquiryFor'] == 'zero') {
        $this->db->where('productId =','0');
        $this->db->where('hosting_solutions =','');
    }
    else if(!empty($params['search']['enquiryFor']) && $params['search']['enquiryFor'] == '2') {
        $this->db->where('hosting_solutions !=','');
    }
    else if(!empty($params['search']['enquiryFor']) && $params['search']['enquiryFor'] == 'All') {
        
    }

    if($StartDate && $EndDate) {
        $this->db->where("dateAdded >= '$StartDt' && dateAdded <= '$EndDt'");
    }

    if($StartDate && !$EndDate) {
        $this->db->where('dateAdded >= ',$StartDt);
    }

    if(!$StartDate && $EndDate) {
        $this->db->where('dateAdded <= ',$EndDt);
    }    

    //set start and limit
    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
    }
    //get records
    $this->db->order_by('dateAdded','desc');
    $query = $this->db->get();
    //return fetched data
    return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
}

function custom_get_where_replied($id) {
    $this->db->select("*");
    $this->db->from("store_enquiry_log");
    $this->db->where("enquiry_id", $id);
    $query = $this->db->get();
    return $query->result();
}

}