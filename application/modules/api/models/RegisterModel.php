<?php

class RegisterModel extends CI_Model{

	function login($email,$password) {
		// echo $password; exit;
		$this->db->where('email', $email);
		$this->db->where('pward', "$password");
		$num = $this->db->count_all_results('accounts');
		echo $this->db->last_query();
		// echo $num; 
		exit;
		return count($num) ? '' : '';
	}

}


?>