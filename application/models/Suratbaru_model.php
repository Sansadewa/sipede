<?php

/**
 * 
 */
class Suratbaru_model extends CI_Model
{

	function __construct(){
		$this->load->library('datatables');
	}

	function getjenis(){
		$this->db->where('view', 1);
		$q = $this->db->get('jenis_surat_baru');
		return $q->result_array();
	}

	function getjenis2(){
		$this->db->where('view', 1);
		$q = $this->db->get('jenis_surat_baru');
		return $q->result();
	}

	function get_kode_organisasi($request=NULL){
		$this->db->distinct();
		$this->db->select('kode_organisasi');
		$this->db->where('YEAR(tanggal_surat)', 2024);
		$q = $this->db->get('no_surat_baru');
		return $q->result();
	}

	function get_nomor_surat($tanggal,$kodeorg, $jenis){
			$this->db->where('YEAR(tanggal_surat)', $tanggal);
			$this->db->where('jenis_surat', $jenis);
			$this->db->where('kode_organisasi', $kodeorg);
			if($jenis==2){
				$this->db->not_like('kode', "DEPR. KP.6");
			}
			$this->db->order_by("CAST(nomor AS SIGNED)", "DESC");
			$this->db->limit(1);
			
			$q=$this->db->get('no_surat_baru');
			return $q->row(); 
	}

    function validate_nomor($nomor,$datetime,$kodeorg,$jenissurat){
			$this->db->where('kode_organisasi', $kodeorg);
			$this->db->where('jenis_surat', $jenissurat);
			$this->db->where('YEAR(tanggal_surat)', date('Y', strtotime($datetime)));
			$this->db->where('nomor', $nomor);
			$q=$this->db->get('no_surat_baru');
			return $q->row();
    }

	function tambah($post){
		$isian =  array(
					    'sifat' => $post['sifat'],
					    'kode_organisasi' => $post['kode_organisasi'],
					    'nomor' => $post['nomor'],
					    'jenis_surat' => $post['jenissurat'],
					    'kode' => $post['kode'],
					    'kategori1' => $post['kategori1'],
					    'kategori2' => $post['kategori2'],
					    'kategori3' => $post['kategori3'],
					    'kategori4' => $post['kategori4'],
					    'tim_kerja' => $post['timkerja'],
					    'tujuan' => $post['tujuan'],
					    'perihal' => $post['perihal'],
					    'catatan' => $post['catatan'],
					    'pembuat' => $this->session->userdata('username'),
					    'tanggal_surat' => date('Y-m-d', strtotime($post['tanggal'])),
					    // menghilangkan bulan
						// 'full_kode' => ($post['sifat']=='Biasa'? 'B' : 'R').'-'.$post['nomor'].'/'.$post['kode_organisasi'].'/'.$post['kode'].'/'.date('m', strtotime($post['tanggal'])).'/'.date('Y', strtotime($post['tanggal']))
					);
					if ($post['jenissurat'] != 1) {
						$isian['full_kode'] = ($post['sifat']=='Biasa'? 'B' : ($post['sifat']=='Rahasia'? 'R' : 'T')).'-'.$post['nomor'].'/'.$post['kode_organisasi'].'/'.$post['kode'].'/'.date('Y', strtotime($post['tanggal']));
					} else {
						$isian['full_kode'] = ($post['nomor'].'/'.$post['kode_organisasi'].'/'.$post['kode'].'/'.date('Y', strtotime($post['tanggal'])));
					}
					$this->db->insert('no_surat_baru',$isian);
					return $isian['full_kode'];
	}

    function get_all($data){
        $this->datatables->select('no_surat_baru.id, sifat, kode_organisasi, nomor, kode, nama_jenis, jenis_surat, kategori1, kategori2, kategori3, kategori4, full_kode, tim_kerja, tujuan, perihal, catatan, tanggal_surat');
        $this->datatables->from('no_surat_baru');
		$this->datatables->join('jenis_surat_baru', 'no_surat_baru.jenis_surat = jenis_surat_baru.id', 'left');
		$jenis = '';
		if (!$data['jenis'] == "all") $jenis = ' AND jenis_surat = '.$data['jenis'];
        $this->datatables->where('MONTH(tanggal_surat) = '.$data['bulan'].' AND YEAR(tanggal_surat)= '.$data['tahun'].' AND kode_organisasi='.$data['kodeorg'].$jenis);
        // $this->datatables->add_column('aksi', 'belum tersedia');
        
        $this->datatables->add_column('aksi', '
        <a href="javascript:;" type="button" class="btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit" title="Edit Nomor Surat"
        data-id="$1" data-fullkode="$2" data-org="$3" data-tim="$4" data-tujuan="$5" data-perihal="$6" data-tanggal="$7" data-catatan="$8"
        > <i class="fa fa-edit"> </i></a>
        
        <a href="javascript:;" type="button" class="btn-danger btn-sm" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus No Surat"
        data-id="$1" data-fullkode="$2"
        > <i class="fa fa-remove"> </i> </a>', 'id, full_kode, kode_organisasi, tim_kerja, tujuan, perihal, tanggal_surat, catatan');
        return $this->datatables->generate();
    }

	function get_all_surtug($year,$detail=FALSE){
		if ($detail) $this->db->where('YEAR(tanggal_surat)', $year);
		$this->db->get('surat_tugas_baru');
	}

    function edit($post_data){
		if ($post_data) {
            $isian = array (
                'tim_kerja' => $post_data['tim_kerja_edit'],
                'tujuan' => $post_data['tujuan_edit'],
                'perihal' => $post_data['perihal_edit'],
                'catatan' => $post_data['catatan_edit'],
            );
			$this->db->where('id',$post_data['id']);
			$this->db->update('no_surat_baru',$isian);		    
		}
  
		if($this->db->affected_rows()){
			return json_encode(array('status'=>'ok','message'=>'Data berhasil disimpan'));
        }else{
         	return json_encode(array('status'=>'failed','message'=>'Gagal menyimpan ke database'));  
        }      
	}

	function delete($id){
        $this->db->delete('no_surat_baru', $id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('success', 'Nomor Surat berhasil dihapus');
        }else{
         	$this->session->set_flashdata('failed', 'Hapus data gagal');
        } 
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


}