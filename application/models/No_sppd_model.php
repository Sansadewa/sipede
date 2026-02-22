<?php

/**
 * 
 */
class No_sppd_model extends CI_Model
{
	
	function __construct(){
		$this->load->library('datatables');
	}


	function get_all(){
		$q = $this->db->get('no_sppd');
		return $q->result(); 
	}

	function get_byIdKeg($id){
		$this->db->select('no.id as id, no.nomor as nomor, no.perihal as perihal');
		$this->db->from('no_sppd no');
		$this->db->join('matriks_kegiatan mtx','mtx.kegiatan=no.kegiatan');
		$this->db->where('no.kegiatan',$id);
		$q = $this->db->get('no_surat');
		return $q->result();
	}

	function get_all_table(){
		$this->datatables->select('num.id as id,num.nomor as nomor, keg.nama as kegiatan, keg.id as id_keg, num.perihal as perihal,jen.nama as jenis,jen.id as id_jenis,num.tanggal as tanggal');
		$this->datatables->from('no_sppd as num');
		$this->datatables->join('kegiatan keg','keg.id = num.kegiatan');
		$this->datatables->join('jenis_surat jen','num.jenis = jen.id');
		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
			data-toggle="modal" data-id="$1" data-nomor="$2" data-kegiatan="$3" data-perihal="$4" data-jenis="$5" data-tanggal="$5"
                            data-target="#modal-edit"
                            title="Edit Nomor"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
                            data-toggle="modal" data-id="$1" data-nomor="$2"
                            data-target="#modal-konfirmasi"
                            title="Hapus No Surat"> <i class="fa fa-remove"> </i> </a>', 'id,nomor,id_keg,perihal, id_jenis,tanggal');
		return $this->datatables->generate();
	}

	function add($post_data){

	}

	function edit($post_data){

	}

	function delete($post_data){

	}
}