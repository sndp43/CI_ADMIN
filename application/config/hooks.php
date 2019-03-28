<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'] = function() {
	$CI = & get_instance();
	//if ($CI->session->userdata(WebSiteSession) == null) {
		$CI->load->model('SystemModel');
		$WebsiteDetails = $CI->SystemModel->GetWebsiteDetails();
		$CI->session->set_userdata(WebSiteSession, $WebsiteDetails);
		// echo "<prE>"; print_r($WebsiteDetails); exit;
	//}
};
