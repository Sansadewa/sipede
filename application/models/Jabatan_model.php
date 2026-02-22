<?php

/**
 * 
 */
class Jabatan_model extends CI_model
{
	
	function get_all(){
		$q = $this->db->get('jabatan');
		return $q->result(); 
	}

	function get_all_table(){
		$this->load->library('datatables');
		$this->datatables->select('id,des_jabatan');
		$this->datatables->from('jabatan');
		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
			data-toggle="modal" data-id="$1" data-deskripsi="$2"
                            data-target="#modal-edit-jabatan"
                            title="Edit Jabatan"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
                            data-toggle="modal" data-id="$1" data-deskripsi="$2"
                            data-target="#modal-konfirmasi-jabatan"
                            title="Hapus Jabtan"> <i class="fa fa-remove"> </i> </a>', 'id,des_jabatan');
		return $this->datatables->generate();
	}

	function add($post_data){
		$this->db->insert('jabatan',array('des_jabatan'=>$post_data['deskripsi']));
		if($this->db->affected_rows()){
			return json_encode(array('status'=>TRUE,'message'=>'Data berhasil diinput'));
		}else{
			return json_encode(array('status'=>FALSE,'message'=>'Data gagal diinput'));
		}
	}

	function edit($post_data){
		$this->db->where('id',$post_data['id']);
		$this->db->update('jabatan',array('des_jabatan'=>$post_data['deskripsi']));
		if($this->db->affected_rows()){
			return json_encode(array('status'=>TRUE,'message'=>'Data berhasil diinput'));
		}else{
			return json_encode(array('status'=>FALSE,'message'=>'Data gagal diinput'));
		}
	}

	function delete($post_data){
		$this->db->delete('jabatan', array('id' => $post_data['id']));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('/master_data');  
		}else{
			$this->session->set_flashdata('success', 'Data gagal dihapus');
            redirect('/master_data');  
		}
	}
}