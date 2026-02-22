<?php

/**
 * 
 */
class Surat_bayar_model extends CI_Model
{

	protected $array_prov = array('6300','6351','6352','6353','6354','6355','6356');
	
	function get_byMtxId($id,$with_no=TRUE){
		if($with_no){
			$this->db->select('sby.id,sby.id_spd,sby.akun_bayar,sby.no_surat_bayar,sby.waktu_harian,sby.uang_harian,sby.uang_transport,sby.waktu_fullboard,sby.uang_harian_fullboard,sby.waktu_penginapan,sby.waktu_penginapan_kwitansi,
			sby.uang_penginapan,sby.uang_penginapan_kwitansi,sby.uang_total,sby.uang_representatif,no.nomor as no_sby,sby.opsi_cc,sby.is_pernyataan_tdk_menginap,transport_cc,penginapan_cc,opsi_print');
			$this->db->from('surat_bayar sby');
			$this->db->join('no_surat no','no.id=sby.no_surat_bayar');
			$this->db->where('sby.id_matriks',$id);
			$q= $this->db->get();
			return $q->row();
		}else{
			$this->db->where('id_matriks',$id);
			$q= $this->db->get('surat_bayar');
			return $q->row();
		}
	}

	function get_print_sby($id){
		$this->db->where('id_matriks',$id);
        $this->db->update('surat_tugas',array('status'=>2));
    		$this->db->select('mtx.id,mtx.nip,mtx.array_tanggal,peg.nama as nama,jab.des_jabatan as jabatan, pang.des_pangkat as pangkat,pang.golongan as golongan,ns.nomor as nomor, ns.perihal as tugas,ns.tanggal as tanggal_surat,sppd.tanggal as tanggal_sppd,sppd.nomor as no_sppd,st.id as id_st,st.waktu,st.template as template,sby.id as id_sby,sby.*,spd.berangkat,spd.tujuan,mtx.tanggal_awal,mtx.tanggal_akhir, keg.nama as kegiatan,st.tugas as tugas_spd,sby.opsi_cc,sby.is_pernyataan_tdk_menginap,transport_cc,penginapan_cc,opsi_print,mtx.kode_kegiatan');
            $this->db->from('matriks_kegiatan mtx');
            $this->db->join('pegawai peg','peg.nip=mtx.nip');
            $this->db->join('kegiatan keg','keg.id=mtx.kegiatan');
            $this->db->join('jabatan jab','jab.id=peg.jabatan');
            $this->db->join('pangkat pang','pang.id=peg.panggol');
            $this->db->join('surat_tugas st', 'mtx.id = st.id_matriks');
            $this->db->join('surat_bayar sby', 'mtx.id = sby.id_matriks');
            $this->db->join('surat_perjalanan spd', 'mtx.id = spd.id_matriks');
            $this->db->join('no_surat ns','ns.id = st.tanggal_surat');
            $this->db->join('no_surat sppd','sppd.id = st.tanggal_sppd');
            $this->db->where('mtx.id',$id);
             $surat = $this->db->get('matriks_kegiatan')->row();

             if($surat->kode_kegiatan){
                $surat->akun_bayar = $surat->kode_kegiatan;
            }
            
            $ckpdb = $this->load->database('ckponline', TRUE);     
            $ckpdb->select('users.*,seksi.*,bidang.*,jabatan.id_jab,jabatan.nm_jab,jabatan.level_fungsional,jabatan.grade_fungsional,jabatan.jf_id,jabatan.is_kpa,jabatan.is_aktif,jabatan.is_struktural');
            $ckpdb->join('jabatan','users.id_jab = jabatan.id_jab','left');
            $ckpdb->join('seksi','users.id_seksi = seksi.id_seksi','left');
            $ckpdb->join('bidang','users.id_bidang = bidang.id_bidang','left');
            $ckpdb->where('nip',$surat->nip);
            $pgw = $ckpdb->get('users')->row();

            if($pgw){
                if($pgw->is_struktural){
                $surat->jabatan = $pgw->nm_jab;
                }elseif($pgw->is_koordinator){
                    if($pgw->id_seksi){
                        $surat->jabatan = $pgw->nm_jab.' (SKF '.$pgw->nama_seksi.')';
                    }else{
                        $surat->jabatan = $pgw->nm_jab.' (KF '.$pgw->nama_bidang.')';
                    }
                }else{
                    $surat->jabatan = $pgw->nm_jab;
                }
            }

          return $surat;  
	}

	function get_all_table_ppk($post_data=NULL){
		if(isset($post_data['bulan']) & isset($post_data['tahun'])){
			if($this->session->userdata('wilayah')->kode == '6300'){
				$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

					$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->where('st.status >=',99);
		        $this->datatables->where('( from_unixtime(mtx.tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(mtx.tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(mtx.tanggal_awal,"%Y")', $post_data['tahun']);
		        /*$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
		        $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
		        $this->datatables->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
		        $this->datatables->add_column('aksi', '
		                <a href="javascript:form_print_ppk($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Ijinkan Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
		        $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
		        $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
			}else{
				$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

					$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->where('st.status >=',99);
		        $this->datatables->where('( from_unixtime(mtx.tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(mtx.tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(mtx.tanggal_awal,"%Y")', $post_data['tahun']);
		        /*$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
		        $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
		        $this->datatables->where('mtx.wilayah =',$this->session->userdata('wilayah')->kode);
		        $this->datatables->add_column('aksi', '
		                <a href="javascript:form_print_ppk($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Ijinkan Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
		        $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
		        $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
			}
		}else{
			if($this->session->userdata('wilayah')->kode == '6300'){
				$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->where('st.status >=',99);
		        $this->datatables->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
		        $this->datatables->add_column('aksi', '
		                <a href="javascript:form_print_ppk($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Ijinkan Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
			}else{
				$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->where('st.status >=',99);
		        $this->datatables->where('mtx.wilayah =',$this->session->userdata('wilayah')->kode);
		        $this->datatables->add_column('aksi', '
		                <a href="javascript:form_print_ppk($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Ijinkan Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
			}
		}
        return $this->datatables->generate();
	}

	function get_all_table($post_data=NULL){
		if(isset($post_data['bulan']) & isset($post_data['tahun'])){
			if($this->session->userdata('wilayah')->kode == '6300'){
				$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

				$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar,sts.deskripsi as status');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->join('status_spd sts','sts.id=st.status');
		        $this->datatables->where('st.status >',2);
		        $this->datatables->where('( from_unixtime(mtx.tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(mtx.tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(mtx.tanggal_awal,"%Y")', $post_data['tahun']);
		        /*$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
		        $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
		        $this->datatables->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
		        $this->datatables->add_column('aksi', '<a href="'.base_url('surat_bayar').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Bayar"> <i class="fa fa-edit"> </i></a>
		                <a href="javascript:form_print($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
		        $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
		        $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
			}else{
				$tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
		        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime(cal_days_in_month(CAL_GREGORIAN, $post_data['bulan'], $post_data['tahun']).'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

					$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar,sts.deskripsi as status');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->join('status_spd sts','sts.id=st.status');
		        $this->datatables->where('st.status >',2);
		        $this->datatables->where('( from_unixtime(mtx.tanggal_awal,"%m") <= '.$post_data['bulan'].' AND from_unixtime(mtx.tanggal_akhir,"%m") >= '.$post_data['bulan'].')');
                $this->datatables->where('from_unixtime(mtx.tanggal_awal,"%Y")', $post_data['tahun']);
		        /*$this->datatables->where('mtx.tanggal_awal >=', $tanggal_awal);
		        $this->datatables->where('mtx.tanggal_akhir <=', $tanggal_akhir);*/
		        $this->datatables->where('mtx.wilayah =',$this->session->userdata('wilayah')->kode);
		        $this->datatables->add_column('aksi', '<a href="'.base_url('surat_bayar').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Bayar"> <i class="fa fa-edit"> </i></a>
		                <a href="javascript:form_print($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
		        $this->datatables->edit_column('periode_waktu_awal', '$1','date("d-m-Y",periode_waktu_awal)');
		        $this->datatables->edit_column('periode_waktu_akhir', '$1','date("d-m-Y",periode_waktu_akhir)');
			}
		}else{
			if($this->session->userdata('wilayah')->kode == '6300'){
				$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar,sts.deskripsi as status');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->join('status_spd sts','sts.id=st.status');
		        $this->datatables->where('st.status >',2);
		        $this->datatables->where('(mtx.wilayah = "6351" OR mtx.wilayah = "6352" OR mtx.wilayah = "6353" OR mtx.wilayah = "6354" OR mtx.wilayah = "6355" OR mtx.wilayah = "6356" OR mtx.wilayah = "6300")');
		        $this->datatables->add_column('aksi', '<a href="'.base_url('surat_bayar').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Bayar"> <i class="fa fa-edit"> </i></a>
		                <a href="javascript:form_print($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
			}else{
				$this->datatables->select('mtx.id as id,peg.nama,peg.nip,keg.nama as keg_nama,
		        keg.id as keg_id,mtx.tanggal_awal as periode_waktu_awal,mtx.tanggal_akhir as periode_waktu_akhir,mtx.is_spd as is_spd,st.is_bayar,sts.deskripsi as status');
		        $this->datatables->from('matriks_kegiatan mtx');
		        $this->datatables->join('pegawai peg','peg.nip=mtx.nip');
		        $this->datatables->join('kegiatan keg','keg.id=mtx.kegiatan');
		        $this->datatables->join('surat_tugas st','mtx.id=st.id_matriks');
		        $this->datatables->join('status_spd sts','sts.id=st.status');
		        $this->datatables->where('st.status >',2);
		        $this->datatables->where('mtx.wilayah =',$this->session->userdata('wilayah')->kode);
		        $this->datatables->add_column('aksi', '<a href="'.base_url('surat_bayar').'/kelola?id=$1" class="btn-sm btn-warning" title="Kelola Surat Bayar"> <i class="fa fa-edit"> </i></a>
		                <a href="javascript:form_print($2,$1);" id="$1$2" data-target="#modal-konfirmasi" data-is_spd="$2" class="btn-sm btn-primary" title="Print Surat Bayar"> <i class="fa fa-print"> </i></a>', 'id,is_bayar');
			}
		}
        return $this->datatables->generate();
	}

	function get_byId($id){
		$this->db->where('id_matriks',$id);
		$q= $this->db->get('surat_bayar');
		return $q->row();
	}

	function add($post_data){
		if($post_data){
			$this->db->where('id',$post_data['id_sby']);
			$q = $this->db->get('surat_bayar');

			$rincian_tambahan = 0;

			$this->db->where('id_surat_bayar',$post_data['id_sby']);
			$tambahan = $this->db->get('uraian_bayar')->result_object();

			foreach ($tambahan as $key) {
				$rincian_tambahan += $key->biaya_tambahan;
			}

			$rincian_tambahan = $rincian_tambahan+( $post_data['waktu_penginapan']*$post_data['uang_penginapan']*0.3);

			$uang_total = ((int)$post_data['waktu_harian']*(int)$post_data['uang_harian'])+((int)$post_data['uang_harian_fullboard']*(int)$post_data['waktu_fullboard'])+(int)$post_data['uang_representatif']+$rincian_tambahan;
			$uang_cc = 0;

		//	if($post_data['opsi_cc'] == 1 || $post_data['opsi_cc'] == 2){
				$uang_cc = (int)$post_data['transport_cc'];
		//	}else{
				$uang_total += (int)$post_data['uang_transport'];
		//	}

		//	if($post_data['opsi_cc'] == 1 || $post_data['opsi_cc'] == 3){
				$uang_cc += (int)$post_data['penginapan_cc'];
		//	}else{
				$uang_total += ((int)$post_data['uang_penginapan_kwitansi']*$post_data['waktu_penginapan_kwitansi']);
	//		}

			if($post_data['penginapan_cc'] && $post_data['transport_cc']){
				$opsi_cc = 1;
			}elseif($post_data['transport_cc']){
				$opsi_cc = 2;
			}elseif($post_data['penginapan_cc']){
				$opsi_cc = 3;
			}else{
				$opsi_cc = null;
			}

			$data= array(
				'no_surat_bayar' => $post_data['no_sby'],
				'waktu_harian' => $post_data['waktu_harian'],
				'uang_harian' => $post_data['uang_harian'],
				'waktu_fullboard' => $post_data['waktu_fullboard'],
				'uang_harian_fullboard' => $post_data['uang_harian_fullboard'],
				'uang_transport' => $post_data['uang_transport'],
				'waktu_penginapan' => $post_data['waktu_penginapan'],
				'uang_penginapan' => $post_data['uang_penginapan'],
				'waktu_penginapan_kwitansi' => $post_data['waktu_penginapan_kwitansi'],
				'uang_penginapan_kwitansi' => $post_data['uang_penginapan_kwitansi'],
				'uang_representatif' => $post_data['uang_representatif'],
				'uang_riil' => $rincian_tambahan,
				'uang_total' => $uang_total,
				'uang_total_cc' => $uang_cc,
				'opsi_cc' => $opsi_cc,
				'opsi_print' => 1,
				'transport_cc' => $post_data['transport_cc'],
				'penginapan_cc' => $post_data['penginapan_cc'],
				'tanggal_dibuat' =>$post_data['tanggal_dibuat'],
				'is_pernyataan_tdk_menginap' => $post_data['is_pernyataan_tdk_menginap']
			);

			$this->db->where('id',$post_data['id_sby']);
			$insert = $this->db->update('surat_bayar',$data);

			if($insert){
				$data= array(
					'is_bayar' => 1
				);
				$this->db->where('id_matriks',$post_data['id_matriks']);
				$update = $this->db->update('surat_tugas',$data);

				$data= array(
					'perkiraan_biaya' => $uang_total
				);
				$this->db->where('id_matriks',$post_data['id_matriks']);
				$update = $this->db->update('surat_perjalanan',$data);

				if($update){
					$this->session->set_flashdata('success', 'Input data berhasil');
	            	redirect('/surat_bayar/kelola?id='.$post_data['id_matriks']);
				}else{
					$this->session->set_flashdata('failed', 'Input data gagal');
	            	redirect('/surat_bayar');
				}
        	}else{
	         	$this->session->set_flashdata('failed', 'Input data gagal');
	            redirect('/surat_bayar');  
        	}  
		}
	}

	function add_tambahan($post_data){
		$form_data = $post_data['form'];

		$this->db->insert('uraian_bayar',array('id_surat_bayar'=>$form_data['id_surat_bayar'],'rincian'=>$form_data['rincian'],'biaya_tambahan'=>$form_data['biaya_tambahan']));
		
		$this->db->where('id_surat_bayar',$form_data['id_surat_bayar']);
		$q = $this->db->get('uraian_bayar');

		$data = array('data'=>$q->result_array());

		return $data;
	}

	function delete_tambahan($id){
		$this->db->where('id_uraian_bayar',$id);
		$q = $this->db->delete('uraian_bayar');

		$data = array('data'=>'ok');

		return $data;
	}

	function edit(){

	}

	function set_bisa_bayar_ppk($post_data){
		$this->db->where('id_matriks',$post_data['id_matriks']);
		$q = $this->db->get('surat_tugas');
		if($q->row()){
			$st = $q->row();
			if($st->status <2){
				return json_encode(array('status'=>'failed','message'=>'SPPD belum dicetak'));
			}
			if($st->status == 3){
				return json_encode(array('status'=>'failed','message'=>'SPPD belum di periksa Keuangan'));
			}

			if($st->status ==99){
				$this->db->where('id_matriks',$post_data['id_matriks']);
				$this->db->update('surat_tugas',array('status'=>3));
				if($this->db->affected_rows()){
					return json_encode(array('status'=>'ok','message'=>'Set bisa bayar berhasil'));
				}else{
					return json_encode(array('status'=>'failed','message'=>'Set gagal, silahkan refresh halaman dan ulangi'));
				}
			}

		}else{
			return json_encode(array('status'=>'failed','message'=>'Rincian SPPD belum dilengkapi'));
		}
	}

	function set_bisa_bayar($post_data){
		$this->db->where('id_matriks',$post_data['id_matriks']);
		$q = $this->db->get('surat_tugas');
		if($q->row()){
			$st = $q->row();
			if($st->status <2){
				return json_encode(array('status'=>'failed','message'=>'SPPD belum dicetak'));
			}
			if($st->status >2){
				return json_encode(array('status'=>'failed','message'=>'SPPD sudah diset bisa bayar'));
			}

			if($st->status ==2){
				$this->db->where('id_matriks',$post_data['id_matriks']);
				if(in_array($this->session->userdata('wilayah')->kode, $this->array_prov) ){
					$this->db->update('surat_tugas',array('status'=>3));
				}else{
					$this->db->update('surat_tugas',array('status'=>3));
				}
				if($this->db->affected_rows()){
					return json_encode(array('status'=>'ok','message'=>'Set bisa bayar berhasil'));
				}else{
					return json_encode(array('status'=>'failed','message'=>'Set gagal, silahkan refresh halaman dan ulangi'));
				}
			}

		}else{
			return json_encode(array('status'=>'failed','message'=>'Rincian SPPD belum dilengkapi'));
		}
	}

		
}