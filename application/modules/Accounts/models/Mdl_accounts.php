<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_accounts extends CI_Model
{

function __construct() {
parent::__construct();
}

function get_table() {
    $table = "accounts";
    return $table;
}


 function verify_user($email) {
        $table = $this->get_table();
        $this->db->set('MailVerified', 1);
        $this->db->where('email', $email);
        $this->db->update($table);

        $query = $this->db->query("select email,MailVerified from $table where email = ? AND MailVerified = 1 ", array($email));
        return $query->num_rows();
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

function get_where_custom_col_three($col, $value,$col1, $value1,$col2, $value2) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $this->db->where($col1, $value1);
    $this->db->where($col2, $value2);
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

function activate_user($id) {
    $table = $this->get_table();
    $this->db->query("UPDATE $table SET status = '1' WHERE id = $id;");
}

function deactivate_user($id) {
     $table = $this->get_table();
    $this->db->query("UPDATE $table SET status = '0' WHERE id = $id;");
}


function getAccounts($params = array()) {
    $table = $this->get_table();
    $this->db->select('*');
    $this->db->from($table);

    //filter data by searched keywords
    if(!empty($params['search']['search'])){
        $this->db->like('firstname',$params['search']['search']);
        $this->db->or_like('email', $params['search']['search']);
    }

    if(!empty($params['search']['account_type'])){
        if($params['search']['account_type'] == '1'){
            $this->db->where('FacebookId !=',"");
        }
        if($params['search']['account_type'] == '2'){
            $this->db->where('GoogleId !=',"");
        }
        if($params['search']['account_type'] == '3'){
             $this->db->where('FacebookId',"");
             $this->db->where('GoogleId',"");
             $this->db->where('role != ',1);
        }
         if($params['search']['account_type'] == '4'){
            $this->db->where('role',1);
            
        }
    }

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

    public function RegisterFBUser($userData) {

         // $Gender = $userData['gender'];
         $FacebookId = $userData['oauth_uid'];
         $Password = $userData['Password'];
         $first_name = $userData['first_name'];
         $last_name = $userData['last_name'];
         $email = $userData['email'];
        // $ProfileImage = $userData['picture_url'];
        // Check if user name exists
         $data = $this->db->query("SELECT * FROM drl_accounts WHERE email = ? ", array('email'=>$email))->row();  //'FacebookId' => $FacebookId,

        
         if (count($data) ==0) {
            // Insert user in data base 
            $insertData = array(
                'FacebookId'=> $FacebookId,
                'pward'=> $Password,
                'email'=> $FacebookId,
                'firstname'=> $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'date_created' => time(),
                'role' => '2',
                // 'ProfileImage' => $ProfileImage,
                // 'User_Group_Type'=>'Website User',
                // 'MailVerified'=>'1',
                // 'Gender'=>$Gender
            );
            $this->db->insert('drl_accounts',$insertData);
            $insert_id = $this->db->insert_id();
            
             $data = $this->db->query("SELECT * FROM drl_accounts WHERE id = ?", array('id' => $insert_id))->row();
             $data->mailstatus = 1;
         
        }else{
            $data->mailstatus = 0;
           //print_r($data);
           //return $data;
        }
        
        return $data;
        
        
    }

    // Insert Update GP User Start

     public function RegisterGPUser($userData) {
        //$Gender = $userData['gender'];
        $GoogleId = $userData['id'];
        $Password = $userData['Password'];
        $first = $userData['name'];
        $email = $userData['email'];
        $ProfileImage = $userData['picture'];
        // Check if user name exists
        $data = $this->db->query("SELECT * FROM drl_accounts WHERE email = ? ", array('email'=>$email))->row(); //'GoogleId' => $GoogleId,
       
        if (count($data) ==0) { 
            // Insert user in data base 
            $insertData = array(
                'GoogleId' => $GoogleId,
                'pward'=> $Password,
                'firstname' => $first,
                'email' => $email,
                'role' => '2',
                'date_created' => time(),
                //'Gender' => $Gender,
            );
            $this->db->insert('drl_accounts', $insertData);
            $insert_id = $this->db->insert_id();

            $data = $this->db->query("SELECT * FROM drl_accounts WHERE id = ?", array('id' => $insert_id))->row();
             $data->mailstatus = 1;

        } else {
             $data->mailstatus = 0;
            
        }
        return $data;
    }
    // Insert Update GP User End

    public function Get_hash_value($email) {
        $query = $this->db->query("select firstname, lastname, Email, pward from tblwebsite_user_master where email = ? ", array($email));
        return $query->row();
    }


}