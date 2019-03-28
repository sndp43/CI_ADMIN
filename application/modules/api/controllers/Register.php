<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Register extends REST_Controller  {

	function __construct() {
		parent::__construct();
		$this->load->module('Site_security');
		$this->load->model('RegisterModel');
	}

	function login_post() {
		$email = $this->post('email');
		$password = $this->post('password');

		$errors = array();
		$flag = false;
		$response = array();

		if(empty($email)) {
			$errors['email'] = "Email should not be empty";
			$flag = true;
		}
		if(empty($password)) {
			$errors['password'] = "Password should not be empty";
			$flag = true;
		}

		if($flag) {
			$response['errors'] = $errors;
			$response['message'] = "Some fields are missing";
		} else {
			$password = $this->site_security->_hash_string($password);
			// echo $password; exit;
			$response['message'] = $this->RegisterModel->login($email,$password);
		}

		$this->response($response, 200);
	}
}

