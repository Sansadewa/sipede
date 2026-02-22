<?php

/**
 * 
 */
class User_model extends CI_Model
{

	function __construct()
	{
		$this->load->library('datatables');
	}

	public function get_user($id){

	}

	public function get_level($id){

	}

	public function get_login($id,$password){

	}

	public function set_login($id){

	}

	public function is_login($id){

	}

	public function get_by_wil($wilayah){
		$this->db->where('wilayah',$wilayah);
		$q = $this->db->get('users');

		return $q->result_object();
	}

	public function get_all(){
		$this->datatables->select('us.username as username,us.name as nama,us.nip as nip,perm.permission as permission,us.permission as id_permission');
		$this->datatables->from('users as us');
		$this->datatables->join('permission perm','us.permission = perm.id');
		$this->datatables->where('us.permission',1);
		
		if ($this->session->userdata('wilayah')->kode == '6300') {
			$this->datatables->where('(wilayah = "6300" OR wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356")');
		}else{
			$this->datatables->where('us.wilayah',$this->session->userdata('wilayah')->kode);
		}
		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
			data-toggle="modal" data-nip="$1" data-nama="$3" data-username="$2" data-id_permission="$4"
                            data-target="#modal-edit"
                            title="Edit Pengguna"g"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
                            data-toggle="modal" data-nip="$1" data-nama="$3" data-username="$2"
                            data-target="#modal-konfirmasi"
                            title="Hapus Pengguna"> <i class="fa fa-remove"> </i> </a>', 'nip,username,nama,id_permission');
		return $this->datatables->generate();
	}

	function add_user($post_data){
		if ($post_data) {
			$isian =  array(
			    'nip' => $post_data['nip'],
			    'username' => $post_data['username'],
			    'password' => password_hash($post_data['password'], PASSWORD_DEFAULT),
			    'permission' => $post_data['permission'],
			    'wilayah' => $this->session->userdata('wilayah')->kode
			);
			$this->db->insert('users',$isian);		    
		}
  
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan');
            redirect('/user');  
        }else{
         	$this->session->set_flashdata('failed', 'Input data gagal');
            redirect('/user');  
        }   
	}

	function delete($nip){
		$this->db->delete('users', array('nip' => $nip));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Pengguna berhasil dihapus');
            redirect('/user');  
        }else{
         	$this->session->set_flashdata('failed', 'Hapus data gagal');
            redirect('/user');  
        } 
	}

	function edit($post_data){
		if ($post_data) {
			if(strlen($post_data['password'])>0){
				$isian =  array(
				    'username' => $post_data['username'],
				    'password' => password_hash($post_data['password'], PASSWORD_DEFAULT),
				    'permission' => $post_data['permission'],
				);
			}else{
				$isian =  array(
				    'username' => $post_data['username'],
				    'permission' => $post_data['permission'],
				);
			}
			$this->db->where('nip',$post_data['nip']);
			$this->db->update('users',$isian);		    
		}
  
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Data pengguna berhasil diubah');
            redirect('/user');  
        }else{
         	$this->session->set_flashdata('failed', 'Ubah data gagal');
            redirect('/user');  
        }  
	}
}