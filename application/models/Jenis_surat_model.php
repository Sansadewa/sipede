<?php

/**
 * 
 */
class Jenis_surat_model extends CI_Model
{

	function __construct()
	{
		$this->load->model('setting_model');
	}
	
	function get_all(){
		if($this->session->userdata('wilayah')->kode == '6300'){
            $this->db->where('(wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356" OR wilayah = "6300")');
        }else{
            $this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
        }
		$q = $this->db->get('jenis_surat');
		return $q->result();
	}

	function get_all_table(){
		$this->load->library('datatables');
		$this->datatables->select('id,nama as deskripsi,template');
		$this->datatables->from('jenis_surat');
		if($this->session->userdata('wilayah')->kode == '6300'){
            $this->db->where('(wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356" OR wilayah = "6300")');
        }else{
            $this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
        }
		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
			data-toggle="modal" data-id="$1" data-deskripsi="$2" data-template="$3"
                            data-target="#modal-edit-kategori"
                            title="Edit Jenis Surat"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
                            data-toggle="modal" data-id="$1" data-deskripsi="$2" 
                            data-target="#modal-konfirmasi-kategori"
                            title="Hapus Jabtan"> <i class="fa fa-remove"> </i> </a>', 'id,deskripsi,template');
		return $this->datatables->generate();
	}

	function add($post_data){
		$this->db->insert('jenis_surat',array('nama'=>$post_data['deskripsi'],'template'=>$post_data['template'],'jenis'=>$post_data['jenis'],'wilayah' => $this->session->userdata('wilayah')->kode));
		$insert_id = $this->db->insert_id();
		if($this->db->affected_rows()){
			$data = array(
				$insert_id => 0
			);
			$this->setting_model->add_setting($data,'spd_surat_number',FALSE,FALSE);
			return json_encode(array('status'=>TRUE,'message'=>'Data berhasil diinput'));
		}else{
			return json_encode(array('status'=>FALSE,'message'=>'Data gagal diinput'));
		}
	}

	function edit($post_data){
		$this->db->where('id',$post_data['id']);
		$this->db->update('jenis_surat',array('nama'=>$post_data['deskripsi']));
		if($this->db->affected_rows()){
			$this->setting_model->edit_setting($data,'spd_surat_number',FALSE,FALSE);
			return json_encode(array('status'=>TRUE,'message'=>'Data berhasil diinput'));
		}else{
			return json_encode(array('status'=>FALSE,'message'=>'Data gagal diinput'));
		}
	}

	function delete($post_data){
		$this->db->delete('jenis_surat', array('id' => $post_data['id']));
		if($this->db->affected_rows()){
			$setting = $this->system->get_set('spd_surat_number');
			$data = array(
				$post_data['id'] => $setting[$post_data['id']]
			);
			$this->setting_model->delete_setting($data,'spd_surat_number',FALSE,FALSE);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('/master_data');  
		}else{
			$this->session->set_flashdata('success', 'Data gagal dihapus');
            redirect('/master_data');  
		}
	}
}