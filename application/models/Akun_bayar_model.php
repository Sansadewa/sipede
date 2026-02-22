<?php

/**
 * 
 */
class Akun_bayar_model extends CI_Model
{
	
	function get_all(){
		$q = $this->db->get('akun_bayar');
		return $q->result();
	}

	function get_all_table(){
		$this->load->library('datatables');
		$this->datatables->select('no_akun,deskripsi');
		$this->datatables->from('akun_bayar');
		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
			data-toggle="modal" data-no_akun="$1" data-deskripsi="$2"
                            data-target="#modal-edit-akun"
                            title="Edit Akun Bayar"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
                            data-toggle="modal" data-no_akun="$1" data-deskripsi="$2"
                            data-target="#modal-konfirmasi-akun"
                            title="Hapus Akun Bayar"> <i class="fa fa-remove"> </i> </a>', 'no_akun,deskripsi');
		return $this->datatables->generate();
	}

	function add($post_data){
		$this->db->insert('akun_bayar',array('deskripsi'=>$post_data['deskripsi'],'no_akun'=>$post_data['no_akun']));
		if($this->db->affected_rows()){
			return json_encode(array('status'=>TRUE,'message'=>'Data berhasil diinput'));
		}else{
			return json_encode(array('status'=>FALSE,'message'=>'Data gagal diinput'));
		}
	}

	function edit($post_data){
		$this->db->where('no_akun',$post_data['no_akun_lama']);
		$this->db->update('akun_bayar',array('deskripsi'=>$post_data['deskripsi'],'no_akun'=>$post_data['no_akun']));
		if($this->db->affected_rows()){
			return json_encode(array('status'=>TRUE,'message'=>'Data berhasil diinput'));
		}else{
			return json_encode(array('status'=>FALSE,'message'=>'Data gagal diinput'));
		}
	}

	function delete($post_data){
		$this->db->delete('akun_bayar', array('no_akun' => $post_data['no_akun']));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('/master_data');  
		}else{
			$this->session->set_flashdata('success', 'Data gagal dihapus');
            redirect('/master_data');  
		}
	}
}
