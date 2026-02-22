<?php

/**
 * 
 */
class Kategori_model extends CI_Model
{

	function __construct(){
		$this->load->library('datatables');
	}

	function get_kat1(){
		$this->db->select('kode, kategori1');
		$this->db->group_by('kategori1');
		$q = $this->db->get('kategori');
		// echo $this->db->last_query(); die();
		return $q->result(); 
	}

	function get_kat2($kat1){
		$this->db->select('kode, kategori2');
		$this->db->group_by('kategori2');
		$this->db->where('kategori1',$kat1);
		$q = $this->db->get('kategori');
		// echo $this->db->last_query(); die();
		return $q->result(); 
	}
	
	function get_kat3($kat1,$kat2){
		$this->db->select('kode, kategori3');
		$this->db->group_by('kategori3');
		$this->db->where('kategori1',$kat1);
		$this->db->where('kategori2',$kat2);
		$q = $this->db->get('kategori');
		// echo $this->db->last_query(); die();
		return $q->result(); 
	}

	function get_kat4($kat1,$kat2,$kat3){
		$this->db->select('kode, kategori4');
		$this->db->group_by('kategori4');
		$this->db->where('kategori1',$kat1);
		$this->db->where('kategori2',$kat2);
		$this->db->where('kategori3',$kat3);
		$q = $this->db->get('kategori');
		return $q->result(); 
	}

	function get_kode_surat($kat1,$kat2,$kat3,$kat4){
		$this->db->select('DISTINCT(kode)');
		$this->db->where('kategori1',$kat1);
		$this->db->where('kategori2',$kat2);
		if($kat3!='Kosong'){$this->db->where('kategori3',$kat3);}
		if($kat4!='Kosong'){$this->db->where('kategori4',$kat4);}
		$q = $this->db->get('kategori');
		return $q->row(); 
	}



	// function get_kegiatan_lds($id,$tahun){
	// 	$prov = array('6300','6351','6352','6353','6354','6355','6356');
	// 	$this->db->select('kegiatan_anggaran.*,sum(pagu) as pagu_total');
	// 	$this->db->where('id',$id);
	//     $this->db->where('tahun_lds', $tahun);
	//     if (in_array($this->session->userdata('wilayah')->kode, $prov)) {
	//     	$this->db->where('wilayah','6300');
	//     }else{
	//     $this->db->where('wilayah',$this->session->userdata('wilayah')->kode);

	//     	}
	// 	$q= $this->db->get('kegiatan_anggaran');

	// 	if($q->num_rows() == 0){
	// 		$this->db->select('akun_bayar.no_akun as id, akun_bayar.no_akun as nama,akun_bayar.tahun_akun as tahun_lds, akun_bayar.wilayah as wilayah');
	// 		$this->db->where('no_akun',$id);
	// 	    $this->db->where('tahun_akun', $tahun);
	// 	    $this->db->or_where('wilayah',$this->session->userdata('wilayah')->kode);
	// 		$q= $this->db->get('akun_bayar');
	// 	}else{
	// 		$kegiatan = $q->row();
	// 		$kegiatan->pagu = $kegiatan->pagu_total;
	// 		return $kegiatan;

	// 	}
	// 	return $q->row(); 
	// }

	// function get_kegiatan_realisasi($id,$tahun){
	// 	$prov = array('6300','6351','6352','6353','6354','6355','6356');
	// 	$this->db->select('sum(spd.perkiraan_biaya) as perkiraan, sum(sb.uang_total) as terbayar');
	// 	$this->db->join('surat_perjalanan spd','mtx.id = spd.id_matriks');
	// 	$this->db->join('surat_bayar sb','mtx.id = sb.id_matriks');
	// 	$this->db->where('sb.akun_bayar',$id);
	// 	$this->db->where('YEAR(FROM_UNIXTIME(mtx.tanggal_awal))',$tahun);
	// 	 if (in_array($this->session->userdata('wilayah')->kode, $prov)) {
	//     	$this->db->where_in('mtx.wilayah',$prov);
	//     }else{
	//     $this->db->where('mtx.wilayah',$this->session->userdata('wilayah')->kode);

	//     	}
	// 	$q= $this->db->get('matriks_kegiatan mtx');
	// 	return $q->row(); 
	// }

	// function get_all($type_min=2){
	// 	$prov = array('6300','6351','6352','6353','6354','6355','6356');
	// 	if (in_array($this->session->userdata('wilayah')->kode, $prov)) {
	// 		 $this->db->where('(wilayah = "6300" OR wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356")');
	// 		 $this->db->where('YEAR(FROM_UNIXTIME(kegiatan.periode_waktu_akhir))',date('Y'));
	// 		 $this->db->where('tipe >=',$type_min);
	// 		  if($type_min == 1){
	// 		 	$this->db->order_by('tipe','asc');
	// 		 }
	// 		$q = $this->db->get('kegiatan');
	// 		return $q->result(); 
	// 	}else{
	// 		$this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
	// 		$this->db->where('YEAR(FROM_UNIXTIME(kegiatan.periode_waktu_akhir))',date('Y'));
	// 		 $this->db->where('tipe >=',$type_min);
	// 		 if($type_min == 1){
	// 		 	$this->db->order_by('tipe','asc');
	// 		 }
	// 		$q = $this->db->get('kegiatan');
	// 		return $q->result(); 
	// 	}

	// }

	// function get_all_bymonth($post_data){
	// 	$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
	// 	$tanggal_akhir = strtotime(date('Y/m/d 23:59:59',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));
	// 	$prov = array('6300','6351','6352','6353','6354','6355','6356');
	// 	if (in_array($this->session->userdata('wilayah')->kode, $prov)) {
	// 		$this->db->where('(wilayah = "6300" OR wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356")');
	// 		$this->db->where('( from_unixtime(periode_waktu_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(periode_waktu_akhir,"%m") >= '.$post_data['bulan'].')');
	//         $this->db->where('from_unixtime(periode_waktu_awal,"%Y")', $post_data['tahun']);
	// 		$q = $this->db->get('kegiatan');
	// 		return $q->result(); 
	// 	}else{
	// 		$this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
	// 		$q = $this->db->get('kegiatan');
	// 		return $q->result(); 
	// 	}

	// }

	// function get_all_array(){
	// 	return array_assoc_by('id', $this->db->get('kegiatan')->result_array());
	// }
	
	// function get_all_lds(){
	// 	$tahun = (string)date('Y');
	// 	$prov = array('6300','6351','6352','6353','6354','6355','6356');
	// 	if(in_array($this->session->userdata('wilayah')->kode, $prov)){
	//         $this->db->where('(wilayah = "6300" OR wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356")');
	//         $this->db->where('tahun_lds', $tahun);
	// 		$q= $this->db->get('kegiatan_anggaran');
	// 		return $q->result(); 
	// 	}else{

	//         $this->db->where('wilayah',$this->session->userdata('wilayah')->kode);
	//         $this->db->where('tahun_lds', $tahun);
	//         $q= $this->db->get('kegiatan_anggaran');
	// 		return $q->result(); 
	// 	}
	// }

	// function get_all_table($post_data){
	// 	$prov = array('6300','6351','6352','6353','6354','6355','6356');
	// 	if(in_array($this->session->userdata('wilayah')->kode, $prov)){
	// 		$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
	// 		$tanggal_akhir = strtotime(date('Y/m/d 23:59:59',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

	// 		$this->datatables->select('id,nama,periode_waktu_awal,periode_waktu_akhir,from_unixtime(periode_waktu_awal,"%Y")');
	// 		$this->datatables->from('kegiatan');
	// 		$this->datatables->where('( from_unixtime(periode_waktu_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(periode_waktu_akhir,"%m") >= '.$post_data['bulan'].')');
	//         $this->datatables->where('(wilayah = "6300" OR wilayah = "6351" OR wilayah = "6352" OR wilayah = "6353" OR wilayah = "6354" OR wilayah = "6355" OR wilayah = "6356")');
	//         $this->datatables->where('from_unixtime(periode_waktu_awal,"%Y")', $post_data['tahun']);
	// 		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
	// 			data-toggle="modal" data-id="$1" data-nama="$2" data-periode_waktu_awal="$3" data-periode_waktu_akhir="$4"
	//                             data-target="#modal-edit"
	//                             title="Edit Kegiatan"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
	//                             data-toggle="modal" data-id="$1" data-nama="$2"
	//                             data-target="#modal-konfirmasi"
	//                             title="Hapus Kegiatan"> <i class="fa fa-remove"> </i> </a>', 'id,nama,date("d-m-Y",periode_waktu_awal),date("d-m-Y",periode_waktu_akhir)');
	// 		$this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
	// 		$this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
	// 		return $this->datatables->generate();
	// 	}else{
	// 		$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
	// 		$tanggal_akhir = strtotime(date('Y/m/d 23:59:59',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

	// 		$this->datatables->select('id,nama,periode_waktu_awal,periode_waktu_akhir,from_unixtime(periode_waktu_awal,"%Y")');
	// 		$this->datatables->from('kegiatan');
	// 		$this->datatables->where('( from_unixtime(periode_waktu_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(periode_waktu_akhir,"%m") >= '.$post_data['bulan'].')');
	//         $this->datatables->where('wilayah',$this->session->userdata('wilayah')->kode);
	//         $this->datatables->where('from_unixtime(periode_waktu_awal,"%Y")', $post_data['tahun']);
	// 		$this->datatables->add_column('aksi', '<a href="javascript:;" type="button" class="btn-sm btn-warning" 
	// 			data-toggle="modal" data-id="$1" data-nama="$2" data-periode_waktu_awal="$3" data-periode_waktu_akhir="$4"
	//                             data-target="#modal-edit"
	//                             title="Edit Kegiatan"> <i class="fa fa-edit"> </i></a><a href="javascript:;" type="button" class="btn-danger btn-sm"
	//                             data-toggle="modal" data-id="$1" data-nama="$2"
	//                             data-target="#modal-konfirmasi"
	//                             title="Hapus Kegiatan"> <i class="fa fa-remove"> </i> </a>', 'id,nama,date("d-m-Y",periode_waktu_awal),date("d-m-Y",periode_waktu_akhir)');
	// 		$this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
	// 		$this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
	// 		return $this->datatables->generate();
	// 	}
		
	// }

	// function add($post_data){

	// 	if ($post_data) {
	// 		if(!cek_tanggal($post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
	// 			return json_encode(array('status'=>'failed','message'=>'Tanggal awal harus kurang dari tanggal akhir.'));
	// 		}
	// 		$isian =  array(
	// 		    'nama' => $post_data['nama'],
	// 		    'periode_waktu_awal' => strtotime($post_data['periode_waktu_awal']),
	// 		    'periode_waktu_akhir' => strtotime($post_data['periode_waktu_akhir']),
	// 		    'wilayah' => $this->session->userdata('wilayah')->kode
	// 		);
	// 		$this->db->insert('kegiatan',$isian);		    
	// 	}
  
	// 	if($this->db->affected_rows()){
	// 		return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan'));
    //     }else{
    //      	return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database')); 
    //     }      
	// }

	// function edit($post_data){
	// 	if ($post_data) {
	// 		if(!cek_tanggal($post_data['periode_waktu_awal'],$post_data['periode_waktu_akhir'])){
	// 			return json_encode(array('status'=>'failed','message'=>'Tanggal awal harus kurang dari tanggal akhir.'));
	// 		}
	// 		$isian =  array(
	// 		    'nama' => $post_data['nama'],
	// 		    'periode_waktu_awal' => strtotime($post_data['periode_waktu_awal']),
	// 		    'periode_waktu_akhir' => strtotime($post_data['periode_waktu_akhir']),
	// 		);
	// 		$this->db->where('id',$post_data['id']);
	// 		$this->db->update('kegiatan',$isian);		    
	// 	}
  
	// 	if($this->db->affected_rows()){
	// 		return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan'));
    //     }else{
    //      	return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database'));  
    //     }      
	// }

	// function delete($id){
	// 	if($id == 1){
	// 		$this->session->set_flashdata('failed', 'Kegiatan tidak dapat dihapus');
    //         redirect('/kegiatan');  
	// 	}
	// 	$this->db->delete('kegiatan', array('id' => $id));
	// 	if($this->db->affected_rows()){
	// 		$this->session->set_flashdata('success', 'Kegiatan berhasil dihapus');
    //         redirect('/kegiatan');  
    //     }else{
    //      	$this->session->set_flashdata('failed', 'Hapus data gagal');
    //         redirect('/kegiatan');  
    //     } 
	// }
}