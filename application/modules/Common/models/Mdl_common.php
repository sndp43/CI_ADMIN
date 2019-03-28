<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_common extends CI_Model
{

function __construct() {
parent::__construct();
}



function get_table() {
    $table = "tablename";
    return $table;
}
function Get_hash_value($email,$table){

      $query = $this->db->query("select * from $table where Email = ? ", array($email));
      return $query->row();
}


function update_email_verification_ckeck_done($email,$accounts_tbl){
       $data =array(
           "MailVerified"=>1
        );
       $this->db->where('email', $email);
       $this->db->update($accounts_tbl, $data);
}


function update_eemailverification_ckeck_done($email,$tbl_emailverification){
       $data =array(
           "status"=>"0"
        );
       $this->db->where('email', $email);
       $this->db->update($tbl_emailverification, $data);
}


  public function GetEmailTemplate($key) {
        $query = $this->db->query("select Subject,Bodya from tblemailtemplate where `key` = ?", array($key));
        return $query->row();
    }

function get($order_by,$table) {
    
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_with_limit($limit, $offset, $order_by,$table)  {
    
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_where($id,$table) {
   
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query;
}
function get_user_email_where($id,$table) {

    $this->db->select('email');
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query->result()[0]->email;
    
}

function get_where_role($role,$table) {
   
    $this->db->where('id', $role);
    $query=$this->db->get($table);
    return $query;
}

function get_where_custom($col, $value,$table)  {
   
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}
function get_where_custom_2col($col, $value,$col1, $value1,$table) {
   
    $this->db->where($col, $value);
    $this->db->where($col1, $value1);
    $query=$this->db->get($table);
    return $query;
}



function _insert($data,$table) {
 
    $this->db->insert($table, $data);
}

function _update($id, $data,$table) {
 
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}

function _delete($id,$table) {
  
    $this->db->where('id', $id);
    $this->db->delete($table);
}

function count_where($column, $value,$table)  {
  
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function count_all($table)  {
   
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_max($table)  {
    $this->db->select_max('id');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->id;
    return $id;
}

function _custom_query($mysql_query,$table) {
    $query = $this->db->query($mysql_query);
    return $query;
}

}