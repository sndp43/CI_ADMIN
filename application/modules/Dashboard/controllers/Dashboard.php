<?php class Dashboard extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Mdl_dashboard");
	}

	function home() {


	    $this->load->module('Site_security');
	    $this->site_security->_make_sure_is_admin();
	    $data['flash']=$this->session->flashdata['item'];
	    $data['view_file'] = "home";
		
		$data['title'] = "Dashboard";
	    $this->load->module('Templates');
	    $this->templates->admin($data);
	}

}