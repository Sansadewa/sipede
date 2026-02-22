<?php

/**
 * 
 */
class Pegawai_model extends CI_model
{

	function __construct(){
		$this->load->library('datatables');
	}

	public function get_by_wil($wilayah){
		if($wilayah == '6300'){
			$this->db->where('(wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356" OR wilayah = "6300")');
			$this->db->order_by('nama','asc');
			$q = $this->db->get('pegawai');

			return $q->result_object();
		}else{
			$this->db->where('wilayah',$wilayah);
			$q = $this->db->get('pegawai');

			return $q->result_object();
		}
	}


	function get_all(){
		if( in_array($this->session->userdata('wilayah')->kode, array('6351','6352','6353','6354','6355','6356','6300'))){
		//	$this->db->where('(wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356" OR wilayah = "6300")');
			$this->db->order_by('jabatan','asc');
			$q = $this->db->get('pegawai');
			return $q->result(); 
		}else{
		//	$this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
			$this->db->order_by('jabatan','asc');
			$q = $this->db->get('pegawai');
			return $q->result(); 
		}
	}

	public function get_all_table(){
		if($this->session->userdata('wilayah')->kode == '6300'){
			$this->datatables->select('peg.nama as nama,peg.nip as nip,peg.pin,peg.jabatan as jab_id,peg.panggol as pang_id,jab.des_jabatan as jabatan,pang.des_pangkat as pangkat');
			$this->datatables->from('pegawai as peg');
			$this->datatables->join('pangkat pang','peg.panggol = pang.id');
			$this->datatables->join('jabatan jab','peg.jabatan = jab.id');
			$this->datatables->where('(peg.wilayah = "6351" OR peg.wilayah = "6352" OR peg.wilayah = "6353" OR peg.wilayah = "6354" OR peg.wilayah = "6355" OR peg.wilayah = "6356" OR peg.wilayah = "6300")');
			$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
				data-toggle="modal" data-nip="$1" data-nama="$2" data-pangkat="$3" data-jabatan="$4" data-id_absensi="$5"
	                            data-target="#modal-edit"
	                            title="Edit Pegawai"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
	                            data-toggle="modal" data-nip="$1" data-nama="$2"
	                            data-target="#modal-konfirmasi"
	                            title="Hapus Pegawai"> <i class="fa fa-remove"> </i> </a>', 'nip,nama,pang_id,jab_id,pin');
			return $this->datatables->generate();
		}else{
			$this->datatables->select('peg.nama as nama,peg.pin,peg.nip as nip,peg.jabatan as jab_id,peg.panggol as pang_id,jab.des_jabatan as jabatan,pang.des_pangkat as pangkat');
			$this->datatables->from('pegawai as peg');
			$this->datatables->join('pangkat pang','peg.panggol = pang.id');
			$this->datatables->join('jabatan jab','peg.jabatan = jab.id');
			$this->datatables->where('peg.wilayah',$this->session->userdata('wilayah')->kode);
			$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
				data-toggle="modal" data-nip="$1" data-nama="$2" data-pangkat="$3" data-jabatan="$4" data-id_absensi="$5"
	                            data-target="#modal-edit"
	                            title="Edit Pegawai"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
	                            data-toggle="modal" data-nip="$1" data-nama="$2"
	                            data-target="#modal-konfirmasi"
	                            title="Hapus Pegawai"> <i class="fa fa-remove"> </i> </a>', 'nip,nama,pang_id,jab_id,pin');
			return $this->datatables->generate();
		}
	}

	function add_pegawai($post_data){
		if ($post_data) {
			$isian =  array(
			    'nip' => $post_data['nip'],
			    'peg_key' => $post_data['nip'].'-'.$this->session->userdata('wilayah')->kode,
			    'nama' => $post_data['nama'],
			    'panggol' => $post_data['pangkat'],
			    'jabatan' => $post_data['jabatan'],
			    'pin' => $post_data['id_absensi'],
			    'wilayah' => $this->session->userdata('wilayah')->kode
			);
			$this->db->insert('pegawai',$isian);		    
		}
  
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Input data berhasil');
            redirect('/pegawai');  
        }else{
         	$this->session->set_flashdata('error', 'Input data gagal');
            redirect('/pegawai');  
        }      
        
	}

	function delete($nip){
		$this->db->delete('pegawai', array('nip' => $nip));
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Pegawai berhasil dihapus');
            redirect('/pegawai');  
        }else{
         	$this->session->set_flashdata('error', 'Hapus data gagal');
            redirect('/pegawai');  
        } 
	}

	function edit($post_data){
		if ($post_data) {
			$isian =  array(
			    'nip' => $post_data['nip'],
			    'nama' => $post_data['nama'],
			    'panggol' => $post_data['pangkat'],
			    'jabatan' => $post_data['jabatan'],
			    'pin' => $post_data['id_absensi'],
			);
			$this->db->where('nip',$post_data['nip']);
			$this->db->update('pegawai',$isian);		    
		}
  
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('/pegawai');  
        }else{
         	$this->session->set_flashdata('error', 'Edit data gagal');
            redirect('/pegawai');  
        }
	}
}