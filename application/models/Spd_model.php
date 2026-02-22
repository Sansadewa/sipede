<?php

/**
 * 
 */
class Spd_model extends CI_model
{
	
	function get_byMtxId($id){
		$this->db->where('id_matriks',$id);
		$q= $this->db->get('surat_perjalanan');
		return $q->row();
	}

/*    function get_for_wilayah($id)){
        $tanggal_awal = strtotime(date('Y/m/d 00:00:00',strtotime('01-'.$post_data['bulan'].'-'.$post_data['tahun'])));
        $tanggal_akhir = strtotime(date('Y/m/d 00:00:00',strtotime($number_days.'-'.$post_data['bulan'].'-'.$post_data['tahun'])));

        $this->db->select();
        $this->db->from('surat_perjalanan sp');
        $this->db->join('matriks_kegiatan mtx','mtx.id = sp.id_matriks');

        $this->db->where('id_matriks',$id);
        $q= $this->db->get();
        return $q->row();
    }*/


	function get_print_spd($id){
        $prov = array('6300','6351','6352','6353','6354','6355','6356');
        if(in_array($this->session->userdata('wilayah')->kode, $prov)){
          //  if($this->session->userdata('wilayah')->kode == '6300'){
                $this->db->where('id_matriks',$id);

                $this->db->update('surat_tugas',array('status'=>2,'pencetak'=>$this->session->userdata('username')));
          //  }
        }else{
            $this->db->where('id_matriks',$id);
            $this->db->update('surat_tugas',array('status'=>2));
        }
    		$this->db->select('mtx.nip,peg.nama as nama,jab.des_jabatan as jabatan, pang.des_pangkat as pangkat,ns.nomor as nomor, ns.perihal as tugas,ns.tanggal as tanggal_surat,sppd.tanggal as tanggal_sppd,sppd.nomor as no_sppd,st.waktu,st.template,st.tugas as perihal,mtx.kode_kegiatan,sby.akun_bayar,spd.kendaraan,spd.berangkat,spd.tujuan,mtx.tanggal_awal,mtx.tanggal_akhir, keg.nama as kegiatan,st.is_pengawasan,mtx.array_tanggal,st.id as st_id,st.visum_nama,st.visum_nip,st.visum_jabatan,st.opsi_lembar4');
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
                        $surat->jabatan = $pgw->nm_jab;
                    }else{
                        $surat->jabatan = $pgw->nm_jab;
                    }
                }else{
                    $surat->jabatan = $pgw->nm_jab;
                }
            }

            return $surat;
	}

    function get_print_st($id){
        $prov = array('6300','6351','6352','6353','6354','6355','6356');
        if(in_array($this->session->userdata('wilayah')->kode, $prov)){
            if($this->session->userdata('wilayah')->kode == '6300'){
                $this->db->where('id_matriks',$id);
                $this->db->update('surat_tugas',array('status'=>2));
            }
        }else{
            $this->db->where('id_matriks',$id);
            $this->db->update('surat_tugas',array('status'=>2));
        }
            $this->db->select('mtx.nip,peg.nama as nama,jab.des_jabatan as jabatan, pang.des_pangkat as pangkat,ns.nomor as nomor, ns.perihal as tugas,ns.tanggal as tanggal_surat,st.tugas as perihal,st.waktu,st.template,mtx.tanggal_awal,mtx.tanggal_akhir, keg.nama as kegiatan,st.is_pengawasan,mtx.array_tanggal');
            $this->db->from('matriks_kegiatan mtx');
            $this->db->join('pegawai peg','peg.nip=mtx.nip');
            $this->db->join('kegiatan keg','keg.id=mtx.kegiatan');
            $this->db->join('jabatan jab','jab.id=peg.jabatan');
            $this->db->join('pangkat pang','pang.id=peg.panggol');
            $this->db->join('surat_tugas st', 'mtx.id = st.id_matriks');
            $this->db->join('no_surat ns','ns.id = st.tanggal_surat');
            $this->db->where('mtx.id',$id);
            $surat = $this->db->get('matriks_kegiatan')->row();

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

        private function get_hari($surat){
                if($surat->waktu == 1){
                    $jangka_waktu = $lama." (".$this->terbilang($lama).") hari"." ".date("j",strtotime($surat->tanggal_awal))." ".
                $this->getBulan(intval(date("m",strtotime($surat->tanggal_awal)))-1)." ".date("Y",strtotime($surat->tanggal_awal));
                }else{
                    $jangka_waktu = $lama." (".$this->terbilang($lama).") hari"." ".date("j",strtotime($surat->tanggal_awal))." s.d ".date("j",strtotime($surat->tanggal_akhir))." ".
                $this->getBulan(intval(date("m",strtotime($surat->tanggal_awal)))-1)." ".date("Y",strtotime($surat->tanggal_awal));
                }
        }
}