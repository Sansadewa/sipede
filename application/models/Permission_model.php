<?php

/**
 * 
 */
class Permission_model extends CI_model
{
	
	function get_all(){
		$q = $this->db->get('permission');
		return $q->result(); 
	}
}