<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemModel
 *
 * @author Harsh
 */
class SystemModel extends CI_Model {
    //put your code here
   function GetWebsiteDetails() {
   		$query = $this->db->get('tblwebsite_master');
        return $query->row();
	}
}