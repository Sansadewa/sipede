<?php

/**
 * 
 */
class Progress_model extends CI_Model
{
	
	function get_all_table($post_data){
		$prov = array('6300','6351','6352','6353','6354','6355','6356');
		if(in_array($this->session->userdata('wilayah')->kode, $prov)){
			$wilayah = '6300';
		}else{
			$wilayah = $this->session->userdata('wilayah')->kode;
		}

		$query = $this->db->query("SELECT surat_bayar.akun_bayar,kegiatan_anggaran.nama AS deskripsi, SUM(surat_bayar.uang_total) AS total,kegiatan_anggaran.pagu FROM surat_bayar
			LEFT JOIN matriks_kegiatan ON matriks_kegiatan.id = surat_bayar.id_matriks
			LEFT JOIN kegiatan_anggaran ON surat_bayar.akun_bayar = kegiatan_anggaran.id
			LEFT JOIN surat_tugas on surat_bayar.id_spd = surat_tugas.id
			WHERE surat_bayar.uang_total >0 and YEAR(surat_tugas.created_at)=".date('Y')."
			and kegiatan_anggaran.wilayah =".$wilayah.' and matriks_kegiatan.wilayah ='.$wilayah."
			GROUP BY surat_bayar.akun_bayar,kegiatan_anggaran.nama");
		$data = array();
		$i = 1;
		foreach ($query->result_array() as $key) {
			$key['id'] = $i;
			$key['total'] = format_uang($key['total']);
			$key['pagu'] = format_uang($key['pagu']);
			$data[] = $key;
			$i++;
		}

		return json_encode(array('data' => $data));

	}
}