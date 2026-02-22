<?php

class M_login extends CI_model
{

	function aksi_login($username,$password){

		$q = $this->db->get_where('users',array('username'=>$username));
		$user = $q->row();
		if (password_verify($password, $user->password)) {
			$newdata = array(
			        'username'  => $user->username,
			        'name'     => $user->name,
			        'status' => "login",
					'akses' => $user->permission,
			        'wilayah' => $this->db->where('kode',$user->wilayah)->get('master_wilayah')->row()
			);

			$this->session->set_userdata($newdata);
		    return array('status'=>true,'akses'=>$user->permission);
		} else {
		    return array('status'=>false);
		}
	}	
	
	function is_admin($table,$where){
		$q = $this->db->get_where($table,$where);
		$q = $q->row();
		if($q->level == 1){
			return true;
		}else{
			return false;
		}
	}

	function get_user($username){
		$q = $this->db->get_where('users',array('username'=>$username));
		return $q->row();
	}

}