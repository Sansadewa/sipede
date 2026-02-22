<?php

/**
 * 
 */
class Setting_model extends CI_Model
{
	
	function add_setting($post,$set_key,$redirect=TRUE,$only_replace=TRUE,$all=FALSE){
		$setting = $this->system->get_set($set_key);
		if(is_null($setting)){
			foreach ($post as $key => $value) {
				if(array_key_exists($key, $post)){
					$setting[$key] = $post[$key];
				}
			}
		}else{
			foreach ($setting as $key => $value) {
				if(array_key_exists($key, $post)){
					$setting[$key] = $post[$key];
				}
			}

			if(!$only_replace){
				foreach ($post as $key => $value) {
					$setting[$key] = $post[$key];
				}
			}
		}
		if($all){

		}else{
			$this->db->where('set_key',$set_key."_".$this->session->userdata('wilayah')->kode);
			$this->db->update('setting',array('set_val'=>json_encode($setting)));
			if($this->db->affected_rows()){
				if($redirect){
					$this->session->set_flashdata('success', 'Input data berhasil');
	            	redirect('/master_aplikasi');
				}else{
					return TRUE;
				} 
	        }else{
	        	if($redirect){
	        		$this->session->set_flashdata('failed', 'Input data gagal');
	            	redirect('/master_aplikasi');  
	        	}else{
	        		return FALSE;
	        	}
	        }
		}
	}

	function edit_setting($post,$set_key,$redirect=TRUE,$only_replace=TRUE){
		$setting = $this->system->get_set($set_key);
		if(is_null($setting)){
			foreach ($post as $key => $value) {
				if(array_key_exists($key, $post)){
					$setting[$key] = $post[$key];
				}
			}
		}else{
			foreach ($setting as $key => $value) {
				if(array_key_exists($key, $post)){
					$setting[$key] = $post[$key];
				}
			}
		}
		$this->db->where('set_key',$set_key);
		$this->db->update('setting',array('set_val'=>json_encode($setting)));
		if($this->db->affected_rows()){
			if($redirect){
				$this->session->set_flashdata('success', 'Input data berhasil');
            	redirect('/master_aplikasi');
			}else{
				return TRUE;
			} 
        }else{
        	if($redirect){
        		$this->session->set_flashdata('failed', 'Input data gagal');
            	redirect('/master_aplikasi');  
        	}else{
        		return FALSE;
        	}
        }
	}


	function delete_setting($post,$set_key,$redirect=TRUE,$only_replace=TRUE){
		$setting = $this->system->get_set($set_key);
		foreach ($setting as $key => $value) {
			if(array_key_exists($key, $post)){
				unset($setting[$key]);
			}
		}
		$this->db->where('set_key',$set_key);
		$this->db->update('setting',array('set_val'=>json_encode($setting)));
		if($this->db->affected_rows()){
			if($redirect){
				$this->session->set_flashdata('success', 'Input data berhasil');
            	redirect('/master_aplikasi');
			}else{
				return TRUE;
			} 
        }else{
        	if($redirect){
        		$this->session->set_flashdata('failed', 'Input data gagal');
            	redirect('/master_aplikasi');  
        	}else{
        		return FALSE;
        	}
        }
	}

	function add_mesin($post,$set_key){
		$this->db->where('set_key','spd_mesin_absen');
		$setting = $this->db->get('setting');;
		if($setting->num_rows()>0){
			$this->db->where('set_key','spd_mesin_absen');
			$this->db->update('setting',array('set_val'=>$post['ip_mesin']));
		}else{
			$this->db->insert('setting',array('set_key'=>'spd_mesin_absen','set_val'=>$post['ip_mesin']));
		}
		return TRUE;
	}

	function add_wilayah($post,$set_key){
		$this->db->where('set_key','spd_kode_wilayah');
		$setting = $this->db->get('setting');;
		if($setting->num_rows()>0){
			$this->db->where('set_key','spd_kode_wilayah');
			$this->db->update('setting',array('set_val'=>$post['kode']));
		}else{
			$this->db->insert('setting',array('set_key'=>'spd_kode_wilayah','set_val'=>$post['kode']));
		}

		$this->db->set('wilayah',$post['kode']);
		$this->db->where('username','admin');
		$this->db->update('users');

		return TRUE;
	}


}